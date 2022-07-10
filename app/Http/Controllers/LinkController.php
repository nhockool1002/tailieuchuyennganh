<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Link\CreateLink;
use DB;
use Auth;
use App\Log;
use App\User;
use App\Link;
use App\S3Manage;
use App\ServiceApiShortLink;
use App\TokenApiShortLink;

class LinkController extends Controller
{
    public function getlLinkConfig() {
    	$service = ServiceApiShortLink::all();
    	$token = TokenApiShortLink::where('user_id', Auth::user()->id)->first();
			$allurl = Link::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
    	$member = Auth::user();
			$s3Link = S3Manage::orderBy("id", "DESC")->get();
    	return view('backend.link.index', compact('service', 'member', 'token', 'allurl', 's3Link'));
    }

    public function updateService(Request $request) {
    	$this->validate($request, 
    		[
    			'service' => 'required|integer'
    		], 
    		[
    			'service.required' => 'Main Service can\'t not empty.',
    			'service.integer' => 'Main Service is number',
    		]);
    	$service = ServiceApiShortLink::all();
    	$data = [];
    	foreach($service as $item) {
    		$data[$item->key_service] = $request->input($item->key_service);
    	}
    	$data = json_encode($data);
    	if (TokenApiShortLink::where('user_id', Auth::user()->id)->count() > 0) {
    		$api_token = TokenApiShortLink::where('user_id', Auth::user()->id)->first();
    		$api_token->api_token = $data;
    		$api_token->user_id = Auth::user()->id;
    		$api_token->save();
    	}
    	else {
    		$api_token = new TokenApiShortLink();
    		$api_token->api_token = $data;
    		$api_token->user_id = Auth::user()->id;
    		$api_token->save();
    	}

    	$user = User::find(Auth::user()->id);
    	$user->service_shortlink_id = $request->service; 
    	$user->save();

    	$log = new Log();
        $log->changelog = 'Update'.'<b><font color="#969415">'.' Main Service Configure '.'</font></b>'.' of <b>'.Auth::user()->username.'</b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::GENERAL_SERVICE_LINK_FUNCTION;
        $log->save();

        return redirect(route('link',['param' => 'update_service']))->with('success_mesage','Update your main service successfully.');
    }

    public function storeService(Request $request) {
    	$this->validate($request, 
    		[
    			'service' => 'required',
    			'api_url' => 'required'
    		], 
    		[
    			'service.required' => 'Service name can\'t not empty.',
    			'api_url.required' => 'Service API URL can\'t not empty.',
    		]);

    	$service = new ServiceApiShortLink();
    	$service->name_service = $request->service;
    	$service->key_service = $request->service;
    	$service->api_service_url = $request->api_url;
    	$service->save();

    	$log = new Log();
        $log->changelog = 'Add New '.'<b><font color="#30b232">'.$request->service.'</font></b>'.' Service successfully';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::ADD_SERVICE_SHORTLINK_FUNCTION;
        $log->save();

        return redirect(route('link',['param' => 'service']))->with('success_mesage','Add new service successfully.');
    }

    public function deleteService($id) {
    	$service = ServiceApiShortLink::find($id);
        $user = Auth::user();

        if ($service->id == $user->service_shortlink_id) {
            return back()->with('warning_mesage','Can\'t delete your main service.');
        }
    	$name = $service->name_service;

    	$service->delete();

    	$log = new Log();
        $log->changelog = 'Delele '.'<b><font color="#8c3117">'.$name.'</font></b>'.' Service successfully';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::DELETE_SERVICE_SHORTLINK_FUNCTION;
        $log->save();

        return redirect(route('link',['param' => 'service']))->with('success_mesage','Delete service successfully.');
    }

    public function createLink(CreateLink $request) {
    	if (TokenApiShortLink::where('user_id', Auth::user()->id)->count() == 0) {
    		return redirect(
					route('link',	['param' => 'create']))
					->with('warning_mesage', \Constant::TOKEN_API_EMPTY
				);
    	}
    	
			$service = ServiceApiShortLink::all();
			$token = TokenApiShortLink::where('user_id', Auth::user()->id)->first();
			$token = json_decode($token->api_token, true);
			$data = [];

			foreach ($service as $item) {
				$long_url = urlencode($request->link);
				$api_token = $token[$item->key_service];

				if ($api_token != null) {
					$api_url = $item->api_service_url."api={$api_token}&url={$long_url}";
					$result = @json_decode(file_get_contents($api_url),TRUE);

					if($result['status'] === 'error') {
						return redirect(
							route('link', ['param' => 'create']))
							->with('warning_mesage', \Constant::UNVALID_URL_OR_TOKEN_API
						);
					} else {
						$data[$item->key_service] = $result['shortenedUrl'];
					}
				}
			}

			// Insert Multi Table
			DB::beginTransaction();
			try {
				// Insert Link list
				$link = new Link();
				$link->link_title = $request->title;
				$link->origin_link = $request->link;
				$link->hash = $this->generateString();
				$link->user_id = Auth::user()->id;
				$link->shorten_list = json_encode($data);
				$link->save();

				// Insert Log
				$log = new Log();
        $log->changelog = 'Create Shortlink '.'<b><font color="#89f442">'.$request->title.'</font></b>'.' successfully';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::CREATE_SHORTLINK_FUNCTION;
        $log->save();

				DB::commit();
				return redirect(
					route('link', ['param' => 'create'])
				)->with('link_created',$link->hash);
			} catch (\Throwable $th) {
				DB::rollBack();
				return redirect(
					route('link', ['param' => 'create'])
				)->with('link_created_error', \Constant::CREATE_SHORT_LINK_ERROR);
			}
    }

    public function getRedirect($string) {
    	if (Link::where('hash', $string)->count() == 0) {
    		return redirect(route('home'));
    	}
    	$link = Link::where('hash', $string)->first();
    	$key_service = $link->user->serviceapishortlink->key_service;
    	$data = json_decode($link->shorten_list, TRUE);
    	$token = TokenApiShortLink::where('user_id', $link->user->id)->first();
    	$token = json_decode($token->api_token, true);
    	if (empty($data[$key_service]) || $data[$key_service] === null) {
    		$shorten_list = json_decode($link->shorten_list, TRUE);
            $long_url = $link->origin_link;
            $api_service = $token;
            $api_token = $api_service[$key_service];
			$service = ServiceApiShortLink::where('key_service', $key_service)->first();
			$api_url = $service->api_service_url."api={$api_token}&url={$long_url}";
			$result = @json_decode(file_get_contents($api_url),TRUE);
			if($result['status'] === 'error') {
				return redirect(route('link',['param' => 'create']))->with('warning_mesage','Please check URL or Token API on General page');
			} else {
				$data[$key_service] = $result['shortenedUrl'];
				$data = json_encode($data);
				$link->shorten_list = $data;
				$link->save();

                $url = Link::where('hash', $string)->first();
                $rURL = json_decode($url->shorten_list, TRUE);
				return redirect($rURL[$key_service]);
			}
    	}
    	else {
    		return redirect($data[$key_service]);
    	}
    }

    public function deleteLink($id) {
        $link = Link::find($id);
        $hash = $link->hash;

        $link->delete();

        $log = new Log();
        $log->changelog = 'Delete Shortlink '.'<b><font color="#2c114c">'.$hash.'</font></b>'.' successfully';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::DELETE_SHORTLINK_FUNCTION;
        $log->save();

        return redirect(route('link',['param' => 'yourlink']))->with('success_mesage','Delete shortlink successfully.');
    }

    private function generateString() {
    	$stTitle = rand_string(7);
    	if (Link::where('hash', $stTitle)->count() > 0) {
    		generateString();
    	}
    	return $stTitle;
    }

}

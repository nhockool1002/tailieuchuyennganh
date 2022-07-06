<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ads;
use App\Log;
use Auth;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{
    public function getAll() {
    	$ads = Ads::all();
    	return view('backend.ads.index', compact('ads'));
    }

    public function storeAll(Request $request) {
    	foreach ($request->data as $key => $item) {
    		$ads = Ads::find($key);
    		$ads->ads_img = $item['ads_img'];
    		$ads->target_link = $item['target_link'];
    		$ads->save();
    		unset($ads);
    	}

    	$log = new Log();
        $log->changelog = 'Update '.'<b><font color="#ff14a5">Advertisement</font></b> successfully.';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::ADVERTISEMENT_STORE_FUNCTION;
        $log->save();

        return redirect(route('ads'))->with('success_mesage','Update Advertisement successfully.');
    }
}

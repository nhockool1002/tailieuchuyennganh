<?php

namespace App\Http\Controllers;

use App;
use App\S3Manage;
use App\Log as LogCustom;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class S3ManageController extends Controller
{
    public function uploadS3(Request $request) {
        if(!$request->hasFile('itemS3')){
            abort(404);
        }

        $path = $request->file('itemS3')->getPathName();
        $name = $request->file('itemS3')->getClientOriginalName();
        $md5 = md5($name);
        $date = date("Y-m-d-H-i-s");

        $key = $md5 . "_" . $date . "_" . $name;
        try {
            $s3 = App::make('aws')->createClient('s3');

            try {
                $s3->putObject([
                    'Key' => $key,
                    'SourceFile' => $path,
                    'Bucket' => env('AWS_BUCKET'),
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect(
                    route('link',['param' => 'create'])
                )->with('s3_warning_message', \Constant::CREATE_S3_ERROR);
            }
            
            DB::beginTransaction();
            try {
                $link = new S3Manage();
                $link->title = $name;
                $link->hash = $key;
                $link->save();


                // Insert Log
				$log = new LogCustom();
                $log->changelog = 'Create S3 Link '.'<b><font color="#89f442">'.$name.'</font></b>'.' successfully';
                $log->user = Auth::user()->username;
                $log->screen = \Constant::CREATE_S3_FUNCTION;
                $log->save();
                
                DB::commit();
                return redirect(
					route('link', ['param' => 'create'])
				)->with('link_s3_created',$key);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
				return redirect(
					route('link', ['param' => 'create'])
				)->with('link_created_s3_error', \Constant::CREATE_S3_ERROR);
            }
        } catch (\Exception $e) {
            return redirect(
                route('link', ['param' => 'create'])
            )->with('link_created_s3_error',$e->getMessage());
        }
    }

    public function gotoS3Link($slug) {
        $item = S3Manage::where("hash", $slug)->first();
        if ($item !== null) {
            $s3 = App::make('aws')->createClient('s3');
        
            $cmd = $s3->getCommand('GetObject', [
                'Bucket' => env('AWS_BUCKET'),
                'Key'    => $slug
            ]);

            $request = $s3->createPresignedRequest($cmd, '+10 minutes');
            $presignedUrl = (string) $request->getUri();

            header("Location: " . $presignedUrl);
            die();
        } else {
            abort(404);
        }
    }

    public function deleteS3Link($id) {
        $item = S3Manage::where("id", $id)->first();

        if($item !== null) {
            try {
                $s3 = App::make('aws')->createClient('s3');
                $s3->deleteObject([
                    'Bucket' => env('AWS_BUCKET'),
                    'Key'    => $item->hash
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                abort(404);
            }
            try {                
                DB::beginTransaction();
                try {
                    S3Manage::where("id", $id)->forceDelete();
                    DB::commit();
                    return redirect(
                        route('link', ['param' => 'create'])
                    )->with('s3_success_message', \Constant::DELETE_S3_COMPLETED);
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect(
                        route('link', ['param' => 'create'])
                    )->with('link_created_s3_error', \Constant::DELETE_S3_ERROR);
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return redirect(
                    route('link', ['param' => 'create'])
                )->with('link_created_s3_error',$e->getMessage());
            }
        } else {
            abort(404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HashTag;
use App\PostHashTag;
class HashTagController extends Controller
{
    public function filterHashTag(Request $request) {
        return HashTag::where('hashtag_name', 'LIKE', '%'.$request->q.'%')->get();
    }

    public function removeHashTag(Request $request) {
        if ($request->ajax()) {
            $postID = $request->postID;
            $hashtagID = $request->hashtagID;
            $getTAG = PostHashTag::where('post_id', $postID)->where('hashtag_id', $hashtagID)->first();
            $getTAG->delete();
        }
    }

    public function getAllHashTagSetting() {
        $hashtaglist = HashTag::all();
        return view('backend.setting.hashtag.index', compact('hashtaglist'));
    }

    public function deleteHashtag($id) {
        $hashtag = HashTag::find($id);
        $hashtag->delete();
        return back()->with('success_mesage', 'Xóa Hashtag thành công');
    }
}

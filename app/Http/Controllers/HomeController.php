<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCommentsRequest;
use App\ProfileComments;
use App\User;
use App\UserTpoint;
use Illuminate\Http\Request;
use App\Menu;
use App\Post;
use App\Ads;
use App\Category;
use App\Setting;
use App\Like;
use App\DonateListCourse;
use Auth;
use DB;
use Exception;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getHome()
    {
        $menus = Menu::all();
        $cats = Category::all();
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $recent3post1 = Post::orderBy('id', 'desc')->take(3)->get();
        $recent3post2 = Post::orderBy('id', 'desc')->skip(3)->take(3)->get();
        $stickytop2post = Post::where('post_special', '1')->orderBy('id', 'desc')->take(2)->get();
        $random7post = Post::inRandomOrder()->take(7)->get();
        $random2book = Post::where('cat_id', '21')->inRandomOrder()->take(2)->get();
        $digital3post = Post::where('cat_id', '23')->orderBy('id', 'desc')->take(3)->get();
        $foreign4post = Post::where('cat_id', '22')->orderBy('id', 'desc')->take(6)->get();
        $graphic6post = Post::where('cat_id', '20')->orderBy('id', 'desc')->take(4)->get();
        $homepage_rightside_300x250_first = Ads::where('ads_zone', 'homepage_rightside_300x250_first')->first();
        $homepage_rightside_300x250_second = Ads::where('ads_zone', 'homepage_rightside_300x250_second')->first();
        $popup = Setting::where('config_name', 'popup')->first();
        $popup = json_decode($popup->config_setting, TRUE);
        $category_top_content_728x90 = Ads::where('ads_zone', 'category_top_content_728x90')->first();

        return view('frontend.home.index', compact('menus', 'recent3post', 'stickytop2post', 'recent3post1', 'recent3post2', 'random7post', 'random2book', 'digital3post', 'foreign4post', 'graphic6post', 'cats', 'homepage_rightside_300x250_first', 'homepage_rightside_300x250_second', 'popup', 'category_top_content_728x90'));
    }

    public function getDonatePage()
    {
        $menus = Menu::all();
        $cats = Category::all();
        $courses = DonateListCourse::orderBy('cat_id', 'DESC')->get();
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $relatepost = Post::inRandomOrder()->take(3)->get();
        $category_right_widget_320x250 = Ads::where('ads_zone', 'category_right_widget_320x250')->first();
        $category_top_content_728x90 = Ads::where('ads_zone', 'category_top_content_728x90')->first();
        $notice = Setting::where('config_name', 'donate_info')->get();
        if ($notice->count() == 0) {
            $notice = '';
        } else {
            $notice = Setting::where('config_name', 'donate_info')->first();
            $notice = $notice->config_setting;
        }
        return view('frontend.donate.index', compact('courses', 'notice', 'cats', 'menus', 'recent3post', 'relatepost', 'category_right_widget_320x250', 'category_top_content_728x90'));
    }

    public function usercpPage($id) {
        $menus = Menu::all();
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        $userTpoint = UserTpoint::where('user_id', $user->id)->first();
        $tpoint = $userTpoint ? $userTpoint->tpoint : 0.000;
        $total_likes = $user->likes()->count();

        $posts = Post::where('user_id', $user->id)->get();

        $comments = ProfileComments::where('owner_id', $user->id)->orderBy('id', 'DESC')->with('user')->paginate(10);

        $totalLikesReceived = 0;

        foreach ($posts as $post) {
            $likesFromOthers = $post->likes()->where('user_id', '<>', $user->id)->count();
            $likesFromSelf = $post->likes()->where('user_id', $user->id)->count();
            $totalLikesReceived += $likesFromOthers + $likesFromSelf;
        }

        return view(
            'frontend.usercp.index',
            compact(
                'menus',
                'recent3post',
                'user',
                'tpoint',
                'total_likes',
                'totalLikesReceived',
                'currentUser',
                'comments'
            )
        );
    }

    public function usercpPagePost(ProfileCommentsRequest $request, $id) {
        $user = Auth::user();
        try {
            DB::beginTransaction();
            $comment = new ProfileComments();
            $comment->user_id = $user->id;
            $comment->owner_id = $id;
            $comment->content = $request->content;
            $comment->save();
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e->getMessage();
        }
    }

    public function usercpCommentsDelete(Request $request ,$id) {
        try {
            DB::beginTransaction();
            $profileComment = ProfileComments::findOrFail($id);
            $profileComment->delete();
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e->getMessage();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\UserTpoint;
use Illuminate\Http\Request;

use Auth;
use File;
use App\Ads;
use App\Log;
use App\Page;
use App\Post;
use App\Menu;
use App\Setting;
use App\Category;

class PageController extends Controller
{
    public function getAll() {
    	$pages = Page::orderBy('id', 'DESC')->paginate(5);
        return view('backend.page.index', compact('pages'));
    }

    public function addPage()
    {
        return view('backend.page.add');
    }

    public function postaddPage(Request $request) {
    	$this->validate($request,
            [
                'title' => 'required',
                'content' => 'required',
                'thumb' => 'required',
            ],
            [
                'title.required' => 'Không được để trống tên bài viết',
                'content.required' => 'Nội dung bài viết không được để trống',
                'thumb.required' => 'Hình đại diện không được để trống',
            ]);

        if ($request->hasFile('thumb')) {
            $file = $request->thumb;
            $rand = rand_string(5);
            $namefile = $file->getClientOriginalExtension();
            $revstr = revstr($rand);
            $name = $rand . $revstr . "." . $namefile;
            $file->move('upload/pages/images/', $name);
        }

        $page = new Page();
        $page->page_name = $request->title;
        $page->page_slug = changeTitle($request->title);
        $page->page_content = $request->content;
        $page->user_id = Auth::user()->id;
        $page->page_img = $name;
        $page->save();

        $log = new Log();
        $log->changelog = 'Add Page  ' . '<b><font color="#873f1b">' . $request->title . '</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::ADD_PAGE_FUNCTION;
        $log->save();

        return redirect(route('editPage',$page->id))->with('success_mesage', 'Add page successfully.');
    }

    public function editPage ($id) {
    	$page = Page::find($id);
        return view('backend.page.edit', compact('page'));
    }

    public function posteditPage (Request $request, $id) {
    	$this->validate($request,
            [
                'title' => 'required',
                'content' => 'required',
            ],
            [
                'title.required' => 'Không được để trống tên bài viết',
                'content.required' => 'Nội dung bài viết không được để trống',
            ]);
        $page = Page::find($id);
        $page->page_name = $request->title;
        $page->page_slug = changeTitle($request->title);
        $page->page_content = $request->content;
        $page->user_id = Auth::user()->id;

        if ($request->hasFile('thumb')) {
            File::delete('upload/pages/images/'.$page->page_img);
            $file = $request->thumb;
            $rand = rand_string(5);
            $namefile = $file->getClientOriginalExtension();
            $revstr = revstr($rand);
            $name = $rand . $revstr . "." . $namefile;
            $file->move('upload/pages/images/', $name);
            $page->page_img = $name;
        }
        $page->save();

        $log = new Log();
        $log->changelog = 'Edit Page  ' . '<b><font color="#871b58">' . $request->title . '</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::EDIT_PAGE_FUNCTION;
        $log->save();

        return redirect(route('editPage',$page->id))->with('success_mesage', 'Edit page successfully.');
    }

    public function deletePage($id)
    {
        $page = Page::find($id);
        File::delete('upload/pages/images/'.$page->page_img);

        $log = new Log();
        $log->changelog = 'Delete Page  ' . '<b><font color="red">' . $page->page_name . '</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::DELETE_PAGE_FUNCTION;
        $log->save();
        $page->delete();
        return redirect(route('page'))->with('success_mesage', 'Delete page successfully.');
    }

    public function filterPage()
    {
        return view('backend.page.filter');
    }

    public function postfilterPage(Request $request)
    {
        $postname = $request->get('postname');
        $pages = Page::where('page_name', 'LIKE', '%'.$postname. '%')->paginate(10);
        return view('backend.page.filter', compact('pages'));
    }

    public function getPage($id) {
        $pages = Page::find($id);
        if (!isset($pages)) {
            return redirect(route('home'));
        }
        $cats = Category::all();
        $menus = Menu::all();
        $social = Setting::where('config_name', 'social')->first();
        $social = json_decode($social->config_setting, true);
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $relatepost = Post::inRandomOrder()->take(4)->get();
        $randompost = Post::inRandomOrder()->take(2)->get();
        $bottom_post_728x90 = Ads::where('ads_zone', 'bottom_post_728x90')->first();
        $bottom_right_widget_post_320x250 = Ads::where('ads_zone', 'bottom_right_widget_post_320x250')->first();
        $userTpoint = UserTpoint::where('user_id', $pages->user_id)->first();
        $tpoint = $userTpoint ? $userTpoint->tpoint : 0.000;
        return view('frontend.page.index', compact('pages', 'cats', 'menus', 'recent3post', 'relatepost' , 'randompost', 'bottom_post_728x90' ,'bottom_right_widget_post_320x250', 'social', 'tpoint'));
    }
}

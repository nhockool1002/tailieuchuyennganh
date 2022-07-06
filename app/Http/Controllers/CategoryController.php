<?php

namespace App\Http\Controllers;

use App\Category;
use App\Log;
use App\Post;
use App\Menu;
use App\Ads;
use App\User;
use App\Moderator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getAll() {
    	$category = Category::orderBy('cat_order', 'ASC')->get();
    	return view('backend.category.index', compact('category'));
    }

    public function addCategory() {
    	return view('backend.category.add');
    }

    public function postaddCategory (Request $request) {
    	$this->validate($request, 
    		[
    			'cat_name' => 'required|min:3|max:40|unique:category',
    			'cat_slug' => 'required|min:3|max:40',
    			'cat_description' => 'required',
    			'cat_order' => 'required'
    		], 
    		[
    			'cat_name.required' => 'Tên danh mục không được để trống.',
    			'cat_name.unique' => 'Tên danh mục không được trùng.',
    			'cat_name.min' => 'Tên danh mục phải có ít nhất 3 ký tự',
    			'cat_name.max' => 'Tên danh mục có nhiều nhất 40 ký tự',
    			'cat_slug.required' => 'Định nghĩa Slug cho tên danh mục',
    			'cat_slug.min' => 'Slug danh mục có ít nhất 3 ký tự',
    			'cat_slug.max' => 'Slug danh mục có nhiều nhất 40 ký tự',
    			'cat_description.required' => 'Mô tả danh mục không được để trống',
    			'cat_order.required' => 'Thứ tự danh mục không được để trống'
    		]);
    	$cat = new Category();
    	$cat->cat_name = $request->cat_name;
    	$cat->cat_slug = $request->cat_slug;
    	$cat->cat_description = $request->cat_description;
    	$cat->cat_order = $request->cat_order;
    	$cat->active = $request->cat_active;
    	$cat->save();

        $log = new Log();
        $log->changelog = 'Add Category '.'<b><font color="blue">'.$request->cat_name.'</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::ADD_CATEGORY_FUNCTION;
        $log->save();

    	return redirect(route('category'))->with('success_mesage','Add category successfully.');
    }

    public function editCategory($id) {
    	$category = Category::find($id);
        $mods = Moderator::where('cat_id', $category->id)->get();
    	return view('backend.category.edit', compact('category', 'mods'));
    }

    public function posteditCategory(Request $request, $id) {
    	$cat = Category::find($id);
    	$this->validate($request, 
    		[
    			'cat_name' => 'required|min:3|max:40',
    			'cat_slug' => 'required|min:3|max:40',
    			'cat_description' => 'required',
    			'cat_order' => 'required'
    		], 
    		[
    			'cat_name.required' => 'Tên danh mục không được để trống.',
    			'cat_name.min' => 'Tên danh mục phải có ít nhất 3 ký tự',
    			'cat_name.max' => 'Tên danh mục có nhiều nhất 40 ký tự',
    			'cat_slug.required' => 'Định nghĩa Slug cho tên danh mục',
    			'cat_slug.min' => 'Slug danh mục có ít nhất 3 ký tự',
    			'cat_slug.max' => 'Slug danh mục có nhiều nhất 40 ký tự',
    			'cat_description.required' => 'Mô tả danh mục không được để trống',
    			'cat_order.required' => 'Thứ tự danh mục không được để trống'
    		]);

        $nemo = $cat->cat_name;
    	$cat->cat_name = $request->cat_name;
    	$cat->cat_slug = $request->cat_slug;
    	$cat->cat_description = $request->cat_description;
    	$cat->cat_order = $request->cat_order;
    	$cat->active = $request->cat_active;
    	$cat->save();

        $log = new Log();
        $log->changelog = 'Edit Category '.'<b><font color="blue">'.$nemo.'</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::EDIT_CATEGORY_FUNCTION;
        $log->save();

    	return redirect(route('editCategory', $cat->id))->with('success_mesage','Edit category successfully.');
    }

    public function deleteCategory($id) {
    	$cat = Category::find($id);

        $log = new Log();
        $log->changelog = 'Delete Category '.'<b><font color="blue">'.$cat->cat_name.'</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::DELETE_CATEGORY_FUNCTION;
        $log->save();

        $cat->delete();
    	return redirect(route('category'))->with('success_mesage','Delete category successfully.');
    }

    public function getCategory($slug, $id) {
        $cat = Category::find($id);

        if (!isset($cat)) {
            return redirect(route('home'));
        }

        if ($slug != $cat->cat_slug) {
            return redirect(route('home'));
        }

        if ($slug == 'wordpress') {
            $cats = Category::all();
        $menus = Menu::all();
        $posts = Post::where('cat_id', $id)->orderBy('id','DESC')->paginate(8);
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $relatepost = Post::where('cat_id', $id)->take(3)->get();
        return view('frontend.category.wordpress', compact('posts', 'cat', 'cats', 'menus', 'recent3post', 'relatepost'));
        }

        $cats = Category::all();
        $menus = Menu::all();
        $posts = Post::where('cat_id', $id)->orderBy('id','DESC')->paginate(8);
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $relatepost = Post::where('cat_id', $id)->take(3)->get();
        $category_right_widget_320x250 = Ads::where('ads_zone', 'category_right_widget_320x250')->first();
        $category_top_content_728x90 = Ads::where('ads_zone', 'category_top_content_728x90')->first();
        return view('frontend.category.index', compact('posts', 'cat', 'cats', 'menus', 'recent3post', 'relatepost', 'category_right_widget_320x250', 'category_top_content_728x90'));
    }

    public function addModerator(Request $request) 
    {
        $cat = Category::find($request->catID);

        $username = $request->username;
        $user = User::where('username', $username)->first();
        $amount = $user->count();

        if($amount == 0) {
            return back()->with('warning_mesage','Username to add Moderator not exist');
        }
        $mod = Moderator::where('user_id', $user->id)->where('cat_id', $request->catID)->get();
        $amountmod = $mod->count();

        if($amountmod != 0) {
            return back()->with('warning_mesage','User has been moderator of Category');
        }

        if($user->role_id != '1') {
            $user->role_id = '2';
        }
        $user->save();
        $moderator = new Moderator();
        $moderator->user_id = $user->id;
        $moderator->cat_id = $request->catID;
        $moderator->save();

        $log = new Log();
        $log->changelog = 'Set '.'<b><font color="#ff7ccd">'.$user->username.'</font></b> to moderator of '.$cat->cat_name;
        $log->user = Auth::user()->username;
        $log->screen = \Constant::EDIT_CATEGORY_FUNCTION;
        $log->save();

        return back()->with('success_mesage','Add Moderator Successfull');
    }

    public function removeModerator($id) {
        $mod = Moderator::find($id);
        if(!isset($mod)) {
            return back()->with('warning_mesage','Không tồn tại ! Kiểm tra lại !');
        }
        $cat = Category::find($mod->cat_id);
        $user = User::find($mod->user_id);
        $check = Moderator::where('user_id', $user->id)->get();
        
        if($check->count() == 1) {
            $user->role_id = '3';
            $user->save();
        }

        $mod->delete();

        $log = new Log();
        $log->changelog = 'Delete '.'<b><font color="#ff7ccd">'.$user->username.'</font></b> to moderator of '.$cat->cat_name;
        $log->user = Auth::user()->username;
        $log->screen = \Constant::EDIT_CATEGORY_FUNCTION;
        $log->save();

        return back()->with('success_mesage','Delete Moderator Successfull');
    }
}

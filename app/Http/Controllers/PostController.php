<?php

namespace App\Http\Controllers;

use App\UserTpointLog;
use Illuminate\Http\Request;
use App\Post;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Menu;
use App\Log;
use App\Ads;
use App\DownloadPost;
use App\SearchData;
use App\Page;
use App\Setting;
use App\Category;
use App\Moderator;
use App\HashTag;
use App\PostHashTag;
use App\UserTpoint;
use App\Like;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;
use Mtownsend\ReadTime\ReadTime;

class PostController extends Controller
{
    public function getAll()
    {
        // $mod = 'Moderator';
        // $admin = 'Administrator';
        $user = Auth::user();
        // if ($user->role->role_name == $mod) {
        //     $cat = Moderator::where('user_id', $user->id)->get();
        //     $listcat = [];
        //     foreach ($cat as $item) {
        //         $listcat[] = $item->cat_id;
        //     }
        //     $posts = Post::whereIn('cat_id', $listcat)->orderBy('id', 'DESC')->paginate(20);
        // }
        if ($user->hasRole(['super-admin', 'admin', 'super-moderator', 'moderator'])) {
            $posts = Post::orderBy('id', 'DESC')->paginate(20);
        }

        return view('backend.post.index', compact('posts'));
    }

    public function deletePost($id)
    {
        // $mod = 'Moderator';
        // $admin = 'Administrator';
        $user = Auth::user();

        $post = Post::find($id);


        // if ($user->role->role_name == $mod) {
        //     $cat = Moderator::where('user_id', $user->id)->get();
        //     $listcat = [];
        //     foreach ($cat as $item) {
        //         $listcat[] = $item->cat_id;
        //     }
        //     if (in_array($post->cat_id, $listcat) == true) {
        //         $log = new Log();
        //         $log->changelog = 'Delete Post  ' . '<b><font color="red">' . $post->post_name . '</font></b>';
        //         $log->user = Auth::user()->username;
        //         $log->screen = \Constant::DELETE_POST_FUNCTION;
        //         $log->save();
        //         $post->delete();
        //         return redirect(route('post'))->with('success_mesage', 'Delete post successfully.');
        //     }
        // }

        if ($user->hasRole(['super-admin', 'admin', 'super-moderator', 'moderator'])) {
            $log = new Log();
            $log->changelog = 'Delete Post  ' . '<b><font color="red">' . $post->post_name . '</font></b>';
            $log->user = Auth::user()->username;
            $log->screen = \Constant::DELETE_POST_FUNCTION;
            $log->save();
            $post->delete();
            return redirect(route('post'))->with('success_mesage', 'Delete post successfully.');
        }

        return redirect(route('post'))->with('warning_mesage', 'Bạn không thể xóa bài viết trong danhh mục không quản lý.');
    }

    public function addPost()
    {
        // $mod = 'Moderator';
        // $admin = 'Administrator';
        $user = Auth::user();

        // if ($user->role->role_name == $mod) {
        //     $cat = Moderator::where('user_id', $user->id)->get();
        //     $listcat = [];
        //     foreach ($cat as $item) {
        //         $listcat[] = $item->cat_id;
        //     }
        //     $cats = Category::whereIn('id', $listcat)->get();
        //     return view('backend.post.add', compact('cats'));
        // }

        if ($user->hasRole(['super-admin', 'admin', 'super-moderator', 'moderator'])) {
            $cats = Category::all();
            return view('backend.post.add', compact('cats'));
        }
    }

    public function postaddPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required',
                'thumb' => 'required',
            ],
            [
                'title.required' => 'Không được để trống tên bài viết',
                'content.required' => 'Nội dung bài viết không được để trống',
                'thumb.required' => 'Hình đại diện không được để trống',
            ]
        );


        if (isset($request->listdl) && !empty($request->listdl)) {
            $data = $request->listdl;
            foreach ($data as $item) {
                if ($item['title'] == NULL || $item['link'] == NULL) {
                    return back()->with('warning_mesage', 'Nếu bật link download thì không được để trống Tiêu đề và Link');
                }
            }
        }

        if ($request->hasFile('thumb')) {
            $file = $request->thumb;
            $rand = rand_string(5);
            $namefile = $file->getClientOriginalExtension();
            $extension = $file->extension();
            if (!in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {
                return redirect(route('addPost'))->withInput()->with('warning_mesage', 'Thumnaild phải là Tệp ảnh (PNG - JPG - JPEG = GIF )');
            }
            $revstr = revstr($rand);
            $name = $rand . $revstr . "." . $namefile;
            $file->move('upload/posts/images/', $name);
        }

        try {
            DB::beginTransaction();
            $post = new Post();
            $post->post_name = $request->title;
            $post->post_slug = changeTitle($request->title);
            $post->post_content = $request->content;
            $post->cat_id = $request->category;
            $post->private_content = $request->private_content;
            $post->user_id = Auth::user()->id;
            $post->post_special = $request->sticky;
            $post->post_img = $name;
            $post->save();

            $userPoint = UserTpoint::where('user_id', Auth::user()->id)->first();
            $userPoint->addTpoint(0.5);

            $userTpointLog = new UserTpointLog();
            $userTpointLog->user_id = Auth::user()->id;
            $userTpointLog->content = "ADD POST #". $post->id;
            $userTpointLog->amount = 5;
            $userTpointLog->status = "IN";
            $userTpointLog->save();

            if (isset($request->listdl)) {
                $zz = json_encode($request->listdl);
                $dl = new DownloadPost();
                $dl->post_id = $post->id;
                $dl->content = $zz;
                $dl->save();
            }

            if (isset($request->listht)) {
                $data = $request->listht;
                foreach ($data as $item) {
                    $check = HashTag::where('hashtag_name', $item)->get();
                    if ($check->count() == 0) {
                        $newTag = new HashTag();
                        $newTag->hashtag_name = $item;
                        $newTag->save();
                    }
                    $getTag = HashTag::where('hashtag_name', $item)->first();
                    $addTag = new PostHashTag();
                    $addTag->post_id = $post->id;
                    $addTag->hashtag_id = $getTag->id;
                    $addTag->save();
                }
            }
            $log = new Log();
            $log->changelog = 'Add Post  ' . '<b><font color="red">' . $request->title . '</font></b>';
            $log->user = Auth::user()->username;
            $log->screen = \Constant::ADD_POST_FUNCTION;
            $log->save();

            DB::commit();
            return redirect(route('editPost', $post->id))->with('success_mesage', 'Add post successfully.');
        } catch(Exception $e) {
            DB::rollBack();
            throw $e->getMessage();
        }
    }

    public function editPost($id)
    {
        // $mod = 'Moderator';
        // $admin = 'Administrator';
        $user = Auth::user();
        $post = Post::find($id);

        $linkdl = DownloadPost::where('post_id', $id)->first();
        if (!empty($linkdl)) {
            $linkdl = json_decode($linkdl->content, TRUE);
        } else {
            $linkdl = [];
        }

        // if ($user->role->role_name == $mod) {
        //     $cat = Moderator::where('user_id', $user->id)->get();
        //     $listcat = [];
        //     foreach ($cat as $item) {
        //         $listcat[] = $item->cat_id;
        //     }
        //     $cats = Category::whereIn('id', $listcat)->get();
        //     $listtags = PostHashTag::where('post_id', $post->id)->get();
        //     if (in_array($post->cat_id, $listcat) == true) {
        //         return view('backend.post.edit', compact('post', 'cats', 'listtags', 'linkdl'));
        //     }
        // }

        if ($user->hasRole(['super-admin', 'admin', 'super-moderator', 'moderator'])) {
            $cats = Category::all();
            $listtags = PostHashTag::where('post_id', $post->id)->get();
            return view('backend.post.edit', compact('post', 'cats', 'listtags', 'linkdl'));
        }

        return redirect(route('post'))->with('warning_mesage', 'Bạn không thể sửa bài viết trong danhh mục không quản lý.');
    }

    public function posteditPost(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required',
            ],
            [
                'title.required' => 'Không được để trống tên bài viết',
                'content.required' => 'Nội dung bài viết không được để trống',
            ]
        );

        if (isset($request->listdl) && !empty($request->listdl)) {
            $data = $request->listdl;
            foreach ($data as $item) {
                if ($item['title'] == NULL || $item['link'] == NULL) {
                    return back()->with('warning_mesage', 'Nếu bật link download thì không được để trống Tiêu đề và Link');
                }
            }
        }

        $post = Post::find($id);
        $post->post_name = $request->title;
        $post->post_slug = changeTitle($request->title);
        $post->post_content = $request->content;
        $post->private_content = $request->private_content;
        $post->cat_id = $request->category;
        $post->post_special = $request->sticky;

        if ($request->hasFile('thumb')) {
            $file = $request->thumb;
            $extension = $file->extension();
            if (!in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {
                return redirect(route('editPost', $post->id))->withInput()->with('warning_mesage', 'Thumnaild phải là Tệp ảnh (PNG - JPG - JPEG = GIF )');
            }
            File::delete('upload/posts/images/' . $post->post_img);
            $file = $request->thumb;
            $rand = rand_string(5);
            $namefile = $file->getClientOriginalExtension();
            $revstr = revstr($rand);
            $name = $rand . $revstr . "." . $namefile;
            $file->move('upload/posts/images/', $name);
            $post->post_img = $name;
        }
        $post->save();

        if (isset($request->listdl)) {
            $zz = json_encode($request->listdl);
            $dl = DownloadPost::where('post_id', $post->id)->first();
            if (!empty($dl)) {
                $dl->content = $zz;
                $dl->save();
            } else {
                $dl = new DownloadPost();
                $dl->post_id = $post->id;
                $dl->content = $zz;
                $dl->save();
            }
        } else {
            $dl = DownloadPost::where('post_id', $post->id)->first();
            if (!empty($dl)) {
                $dl->content = '{}';
                $dl->save();
            } else {
                $dl = new DownloadPost();
                $dl->post_id = $post->id;
                $dl->content = '{}';
                $dl->save();
            }
        }

        if (isset($request->listht)) {
            $data = $request->listht;
            if (!empty($data)) {
                foreach ($data as $item) {
                    $check = HashTag::where('hashtag_name', $item)->get();
                    if ($check->count() == 0) {
                        $newTag = new HashTag();
                        $newTag->hashtag_name = $item;
                        $newTag->save();
                    }
                    $getTag = HashTag::where('hashtag_name', $item)->first();
                    $ck = PostHashTag::where('hashtag_id', $getTag->id)->where('post_id', $post->id)->get();
                    if ($ck->count() == 0) {
                        $addTag = new PostHashTag();
                        $addTag->post_id = $post->id;
                        $addTag->hashtag_id = $getTag->id;
                        $addTag->save();
                    }
                }
            }
        }
        $log = new Log();
        $log->changelog = 'Edit Post  ' . '<b><font color="red">' . $request->title . '</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::ADD_POST_FUNCTION;
        $log->save();

        return redirect(route('editPost', $post->id))->with('success_mesage', 'Edit post successfully.');
    }

    public function filterPost()
    {
        return view('backend.post.filter');
    }

    public function postfilterPost(Request $request)
    {
        $postname = $request->get('postname');
        $posts = Post::where('post_name', 'LIKE', '%' . $postname . '%')->paginate(10);
        return view('backend.post.filter', compact('posts'));
    }

    public function getPost($id)
    {
        $posts = Post::find($id);
        if (!isset($posts)) {
            return redirect(route('home'));
        }
        Event::fire('posts.view', $posts);
        $hashtags = PostHashTag::where('post_id', $id)->get();
        $linkdl = DownloadPost::where('post_id', $id)->first();
        if (!empty($linkdl)) {
            $linkdl = json_decode($linkdl->content, TRUE);
        } else {
            $linkdl = [];
        }
        $cats = Category::all();
        $menus = Menu::all();
        $social = Setting::where('config_name', 'social')->first();
        $social = json_decode($social->config_setting, true);
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $relatepost = Post::where('cat_id', $posts->cat_id)->where('id', '!=', $posts->id)->take(4)->get();
        $randompost = Post::inRandomOrder()->take(2)->get();
        $bottom_post_728x90 = Ads::where('ads_zone', 'bottom_post_728x90')->first();
        $bottom_right_widget_post_320x250 = Ads::where('ads_zone', 'bottom_right_widget_post_320x250')->first();
        $category_top_content_728x90 = Ads::where('ads_zone', 'category_top_content_728x90')->first();

        $user = Auth::user();
        $user_has_like = 0;
        $tpoint = 0.000;
        if ($user) {
            $liked = $user->hasLikedPost($posts);
            if ($liked) {
                $user_has_like = 1;
            }
            $userTpoint = UserTpoint::where('user_id', $user->id)->first();
            $tpoint = $userTpoint ? $userTpoint->tpoint : 0.000;
        }
        $likedUsers = $posts->likes->pluck('user');
        $readTime = (new ReadTime($posts->post_content, $omitSeconds = true, $abbreviated = false, $wordsPerMinute = 230))->get();
        return view('frontend.post.index', compact('readTime', 'posts', 'cats', 'menus', 'recent3post', 'relatepost', 'randompost', 'bottom_post_728x90', 'bottom_right_widget_post_320x250', 'social', 'hashtags', 'linkdl', 'category_top_content_728x90', 'tpoint', 'user_has_like', 'likedUsers', 'user'));
    }

    public function getSearch(Request $request)
    {
        $filter = $request->get('search');
        $filter = strip_tags(trim(html_entity_decode($filter)));
        $search = SearchData::where('data', $filter)->first();
        if (isset($search)) {
            $search->search_count  = $search->search_count + 1;
            $search->save();
        } else {
            $newsearch = new SearchData();
            $newsearch->data = $filter;
            $newsearch->search_count = 1;
            $newsearch->save();
        }
        $posts = Post::where('post_name', 'LIKE', '%' . $filter . '%')->orderBy('id', 'DESC')->paginate(10);
        $pages = Page::where('page_name', 'LIKE', '%' . $filter . '%')->paginate(10);
        $all = $posts->merge($pages);
        $cats = Category::all();
        $menus = Menu::all();
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $relatepost = Post::orderBy('id', 'asc')->take(3)->get();
        $category_right_widget_320x250 = Ads::where('ads_zone', 'category_right_widget_320x250')->first();
        $category_top_content_728x90 = Ads::where('ads_zone', 'category_top_content_728x90')->first();
        return view('frontend.search.index', compact('all', 'cats', 'menus', 'recent3post', 'relatepost', 'category_right_widget_320x250', 'category_top_content_728x90', 'filter', 'pages'));
    }

    public function getHashtag(Request $request)
    {
        $filter = $request->get('hashtag');
        $filter = strip_tags(trim(html_entity_decode($filter)));
        $search = SearchData::where('data', $filter)->first();

        $getHashtag = HashTag::where('hashtag_name', $filter)->first();
        if ($getHashtag == NULL) {
            return redirect(route('home'));
        }
        $hashtagID = $getHashtag->id;
        $posts = PostHashTag::where('hashtag_id', $hashtagID)->paginate(10);
        $cats = Category::all();
        $menus = Menu::all();
        $recent3post = Post::orderBy('id', 'desc')->take(3)->get();
        $relatepost = Post::orderBy('id', 'asc')->take(3)->get();
        $category_right_widget_320x250 = Ads::where('ads_zone', 'category_right_widget_320x250')->first();
        $category_top_content_728x90 = Ads::where('ads_zone', 'category_top_content_728x90')->first();
        return view('frontend.hashtag.index', compact('posts', 'cats', 'menus', 'recent3post', 'relatepost', 'category_right_widget_320x250', 'category_top_content_728x90', 'filter'));
    }

    public function getRelatePost(Request $request)
    {
        $relatepost = Post::where('cat_id', $request->catID)->where('id', '!=', $request->postID)->inRandomOrder()->take(4)->get();
        return json_decode($relatepost, TRUE);
    }

    public function like(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'not_login'], 400);
        }
        $user_id = Auth::user()->id; // Lấy ID của user hiện tại
        $post_id = $request->post_id; // Lấy ID của bài viết được like

        $post = Post::find($post_id); // Tìm bài viết

        // Kiểm tra xem user đã like bài viết chưa
        if ($post->likes()->where('user_id', $user_id)->exists()) {
            return response()->json(['message' => 'like_duplicate'], 400);
        }

        try {
            DB::beginTransaction();
            $like = new Like();
            $like->user_id = $user_id;
            $post->likes()->save($like);

            $likedUsers = $post->likes->pluck('user');

            $list = '';
            if ($likedUsers && count($likedUsers) >= 0) {
                $lastUser = $likedUsers->last();
                foreach ($likedUsers as $u) {
                    if ($lastUser->username !== $u->username) {
                        $list .= '<a href="#">'. $u->username .'</a>, ';
                    } else {
                        $list .= '<a href="#">'. $u->username .'</a>';
                    }
                }
            }

            $userPoint = UserTpoint::where('user_id', $user_id)->first();
            $userPoint->addTpoint(0.5);

            $userTpointLog = new UserTpointLog();
            $userTpointLog->user_id = $user_id;
            $userTpointLog->content = "THANK POST #". $post_id;
            $userTpointLog->amount = 0.5;
            $userTpointLog->status = "IN";
            $userTpointLog->save();
            DB::commit();
            return response()->json(['message' => 'like_success', 'list' => $list], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'like_failed'], 400);
        }
    }
}

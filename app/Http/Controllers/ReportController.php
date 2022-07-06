<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Post;

class ReportController extends Controller
{
    public function index(Request $request) {
        $ip = $request->ip();
        if(!isset($request->id) || !isset($request->post)) {
            return redirect(route('home'));
        }
        $id = $request->id;
        $postname = $request->post;

        if (Post::where('post_name', $postname)->count() == 0 ) {
            return redirect(route('home'));
        }

        if (Post::where('post_name', $postname)->count() != 0 ) {
            $post = Post::where('post_name', $postname)->first();
            if($post->id != $id) {
                return redirect(route('home'));
            }
        }

        if (Report::where('ip_report', $ip)->count() != 0 && Report::where('post_name', $postname)->count() != 0) {
            return back()->with('warning_mesage', 'Bạn đã báo cáo bài viết này rồi');
        }

        $report = new Report();
        $report->post_name = $postname;
        $report->ip_report = $ip;
        $report->save();
        return back()->with('success_mesage', 'Bạn đã báo cáo bài viết thành công !');
    }

    public function getReportScreen() {
        $reports = Report::orderBy('id', 'DESC')->get();
        return view('backend.setting.report-list.index', compact('reports'));
    }

    public function deleteReport($id) {
        $report = Report::find($id);
        $report->delete();
        return back()->with('success_mesage', 'Xử lý Report thành công !');
    }

    public function deleteAllReport() {
        Report::query()->delete();
        return back()->with('success_mesage', 'Xóa tất cả Report thành công');
    }
}

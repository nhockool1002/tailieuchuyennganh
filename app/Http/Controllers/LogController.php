<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function getAll() {
    	$logs = Log::orderBy('id', 'DESC')->paginate(20);
    	return view('backend.log.index', compact('logs'));
    }

    public function deleteAllLog () {
    	Log::query()->delete();
    	return back()->with('success_mesage', 'Xóa tất cả Log thành công');
    }
}

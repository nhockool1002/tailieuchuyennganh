<?php

namespace App\Http\Controllers\RF;

use Exception;
use App\Helpers\Traits\LinkTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\RF\CreateLinkRequest;
use App\Http\Requests\RF\DeleteLinkRequest;
use App\Http\Controllers\Controller;
use App\RF\LinkCreator;



class LinkController extends Controller
{
    use LinkTrait;

    public function index() {
        return view('backend.RF.Link.index');
    }

    public function getAll() {
        $data = LinkCreator::all();
        return response()->json($data);
    }

    public function createLink(CreateLinkRequest $request) {
        try {
            $shrink_earn_url = $this->generateShrinkearn($request->name, $request->url);
            if ($shrink_earn_url !== false) {
                DB::beginTransaction();
                LinkCreator::create([
                    'name' => $request->name,
                    'origin' => $request->url,
                    'short_link' => $shrink_earn_url,
                    'created_by' => $request->user()->username
                ]);
                DB::commit();
                return response()->json(['success' => true], 200);
            } else {
                DB::rollback();
                $msg = 'GenerateShrinkearn not success';
                Log::info('RF\LinkController - createLink');
                Log::error($msg);
                return response()->json(['success' => false], 200);
            }

        } catch (Exception $e) {
            DB::rollback();
            Log::info('RF\LinkController - createLink');
			Log::error($e->getMessage());
			return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function deleteLink(DeleteLinkRequest $request) {
        try {
            DB::beginTransaction();
            LinkCreator::destroy($request->id);
            DB::commit();
            return response()->json(['success' => true], 200);
        } catch (Exception $e) {
            DB::rollback();
            Log::info('RF\LinkController - deleteLink');
			Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}

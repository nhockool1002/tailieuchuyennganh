<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PokemonDeleteRequest;
use App\Http\Requests\PokemonRequest;
use App\Http\Requests\PokemonEditRequest;
use App\Pokemon;
use App\Log;
use DB;
use Exception;
use Auth;
use File;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pkm = Pokemon::orderBy('id', 'DESC')->get();

        return response()->json($pkm);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pkm = Pokemon::find($id);

        return response()->json($pkm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function indexView() {
        $pkms = Pokemon::orderBy('id', 'DESC')->paginate(20);
        return view('backend.pokemon.index', compact('pkms'));
    }

    public function addView() {
        return view('backend.pokemon.add');
    }

    public function editView($id) {
        $pkm = Pokemon::where('id', $id)->first();
        return view('backend.pokemon.edit', compact('pkm'));
    }

    public function addSubmit(PokemonRequest $request) {
        if ($request->hasFile('thumb')) {
            $file = $request->thumb;
            $rand = rand_string(5);
            $nameFile = $file->getClientOriginalExtension();
            $extension = $file->extension();
            if (!in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {
                return redirect(route('addPost'))
                    ->withInput()
                    ->with(
                        'warning_message',
                        'Thumbnail phải là Tệp ảnh (PNG - JPG - JPEG = GIF )'
                    );
            }
            $revStr = revstr($rand);
            $name = $rand . $revStr . "." . $nameFile;
            $file->move('upload/posts/images/', $name);
        }

        DB::beginTransaction();
        try {
            $pkm = new Pokemon();
            $pkm->name = $request->name;
            $pkm->description = $request->description;
            $pkm->author = $request->author;
            $pkm->author_bio = $request->author_bio;
            $pkm->version = $request->version;
            $pkm->base_on = $request->base_on;
            $pkm->content = $request->content;
            $pkm->thumb = $name;
            $pkm->url = $request->url;
            $pkm->url2 = $request->url2;
            $pkm->save();

            $log = new Log();
            $log->changelog = 'Add Pokemon Rom  ' . '<b><font color="red">' . $request->name . '</font></b>';
            $log->user = Auth::user()->username;
            $log->screen = 'Add Pokemon Rom';
            $log->save();

            DB::commit();
            return redirect(route('addViewPokemon', $pkm->id))->with('success_message', 'Add post successfully.');
        } catch (Exception $e) {
            DB::rollback();
            throw $e->getMessage();
        }
    }

    public function editSubmit(PokemonEditRequest $request, $id) {
        DB::beginTransaction();
        try {
            $pkm = Pokemon::find($id);
            $pkm->name = $request->name;
            $pkm->description = $request->description;
            $pkm->author = $request->author;
            $pkm->author_bio = $request->author_bio;
            $pkm->version = $request->version;
            $pkm->base_on = $request->base_on;
            $pkm->content = $request->content;
            $pkm->url = $request->url;
            $pkm->url2 = $request->url2;

            if ($request->hasFile('thumb')) {
                $file = $request->thumb;
                $extension = $file->extension();
                if (!in_array($extension, ['png', 'jpg', 'jpeg', 'gif'])) {
                    return redirect(
                        route('editPost', $pkm->id))
                        ->withInput()
                        ->with(
                            'warning_message',
                            'Thumbnail phải là Tệp ảnh (PNG - JPG - JPEG = GIF )'
                        );
                }
                File::delete('upload/posts/images/' . $pkm->thumb);
                $file = $request->thumb;
                $rand = rand_string(5);
                $nameFile = $file->getClientOriginalExtension();
                $revStr = revstr($rand);
                $name = $rand . $revStr . "." . $nameFile;
                $file->move('upload/posts/images/', $name);
                $pkm->thumb = $name;
            }
            $pkm->save();

            $log = new Log();
            $log->changelog = 'Edit Post  ' . '<b><font color="red">' . $request->name . '</font></b>';
            $log->user = Auth::user()->username;
            $log->screen = 'Edit Pokemon Rom';
            $log->save();

            DB::commit();
            return redirect(route('editViewPokemon', $pkm->id))->with('success_message', 'Edit post successfully.');
        } catch (Exception $e) {
            DB::rollback();
            throw $e->getMessage();
        }
    }

    public function deleteRom($id) {
        DB::beginTransaction();
        try {
            $pkm = Pokemon::find($id);
            if ($pkm) {
                $name = $pkm->name;
                $pkm->delete();
                $log = new Log();
                $log->changelog = 'Delete Post  ' . '<b><font color="red">' . $name . '</font></b>';
                $log->user = Auth::user()->username;
                $log->screen = 'Delete Pokemon Rom';
                $log->save();
                DB::commit();
                return redirect(route('indexViewPokemon'))->with('success_message', 'Delete post successfully.');
            } else {
                return redirect(route('indexViewPokemon'))->with('warning_message', 'Delete post failed.');
            }
        } catch (Exception $e) {
            DB::rollback();
            throw $e->getMessage();
        }
    }
}

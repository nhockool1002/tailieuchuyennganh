<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Menu;
use App\Log;
use Auth;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function menuConfig() 
    {
    	$menus = Menu::all();
    	$cats = Category::all();
    	return view('backend.menu.index', compact('menus','cats'));
    }

    public function postaddcategorymenu(Request $request)
    {
        $id = $request->menu_id;
        $cat = Category::find($id);
    	$url = \Constant::URL_HOME.'category/'.$cat->cat_slug.'/'.$request->menu_id;
    	$menu = new Menu();
    	$menu->menu_name = $request->menu_name;
    	$menu->menu_url = $url;
    	$menu->save();

    	$log = new Log();
        $log->changelog = 'Add Menu '.'<b><font color="orange">'.$request->menu_name.'</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::ADD_MENU_FUNCTION;
        $log->save();

    	return redirect(route('menu'))->with('success_mesage','Add menu successfully.');
    }

    public function postaddmenucustom(Request $request)
    {
        $this->validate($request, 
            [
                'menu_name' => 'required',
                'menu_url' => 'required',
            ],
            [
                'menu_name.required' => 'Please input menu name on custom, this field can\'t empty.',
                'menu_url.required' => 'Please input menu url on custom, this field can\'t empty',
            ]);
    	$menu = new Menu();
    	$menu->menu_name = $request->menu_name;
    	$menu->menu_url = $request->menu_url;
    	$menu->save();

    	$log = new Log();
        $log->changelog = 'Add Menu '.'<b><font color="orange">'.$request->menu_name.'</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::ADD_MENU_FUNCTION;
        $log->save();

    	return redirect(route('menu'))->with('success_mesage','Add menu successfully.');
    }

    public function deletemenu($id)
    {
        $menu = Menu::find($id);

        $log = new Log();
        $log->changelog = 'Delete Menu '.'<b><font color="orange">'.$menu->menu_name.'</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::DELETE_MENU_FUNCTION;
        $log->save();

        $menu->delete();
        return redirect(route('menu'))->with('success_mesage','Delete menu successfully.');
    }
}

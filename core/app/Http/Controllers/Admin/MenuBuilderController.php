<?php

namespace App\Http\Controllers\Admin;

use App\BasicSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Support\Facades\Session;

class MenuBuilderController extends Controller
{

    public function index(Request $request) {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;

        // set language
        app()->setLocale($lang->code);

        // get page names of selected language
        $pages = Page::where('language_id', $lang->id)->get();
        $data["pages"] = $pages;

        // get previous menus
        $menu = Menu::where('language_id', $lang->id)->first();
        $data['prevMenu'] = '';
        if (!empty($menu)) {
            $data['prevMenu'] = $menu->menus;
        }

        return view('admin.menu_builder.index', $data);
    }

    public function update(Request $request) {
        Menu::where('language_id', $request->language_id)->delete();

        $menu = new Menu;
        $menu->language_id = $request->language_id;
        $menu->menus = $request->str;
        $menu->save();

        return response()->json(['status' => 'success', 'message' => 'Menu updated successfully!']);
    }
}

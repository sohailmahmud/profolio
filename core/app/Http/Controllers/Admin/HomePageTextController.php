<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicSetting as BS;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomePageTextController extends Controller
{
    public function index(Request $request)
    {
        if (empty($request->language)) {
            $data['lang_id'] = 0;
            $data['abs'] = BS::firstOrFail();
        } else {
            $lang = Language::where('code', $request->language)->firstOrFail();
            $data['lang_id'] = $lang->id;
            $data['abs'] = $lang->basic_setting;
        }
        return view('admin.home.home-page-text', $data);
    }

    public function update(Request $request, $langid)
    {
        $bs = BS::where('language_id', $langid)->firstOrFail();
        foreach ($request->types as $key => $type) {
            $bs->$type = $request[$type];
        }
        $bs->save();
        Session::flash('success', 'Text updated successfully!');
        return "success";
    }
}

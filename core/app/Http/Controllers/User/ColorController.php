<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\BasicSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ColorController extends Controller
{
    public function index() {
        $data = BasicSetting::where('user_id', Auth::user()->id)->select('base_color');
        if ($data->count() == 0) {
            $data = new BasicSetting;
            $data->user_id = Auth::user()->id;
            $data->save();
        } else {
            $data = $data->firstOrFail();
        }
        $data['data'] = $data;
        return view('user.settings.color', $data);
    }

    public function update(Request $request) {
        $data = BasicSetting::where('user_id', Auth::user()->id)->firstOrFail();
        $data->base_color = $request->base_color;
        $data->save();

        Session::flash('success', 'Base color updated successfully!');
        return back();
    }
}

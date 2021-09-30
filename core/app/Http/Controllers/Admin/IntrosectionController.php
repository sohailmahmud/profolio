<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BasicSetting as BS;
use App\Models\Language;
use Purifier;
use Validator;
use Session;

class IntrosectionController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abs'] = $lang->basic_setting;
        return view('admin.home.intro-section', $data);
    }

    public function update(Request $request, $langid)
    {


        $main_image = $request->file('intro_main_image');
        $signature = $request->file('intro_signature');
        $video_bg = $request->file('intro_video_image');

        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'intro_main_image' => [
                function ($attribute, $value, $fail) use ($main_image, $allowedExts) {
                    if (!empty($main_image)) {
                        $ext = $main_image->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],

            'intro_signature' => [
                function ($attribute, $value, $fail) use ($signature, $allowedExts) {
                    if (!empty($signature)) {
                        $ext = $signature->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],

            'intro_video_image' => [
                function ($attribute, $value, $fail) use ($video_bg, $allowedExts) {
                    if (!empty($video_bg)) {
                        $ext = $video_bg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $input = $request->all();

        $bs = BS::where('language_id', $langid)->firstOrFail();


        if ($request->hasFile('intro_main_image')) {
            @unlink('assets/front/img/' . $bs->intro_main_image);
            $main_image_name = uniqid() .'.'. $main_image->getClientOriginalExtension();
            $main_image->move('assets/front/img/', $main_image_name);
            $input['intro_main_image'] = $main_image_name;
        }

        $input['intro_text'] = Purifier::clean($request->intro_text);
        $bs->update($input);

        Session::flash('success', 'data updated successfully!');
        return "success";
    }

    public function removeImage(Request $request) {
        $type = $request->type;
        $langid = $request->language_id;

        $bs = BS::where('language_id', $langid)->firstOrFail();

        if ($type == "signature") {
            @unlink("assets/front/img/" . $bs->intro_signature);
            $bs->intro_signature = NULL;
            $bs->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}

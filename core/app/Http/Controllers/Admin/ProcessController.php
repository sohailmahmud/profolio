<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Process;
use Validator;
use Session;

class ProcessController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['processes'] = Process::where('language_id', $lang_id)->orderBy('id', 'DESC')->get();
        $data['lang_id'] = $lang_id;
        return view('admin.home.process.index', $data);
    }

    public function edit($id)
    {
        $data['process'] = Process::findOrFail($id);
        return view('admin.home.process.edit', $data);
    }

    public function store(Request $request)
    {

        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'image' => 'required',
            'title' => 'required|max:50',
            'serial_number' => 'required|integer',

            'image' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }


        if ($request->hasFile('image')) {
            $main_image = time() . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move('assets/front/img/process/', $main_image);
            $image = $main_image;
        }else{
            $image = null;
        }

        $process = new Process;
        $process->image = $image;
        $process->language_id = $request->language_id;
        $process->title = $request->title;
        $process->serial_number = $request->serial_number;
        $process->save();

        Session::flash('success', 'Process added successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'title' => 'required|max:50',
            'serial_number' => 'required|integer',

            'image' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
        ];

        $request->validate($rules);

        $process = Process::findOrFail($request->process_id);

        if ($request->hasFile('image')) {
            $main_image = time() . '.' . $img->getClientOriginalExtension();
            @unlink('assets/front/img/process/' . $process->image);
            $request->file('image')->move('assets/front/img/process/', $main_image);
            $process->image = $main_image;
        }



        $process->title = $request->title;
        $process->serial_number = $request->serial_number;
        $process->save();

        Session::flash('success', 'Process updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {

        $process = Process::findOrFail($request->process_id);
        @unlink('assets/front/img/process/' . $process->image);
        $process->delete();

        Session::flash('success', 'Process deleted successfully!');
        return back();
    }

    public function removeImage(Request $request) {
        $type = $request->type;
        $featId = $request->process_id;

        $process = Process::findOrFail($featId);

        if ($type == "process") {
            @unlink("assets/front/img/process/" . $process->image);
            $process->image = NULL;
            $process->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}

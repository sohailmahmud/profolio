<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Achievement;
use App\Models\User\BasicSetting;
use App\Models\User\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('language')) {
            $lang = Language::where([
                ['code', $request->language],
                ['user_id', Auth::id()]
            ])->first();
            Session::put('currentLangCode', $request->language);
        } else {
            $lang = Language::where([
                ['is_default', 1],
                ['user_id', Auth::id()]
            ])
                ->first();
            Session::put('currentLangCode', $lang->code);
        }
        $data['achievements'] = Achievement::where([
            ['language_id', '=', $lang->id],
            ['user_id', '=', Auth::id()],
        ])
        ->orderBy('id', 'DESC')
        ->get();
        return view('user.achievement.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'user_language_id.required' => 'The language field is required',
        ];

        $rules = [
            'user_language_id' => 'required',
            'title' => 'required|max:255',
            'count' => 'required|integer',
            'serial_number' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $input = $request->all();
        $input['language_id'] = $request->user_language_id;
        $input['user_id'] = Auth::id();

        $achievement = new Achievement;
        $achievement->create($input);

        Session::flash('success', 'Achievement added successfully!');
        return "success";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function edit($id)
    {
        $data['achievement'] = Achievement::findOrFail($id);
        return view('user.achievement.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $allowedExts = array('jpg', 'png', 'jpeg');
        $slug = make_slug($request->title);

        $rules = [
            'title' => 'required|max:255',
            'count' => 'required|integer',
            'serial_number' => 'required|integer'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $input = $request->all();
        $achievement = Achievement::findOrFail($request->achievement_id);
        $input['slug'] = $slug;
        $input['user_id'] = Auth::id();
        $achievement->update($input);
        Session::flash('success', 'Achievement updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {
        $achievement = Achievement::findOrFail($request->achievement_id);
        $achievement->delete();
        Session::flash('success', 'Achievement deleted successfully!');
        return back();
    }
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $achievement = Achievement::findOrFail($id);
            $achievement->delete();
        }
        Session::flash('success', 'Achievements deleted successfully!');
        return "success";
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\JobExperience;
use App\Models\User\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Purifier;
use Validator;


class JobExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
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
        $data['job_experiences'] = JobExperience::where([
            ['lang_id', '=', $lang->id],
            ['user_id', '=', Auth::id()],
        ])
            ->orderBy('id', 'DESC')
            ->get();
        return view('user.job_experience.index',$data);
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
        $rules =[
            'user_language_id' => 'required',
            'company_name' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'serial_number' => 'required',
        ];
        if(!array_key_exists('is_continue',$request->all())){
            $rules['end_date'] = 'required';
            $request['is_continue'] = 0;
        }
        $messages = [
            'user_language_id.required'=> 'The language field is required',
            'company_name.required'=> 'The company name field is required',
            'designation.required'=> 'The designation field is required',
            'start_date.required'=> 'The start date field is required',
            'end_date.required'=> 'The end date field is required',
            'serial_number.required'=> 'The serial number field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $newJobExperience = new JobExperience();
        $newJobExperience->company_name = $request->company_name;
        $newJobExperience->designation = $request->designation;
        $newJobExperience->content = Purifier::clean($request->content);
        $newJobExperience->start_date = $request->start_date;
        $newJobExperience->end_date = $request->is_continue === "1"
                                               ? null: $request->end_date;
        $newJobExperience->is_continue = $request->is_continue;
        $newJobExperience->serial_number = $request->serial_number;
        $newJobExperience->lang_id = $request->user_language_id;
        $newJobExperience->user_id = Auth::id();
        $newJobExperience->save();
        Session::flash('success', 'Job experience added successfully!');
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
        $data['jobExperience'] = JobExperience::query()->findOrFail($id);
        return view('user.job_experience.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return
     */
    public function update(Request $request)
    {
        $rules =[
            'company_name' => 'required',
            'designation' => 'required',
            'start_date' => 'required',
            'serial_number' => 'required',
        ];
        if(!array_key_exists('is_continue',$request->all())){
            $rules['end_date'] = 'required';
        }
        $messages = [
            'company_name.required'=> 'The category field is required',
            'designation.required'=> 'The designation field is required',
            'start_date.required'=> 'The start date field is required',
            'end_date.required'=> 'The end date field is required',
            'serial_number.required'=> 'The serial number field is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $newJobExperience = JobExperience::query()->findOrFail($request->id);
        $newJobExperience->company_name = $request->company_name;
        $newJobExperience->designation = $request->designation;
        $newJobExperience->content = Purifier::clean($request->content);
        $newJobExperience->start_date = $request->start_date;
        $newJobExperience->end_date = $request->is_continue === "on" ? null: $request->end_date;
        $newJobExperience->is_continue = $request->is_continue === "on" ? 1 : 0;
        $newJobExperience->serial_number = $request->serial_number;
        $newJobExperience->user_id = Auth::id();
        $newJobExperience->save();
        Session::flash('success', 'Job experience updated successfully!');
        return "success";
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

    public function delete(Request $request){
        JobExperience::query()
                       ->findOrFail($request->id)
                       ->delete();
        Session::flash('success', 'Job experience deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request){
        $ids = $request->ids;
        foreach ($ids as $id) {
            JobExperience::findOrFail($id)->delete();
        }
        Session::flash('success', 'Job experience deleted successfully!');
        return "success";
    }
}

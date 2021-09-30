<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Language;
use App\Models\User\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class SkillCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index(Request $request)
    {
        $data = null;
        if($request->has('userLanguage')){
            $lang = Language::where([
                ['code', $request->userLanguage],
                ['user_id', Auth::id()]
            ])->first();
            Session::put('currentLangCode',$request->userLanguage);
        }else{
            $lang = Language::where([
                ['is_default', 1],
                ['user_id',Auth::id()]
            ])
                ->first();
            Session::put('currentLangCode',$lang->code ?? null);
        }
        if(!is_null($lang)){
            $data['bcategorys'] = SkillCategory::where([
                ['language_id','=', $lang->id],
                ['user_id','=', Auth::id()],
            ])
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }else{
            $data['bcategorys'] = null;
        }

        return view('user.skill.bcategory.index',$data);
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
        $messages = [
            'lang_id.required' => 'The language field is required',
            'name' => 'The name field is required',
            'status' => 'The status field is required',
            'serial_number' => 'The serial number field is required',
        ];

        $rules = [
            'lang_id' => 'required',
            'name' => 'required|max:255',
            'status' => 'required',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $bcategory = new SkillCategory();
        $bcategory->language_id = $request->lang_id;
        $bcategory->name = $request->name;
        $bcategory->status = $request->status;
        $bcategory->user_id = Auth::id();
        $bcategory->serial_number = $request->serial_number;
        $bcategory->save();

        Session::flash('success', 'Skill category added successfully!');
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
        $messages = [
            'name' => 'The name field is required',
            'status' => 'The status field is required',
            'serial_number' => 'The serial number field is required',
        ];

        $rules = [
            'name' => 'required|max:255',
            'status' => 'required',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $bcategory = SkillCategory::findOrFail($request->bcategory_id);
        $bcategory->name = $request->name;
        $bcategory->status = $request->status;
        $bcategory->serial_number = $request->serial_number;
        $bcategory->save();

        Session::flash('success', 'Skill category updated successfully!');
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
        $bcategory = SkillCategory::findOrFail($request->bcategory_id);
        if ($bcategory->skills()->count() > 0) {
            Session::flash('warning', 'First, delete all the skills under this category!');
            return back();
        }
        $bcategory->delete();
        Session::flash('success', 'Skill category deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $bcategory = SkillCategory::findOrFail($id);
            if ($bcategory->skills()->count() > 0) {
                Session::flash('warning', 'First, delete all the skills under the selected categories!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $bcategory = SkillCategory::findOrFail($id);
            $bcategory->delete();
        }

        Session::flash('success', 'Skill categories deleted successfully!');
        return "success";
    }
}

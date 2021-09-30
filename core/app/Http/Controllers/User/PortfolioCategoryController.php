<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Language;
use App\Models\User\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class PortfolioCategoryController extends Controller
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
        $data['categories'] = PortfolioCategory::where([
            ['language_id', '=', $lang->id],
            ['user_id', '=', Auth::id()],
        ])
            ->orderBy('id', 'DESC')
            ->get();
        return view('user.portfolio.bcategory.index', $data);
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
            'user_language_id.required' => 'The language field is required',
            'name' => 'The name field is required',
            'status' => 'The status field is required',
            'serial_number' => 'The serial number field is required',
        ];

        $rules = [
            'user_language_id' => 'required',
            'name' => 'required|max:255',
            'status' => 'required',
            'serial_number' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $bcategory = new PortfolioCategory();
        $bcategory->language_id = $request->user_language_id;
        $bcategory->name = $request->name;
        $bcategory->status = $request->status;
        $bcategory->user_id = Auth::id();
        $bcategory->serial_number = $request->serial_number;
        $bcategory->save();

        Session::flash('success', 'Portfolio category added successfully!');
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

        $bcategory = PortfolioCategory::findOrFail($request->bcategory_id);
        $bcategory->name = $request->name;
        $bcategory->status = $request->status;
        $bcategory->serial_number = $request->serial_number;
        $bcategory->save();

        Session::flash('success', 'Portfolio category updated successfully!');
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
        $bcategory = PortfolioCategory::findOrFail($request->bcategory_id);
        if ($bcategory->portfolios()->count() > 0) {
            Session::flash('warning', 'First, delete all the portfolios under this category!');
            return back();
        }
        $bcategory->delete();
        Session::flash('success', 'Portfolio category deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $bcategory = PortfolioCategory::findOrFail($id);
            if ($bcategory->portfolios()->count() > 0) {
                Session::flash('warning', 'First, delete all the portfolios under the selected categories!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $bcategory = PortfolioCategory::findOrFail($id);
            $bcategory->delete();
        }

        Session::flash('success', 'Portfolio categories deleted successfully!');
        return "success";
    }
}

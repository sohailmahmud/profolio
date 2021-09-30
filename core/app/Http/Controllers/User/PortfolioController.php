<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Language;
use App\Models\User\Portfolio;
use App\Models\User\PortfolioCategory;
use App\Models\User\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Purifier;
use Validator;

class PortfolioController extends Controller
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
        $data['portfolios'] = Portfolio::where([
            ['language_id', '=', $lang->id],
            ['user_id', '=', Auth::id()],
        ])
            ->orderBy('id', 'DESC')
            ->get();

        $data['categories'] = PortfolioCategory::where([
            ['language_id', '=', $lang->id],
            ['user_id', '=', Auth::id()],
            ['status', '=', 1]
        ])
            ->orderBy('serial_number', 'ASC')
            ->get();
        return view('user.portfolio.portfolio.index', $data);
    }

    public function sliderstore(Request $request)
    {
        $img = $request->file('file');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'file' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    $ext = $img->getClientOriginalExtension();
                    if (!in_array($ext, $allowedExts)) {
                        return $fail("Only png, jpg, jpeg images are allowed");
                    }
                },
            ]
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $filename = uniqid() . '.jpg';

        $img->move('assets/front/img/user/portfolios/', $filename);

        $pi = new PortfolioImage;
        if (!empty($request->portfolio_id)) {
            $pi->user_portfolio_id = $request->portfolio_id;
        }
        $pi->image = $filename;
        $pi->user_id = Auth::user()->id;
        $pi->save();

        return response()->json(['status' => 'success', 'file_id' => $pi->id]);
    }

    public function sliderrmv(Request $request)
    {
        $pi = PortfolioImage::findOrFail($request->fileid);
        if (!empty($request->type) && $request->type == 'edit') {
            if (PortfolioImage::where('user_portfolio_id', $pi->user_portfolio_id)->count() == 1) {
                return "minimum_one";
            }
        }
        @unlink('assets/front/img/user/portfolios/' . $pi->image);
        $pi->delete();
        return $pi->id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');
        $messages = [
            'user_language_id.required' => 'The language field is required',
            'title.required' => 'The title field is required',
            'category.required' => 'The category field is required',
            'content.required' => 'The content field is required',
            'serial_number.required' => 'The serial number field is required',
            'image.required' => 'The image field is required',
        ];

        $slug = make_slug($request->title);
        $rules = [
            'user_language_id' => 'required',
            'title' => 'required|max:255',
            'category' => 'required',
            'content' => 'required',
            'serial_number' => 'required|integer',
            'image' => ['required',
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'slider_images' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        if (!isset($request->featured)) $request["featured"] = "0";
        $input = $request->all();
        $input['category_id'] = $request->category;
        $input['language_id'] = $request->user_language_id;
        $input['slug'] = $slug;
        $input['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $directory = 'assets/front/img/user/portfolios/';
            @mkdir($directory, 0775, true);
            $request->file('image')->move($directory, $filename);
            $input['image'] = $filename;
        }
        $input['content'] = Purifier::clean($request->content);
        $portfolio = new Portfolio;
        $portfolio = $portfolio->create($input);



        $sliders = $request->slider_images;
        $pis = PortfolioImage::findOrFail($sliders);
        foreach ($pis as $key => $pi) {
            $pi->user_portfolio_id = $portfolio->id;
            $pi->save();
        }

        $exSliders = PortfolioImage::whereNull('user_portfolio_id')->get();
        foreach ($exSliders as $key => $exSlider) {
            @unlink('assets/front/img/user/portfolios/' . $exSlider->image);
        }

        Session::flash('success', 'Portfolio added successfully!');
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return
     */
    public function edit($id)
    {
        $data['portfolio'] = Portfolio::findOrFail($id);
        $data['categories'] = PortfolioCategory::where([
            ['language_id', '=', $data['portfolio']->language_id],
            ['user_id', '=', Auth::id()],
            ['status', '=', 1]
        ])
            ->orderBy('serial_number', 'ASC')
            ->get();
        return view('user.portfolio.portfolio.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $img = $request->file('image');
        $allowedExts = array('jpg', 'png', 'jpeg');
        $slug = make_slug($request->title);

        $rules = [
            'title' => 'required|max:255',
            'category' => 'required',
            'content' => 'required',
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
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $input = $request->all();
        $portfolio = Portfolio::findOrFail($request->id);
        $input['category_id'] = $request->category;
        $input['slug'] = $slug;
        $input['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move('assets/front/img/user/portfolios/', $filename);
            @unlink('assets/front/img/user/portfolios/' . $portfolio->image);
            $input['image'] = $filename;
        }
        if (!isset($request->featured)) $input["featured"] = "0";
        $input['content'] = Purifier::clean($request->content);
        $portfolio->update($input);
        Session::flash('success', 'Portfolio updated successfully!');
        return "success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getcats($langid)
    {
        return PortfolioCategory::where([
            ['language_id', $langid],
            ['user_id', '=', Auth::id()],
            ['status', '=', 1]
        ])
            ->orderBy('serial_number', 'ASC')
            ->get();
    }

    public function delete(Request $request)
    {
        $portfolio = Portfolio::findOrFail($request->id);
        foreach ($portfolio->portfolio_images as $key => $pi) {
            @unlink('assets/front/img/user/portfolios/' . $pi->image);
            $pi->delete();
        }
        @unlink('assets/front/img/user/portfolios/' . $portfolio->image);
        $portfolio->delete();
        Session::flash('success', 'Portfolio deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $portfolio = Portfolio::findOrFail($id);
            foreach ($portfolio->portfolio_images as $key => $pi) {
                @unlink('assets/front/img/user/portfolios/' . $pi->image);
                $pi->delete();
            }
            @unlink('assets/front/img/user/portfolios/' . $portfolio->image);
            $portfolio->delete();
        }
        Session::flash('success', 'Portfolios deleted successfully!');
        return "success";
    }

    public function images($portid)
    {
        $images = PortfolioImage::where('user_portfolio_id', $portid)->get();
        return $images;
    }
}

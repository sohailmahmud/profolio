<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Language;
use App\Models\User\Blog;
use App\Models\User\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Purifier;
use Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $data['blogs'] = Blog::where([
            ['language_id', '=', $lang->id],
            ['user_id', '=', Auth::id()],
        ])
            ->orderBy('id', 'DESC')
            ->get();

        $data['bcats'] = BlogCategory::where([
            ['language_id', '=', $lang->id],
            ['user_id', '=', Auth::id()],
            ['status', '=', 1]
        ])
            ->orderBy('serial_number', 'ASC')
            ->get();
        return view('user.blog.blog.index', $data);
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
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $input = $request->all();
        $input['category_id'] = $request->category;
        $input['language_id'] = $request->user_language_id;
        $input['slug'] = $slug;
        $input['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $directory = 'assets/front/img/user/blogs/';
            if (!file_exists($directory)) mkdir($directory, 0775, true);
            $request->file('image')->move($directory, $filename);
            $input['image'] = $filename;
        }
        $input['content'] = Purifier::clean($request->content);
        $blog = new Blog;
        $blog->create($input);

        Session::flash('success', 'Blog added successfully!');
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
        $data['blog'] = Blog::findOrFail($id);
        $data['bcats'] = BlogCategory::where([
            ['language_id', '=', $data['blog']->language_id],
            ['user_id', '=', Auth::id()],
            ['status', '=', 1]
        ])
            ->orderBy('serial_number', 'ASC')
            ->get();
        return view('user.blog.blog.edit', $data);
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
        $blog = Blog::findOrFail($request->blog_id);
        $input['category_id'] = $request->category;
        $input['slug'] = $slug;
        $input['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move('assets/front/img/user/blogs/', $filename);
            @unlink('assets/front/img/user/blogs/' . $blog->image);
            $input['image'] = $filename;
        }
        $input['content'] = Purifier::clean($request->content);
        $blog->update($input);
        Session::flash('success', 'Blog updated successfully!');
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
        return BlogCategory::where([
            ['language_id', $langid],
            ['user_id', '=', Auth::id()],
            ['status', '=', 1]
        ])->get();
    }

    public function delete(Request $request)
    {
        $blog = Blog::findOrFail($request->blog_id);
        if (file_exists('assets/front/img/user/blogs/' . $blog->image)) {
            @unlink('assets/front/img/user/blogs/' . $blog->image);
        }
        $blog->delete();
        Session::flash('success', 'Blog deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $blog = Blog::findOrFail($id);
            if (file_exists('assets/front/img/user/blogs/' . $blog->image)) {
                @unlink('assets/front/img/user/blogs/' . $blog->image);
            }
            $blog->delete();
        }
        Session::flash('success', 'Blogs deleted successfully!');
        return "success";
    }
}

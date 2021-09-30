<?php

namespace App\Http\Controllers\Admin;

use App\Models\Timezone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BasicSetting;
use App\Models\BasicExtended;
use App\Models\Language;
use App\Models\Seo;
use Session;
use Validator;
use Artisan;
use Purifier;

class BasicController extends Controller
{
    public function favicon(Request $request)
    {
        return view('admin.basic.favicon');
    }

    public function updatefav(Request $request)
    {
        $img = $request->file('favicon');
        $allowedExts = array('jpg', 'png', 'jpeg','ico');

        $rules = [
            'favicon' => [
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
            $validator->getMessageBag()->add('error', 'true');
            return response()->json(['errors' => $validator->errors(), 'id' => 'favicon']);
        }

        if ($request->hasFile('favicon')) {
            $filename = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move('assets/front/img/', $filename);

            $bss = BasicSetting::all();

            foreach ($bss as $key => $bs) {

                @unlink('assets/front/img/' . $bs->favicon);
                $bs->favicon = $filename;
                $bs->save();
            }
        }
        Session::flash('success', 'Favicon update successfully.');
        return back();
    }

    public function logo(Request $request)
    {
        return view('admin.basic.logo');
    }

    public function updatelogo(Request $request)
    {
        $img = $request->file('file');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'file' => [
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
            $validator->getMessageBag()->add('error', 'true');
            return response()->json(['errors' => $validator->errors(), 'id' => 'logo']);
        }

        if ($request->hasFile('file')) {
            $bss = BasicSetting::all();

            $filename = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move('assets/front/img/', $filename);

            foreach ($bss as $key => $bs) {
                // only remove the the previous image, if it is not the same as default image or the first image is being updated
                @unlink('assets/front/img/' . $bs->logo);
                $bs->logo = $filename;
                $bs->save();
            }
        }
        Session::flash('success', 'Logo update successfully.');
        return back();
    }

    public function preloader(Request $request)
    {
        return view('admin.basic.preloader');
    }

    public function updatepreloader(Request $request)
    {
        $img = $request->file('file');
        $allowedExts = array('jpg', 'png', 'jpeg', 'gif');

        $rules = [
            'preloader_status' => 'required',
            'file' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only gif, png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
        ];

        $request->validate($rules);

        $bss = BasicSetting::all();

        if ($request->hasFile('file')) {
            $filename = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move('assets/front/img/', $filename);
        }

        foreach ($bss as $key => $bs) {
            $bs->preloader_status = $request->preloader_status;
            if ($request->hasFile('file')) {
                @unlink('assets/front/img/' . $bs->preloader);
                $bs->preloader = $filename;
            }
            $bs->save();
        }
        Session::flash('success', 'Preloader updated successfully.');
        return back();
    }


    public function basicinfo()
    {
        $data['abs'] = BasicSetting::firstOrFail();
        $data['abe'] = BasicExtended::firstOrFail();
        $data['timezones'] = Timezone::all();
        return view('admin.basic.basicinfo', $data);
    }

    public function updatebasicinfo(Request $request)
    {
        $request->validate([
            'website_title' => 'required',
            'timezone' => 'required',
            'base_color' => 'required',
            'base_currency_symbol' => 'required',
            'base_currency_symbol_position' => 'required',
            'base_currency_text' => 'required',
            'base_currency_text_position' => 'required',
            'base_currency_rate' => 'required|numeric'
        ]);

        $bss = BasicSetting::all();
        foreach ($bss as $key => $bs) {
            $bs->website_title = $request->website_title;
            $bs->base_color = $request->base_color;
            $bs->save();
        }

        $bes = BasicExtended::all();
        foreach ($bes as $key => $be) {
            $be->base_currency_symbol = $request->base_currency_symbol;
            $be->base_currency_symbol_position = $request->base_currency_symbol_position;
            $be->base_currency_text = $request->base_currency_text;
            $be->base_currency_text_position = $request->base_currency_text_position;
            $be->base_currency_rate = $request->base_currency_rate;
            $be->timezone = $request->timezone;
            $be->save();
        }
        // set timezone in .env
        if ($request->has('timezone') && $request->filled('timezone')) {
            $arr = ['TIMEZONE' => $request->timezone];
            setEnvironmentValue($arr);
            \Artisan::call('config:clear');
        }
        Session::flash('success', 'Basic informations updated successfully!');
        return back();
    }


    public function updateslider(Request $request, $lang)
    {
        $be = BasicExtended::where('language_id', $lang)->firstOrFail();


        if ($request->hasFile('slider_shape_img')) {
            @unlink('assets/front/img/' . $be->slider_shape_img);
            $filename = uniqid() . '.' . $request->slider_shape_img->getClientOriginalExtension();
            $request->slider_shape_img->move('assets/front/img/', $filename);
            $be->slider_shape_img = $filename;
        }

        if ($request->hasFile('slider_bottom_img')) {
            @unlink('assets/front/img/' . $be->slider_bottom_img);
            $filename = uniqid() . '.' . $request->slider_bottom_img->getClientOriginalExtension();
            $request->slider_bottom_img->move('assets/front/img/', $filename);
            $be->slider_bottom_img = $filename;
        }

        $be->save();
        Session::flash('success', 'Slider data updated successfully!');
        return back();
    }

    public function breadcrumb(Request $request)
    {
        return view('admin.basic.breadcrumb');
    }

    public function updatebreadcrumb(Request $request)
    {
        $img = $request->file('file');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'file' => [
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
            $validator->getMessageBag()->add('error', 'true');
            return response()->json(['errors' => $validator->errors(), 'id' => 'breadcrumb']);
        }


        if ($request->hasFile('file')) {

            $filename = uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move('assets/front/img/', $filename);

            $bss = BasicSetting::all();
            foreach ($bss as $key => $bs) {
                @unlink('assets/front/img/' . $bs->breadcrumb);
                $bs->breadcrumb = $filename;
                $bs->save();
            }
        }
        Session::flash('success', 'Breadcrumb update successfully.');
        return back();
    }


    public function script()
    {
        $data = BasicSetting::first();
        return view('admin.basic.scripts', ['data' => $data]);
    }

    public function updatescript(Request $request)
    {

        $bss = BasicSetting::all();

        foreach ($bss as $bs) {
            $bs->tawkto_property_id = $request->tawkto_property_id;
            $bs->is_tawkto = $request->is_tawkto;

            $bs->is_disqus = $request->is_disqus;
            $bs->is_user_disqus = $request->is_user_disqus;
            $bs->disqus_shortname = $request->disqus_shortname;

            $bs->is_recaptcha = $request->is_recaptcha;
            $bs->google_recaptcha_site_key = $request->google_recaptcha_site_key;
            $bs->google_recaptcha_secret_key = $request->google_recaptcha_secret_key;

            $bs->is_whatsapp = $request->is_whatsapp;
            $bs->whatsapp_number = $request->whatsapp_number;
            $bs->whatsapp_header_title = $request->whatsapp_header_title;
            $bs->whatsapp_popup_message = Purifier::clean($request->whatsapp_popup_message);
            $bs->whatsapp_popup = $request->whatsapp_popup;

            $bs->save();
        }

        Session::flash('success', 'Plugins updated successfully!');
        return back();
    }


    public function maintainance()
    {
        $data = BasicSetting::select('maintainance_mode', 'maintenance_img', 'maintenance_status', 'maintainance_text', 'secret_path')
            ->first();

        return view('admin.basic.maintainance', ['data' => $data]);
    }

    public function updatemaintainance(Request $request)
    {
        $img = $request->file('file');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'file' => [
                function ($attribute, $value, $fail) use ($img, $allowedExts) {
                    if (!empty($img)) {
                        $ext = $img->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ],
            'maintenance_status' => 'required',
            'maintainance_text' => 'required'
        ];

        $message = [
            'maintainance_text.required' => 'The maintenance message field is required.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $bs = BasicSetting::first();

        // first, get the maintenance image from db
        if ($request->hasFile('file')) {
            $filename = uniqid() . '.' . $request->file('file')->getClientOriginalExtension();

            @unlink("assets/front/img/" . $bs->maintenance_img);
            $request->file('file')->move('assets/front/img/', $filename);
        }


        $down = "down";
        if ($request->filled('secret_path')) {
            $down .= " --secret=" . $request->secret_path;
        }

        if ($request->maintenance_status == 1) {
            @unlink('core/storage/framework/down');
            Artisan::call($down);
        } else {
            Artisan::call('up');
        }

        
        $bs->update([
            'maintenance_img' => $request->hasFile('file') ? $filename : $bs->maintenance_img,
            'maintenance_status' => $request->maintenance_status,
            'maintainance_text' => clean($request->maintainance_text),
            'secret_path' => $request->secret_path
        ]);

        $request->session()->flash('success', 'Maintenance Info updated successfully!');

        return redirect()->back();
    }




    public function sections(Request $request)
    {
        $data['abs'] = BasicSetting::first();

        return view('admin.home.sections', $data);
    }

    public function updatesections(Request $request)
    {
        $bss = BasicSetting::all();

        foreach ($bss as $key => $bs) {
            $bs->update($request->all());
        }

        Session::flash('success', 'Sections customized successfully!');
        return back();
    }


    public function cookiealert(Request $request)
    {
        $lang = Language::where('code', $request->language)->firstOrFail();
        $data['lang_id'] = $lang->id;
        $data['abe'] = $lang->basic_extended;

        return view('admin.basic.cookie', $data);
    }

    public function updatecookie(Request $request, $langid)
    {
        $request->validate([
            'cookie_alert_status' => 'required',
            'cookie_alert_text' => 'required',
            'cookie_alert_button_text' => 'required|max:25',
        ]);

        $be = BasicExtended::where('language_id', $langid)->firstOrFail();
        $be->cookie_alert_status = $request->cookie_alert_status;
        $be->cookie_alert_text = Purifier::clean($request->cookie_alert_text);
        $be->cookie_alert_button_text = $request->cookie_alert_button_text;
        $be->save();

        Session::flash('success', 'Cookie alert updated successfully!');
        return back();
    }

    public function seo(Request $request)
    {
      // first, get the language info from db
      $language = Language::where('code', $request->language)->firstOrFail();
      $langId = $language->id;

      // then, get the seo info of that language from db
      $seo = Seo::where('language_id', $langId);

      if ($seo->count() == 0) {
        // if seo info of that language does not exist then create a new one
        Seo::create($request->except('language_id') + [
          'language_id' => $langId
        ]);
      }

      $information['language'] = $language;

      // then, get the seo info of that language from db
      $information['data'] = $seo->first();

      // get all the languages from db
      $information['langs'] = Language::all();

      return view('admin.basic.seo', $information);
    }

    public function updateSEO(Request $request)
    {
      // first, get the language info from db
      $language = Language::where('code', $request->language)->first();
      $langId = $language->id;

      // then, get the seo info of that language from db
      $seo = SEO::where('language_id', $langId)->first();

      // else update the existing seo info of that language
      $seo->update($request->all());

      $request->session()->flash('success', 'SEO Informations updated successfully!');

      return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Session;

class RegisterUserController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->term;

        $users = User::when($term, function($query, $term) {
            $query->where('username', 'like', '%' . $term . '%')->orWhere('email', 'like', '%' . $term . '%');
        })->orderBy('id', 'DESC')->paginate(10);
        return view('admin.register_user.index',compact('users'));
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('admin.register_user.details',compact('user'));

    }


    public function userban(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        $user->update([
            'status' => $request->status,
        ]);
        Session::flash('success', 'Status update successfully!');
        return back();

    }


    public function emailStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'email_verified' => $request->email_verified,
        ]);

        Session::flash('success', 'Email status updated for ' . $user->username);
        return back();
    }

    public function userFeatured(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        $user->featured = $request->featured;
        $user->save();
        Session::flash('success', 'User featured update successfully!');
        return back();
    }


    public function changePass($id) {
        $data['user'] = User::findOrFail($id);
        return view('admin.register_user.password', $data);
    }


    public function updatePassword(Request $request)
    {

        $messages = [
            'npass.required' => 'New password is required',
            'cfpass.required' => 'Confirm password is required',
        ];

        $request->validate([
            'npass' => 'required',
            'cfpass' => 'required',
        ], $messages);


        $user = User::findOrFail($request->user_id);
        if ($request->npass == $request->cfpass) {
            $input['password'] = Hash::make($request->npass);
        } else {
            return back()->with('warning', __('Confirm password does not match.'));
        }

        $user->update($input);

        Session::flash('success', 'Password update for ' . $user->username);
        return back();
    }

    public function delete(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        if ($user->testimonials()->count() > 0) {
            $testimonials = $user->testimonials()->get();
            foreach ($testimonials as $key => $tstm) {
                @unlink('assets/front/img/user/testimonials/' . $tstm->image);
                $tstm->delete();
            }
        }

        if ($user->social_media()->count() > 0) {
            $user->social_media()->delete();
        }

        if ($user->skills()->count() > 0) {
            $user->skills()->delete();
        }

        if ($user->services()->count() > 0) {
            $services = $user->services()->get();
            foreach ($services as $key => $service) {
                @unlink('assets/front/img/user/services/' . $service->image);
                $service->delete();
            }
        }

        if ($user->seos()->count() > 0) {
            $user->seos()->delete();
        }

        if ($user->portfolios()->count() > 0) {
            $portfolios = $user->portfolios()->get();
            foreach ($portfolios as $key => $portfolio) {
                @unlink('assets/front/img/user/portfolios/' . $portfolio->image);
                if ($portfolio->portfolio_images()->count() > 0) {
                    foreach ($portfolio->portfolio_images as $key => $pi) {
                        @unlink('assets/front/img/user/portfolios/' . $pi->image);
                        $pi->delete();
                    }
                }
                $portfolio->delete();
            }
        }

        if ($user->portfolioCategories()->count() > 0) {
            $user->portfolioCategories()->delete();
        }

        if ($user->permission()->count() > 0) {
            $user->permission()->delete();
        }

        if ($user->languages()->count() > 0) {
            $user->languages()->delete();
        }

        if ($user->home_page_texts()->count() > 0) {
            $homeTexts = $user->home_page_texts()->get();
            foreach ($homeTexts as $key => $homeText) {
                @unlink('assets/front/img/user/home_settings/' . $homeText->hero_image);
                @unlink('assets/front/img/user/home_settings/' . $homeText->about_image);
                @unlink('assets/front/img/user/home_settings/' . $homeText->skills_image);
                @unlink('assets/front/img/user/home_settings/' . $homeText->achievement_image);
                $homeText->delete();
            }
        }

        if ($user->educations()->count() > 0) {
            $user->educations()->delete();
        }

        if ($user->blog_categories()->count() > 0) {
            $user->blog_categories()->delete();
        }

        if ($user->blogs()->count() > 0) {
            $blogs = $user->blogs()->get();
            foreach ($blogs as $key => $blog) {
                @unlink('assets/front/img/user/blogs/' . $blog->image);
                $blog->delete();
            }
        }

        if ($user->basic_setting()->count() > 0) {
            $bs = $user->basic_setting;
            @unlink('assets/front/img/user/' . $bs->logo);
            @unlink('assets/front/img/user/' . $bs->preloader);
            @unlink('assets/front/img/user/' . $bs->favicon);
            @unlink('assets/front/img/user/cv/' . $bs->cv);
            $bs->delete();
        }

        if ($user->achievements()->count() > 0) {
            $user->achievements()->delete();
        }

        if ($user->memberships()->count() > 0) {
            foreach($user->memberships as $key => $membership) {
                @unlink('assets/front/img/membership/receipt/' . $membership->receipt);
                $membership->delete();
            }
        }

        if ($user->job_experiences()->count() > 0) {
            $user->job_experiences()->delete();
        }

        @unlink('assets/front/img/user/' . $user->photo);
        $user->delete();

        Session::flash('success', 'User deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $user = User::findOrFail($id);

            if ($user->testimonials()->count() > 0) {
                $testimonials = $user->testimonials()->get();
                foreach ($testimonials as $key => $tstm) {
                    @unlink('assets/front/img/user/testimonials/' . $tstm->image);
                    $tstm->delete();
                }
            }
    
            if ($user->social_media()->count() > 0) {
                $user->social_media()->delete();
            }
    
            if ($user->skills()->count() > 0) {
                $user->skills()->delete();
            }
    
            if ($user->services()->count() > 0) {
                $services = $user->services()->get();
                foreach ($services as $key => $service) {
                    @unlink('assets/front/img/user/services/' . $service->image);
                    $service->delete();
                }
            }
    
            if ($user->seos()->count() > 0) {
                $user->seos()->delete();
            }
    
            if ($user->portfolios()->count() > 0) {
                $portfolios = $user->portfolios()->get();
                foreach ($portfolios as $key => $portfolio) {
                    @unlink('assets/front/img/user/portfolios/' . $portfolio->image);
                    if ($portfolio->portfolio_images()->count() > 0) {
                        foreach ($portfolio->portfolio_images as $key => $pi) {
                            @unlink('assets/front/img/user/portfolios/' . $pi->image);
                            $pi->delete();
                        }
                    }
                    $portfolio->delete();
                }
            }
    
            if ($user->portfolioCategories()->count() > 0) {
                $user->portfolioCategories()->delete();
            }
    
            if ($user->permission()->count() > 0) {
                $user->permission()->delete();
            }
    
            if ($user->languages()->count() > 0) {
                $user->languages()->delete();
            }
    
            if ($user->home_page_texts()->count() > 0) {
                $homeTexts = $user->home_page_texts()->get();
                foreach ($homeTexts as $key => $homeText) {
                    @unlink('assets/front/img/user/home_settings/' . $homeText->hero_image);
                    @unlink('assets/front/img/user/home_settings/' . $homeText->about_image);
                    @unlink('assets/front/img/user/home_settings/' . $homeText->skills_image);
                    @unlink('assets/front/img/user/home_settings/' . $homeText->achievement_image);
                    $homeText->delete();
                }
            }
    
            if ($user->educations()->count() > 0) {
                $user->educations()->delete();
            }
    
            if ($user->blog_categories()->count() > 0) {
                $user->blog_categories()->delete();
            }
    
            if ($user->blogs()->count() > 0) {
                $blogs = $user->blogs()->get();
                foreach ($blogs as $key => $blog) {
                    @unlink('assets/front/img/user/blogs/' . $blog->image);
                    $blog->delete();
                }
            }
    
            if ($user->basic_setting()->count() > 0) {
                $bs = $user->basic_setting;
                @unlink('assets/front/img/user/' . $bs->logo);
                @unlink('assets/front/img/user/' . $bs->preloader);
                @unlink('assets/front/img/user/' . $bs->favicon);
                @unlink('assets/front/img/user/cv/' . $bs->cv);
                $bs->delete();
            }
    
            if ($user->achievements()->count() > 0) {
                $user->achievements()->delete();
            }

            if ($user->memberships()->count() > 0) {
                foreach($user->memberships as $key => $membership) {
                    @unlink('assets/front/img/membership/receipt/' . $membership->receipt);
                    $membership->delete();
                }
            }
    
            if ($user->job_experiences()->count() > 0) {
                $user->job_experiences()->delete();
            }
    
            @unlink('assets/front/img/user/' . $user->photo);
            $user->delete();
        }

        Session::flash('success', 'Users deleted successfully!');
        return "success";
    }
}

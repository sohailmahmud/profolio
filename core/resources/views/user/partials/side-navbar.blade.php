@php
$default = \App\Models\User\Language::where('is_default', 1)->where('user_id', Auth::user()->id)->first();
$user = Auth::guard('web')->user();
$package = \App\Http\Helpers\UserPermissionHelper::currentPackagePermission($user->id);
if (!empty($user)) {
$permissions = \App\Http\Helpers\UserPermissionHelper::packagePermission($user->id);
$permissions = json_decode($permissions, true);
}
@endphp
<div class="sidebar sidebar-style-2" @if(request()->cookie('user-theme') == 'dark') data-background-color="dark2" @endif>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (!empty(Auth::user()->photo))
                    <img src="{{asset('assets/front/img/user/'.Auth::user()->photo)}}" alt="..."
                        class="avatar-img rounded">
                    @else
                    <img src="{{asset('assets/admin/img/propics/blank_user.jpg')}}" alt="..."
                        class="avatar-img rounded">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                    {{auth()->user()->first_name.' '.auth()->user()->last_name}}
                    <span class="user-level">{{auth()->user()->username}}</span>
                    <span class="caret"></span>
                    </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            @if(!is_null($package))
                            <li>
                                <a href="{{route('user-profile-update')}}">
                                <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{route('user.changePass')}}">
                                <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('user-logout')}}">
                                <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <div class="row mb-2">
                    <div class="col-12">
                        <form action="">
                            <div class="form-group py-0">
                                <input name="term" type="text" class="form-control sidebar-search ltr" value="" placeholder="Search Menu Here...">
                            </div>
                        </form>
                    </div>
                </div>
                <li class="nav-item
                @if(request()->path() == "user/dashboard") active
                @endif">
                <a href="{{route('user-dashboard')}}">
                    <i class="la flaticon-paint-palette"></i>
                    <p>Dashboard</p>
                </a>
                </li>
                <li class="nav-item
                @if(request()->path() == "user/profile") active
                @endif">
                <a href="{{route('user-profile')}}">
                    <i class="far fa-user-circle"></i>
                    <p>Edit Profile</p>
                </a>
                </li>

                @if(!is_null($package))
                <li class="nav-item
                    @if(request()->path() == 'user/favicon') active
                    @elseif(request()->path() == 'user/theme/version') active
                    @elseif(request()->path() == 'user/logo') active
                    @elseif(request()->path() == 'user/preloader') active
                    @elseif(request()->path() == 'user/color') active
                    @elseif(request()->path() == 'user/social') active
                    @elseif(request()->is('user/social/*')) active
                    @elseif(request()->path() == 'user/basic_settings/seo') active
                    @endif">
                    <a data-toggle="collapse" href="#basic">
                        <i class="la flaticon-settings"></i>
                        <p>Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse
                        @if(request()->path() == 'user/favicon') show
                        @elseif(request()->path() == 'user/theme/version') show
                        @elseif(request()->path() == 'user/logo') show
                        @elseif(request()->path() == 'user/preloader') show
                        @elseif(request()->path() == 'user/color') show
                        @elseif(request()->path() == 'user/social') show
                        @elseif(request()->is('user/social/*')) show
                        @elseif(request()->path() == 'user/basic_settings/seo') show
                        @endif" id="basic">
                        <ul class="nav nav-collapse">
                            <li class="@if(request()->path() == 'user/theme/version') active @endif">
                                <a href="{{route('user.theme.version')}}">
                                    <span class="sub-item">Themes</span>
                                </a>
                            </li>
                            <li class="@if(request()->path() == 'user/favicon') active @endif">
                                <a href="{{route('user.favicon')}}">
                                <span class="sub-item">Favicon</span>
                                </a>
                            </li>
                            <li class="@if(request()->path() == 'user/logo') active @endif">
                                <a href="{{route('user.logo')}}">
                                <span class="sub-item">Logo</span>
                                </a>
                            </li>
                            <li class="@if(request()->path() == 'user/preloader') active @endif">
                                <a href="{{route('user.preloader')}}">
                                <span class="sub-item">Preloader</span>
                                </a>
                            </li>


                            <li class="@if(request()->path() == 'user/color') active @endif">
                                <a href="{{route('user.color.index')}}">
                                <span class="sub-item">Color Settings</span>
                                </a>
                            </li>


                            <li class="@if(request()->path() == 'user/social') active
                                @elseif(request()->is('user/social/*')) active @endif">
                                <a href="{{route('user.social.index')}}">
                                <span class="sub-item">Social Links</span>
                                </a>
                            </li>


                            <li class="@if(request()->path() == 'user/basic_settings/seo') active @endif">
                                <a href="{{route('admin.basic_settings.seo', ['language' => $default->code])}}">
                                <span class="sub-item">SEO Information</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if(!is_null($package))
                <li class="nav-item @if(request()->path() == 'user/home-page-text/edit') active @endif">
                    <a href="{{route('user.home.page.text.edit', ['language' => $default->code])}}">
                        <i class="fas fa-home"></i>
                        <p>Home Sections</p>
                    </a>
                </li>

                <li class="nav-item
                    @if(request()->path() == 'user/preference') active
                    @endif">
                    <a href="{{route('user.preference.index')}}">
                        <i class="fas fa-toggle-on"></i>
                        <p>Preference</p>
                    </a>
                </li>
                @endif


                @if (!empty($permissions) && in_array('Skill', $permissions))
                <li class="nav-item
                    @if(request()->path() == 'user/skills') active
                    @elseif(request()->is('user/skill/*/edit')) active
                    @endif">
                    <a href="{{route('user.skill.index').'?language='.$default->code}}">
                        <i class="fas fa-pencil-ruler"></i>
                        <p>Skills</p>
                    </a>
                </li>
                @endif

                @if (!empty($permissions) && in_array('Service', $permissions))
                <li class="nav-item
                @if(request()->path() == "user/services") active
                @endif">
                <a href="{{route('user.services.index').'?language='.$default->code}}">
                    <i class="fas fa-hands"></i>
                    <p>Services</p>
                </a>
                </li>
                @endif

                @if (!empty($permissions) && in_array('Experience', $permissions))
                <li class="nav-item
                    @if(request()->path() == 'user/experiences') active
                    @elseif(request()->is('user/experience/*/edit')) active
                    @elseif(request()->path() == 'user/job-experiences') active
                    @elseif(request()->is('user/job-experience/*/edit')) active
                    @endif">
                    <a data-toggle="collapse" href="#experience">
                        <i class="fas fa-user-cog"></i>
                        <p>Experiences</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse
                        @if(request()->path() == 'user/experiences') show
                        @elseif(request()->is('user/experience/*/edit')) show
                        @elseif(request()->path() == 'user/job-experiences') show
                        @elseif(request()->is('user/job-experience/*/edit')) show
                        @endif" id="experience">
                        <ul class="nav nav-collapse">
                            <li class="
                                @if(request()->path() == 'user/job-experiences') active
                                @elseif(request()->is('user/job-experience/*/edit')) active
                                @endif">
                                <a href="{{route('user.job.experiences.index').'?language='.$default->code}}">
                                <span class="sub-item">Job Experiences</span>
                                </a>
                            </li>
                            <li class="
                                @if(request()->path() == 'user/experiences') active
                                @elseif(request()->is('user/experience/*/edit')) active
                                @endif">
                                <a href="{{route('user.experience.index')."?language=".$default->code}}">
                                <span class="sub-item">Educations</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (!empty($permissions) && in_array('Achievements', $permissions))
                <li class="nav-item
                @if(request()->path() == 'user/achievements') active
                @elseif(request()->is('user/achievement/*/edit')) active
                @endif">
                    <a href="{{route('user.achievement.index')}}">
                        <i class="fas fa-trophy"></i>
                        <p>Achievements</p>
                    </a>
                </li>
                @endif

                @if (!empty($permissions) && in_array('Portfolio', $permissions))
                <li class="nav-item
                    @if(request()->path() == 'user/portfolio-categories') active
                    @elseif(request()->path() == 'user/portfolios') active
                    @elseif(request()->is('user/portfolio/*/edit')) active
                    @endif">
                    <a data-toggle="collapse" href="#portfolio">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Portfolio</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse
                        @if(request()->path() == 'user/portfolio-categories') show
                        @elseif(request()->path() == 'user/portfolios') show
                        @elseif(request()->is('user/portfolio/*/edit')) show
                        @endif" id="portfolio">
                        <ul class="nav nav-collapse">
                            <li class="@if(request()->path() == 'user/portfolio-categories') active @endif">
                                <a href="{{route('user.portfolio.category.index')."?language=".$default->code}}">
                                <span class="sub-item">Category</span>
                                </a>
                            </li>
                            <li class="
                                @if(request()->path() == 'user/portfolios') active
                                @elseif(request()->is('user/portfolio/*/edit')) active
                                @endif">
                                <a href="{{route('user.portfolio.index')."?language=".$default->code}}">
                                <span class="sub-item">Portfolios</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (!empty($permissions) && in_array('Testimonial', $permissions))
                <li class="nav-item
                @if(request()->path() == "user/testimonials") active
                @elseif(request()->is('user/testimonial/*/edit')) active
                @endif">
                <a href="{{route('user.testimonials.index')."?language=".$default->code}}">
                    <i class="far fa-comment"></i>
                    <p>Testimonial</p>
                </a>
                </li>
                @endif

                @if (!empty($permissions) && in_array('Blog', $permissions))
                <li class="nav-item
                    @if(request()->path() == 'user/blog-categories') active
                    @elseif(request()->path() == 'user/blogs') active
                    @elseif(request()->is('user/blog/*/edit')) active
                    @endif">
                    <a data-toggle="collapse" href="#blog">
                        <i class="fas fa-blog"></i>
                        <p>Blogs</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse
                        @if(request()->path() == 'user/blog-categories') show
                        @elseif(request()->path() == 'user/blogs') show
                        @elseif(request()->is('user/blog/*/edit')) show
                        @endif" id="blog">
                        <ul class="nav nav-collapse">
                            <li class="@if(request()->path() == 'user/blog-categories') active @endif">
                                <a href="{{route('user.blog.category.index')."?language=".$default->code}}">
                                <span class="sub-item">Category</span>
                                </a>
                            </li>
                            <li class="
                                @if(request()->path() == 'user/blogs') active
                                @elseif(request()->is('user/blog/*/edit')) active
                                @endif">
                                <a href="{{route('user.blog.index')."?language=".$default->code}}">
                                <span class="sub-item">Blogs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (!empty($permissions) && in_array('Follow/Unfollow', $permissions))
                <li class="nav-item
                    @if(request()->path() == 'user/follower-list') active
                    @elseif(request()->path() == 'user/following-list') active
                    @endif">
                    <a data-toggle="collapse" href="#follow">
                        <i class="fas fa-user-friends"></i>
                        <p>Follower/Following</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse
                        @if(request()->path() == 'user/follower-list') show
                        @elseif(request()->path() == 'user/following-list') show
                        @endif" id="follow">
                        <ul class="nav nav-collapse">
                            <li class="@if(request()->path() == 'user/follower-list') active @endif">
                                <a href="{{route('user.follower.list')}}">
                                <span class="sub-item">Follower</span>
                                </a>
                            </li>
                            <li class="
                                @if(request()->path() == 'user/following-list') active
                                @elseif(request()->is('user/following-list')) active
                                @endif">
                                <a href="{{route('user.following.list')}}">
                                <span class="sub-item">Following</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (!is_null($package))
                {{-- Language Management Page --}}
                <li class="nav-item
                    @if(request()->path() == 'user/languages') active
                    @elseif(request()->is('user/language/*/edit')) active
                    @elseif(request()->is('user/language/*/edit/keyword')) active
                    @endif">
                    <a href="{{route('user.language.index')}}">
                        <i class="fas fa-language"></i>
                        <p>Language Management</p>
                    </a>
                </li>
                @endif

                <li class="nav-item
                    @if(request()->path() == 'user/package-list') active
                    @elseif(request()->is('user/package/checkout/*')) active
                    @endif">
                    <a href="{{route('user.plan.extend.index')}}">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <p>Buy Plan</p>
                    </a>
                </li>
                <li class="nav-item
                    @if(request()->path() == 'user/payment-log') active
                    @endif">
                    <a href="{{route('user.payment-log.index')}}">
                        <i class="fas fa-list-ol"></i>
                        <p>Payment Logs</p>
                    </a>
                </li>
                @if(!is_null($package))
                <li class="nav-item
                    @if(request()->path() == 'user/cv-upload') active
                    @endif">
                    <a href="{{route('user.cv.upload')}}">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Upload CV</p>
                    </a>
                </li>
                @endif
                <li class="nav-item
                    @if(request()->path() == 'user/change-password') active
                    @endif">
                    <a href="{{route('user.changePass')}}">
                        <i class="fas fa-key"></i>
                        <p>Change Password</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

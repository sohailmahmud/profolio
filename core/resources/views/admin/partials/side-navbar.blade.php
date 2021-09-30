@php
    $default = \App\Models\Language::where('is_default', 1)->first();
    $admin = Auth::guard('admin')->user();
    if (!empty($admin->role)) {
      $permissions = $admin->role->permissions;
      $permissions = json_decode($permissions, true);
    }
@endphp

<div class="sidebar sidebar-style-2" @if(request()->cookie('admin-theme') == 'dark') data-background-color="dark2" @endif>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    @if (!empty(Auth::guard('admin')->user()->image))
                        <img src="{{asset('assets/admin/img/propics/'.Auth::guard('admin')->user()->image)}}" alt="..."
                             class="avatar-img rounded">
                    @else
                        <img src="{{asset('assets/admin/img/propics/blank_user.jpg')}}" alt="..."
                             class="avatar-img rounded">
                    @endif
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
            <span>
              {{Auth::guard('admin')->user()->first_name}}
               <span class="user-level">Admin</span>
              <span class="caret"></span>
            </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{route('admin.editProfile')}}">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.changePass')}}">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin.logout')}}">
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

                {{-- Dashboard --}}
                <li class="nav-item @if(request()->path() == 'admin/dashboard') active @endif">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="la flaticon-paint-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Package --}}
                @if (empty($admin->role) || (!empty($permissions) && in_array('Packages', $permissions)))
                    <li class="nav-item
                    @if(request()->path() == 'admin/packages') active
                    @elseif(request()->is('admin/package/*/edit')) active
                    @endif">
                        <a href="{{route('admin.package.index') . '?language=' . $default->code}}">
                            <i class="fas fa-receipt"></i>
                            <p>Packages</p>
                        </a>
                    </li>
                @endif

                @if (empty($admin->role) || (!empty($permissions) && in_array('Payment Log', $permissions)))
                    <li class="nav-item
         @if(request()->path() == 'admin/payment-log') active
         @endif">
                        <a href="{{route('admin.payment-log.index')}}">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <p>Payment Log</p>
                        </a>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Menu Builder', $permissions)))
                    {{-- Menu Builder--}}
                    <li class="nav-item
            @if(request()->path() == 'admin/menu-builder') active @endif">
                        <a href="{{route('admin.menu_builder.index') . '?language=' . $default->code}}">
                            <i class="fas fa-bars"></i>
                            <p>Menu Builder</p>
                        </a>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Home Page', $permissions)))
                    {{-- Home Page --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/features') active
          @elseif(request()->path() == 'admin/introsection') active
          @elseif(request()->routeIs('admin.herosection.imgtext')) active
          @elseif(request()->is('admin/feature/*/edit')) active
          @elseif(request()->is('admin/process')) active
          @elseif(request()->is('admin/process/*/edit')) active
          @elseif(request()->path() == 'admin/testimonials') active
          @elseif(request()->is('admin/testimonial/*/edit')) active
          @elseif(request()->path() == 'admin/menu/section') active
          @elseif(request()->path() == 'admin/special/section') active
          @elseif(request()->path() == 'admin/herosection/video') active
          @elseif(request()->path() == 'admin/home-page-text-section') active
          @elseif(request()->path() == 'admin/partners') active
          @elseif(request()->is('admin/partner/*/edit')) active
          @elseif(request()->path() == 'admin/sections') active
          @endif">
                        <a data-toggle="collapse" href="#home">
                            <i class="la flaticon-home"></i>
                            <p>Home Page</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
            @if(request()->path() == 'admin/features') show
            @elseif(request()->path() == 'admin/introsection') show
            @elseif(request()->routeIs('admin.herosection.imgtext')) show
            @elseif(request()->is('admin/feature/*/edit')) show
            @elseif(request()->is('admin/process')) show
            @elseif(request()->is('admin/process/*/edit')) show
            @elseif(request()->path() == 'admin/testimonials') show
            @elseif(request()->is('admin/testimonial/*/edit')) show
            @elseif(request()->path() == 'admin/special/section') show
            @elseif(request()->path() == 'admin/home-page-text-section') show
            @elseif(request()->path() == 'admin/partners') show
            @elseif(request()->is('admin/partner/*/edit')) show
            @elseif(request()->path() == 'admin/sections') show
            @endif" id="home">
                            <ul class="nav nav-collapse">

                                <li class="@if(request()->routeIs('admin.herosection.imgtext')) active @endif">
                                    <a href="{{route('admin.herosection.imgtext') . '?language=' . $default->code}}">
                                        <span class="sub-item">Hero Section</span>
                                    </a>
                                </li>

                                <li class="@if(request()->path() == 'admin/introsection') active @endif">
                                    <a href="{{route('admin.introsection.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Intro Section</span>
                                    </a>
                                </li>

                                <li class="
                @if(request()->path() == 'admin/features') active
                @elseif(request()->is('admin/feature/*/edit')) active
                @endif">
                                    <a href="{{route('admin.feature.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Features</span>
                                    </a>
                                </li>

                                <li class="
                @if(request()->path() == 'admin/process') active
                @elseif(request()->is('admin/process/*/edit')) active
                @endif">
                                    <a href="{{route('admin.process.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Work Process</span>
                                    </a>
                                </li>

                                <li class="
                @if(request()->path() == 'admin/testimonials') active
                @elseif(request()->is('admin/testimonial/*/edit')) active
                @endif">
                                    <a href="{{route('admin.testimonial.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Testimonials</span>
                                    </a>
                                </li>
                                <li class="
                @if(request()->path() == 'admin/partners') active
                @elseif(request()->is('admin/partner/*/edit')) active
                @endif">
                                    <a href="{{route('admin.partner.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Partners</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/home-page-text-section') active @endif">
                                    <a href="{{route('admin.home.page.text.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Section Titles</span>
                                    </a>
                                </li>
                                <li class="
                                @if(request()->path() == 'admin/sections') active
                                @endif">
                                    <a href="{{route('admin.sections.index')}}">
                                        <span class="sub-item">Section Hide / Show</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Footer', $permissions)))
                    {{-- Footer --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/footers') active
          @elseif(request()->path() == 'admin/ulinks') active
          @endif">
                        <a data-toggle="collapse" href="#footer">
                            <i class="fas fa-shoe-prints"></i>
                            <p>Footer</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
            @if(request()->path() == 'admin/footers') show
            @elseif(request()->path() == 'admin/ulinks') show
            @endif" id="footer">
                            <ul class="nav nav-collapse">
                                <li class="@if(request()->path() == 'admin/footers') active @endif">
                                    <a href="{{route('admin.footer.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Image & Text</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/ulinks') active @endif">
                                    <a href="{{route('admin.ulink.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Useful Links</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif



                @if (empty($admin->role) || (!empty($permissions) && in_array('Pages', $permissions)))
                    {{-- Dynamic Pages --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/page/create') active
          @elseif(request()->path() == 'admin/pages') active
          @elseif(request()->is('admin/page/*/edit')) active
          @endif">
                        <a data-toggle="collapse" href="#pages">
                            <i class="la flaticon-file"></i>
                            <p>Pages</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
            @if(request()->path() == 'admin/page/create') show
            @elseif(request()->path() == 'admin/pages') show
            @elseif(request()->is('admin/page/*/edit')) show
            @endif" id="pages">
                            <ul class="nav nav-collapse">
                                <li class="@if(request()->path() == 'admin/page/create') active @endif">
                                    <a href="{{route('admin.page.create')}}">
                                        <span class="sub-item">Create Page</span>
                                    </a>
                                </li>
                                <li class="
                @if(request()->path() == 'admin/pages') active
                @elseif(request()->is('admin/page/*/edit')) active
                @endif">
                                    <a href="{{route('admin.page.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Pages</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Blogs', $permissions)))
                    {{-- Blogs --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/bcategorys') active
          @elseif(request()->path() == 'admin/blogs') active
          @elseif(request()->is('admin/blog/*/edit')) active
          @endif">
                        <a data-toggle="collapse" href="#blog">
                            <i class="fas fa-blog"></i>
                            <p>Blogs</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
            @if(request()->path() == 'admin/bcategorys') show
            @elseif(request()->path() == 'admin/blogs') show
            @elseif(request()->is('admin/blog/*/edit')) show
            @endif" id="blog">
                            <ul class="nav nav-collapse">
                                <li class="@if(request()->path() == 'admin/bcategorys') active @endif">
                                    <a href="{{route('admin.bcategory.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Category</span>
                                    </a>
                                </li>
                                <li class="
                @if(request()->path() == 'admin/blogs') active
                @elseif(request()->is('admin/blog/*/edit')) active
                @endif">
                                    <a href="{{route('admin.blog.index') . '?language=' . $default->code}}">
                                        <span class="sub-item">Blogs</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('FAQ Management', $permissions)))
                    {{-- FAQ Management --}}
                    <li class="nav-item
           @if(request()->path() == 'admin/faqs') active @endif">
                        <a href="{{route('admin.faq.index') . '?language=' . $default->code}}">
                            <i class="la flaticon-round"></i>
                            <p>FAQ Management</p>
                        </a>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Contact Page', $permissions)))
                    {{-- Contact Page --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/contact') active @endif">
                        <a href="{{route('admin.contact.index') . '?language=' . $default->code}}">
                            <i class="la flaticon-whatsapp"></i>
                            <p>Contact Page</p>
                        </a>
                    </li>
                @endif


                {{-- Announcement Popup--}}
                @if (empty($admin->role) || (!empty($permissions) && in_array('Announcement Popup', $permissions)))
                <li class="nav-item
                    @if(request()->path() == 'admin/popup/create') active
                    @elseif(request()->path() == 'admin/popup/types') active
                    @elseif(request()->is('admin/popup/*/edit')) active
                    @elseif(request()->path() == 'admin/popups') active
                    @endif">
                    <a data-toggle="collapse" href="#announcementPopup">
                        <i class="fas fa-bullhorn"></i>
                        <p>Announcement Popup</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse
                        @if(request()->path() == 'admin/popup/create') show
                        @elseif(request()->path() == 'admin/popup/types') show
                        @elseif(request()->path() == 'admin/popups') show
                        @elseif(request()->is('admin/popup/*/edit')) show
                        @endif" id="announcementPopup">
                        <ul class="nav nav-collapse">
                            <li class="@if(request()->path() == 'admin/popup/types') active
                                @elseif(request()->path() == 'admin/popup/create') active
                                @endif">
                                <a href="{{route('admin.popup.types')}}">
                                <span class="sub-item">Add Popup</span>
                                </a>
                            </li>
                            <li class="@if(request()->path() == 'admin/popups') active
                                @elseif(request()->is('admin/popup/*/edit')) active
                                @endif">
                                <a href="{{route('admin.popup.index') . '?language=' . $default->code}}">
                                <span class="sub-item">Popups</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif


                {{-- Registered Users --}}
                @if (empty($admin->role) || (!empty($permissions) && in_array('Registered Users', $permissions)))
                    <li class="nav-item
         @if(request()->path() == 'admin/register/users') active
         @elseif(request()->is('admin/register/user/details/*')) active
         @elseif (request()->routeIs('register.user.changePass')) active
         @endif">
                        <a href="{{route('admin.register.user')}}">
                            <i class="la flaticon-users"></i>
                            <p>Registered Users</p>
                        </a>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Subscribers', $permissions)))
                    {{-- Subscribers --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/subscribers') active
          @elseif(request()->path() == 'admin/mailsubscriber') active
          @endif">
                        <a data-toggle="collapse" href="#subscribers">
                            <i class="la flaticon-envelope"></i>
                            <p>Subscribers</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
            @if(request()->path() == 'admin/subscribers') show
            @elseif(request()->path() == 'admin/mailsubscriber') show
            @endif" id="subscribers">
                            <ul class="nav nav-collapse">
                                <li class="@if(request()->path() == 'admin/subscribers') active @endif">
                                    <a href="{{route('admin.subscriber.index')}}">
                                        <span class="sub-item">Subscribers</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/mailsubscriber') active @endif">
                                    <a href="{{route('admin.mailsubscriber')}}">
                                        <span class="sub-item">Mail to Subscribers</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Payment Gateways', $permissions)))
                    {{-- Payment Gateways --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/gateways') active
          @elseif(request()->path() == 'admin/offline/gateways') active
          @endif">
                        <a data-toggle="collapse" href="#gateways">
                            <i class="la flaticon-paypal"></i>
                            <p>Payment Gateways</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
            @if(request()->path() == 'admin/gateways') show
            @elseif(request()->path() == 'admin/offline/gateways') show
            @endif" id="gateways">
                            <ul class="nav nav-collapse">
                                <li class="@if(request()->path() == 'admin/gateways') active @endif">
                                    <a href="{{route('admin.gateway.index')}}">
                                        <span class="sub-item">Online Gateways</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/offline/gateways') active @endif">
                                    <a href="{{route('admin.gateway.offline') . '?language=' . $default->code}}">
                                        <span class="sub-item">Offline Gateways</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                @endif



                @if (empty($admin->role) || (!empty($permissions) && in_array('Settings', $permissions)))
                    {{-- Basic Settings --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/favicon') active
          @elseif(request()->path() == 'admin/logo') active
          @elseif(request()->path() == 'admin/preloader') active
          @elseif(request()->path() == 'admin/basicinfo') active
          @elseif(request()->path() == 'admin/social') active
          @elseif(request()->is('admin/social/*')) active
          @elseif(request()->path() == 'admin/breadcrumb') active
          @elseif(request()->path() == 'admin/heading') active
          @elseif(request()->path() == 'admin/script') active
          @elseif(request()->path() == 'admin/seo') active
          @elseif(request()->path() == 'admin/maintainance') active
          @elseif(request()->path() == 'admin/cookie-alert') active
          @elseif(request()->path() == 'admin/mail-from-admin') active
          @elseif(request()->path() == 'admin/mail-to-admin') active
          @elseif(request()->path() == 'admin/email-templates') active
          @elseif(request()->routeIs('admin.product.tags')) active
          @elseif(request()->routeIs('admin.email.editTemplate')) active
          @elseif(request()->path() == 'admin/seo') active
          @endif">
                        <a data-toggle="collapse" href="#basic">
                            <i class="la flaticon-settings"></i>
                            <p>Settings</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse
            @if(request()->path() == 'admin/favicon') show
            @elseif(request()->path() == 'admin/logo') show
            @elseif(request()->path() == 'admin/preloader') show
            @elseif(request()->path() == 'admin/basicinfo') show
            @elseif(request()->path() == 'admin/social') show
            @elseif(request()->is('admin/social/*')) show
            @elseif(request()->path() == 'admin/breadcrumb') show
            @elseif(request()->path() == 'admin/heading') show
            @elseif(request()->path() == 'admin/script') show
            @elseif(request()->path() == 'admin/seo') show
            @elseif(request()->path() == 'admin/maintainance') show
            @elseif(request()->path() == 'admin/cookie-alert') show
            @elseif(request()->path() == 'admin/mail-from-admin') show
            @elseif(request()->path() == 'admin/mail-to-admin') show
            @elseif(request()->path() == 'admin/email-templates') show
            @elseif(request()->routeIs('admin.product.tags')) show
            @elseif(request()->routeIs('admin.email.editTemplate')) show
            @elseif(request()->path() == 'admin/seo') show
            @endif" id="basic">
                            <ul class="nav nav-collapse">
                                <li class="@if(request()->path() == 'admin/favicon') active @endif">
                                    <a href="{{route('admin.favicon')}}">
                                        <span class="sub-item">Favicon</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/logo') active @endif">
                                    <a href="{{route('admin.logo')}}">
                                        <span class="sub-item">Logo</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/basicinfo') active @endif">
                                    <a href="{{route('admin.basicinfo')}}">
                                        <span class="sub-item">General Settings</span>
                                    </a>
                                </li>

                                <li class="submenu">
                                    <a data-toggle="collapse" href="#emailset"
                                       aria-expanded="{{(request()->path() == 'admin/mail-from-admin' || request()->path() == 'admin/mail-to-admin' || request()->path() == 'admin/email-templates' || request()->routeIs('admin.email.editTemplate')) ? 'true' : 'false' }}">
                                        <span class="sub-item">Email Settings</span>
                                        <span class="caret"></span>
                                    </a>
                                    <div
                                        class="collapse {{(request()->path() == 'admin/mail-from-admin' || request()->path() == 'admin/mail-to-admin' || request()->path() == 'admin/email-templates' || request()->routeIs('admin.email.editTemplate')) ? 'show' : '' }}"
                                        id="emailset">
                                        <ul class="nav nav-collapse subnav">
                                            <li class="@if(request()->path() == 'admin/mail-from-admin') active @endif">
                                                <a href="{{route('admin.mailFromAdmin')}}">
                                                    <span class="sub-item">Mail from Admin</span>
                                                </a>
                                            </li>
                                            <li class="@if(request()->path() == 'admin/mail-to-admin') active @endif">
                                                <a href="{{route('admin.mailToAdmin')}}">
                                                    <span class="sub-item">Mail to Admin</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="@if(request()->path() == 'admin/preloader') active @endif">
                                    <a href="{{route('admin.preloader')}}">
                                    <span class="sub-item">{{__('Preloader')}}</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/breadcrumb') active @endif">
                                    <a href="{{route('admin.breadcrumb')}}">
                                        <span class="sub-item">Breadcrumb</span>
                                    </a>
                                </li>

                                <li class="@if(request()->path() == 'admin/social') active
                                @elseif(request()->is('admin/social/*')) active @endif">
                                    <a href="{{route('admin.social.index')}}">
                                        <span class="sub-item">Social Links</span>
                                    </a>
                                </li>

                                <li class="@if(request()->path() == 'admin/script') active @endif">
                                    <a href="{{route('admin.script')}}">
                                        <span class="sub-item">Plugins</span>
                                    </a>
                                </li>

                                <li class="@if(request()->path() == 'admin/maintainance') active @endif">
                                    <a href="{{route('admin.maintainance')}}">
                                        <span class="sub-item">Maintainance Mode</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/cookie-alert') active @endif">
                                    <a href="{{route('admin.cookie.alert') . '?language=' . $default->code}}">
                                        <span class="sub-item">Cookie Alert</span>
                                    </a>
                                </li>
                                <li class="@if(request()->path() == 'admin/seo') active @endif">
                                    <a href="{{route('admin.seo', ['language' => $default->code])}}">
                                    <span class="sub-item">SEO Information</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Language Management', $permissions)))
                    {{-- Language Management Page --}}
                    <li class="nav-item
         @if(request()->path() == 'admin/languages') active
         @elseif(request()->is('admin/language/*/edit')) active
         @elseif(request()->is('admin/language/*/edit/keyword')) active
         @endif">
                        <a href="{{route('admin.language.index')}}">
                            <i class="la flaticon-chat-8"></i>
                            <p>Language Management</p>
                        </a>
                    </li>
                @endif


                @if (empty($admin->role) || (!empty($permissions) && in_array('Role Management', $permissions)))
                    {{-- Role Management Page --}}
                    <li class="nav-item
          @if(request()->path() == 'admin/roles') active
          @elseif(request()->is('admin/role/*/permissions/manage')) active
          @endif">
                        <a href="{{route('admin.role.index')}}">
                            <i class="la flaticon-multimedia-2"></i>
                            <p>Role Management</p>
                        </a>
                    </li>
                @endif



                @if (empty($admin->role) || (!empty($permissions) && in_array('Admins Management', $permissions)))
                    {{-- Admins Management Page --}}
                    <li class="nav-item
           @if(request()->path() == 'admin/users') active
           @elseif(request()->is('admin/user/*/edit')) active
           @endif">
                        <a href="{{route('admin.user.index')}}">
                            <i class="la flaticon-user-5"></i>
                            <p>Admins Management</p>
                        </a>
                    </li>
                @endif

                @if (empty($admin->role) || (!empty($permissions) && in_array('Sitemap', $permissions)))
                    {{-- Sitemap--}}
                    <li class="nav-item
            @if(request()->path() == 'admin/sitemap') active @endif">
                        <a href="{{route('admin.sitemap.index') . '?language=' . $default->code}}">
                            <i class="fa fa-sitemap"></i>
                            <p>Sitemap</p>
                        </a>
                    </li>
                @endif


                {{-- Cache Clear --}}
                <li class="nav-item">
                    <a href="{{route('admin.cache.clear')}}">
                        <i class="la flaticon-close"></i>
                        <p>Clear Cache</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

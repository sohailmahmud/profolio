<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Membership;
use App\Models\OfflineGateway;
use App\Models\Package;
use App\Models\PaymentGateway;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BuyPlanController extends Controller
{
    public function index()
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $data['bex'] = $currentLang->basic_extended;
        $data['packages'] = Package::all();
        $nextPackageCount = Membership::query()->where([
            ['user_id', Auth::id()],
            ['expire_date', '>=', Carbon::now()->toDateString()]
        ])->count();
        $data['membership'] = Membership::query()->where([
            ['user_id', Auth::id()],
            ['start_date', '>', Carbon::now()->toDateString()]
        ])->first();
        $data['package'] = isset($data['membership']) ? Package::query()->where('id', $data['membership']->package_id)->first() : null;
        //current package
        $data['current_membership'] = Membership::query()->where([
            ['user_id', Auth::id()],
            ['start_date', '<=', Carbon::now()->toDateString()],
            ['expire_date', '>=', Carbon::now()->toDateString()]
        ])->first();
        if($data['current_membership']){
            $data['next_membership'] = Membership::query()->where([
                ['user_id', Auth::id()],
                ['start_date', '>', $data['current_membership']->expire_date],
            ])->first();
            $data['next_package'] = $data['next_membership'] ? Package::query()->where('id', $data['next_membership']->package_id)->first() : null;
        }
        $data['current_package'] = $data['current_membership'] ? Package::query()->where('id', $data['current_membership']->package_id)->first() : null;
        $data['package_count'] = $nextPackageCount;
        return view('user.buy_plan.index', $data);
    }

    public function checkout($package_id)
    {
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()
                ->get('lang'))
                ->first();
        } else {
            $currentLang = Language::where('is_default', 1)
                ->first();
        }
        $be = $currentLang->basic_extended;
        $online = PaymentGateway::query()->where('status', 1)->get();
        $offline = OfflineGateway::all();
        $data['offline'] = $offline;
        $data['payment_methods'] = $online->merge($offline);
        $data['package'] = Package::query()->findOrFail($package_id);
        $data['membership'] = Membership::query()->where([
            ['user_id', Auth::id()],
            ['expire_date', '>=', \Carbon\Carbon::now()->format('Y-m-d')]
            ])
            ->latest()
            ->first();
        $data['bex'] = $be;
        return view('user.buy_plan.checkout', $data);

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Membership;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data['memberships'] = Membership::query()->when($search, function ($query, $search) {
            return $query->where('transaction_id', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('admin.payment_log.index', $data);
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

    public function transaction(Request $request)
    {
        $search = $request->search;
        $data['memberships'] = Membership::query()
            ->where('admin_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('transaction_id', $search);
            })
            ->orderBy('expire_date', 'DESC')
            ->paginate(10);
        return view('admin.transaction.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     */
    public function update(Request $request)
    {

        $currentLang = session()->has('lang') ?
            (Language::where('code', session()->get('lang'))->first())
            : (Language::where('is_default', 1)->first());
        $be = $currentLang->basic_extended;
        $membership = Membership::query()->findOrFail($request->id);
        $membership->update(['status' => $request->status]);
        $user = User::query()->findOrFail($membership->user_id);
        $package = Package::query()->findOrFail($membership->package_id);
        if ($request->status === "1") {
            $membership['first_name'] = $user->first_name;
            $membership['last_name'] = $user->last_name;
            $membership['username'] = $user->username;
            $membership['email'] = $user->email;
            $data['payment_method'] = $membership->payment_method;

            //comparison date
            $date1 = Carbon::createFromFormat('m/d/Y', \Carbon\Carbon::parse($membership->start_date)->format('m/d/Y'));
            $date2 = Carbon::createFromFormat('m/d/Y', \Carbon\Carbon::now()->format('m/d/Y'));
            $result = $date1->gte($date2);
            if($result){
                $data['start_date'] = $membership->start_date;
                $data['expire_date'] = $membership->expire_date;
            }
            else{
                $data['start_date'] = Carbon::now()->format('d-m-Y');
                if ($package->term === "daily") {
                    $data['expire_date'] = Carbon::today()->addDay()->format('d-m-Y');
                } elseif ($package->term === "weekly") {
                    $data['expire_date'] = Carbon::today()->addWeek()->format('d-m-Y');
                } elseif ($package->term === "monthly") {
                    $data['expire_date'] = Carbon::today()->addMonth()->format('d-m-Y');
                } else {
                    $data['expire_date'] = Carbon::today()->addYear()->format('d-m-Y');
                }
                $membership->update(['start_date' =>  $data['start_date']]);
                $membership->update(['expire_date' =>  $data['expire_date']]);
            }
            $count_membership = Membership::query()->where('user_id', $membership->user_id)->count();
            if ($count_membership > 1) {
                $filename = $this->makeInvoice($data, "membership", $membership, $user->password, $membership->amount, "offline", $user->phone,$be->base_currency_symbol_position,$be->base_currency_symbol,$be->base_currency_text,$membership->transaction_id,$package->title);
                $subject = "Your membership request is approved";
                $body = "We have approved your membership. This is a confirmation mail from us. Please see the invoice attachment below";
                $this->sendMailWithPhpMailer($data, $filename, $be, $subject, $body, $user->email, $user->first_name . ' ' . $user->last_name);
            } else {
                $filename = $this->makeInvoice($data, "membership", $membership, $user->password, $membership->amount, "offline", $user->phone,$be->base_currency_symbol_position,$be->base_currency_symbol,$be->base_currency_text,$membership->transaction_id,$package->title);
                $email = $user->email;
                $subject = "Your membership request is approved";
                $body = "We have approved your membership. This is a confirmation mail from us. Email: {$email}";
                $user->update([
                    'status' => 1
                ]);
                $this->sendMailWithPhpMailer($data, $filename, $be, $subject, $body, $user->email, $user->first_name . ' ' . $user->last_name);
            }
        } elseif ($request->status == 2) {
            $subject = "Your membership request is rejected";
            $body = "Sorry, your membership request for <strong>" . $package->title . "</strong> has been rejected.";

            $this->sendMailWithPhpMailer(false, false, $be, $subject, $body, $user->email, $user->first_name . ' ' . $user->last_name);
        }
        session()->flash('success', "Membership status changed successfully!");
        return redirect()->route('admin.payment-log.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\User\UserCheckoutController;
use App\Http\Helpers\UserPermissionHelper;
use App\Models\Language;
use App\Models\Package;
use PHPMailer\PHPMailer\Exception;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Models\PaymentGateway;
use Config;
use Session;

class StripeController extends Controller
{
    public function __construct()
    {
        //Set Spripe Keys
        $stripe = PaymentGateway::findOrFail(14);
        $stripeConf = json_decode($stripe->information, true);
        Config::set('services.stripe.key', $stripeConf["key"]);
        Config::set('services.stripe.secret', $stripeConf["secret"]);
    }

    public function paymentProcess(Request $request, $_amount, $_title, $_success_url, $_cancel_url)
    {
        $title = $_title;
        $price = $_amount;
        $price = round($price, 2);
        $cancel_url = $_cancel_url;

        Session::put('request', $request->all());


        $stripe = Stripe::make(Config::get('services.stripe.secret'));
        try {

            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->cardNumber,
                    'exp_month' => $request->month,
                    'exp_year' => $request->year,
                    'cvc' => $request->cardCVC,
                ],
            ]);

            if (!isset($token['id'])) {
                return back()->with('error', 'Token Problem With Your Token.');
            }

            $charge = $stripe->charges()->create([
                'card' => $token['id'],
                'currency' =>  "USD",
                'amount' => $price,
                'description' => $title,
            ]);


            if ($charge['status'] == 'succeeded') {
                $paymentFor = Session::get('paymentFor');
                $package = Package::find($request->package_id);
                $transaction_id = UserPermissionHelper::uniqidReal(8);
                $transaction_details = json_encode($charge);
                
                $currentLang = session()->has('lang') ?
                (Language::where('code', session()->get('lang'))->first())
                : (Language::where('is_default', 1)->first());
                $be = $currentLang->basic_extended;

                if ($paymentFor == "membership") {
                    $amount = $request->price;
                    $password = $request->password;
                    $checkout = new CheckoutController();
                    $admin = $checkout->store($request, $transaction_id, $transaction_details, $amount,$be,$password);
                    $subject = "You made your membership purchase successful";
                    $body = "You made a payment. This is a confirmation mail from us.Please get your credentials below.
                             <br>
                             <h4 style='color:#141414; font-weight: 600; font-size: 14px;'>Email: {$admin->email}</h4>
                             <h4 style='color:#141414; font-weight: 600; font-size: 14px;'>Password: {$password}</h4>
                             <br>
                             Thank you for your purchase.
                             ";
                    $file_name = $this->makeInvoice($request,"membership",$admin,$password,$amount,"Paystack",$request['phone'],$be->base_currency_symbol_position,$be->base_currency_symbol,$be->base_currency_text,$transaction_id,$package->title);
                    $this->sendMailWithPhpMailer($request,$file_name,$be,$subject,$body,$request['email'],$request['first_name'].' '.$request['last_name']);
                    session()->flash('success', __('successful_payment'));
                    Session::forget('request');
                    Session::forget('paymentFor');
                    return redirect()->route('success.page');
                }
                elseif($paymentFor == "extend") {
                    $amount = $request['price'];
                    $password = uniqid('qrcode');
                    $checkout = new UserCheckoutController();
                    $user = $checkout->store($request, $transaction_id, $transaction_details, $amount,$be,$password);
                    $subject = "You made your membership purchase successful";
                    $body = "You made a payment. This is a confirmation mail from us. Please see the invoice attachment below";
                    $file_name = $this->makeInvoice($request,"extend",$user,$password,$amount,$request["payment_method"],$user->phone_number,$be->base_currency_symbol_position,$be->base_currency_symbol,$be->base_currency_text,$transaction_id,$package->title);
                    $this->sendMailWithPhpMailer($request,$file_name,$be,$subject,$body,$user->email,$user->first_name.' '.$user->last_name);
                    session()->flash('success', __('successful_payment'));
                    Session::forget('request');
                    Session::forget('paymentFor');
                    return redirect()->route('success.page');
                }
            }
        } catch (Exception $e) {
            return redirect($cancel_url)->with('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return redirect($cancel_url)->with('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return redirect($cancel_url)->with('error', $e->getMessage());
        }
        return redirect($cancel_url)->with('error', 'Please Enter Valid Credit Card Informations.');
    }

    public function cancelPayment()
    {
        $requestData = Session::get('request');
        $paymentFor = Session::get('paymentFor');
        session()->flash('error', __('cancel_payment'));
        if($paymentFor == "membership"){
            return redirect()->route('front.register.view',['status' => $requestData['package_type'],'id' => $requestData['package_id']])->withInput($requestData);
        }else{
            return redirect()->route('user.plan.extend.checkout',['package_id' => $requestData['package_id']])->withInput($requestData);
        }
    }
}

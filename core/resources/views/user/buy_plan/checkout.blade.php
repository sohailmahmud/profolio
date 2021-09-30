@extends('user.layout')

@section('content')
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row justify-content-center align-items-center mb-1">
        <div class="col-md-1 pl-md-0">
        </div>

        <div class="col-md-6 pl-md-0 pr-md-0">
            <div class="card card-pricing card-pricing-focus card-secondary">
                <form action="{{route('user.plan.checkout')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="package_id" value="{{$package->id}}">
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    <input type="hidden" name="payment_method" id="payment" value="{{old('payment_method')}}">
                    <div class="card-header">
                        <h4 class="card-title">{{$package->title}}</h4>
                        <div class="card-price">
                            <span class="price">{{$package->price== 0 ? "Free" : format_price($package->price)}}</span>
                            <span class="text">/{{$package->term}}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="specification-list">
                            <li>
                                <span class="name-specification">Membership</span>
                                <span class="status-specification">Yes</span>
                            </li>
                            <li>
                                <span class="name-specification">Start Date</span>
                                <input type="hidden" name="start_date" value="{{\Illuminate\Support\Carbon::parse($membership->expire_date ?? \Carbon\Carbon::yesterday())->addDay()->format('d-m-Y')}}">
                                <span
                                    class="status-specification">{{\Illuminate\Support\Carbon::parse($membership->expire_date ?? \Carbon\Carbon::yesterday())->addDay()->format('d-m-Y')}}</span>
                            </li>
                            <li>
                                <span class="name-specification">Expire Date</span>
                                <span class="status-specification">
                                    @if($package->term === "daily")
                                        {{\Illuminate\Support\Carbon::parse($membership->expire_date ?? now())->addDay()->format('d-m-Y')}}
                                        <input type="hidden" name="expire_date" value="{{\Illuminate\Support\Carbon::parse($membership->expire_date ?? now())->addDay()->format('d-m-Y')}}">
                                    @elseif($package->term === "weekly")
                                        {{\Illuminate\Support\Carbon::parse($membership->expire_date ?? now())->addWeek()->format('d-m-Y')}}
                                        <input type="hidden" name="expire_date" value="{{\Illuminate\Support\Carbon::parse($membership->expire_date ?? now())->addWeek()->format('d-m-Y')}}">
                                    @elseif($package->term === "monthly")
                                        {{\Illuminate\Support\Carbon::parse($membership->expire_date ?? now())->addMonth()->format('d-m-Y')}}
                                        <input type="hidden" name="expire_date" value="{{\Illuminate\Support\Carbon::parse($membership->expire_date ?? now())->addMonth()->format('d-m-Y')}}">
                                    @else
                                        {{\Illuminate\Support\Carbon::parse($membership->expire_date ?? now())->addYear()->format('d-m-Y')}}
                                        <input type="hidden" name="expire_date" value="{{\Illuminate\Support\Carbon::parse($membership->expire_date ?? now())->addYear()->format('d-m-Y')}}">
                                    @endif
                            </span>
                            </li>
                            <li>
                                <span class="name-specification">Total Cost</span>
                                <input type="hidden" name="price" value="{{$package->price}}">
                                <span class="status-specification">
                                    {{$package->price== 0 ? "Free" : format_price($package->price)}}
                                </span>
                            </li>
                            @if($package->price != 0)
                            <li>
                                <div class="form-group px-0">
                                    <label class="text-white">Payment Method</label>
                                    <select name="payment_method" class="form-control input-solid" id="payment-gateway"
                                            required>
                                        <option value="" disabled selected>Select a Payment Method</option>
                                        @foreach($payment_methods as $payment_method)
                                            <option value="{{$payment_method->name}}" {{old("payment_method") == $payment_method->name ? "selected":""}}>{{$payment_method->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            @endif

                            

                            <div class="row gateway-details pt-3 text-left" id="tab-stripe" style="display: none;">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Card Number')}} *</label>
        
                                        <input type="text" class="form-control" name="cardNumber" placeholder="{{ __('Card Number')}}" autocomplete="off" oninput="validateCard(this.value);" disabled />
        
                                        @if($errors->has('cardNumber'))
                                        <p class="text-danger mb-0">{{ $errors->first('cardNumber') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('CVC')}} *</label>
                                        
                                        <input type="text" class="form-control" placeholder="{{ __('CVC') }}" name="cardCVC" oninput="validateCVC(this.value);" disabled>
                                        
                                        @if($errors->has('cardCVC'))
                                        <p class="text-danger mb-0">{{ $errors->first('cardCVC') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('Month')}} *</label>
                                        
                                        <input type="text" class="form-control" placeholder="{{__('Month')}}" name="month" disabled>
                                        
                                        @if($errors->has('month'))
                                        <p class="text-danger mb-0">{{ $errors->first('month') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        
                                        <label>{{__('Year')}} *</label>
                                        
                                        <input type="text" class="form-control" placeholder="{{__('Year')}}" name="year" disabled>
                                        
                                        @if($errors->has('year'))
                                        <p class="text-danger mb-0">{{ $errors->first('year') }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div id="instructions" class="text-left"></div>
                            <input type="hidden" name="is_receipt" value="0" id="is_receipt">
                        </ul>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-light btn-block" type="submit"><b>Checkout Now</b></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-1 pr-md-0"></div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            "use strict";
            $("#payment-gateway").on('change', function () {
                let offline = @php echo json_encode($offline); @endphp;
                let data = [];
                offline.map(({id, name}) => {
                    data.push(name);
                });
                let paymentMethod = $("#payment-gateway").val();

                if(paymentMethod == 'Stripe') {
                    $("#tab-stripe").show();
                    $("#tab-stripe input").removeAttr('disabled');
                } else {
                    $(".gateway-details").hide();
                    $("#tab-stripe input").attr('disabled', true);
                }

                if (data.indexOf(paymentMethod) !== -1) {
                    let formData = new FormData();
                    formData.append('name', paymentMethod);
                    $.ajax({
                        url: '{{route('front.payment.instructions')}}',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        cache: false,
                        data: formData,
                        success: function (data) {
                            let instruction = $("#instructions");
                            let instructions = `<div class="gateway-desc">${data.instructions}</div>`;
                            if (data.description != null) {
                                var description = `<div class="gateway-desc"><p>${data.description}</p></div>`;
                            } else {
                                var description = `<div></div>`;
                            }
                            let receipt = `<div class="form-element mb-2">
                                              <label>Receipt<span>*</span></label><br>
                                              <input type="file" name="receipt" value="" class="file-input" required>
                                              <p class="mb-0 text-warning">** Receipt image must be .jpg / .jpeg / .png</p>
                                           </div>`;
                            if (data.is_receipt === 1) {
                                $("#is_receipt").val(1);
                                let finalInstruction = instructions + description + receipt;
                                instruction.html(finalInstruction);
                            } else {
                                $("#is_receipt").val(0);
                                let finalInstruction = instructions + description;
                                instruction.html(finalInstruction);
                            }
                            $('#instructions').fadeIn();
                        },
                        error: function (data) {
                        }
                    })
                } else {
                    $('#instructions').fadeOut();
                }
            });
        });
    </script>
@endsection

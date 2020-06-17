@extends('Backend.master')

@section('title')
    Booking Details
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Hotel New York Booking</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">

                <form class="form-inline">
                    <label class="col-sm-2" for="check_in">Booking ID</label>
                    <input type="number" readonly value="{{$booking_details->id}}" class="col-sm-2 form-control">
                    <label class="col-sm-2" for="check_in">Check In</label>
                    <input type="date" readonly value="{{$temp[0]}}" class="col-sm-2 form-control">
                    <label class="col-sm-2" for="check_out">Check Out</label>
                    <input type="date" readonly value="{{$temp2[0]}}" class="col-sm-2 form-control">
                </form>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-4">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Booking Information</h6>
                    </div>
                    <div class="card-body">
                             <div class="form-group row">
                                <label for="room" class="col-md-5 col-form-label text-md-right">{{ __('Room Number') }}</label>
                                <div class="col-md-7">
                                    <input id="room" type="text" readonly  class="form-control" name="room_id" value="{{$booking_details->room_id}}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rent" class="col-md-5 col-form-label text-md-right">{{ __('Rent Per Night') }}</label>
                                <div class="col-md-7">
                                    <input type="text" readonly  class="form-control" value="{{$booking_details->basic_rent}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-5 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <div class="col-md-7">
                                    <input type="text" readonly class="form-control" name="full_name" value="{{$booking_details->full_name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile_no" class="col-md-5 col-form-label text-md-right">{{ __('Mobile No.') }}</label>
                                <div class="col-md-7">
                                    <input id="mobile_no" readonly type="text" class="form-control" name="mobile_no" value="{{$booking_details->mobile_no}}" required autocomplete="Mobile Number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="national_id" class="col-md-5 col-form-label text-md-right">{{ __('National Id') }}</label>
                                <div class="col-md-7">
                                    <input id="national_id"  readonly type="text" class="form-control" value="{{$booking_details->national_id}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="passport_no" class="col-md-5 col-form-label text-md-right">{{ __('Passport No') }}</label>
                                <div class="col-md-7">
                                    <input id="passport_no" readonly type="text" class="form-control" name="passport_no" value="{{$booking_details->passport_no}}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile_two" class="col-md-5 col-form-label text-md-right">{{ __('Phone Number ') }}</label>

                                <div class="col-md-7">
                                    <input id="mobile_two" readonly type="text" value="{{$booking_details->mobile_two}}" class="form-control" name="mobile_two">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label style="color: #1b4b72" for="booked_by" class="col-md-5 col-form-label text-md-right"><b>{{ __('Last Update By ') }}</b></label>

                                <div class="col-md-7">
                                    <input style="color: #1b4b72" id="mobile_two" readonly type="text" value="{{$userName->employeeName($booking_details->created_by)->name}}({{$booking_details->created_by}})" class="form-control" name="mobile_two">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Rent Information</h6>
                    </div>
                    <div class="card-body">
                            <div class="form-group row">
                                <label for="bookingDays" class="col-md-5 col-form-label text-md-right">{{ __('Booking Days') }}</label>
                                <div class="col-md-7">
                                    <input readonly type="number" class="form-control"  value="{{$booking_details->booking_days}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Adult" class="col-md-5 col-form-label text-md-right">{{ __('Adult') }}</label>
                                <div class="col-md-7">
                                    <input readonly type="number" class="form-control"  value="{{$booking_details->adults}}">
                                </div>
                            </div>
                               <div class="form-group row">
                                <label for="Children" class="col-md-5 col-form-label text-md-right">{{ __('Children') }}</label>
                                <div class="col-md-7">
                                    <input readonly type="number" class="form-control"  value="{{$booking_details->children}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="TotalPrice" class="col-md-5 col-form-label text-md-right">{{ __('Total Rent') }}</label>
                                <div class="col-md-7">
                                    <input readonly type="number" class="form-control"  value="{{$booking_details->total_rent}}">
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="Discount" class="col-md-5 col-form-label text-md-right">{{ __('Discount') }}</label>
                            <div class="col-md-7">
                                <input readonly type="text" class="form-control"  value="{{$booking_details->discount}} %" >
                            </div>
                        </div>

                    <?php $i=1; ?>
                                @foreach($payment as $item)
                            <div class="form-group row">
                                <label for="Partial_payment" class="col-md-5 col-form-label text-md-right">{{ __('Payment') }} {{$i++}}</label>
                                <div class="col-md-7">
                                    <input type="number" readonly class="form-control" name="Partial_payment" value="{{$item->paid_amount}}">
                                </div>
                            </div>
                                    @endforeach


                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info">Customer Information</h6>
                    </div>
                    <div class="card-body">
                           <div class="form-group row">
                                <label for="occupation" class="col-md-5 col-form-label text-md-right">{{ __('Occupation') }} </label>

                                <div class="col-md-7">
                                    <input id="occupation" readonly type="text" class="form-control" name="occupation" value="{{$booking_details->occupation}}" required autocomplete="Last Name">
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="Pov" class="col-md-5 col-form-label text-md-right">{{ __('Purpose Of Visit') }}</label>

                                <div class="col-md-7">
                                    <input id="Pov" readonly type="text" class="form-control" value="{{ $booking_details->purpose_of_visit}}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-5 col-form-label text-md-right">{{ __('Address 1') }} </label>
                                <div class="col-md-7">
                                    <textarea id="address" class="form-control" name="address" required>{{$booking_details->address}}</textarea>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-md-5 col-form-label text-md-right">{{ __('City') }} </label>
                                <div class="col-md-7">
                                    <input id="city" readonly type="text" class="form-control" value="{{$booking_details->city}}">
                                </div>
                            </div>
                        <div class="form-group row">
                                <label for="Country" class="col-md-5 col-form-label text-md-right">{{ __('Country') }} </label>
                            <div class="col-md-7">
                                <input id="city" readonly type="text" class="form-control" value="{{$booking_details->country}}">
                            </div>
                        </div>
                        <div class="form-group row"  style="padding-bottom: 30px">
                            <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-7">
                                <input id="email"  readonly type="email" class="form-control" name="email" value="{{ $booking_details->email_address}}">
                            </div>
                        </div>
                </div>

            </div>

        </div>


        <!-- DataTales Example -->

        </div>
        <div class="row">
            <div class="col-sm-4">
            <a href="{{url('/partial-payment-form/'.$booking_details->book_id)}}">
                <button class="btn btn-success">
                <i class="fas fa-money-check-alt"></i>  {{ __('Partial Payment') }}
            </button>
            </a>
            </div>
            @if($booking_details->bookstatus!=4)
            <div class="col-sm-4" style="text-align: center">
                <a href="{{url('/additional-service-costs/'.$booking_details->book_id)}}">

                    <button class="btn btn-info">
                        <i class="fas fa-calculator"></i>  {{ __('Service') }}
                    </button>
                </a>
            </div>
            <div class="col-sm-4" style="text-align: right">
                <a href="{{url('/view-checkout-form/'.$booking_details->book_id)}}">
                <button class="btn btn-warning">
                    <i class="fas fa-sign-out-alt"></i>  {{ __('Check Out') }}
                </button>
                </a>
            </div>
                @endif
        </div>
    <!-- /.container-fluid -->


@endsection


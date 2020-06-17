@extends('Backend.master')

@section('title')
    Edit Booking
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Edit Booking Information</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                    <h6 style="text-align: center" class="text-danger">{{ Session::get('Message') }}</h6>

                </div>
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
                        <form method="POST" action="{{ route('update-booking') }}" name="confirmBooking">
                            @csrf

                            <div class="form-group row">
                                <label for="room" class="col-md-5 col-form-label text-md-right">{{ __('Room Number') }}</label>
                                <div class="col-md-7">
                                    <input type="hidden" name="booking_id" value="{{$bookingInfo->id}}" >
                                    <input id="room" type="text" readonly  class="form-control" name="room_id" value="{{$bookingInfo->room_id}}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rent" class="col-md-5 col-form-label text-md-right">{{ __('Rent Per Night') }}</label>
                                <div class="col-md-7">
                                    <input id="rent" type="text" readonly  class="form-control @error('rent_per_night') is-invalid @enderror" name="rent_per_night" value="{{$bookingInfo->basic_rent}}">
                                    @error('rent_per_night')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Rent Information</h6>
                    </div>
                    <div class="card-body">
                        <?php
                        $temp = explode(' ', $bookingInfo->check_in);
                        $temp2 = explode(' ', $bookingInfo->check_out);
                        ?>
                        <div class="form-group row">
                            <label for="check_in" class="col-md-5 col-form-label text-md-right">{{ __('Check In') }}</label>
                            <div class="col-md-7">
                                <input id="check_in" type="date" readonly  class="form-control" value="{{$temp[0]}}" >
                              </div>
                        </div>
                        <div class="form-group row">
                            <label for="checkOut" class="col-md-5 col-form-label text-md-right">{{ __('Check Out') }}</label>
                            <div class="col-md-7">
{{--                                {{Date('Y-m-d', time() + 86400)}}--}}
                                <input id="checkOut" onchange="myFunction()" min="{{Date('Y-m-d', time() + 86400)}}" type="date"  class="form-control" name="check_out" value="{{$temp2[0]}}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Due_payment" class="col-md-5 col-form-label text-md-right">{{ __('Partial Payment') }}</label>
                            <div class="col-md-7">
                                <input id="PartialPayment" readonly type="number" class="form-control" value="{{$paymentPartial}}">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Due_payment" class="col-md-5 col-form-label text-md-right">{{ __('New Total') }}</label>
                            <div class="col-md-7">
                                <input id="NewTotal" readonly type="number" name="total_rent" class="form-control">
                                @error('total_rent')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Due_payment" class="col-md-5 col-form-label text-md-right">{{ __('Adjust Amount') }}</label>
                            <div class="col-md-7">
                                <input id="AdjustAmount" readonly type="number" name="adjust_rent" class="form-control">
                                @error('adjust_rent')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input id="Bookdays" readonly type="hidden" name="booking_days" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="PartialPayment" class="col-md-5 col-form-label text-md-right">{{ __('New Payment') }}</label>
                            <div class="col-md-7">
                                <input id="NewPay" min="0" type="number" class="form-control" name="partial_payment" value="0">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-5">
                        <button  type="submit" class="btn btn-primary col-sm-4">
                            {{ __('Update') }}
                        </button>

                    </div>
                </div>
            </div>
            </form>
            <!-- DataTales Example -->

        </div>
        <!-- /.container-fluid -->
        <script>
            function myFunction() {

                var x = document.getElementById("checkOut").value;
                var y = document.getElementById("check_in").value;
                var rent = document.getElementById("rent").value;
                var partialPayment = document.getElementById("PartialPayment").value;

                $.ajax({
                    type: 'POST',
                    url: '{{url('/edit-date-calculation')}}',
                    data: {checkOut:x,checkIn:y,"_token":"{{csrf_token()}}"},

                }).done(function( msg ) {
                        console.log(msg);
                    var res= msg*rent-partialPayment;
                    document.getElementById("NewTotal").value = msg*rent;
                    document.getElementById("AdjustAmount").value = res;
                    document.getElementById("Bookdays").value = msg;
                    document.getElementById("NewPay").max = res;
                });


            }
        </script>

@endsection


@extends('Backend.master')

@section('title')
    Cancel Bookings
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">Cancel & Refund Booking</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-4">

                <!-- Basic Card Example -->
            </div>
            <div class="col-lg-4">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-danger" style="text-align: center">Refund Booking</h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cancel-booking-with-refund') }}" name="confirmBooking">
                            @csrf
                        <div class="form-group row">
                            <label for="booking_id" class="col-md-5 col-form-label text-md-right">{{ __('Booking ID') }} </label>

                            <div class="col-md-7">
                                <input id="booking_id" type="text" class="form-control" readonly name="booking_id" value="{{ $bookingInfo->id }}">
                                @error('booking_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Pov" class="col-md-5 col-form-label text-md-right">{{ __('Room No') }}</label>
                            <div class="col-md-7">
                                <input id="Pov" type="text" class="form-control @error('room_no') is-invalid @enderror" readonly name="room_no" value="{{ $bookingInfo->room_id }}" >
                                @error('room_no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-5 col-form-label text-md-right">{{ __('Customer Name') }} </label>
                            <div class="col-md-7">
                                <textarea id="address" class="form-control" required>{{$bookingInfo->full_name}}</textarea>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="mobile_no" class="col-md-5 col-form-label text-md-right">{{ __('Mobile No') }} </label>
                            <div class="col-md-7">
                                <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" value="{{$bookingInfo->mobile_no}}" name="mobile_no" required >
                                @error('mobile_no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group row">
                                <label for="payment" class="col-md-5 col-form-label text-md-right">{{ __('Partial Payment') }} </label>
                                <div class="col-md-7">
                                    <input id="payment" type="text" class="form-control" value="{{$paymentamount}}" name="refund_amount" required >
                                    @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row"  style="padding-bottom: 30px">
                             <div class="col-md-5" style="text-align: right">
                                <input  type="checkbox" name="refund">
                            </div>
                            <div class="col-sm-7"><b>Refund Money</b>
                                 </div>
                            <p><span style="color: red">*</span>(please select the "Refund Money" Option to refund the money. if you dont want to refund please leave it blank)</p>

                        </div>
                    </div>

                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group row mb-0">
                    <div class="col-md-12 offset-md-4">
                        <button onclick="return confirm('Are you Sure to Cancel the Order! IF you confirm it cannot be retrieved!')"  type="submit" class="btn btn-primary col-sm-4">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </div>
            </div>
            </form>

            <!-- DataTales Example -->

        </div>
        <!-- /.container-fluid -->

        <script>
            function validate() {
                var  mobileNo = document.getElementById("mobile_no");

                if (!mobileNo.checkValidity()) {
                    document.getElementById("mobile_no_error").innerHTML = mobileNo.validationMessage;
                    document.getElementById("mobile_no").style.borderColor = "red";
                }else{
                    document.getElementById("mobile_no_error").innerHTML="";
                    document.getElementById("mobile_no").style.borderColor = "green";
                }
            }

            document.forms['confirmBooking'].elements['country'].value = '{{ old('country') }}';
        </script>

@endsection


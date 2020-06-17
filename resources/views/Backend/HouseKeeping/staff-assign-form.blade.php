@extends('Backend.master')

@section('title')
    House Keeping
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">House Keeping Staff Allocation</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                </div>
            </div>
        </div>
        <form method="post" action="{{route('Post-booking-service')}}">
            @csrf
            <div class="row">

                <div class="col-lg-4">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">House Keeping</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="BookingID" class="col-md-5 col-form-label text-md-right">{{ __('Booking ID') }}</label>
                                <div class="col-md-7">
                                    <input id="BookingID" readonly type="number" class="form-control" name="booking_id" value="{{$bookingInfo->id}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Partial_payment" class="col-md-5 col-form-label text-md-right">{{ __('Room Number') }}<span style="color: red">*</span></label>
                                <div class="col-md-7">
                                    <input id="room_id"  readonly type="number" class="form-control" value="{{$bookingInfo->room_id}}" name="room_number" required >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Staff Allocation</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="BookingID" class="col-md-5 col-form-label text-md-right">{{ __('Staff Name') }}</label>
                                <div class="col-md-7">
                                    <select class="form-control" name="staff_id" required>
                                        <option value="">Please Select One</option>
                                        @foreach($staffs as $staff)
                                        <option value="{{$staff->id}}">{{$staff->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Partial_payment" class="col-md-5 col-form-label text-md-right">{{ __('Service On') }}<span style="color: red">*</span></label>
                                <div class="col-md-7">
                                    <input id="room_id"  readonly type="text" class="form-control" value="Room" name="service_area" required >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Partial_payment" class="col-md-5 col-form-label text-md-right">{{ __('Allocation Time') }}<span style="color: red">*</span></label>
                                <div class="col-md-7">
                                    <input id="room_id"  type="time" class="form-control" value="allocation_time" name="allocation_time" required >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row mb-0">

                        <div class="col-md-5 offset-md-5">
                            <button  type="submit" class="btn btn-primary col-sm-4">
                                {{ __('Allocate') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- DataTales Example -->
            </div>
        </form>
        <!-- /.container-fluid -->


@endsection


@extends('Backend.master')

@section('title')
    Home
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
        <form method="post" action="{{route('partialPayment')}}">
            @csrf
        <div class="row">
            <div class="col-lg-4">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Account Information</h6>
                    </div>
                    <div class="card-body">


                        <div class="form-group row">
                            <label for="BookingID" class="col-md-5 col-form-label text-md-right">{{ __('Total Payable') }}</label>
                            <div class="col-md-7">
                                <input  readonly type="text" class="form-control"  value="{{$bookingId->total_rent}} Tk">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Partial_payment" class="col-md-5 col-form-label text-md-right">{{ __('Paid Amount') }}<span style="color: red">*</span></label>
                            <div class="col-md-7">
                                <input readonly type="text" value="{{$sumPay}} Tk"  class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Due_payment" class="col-md-5 col-form-label text-md-right">{{ __('Due Payment') }}</label>
                            <div class="col-md-7">
                                <input readonly type="text" class="form-control" value="{{$bookingId->total_rent-$sumPay}} TK">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Payment Information</h6>
                    </div>
                    <div class="card-body">


                        <div class="form-group row">
                            <label for="BookingID" class="col-md-5 col-form-label text-md-right">{{ __('Booking ID') }}</label>
                            <div class="col-md-7">
                                <input id="BookingID" readonly type="number" class="form-control" name="booking_id" value="{{$bookingId->id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Partial_payment" class="col-md-5 col-form-label text-md-right">{{ __('Partial Payment') }}<span style="color: red">*</span></label>
                            <div class="col-md-7">
                                <input id="Partial_payment" min="1" max="{{$bookingId->total_rent-$sumPay}}"  type="number" class="form-control" name="paid_amount" required >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info">Payment History</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark">
                    <thead>
                    <tr>
                        <th>SL.</th>
                        <th >Amount</th>
                        <th style="text-align: center">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($particularPayments as $particularPayment)
                    <tr>
                        <td>{{$i++}}</td>
                        <td style="text-align: center">{{$particularPayment->paid_amount}}</td>
                        <td style="text-align: center">{{$particularPayment->created_at}}</td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row mb-0">
                    <div class="col-md-5">
                     <a href="{{url('view-bookings-by-id/'.$bookingId->id)}}" >  <button  type="button" class="btn btn-warning col-sm-4">
                            {{ __('Back') }}
                        </button></a>
                    </div>
                    <div class="col-md-5 offset-md-5">
                        <button  type="submit" class="btn btn-primary col-sm-4">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- DataTales Example -->
        </div>
        </form>
        <!-- /.container-fluid -->


@endsection


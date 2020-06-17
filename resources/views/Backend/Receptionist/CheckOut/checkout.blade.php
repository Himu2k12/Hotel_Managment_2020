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
                    <h4 style="text-align: center">Hotel New York</h4>
                    <h5 style="text-align: center; color: #2fa360">CHECK-OUT</h5>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                </div>
            </div>
        </div>
        <?php

        ?>

            <div class="row">
                <div class="col-lg-3">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-info">Payment History</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-dark">
                                <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                                @foreach($particularPayments as $particularPayment)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$particularPayment->paid_amount}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Booking Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="BookingID" class="col-md-5 col-form-label text-md-right">{{ __('Booking ID') }}</label>
                                <div class="col-md-7">
                                    <a href="{{url('view-bookings-by-id/'.$bookingId->id)}}"> <input disabled  class="form-control" value="{{$bookingId->id}}"></a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Partial_payment" class="col-md-5 col-form-label text-md-right">{{ __('Check In') }}</label>
                                <div class="col-md-7">
                                    <input readonly  class="form-control" value="{{$bookingId->check_in}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-5 col-form-label text-md-right">{{ __('Check Out') }}</label>
                                <div class="col-md-7">
                                    <input readonly  class="form-control" value="{{$bookingId->check_out}}">
                                </div>
                            </div>
                            <div class="form-group row">
                            <label for="" class="col-md-5 col-form-label text-md-right">{{ __('Room Rent') }}</label>
                            <div class="col-md-7">
                                <input readonly  class="form-control" value="{{$bookingId->total_rent}}">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-5">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Total Information</h6>
                        </div>

                        <div class="card-body">
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Product Name</th>
                                        <th>Net Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $j=1; ?>
                                    @foreach($serviceInfo as $item)
                                        <tr>
                                            <td>{{$j++}}</td>
                                            <td>{{$item->product_name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->total_price}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mb-4 py-3 border-bottom-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                </div>
                            <div class="col-lg-4">
                                <!-- Basic Card Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-success" style="text-align: center">Total Calculation</h6>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-group" action="{{route('saveCheckout')}}" method="post">
                                            @csrf
                                        <div class="form-group row">
                                            <label for="BookingID" class="col-md-5 col-form-label text-md-right">{{ __('Room Rent') }}</label>
                                            <div class="col-md-7">
                                                <input disabled  class="form-control" value="{{$bookingId->total_rent}}">
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                                <label for="BookingID" class="col-md-5 col-form-label text-md-right">TAX(@if(isset($Tax)){{$Tax->tax_percent}}% @else 0% @endif ) </label>
                                                <div class="col-md-7">
                                                    <input readonly  class="form-control" name="tax_amount" @if(isset($Tax)) value="{{$bookingId->total_rent*$Tax->tax_percent/100}}" @else value="0" @endif>
                                                </div>
                                         </div>
                                        <div class="form-group row">
                                            <label for="Partial_payment" class="col-md-5 col-form-label text-md-right">{{ __('Total Service') }}</label>
                                            <div class="col-md-7">
                                                <input readonly  class="form-control" value="{{$totalService}}">
                                            </div>
                                        </div>
                                            <hr>
                                        <div class="form-group row">
                                                <label class="col-md-5 col-form-label text-md-right">{{ __('Total Amount') }}</label>
                                                <div class="col-md-7">
                                                    <input id="totalAmount" readonly value="{{$totalAmount}}"  class="form-control" >
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-md-5 col-form-label text-md-right">{{ __('Total Paid') }}</label>
                                            <div class="col-md-7">
                                                <input readonly  class="form-control" value="{{$totalPaid}}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="" class="col-md-5 col-form-label text-md-right">{{ __('Due Amount') }}</label>
                                            <div class="col-md-7">
                                                <input type="hidden" name="booking_id" value="{{$bookingId->id}}">
                                                <input readonly  class="form-control" name="due_amount" value="{{$totalDue}}">
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label for="" class="col-md-5 col-form-label text-md-right">{{ __('Payment Method') }}</label>
                                            <div class="col-md-7">
                                               <select name="payment_type"  class="form-control" required>
                                                   <option value="">Select One</option>
                                                   <option value="Cash">Cash</option>
                                                   <option value="Card">Card</option>
                                                   <option value="Bkash">Bkash</option>
                                               </select>
                                            </div>
                                        </div>
                                         <div class="form-group row">

                                                <div class="col-md-5" align="right">
                                                    <input  type="checkbox" required name="payment_done_status">
                                                </div>
                                             <div class="col-md-7">
                                                 Payment Done
                                             </div>
                                         </div>
                                        <div class="form-group row">
                                           <div class="col-md-12">
                                                <input  class="form-control btn btn-info" type="submit" value="Confirm">
                                            </div>
                                        </div>
                                        </form>

                                    </div>
                                </div>

                            </div>

                            </div>
                            <div class="row">
                                <div class="offset-5 col-md-5">
                                    <a  href="{{url('front-desk')}}" >
                                        <button  type="button" class="form-control btn btn-success col-sm-4">
                                            {{ __('Home') }}
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- DataTales Example -->
            </div>
        <!-- /.container-fluid -->


@endsection


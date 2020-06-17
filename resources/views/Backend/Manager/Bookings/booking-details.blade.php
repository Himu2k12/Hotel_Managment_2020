@extends('Backend.master')

@section('title')
    Booking Details

@endsection
@section('content')
    <style>
        .m-0{
            text-align: center;
        }
    </style>
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
                <?php

                $temp=explode(' ',$booking_details->check_in);
                $temp2=explode(' ',$booking_details->check_out);
                ?>

                <form class="form-inline">
                    <label class="col-sm-2" for="check_in">Booking ID</label>
                    <input type="number" readonly value="{{$booking_details->book_id}}" class="col-sm-2 form-control">
                    <label class="col-sm-2" for="check_in">Check In</label>
                    <input type="date" readonly value="{{$temp[0]}}" class="col-sm-2 form-control">
                    <label class="col-sm-2" for="check_out">Check Out</label>
                    <input type="date" readonly value="{{$temp2[0]}}" class="col-sm-2 form-control">
                </form>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-12">

                <!-- Basic Card Example -->
                <div class="card shadow mb-12">
                    <div class="card-header py-12">
                        <h6 class="m-0 font-weight-bold text-primary">Booking Information</h6>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2">
                            <label for="room" class="col-form-label text-md-right">{{ __('Room Number') }}</label>
                        </div>
                        <div class="col-md-2">
                            <input id="room" type="text" readonly  class="form-control" name="room_id" value="{{$booking_details->room_id}}" >
                        </div>
                        <div class="col-md-2">
                            <label for="room" class="col-form-label text-md-right">{{ __('Customer ID') }}</label>
                        </div>
                            <div class="col-md-2">
                                <input id="room" type="text" readonly  class="form-control" name="room_id" value="{{$booking_details->id}}" >
                            </div>

                        <div class="col-md-2">
                            <label for="rent" class="col-form-label text-md-right">{{ __('Rent Per Night') }}</label>
                        </div>
                        <div class="col-md-2">
                             <input type="text" readonly  class="form-control" value="{{$booking_details->basic_rent}}">
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2">
                            <label for="Pov" class="col-form-label text-md-right">{{ __('Visiting Purpose') }}</label>
                        </div>
                            <div class="col-md-2">
                                <input id="Pov" readonly type="text" class="form-control" value="{{ $booking_details->purpose_of_visit}}" >
                            </div>

                        <div class="col-md-2">
                            <label for="bookingDays" class="col-form-label text-md-right">{{ __('Booking Days') }}</label>
                        </div>
                            <div class="col-md-2">
                                <input readonly type="number" class="form-control"  value="{{$booking_details->booking_days}}">
                            </div>
                        <div class="col-md-2">
                            <label for="Adult" class="col-form-label text-md-right">{{ __('Adult') }}</label>
                        </div>
                        <div class="col-md-2">
                                <input readonly type="number" class="form-control"  value="{{$booking_details->adults}}">
                         </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2">
                            <label for="Children" class="col-form-label text-md-right">{{ __('Children') }}</label>
                        </div>
                        <div class="col-md-2">
                            <input readonly type="number" class="form-control"  value="{{$booking_details->children}}">
                        </div>

                        <div class="col-md-2">
                            <label for="TotalPrice" class="col-form-label text-md-right">{{ __('Total Rent') }}</label>
                        </div>
                            <div class="col-md-2">
                                <input readonly type="number" class="form-control"  value="{{$booking_details->total_rent}}">
                            </div>

                        <div class="col-md-2">
                            <label for="Discount" class="col-form-label text-md-right">{{ __('Discount') }}</label>
                        </div>
                        <div class="col-md-2">
                            <input readonly type="text" class="form-control"  value="{{$booking_details->discount}} %" >
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2">
                            <label for="Discount" class="col-form-label text-md-right">{{ __('Booked By') }}</label>
                        </div>
                        <div class="col-md-3">
                            <input readonly type="text" class="form-control"  value="{{$user->EmployeeName($booking_details->created_by)->name}} (#{{$booking_details->created_by}})" >
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Basic Card Example -->
                <div class="card shadow mb-12">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info">Customer Information</h6>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2">
                            <label for="name" class="col-form-label text-md-right">{{ __('Full Name') }}</label>
                        </div>
                        <div class="col-md-2">
                            <input type="text" readonly class="form-control" name="full_name" value="{{$booking_details->full_name}}">
                        </div>

                        <div class="col-md-2">
                            <label for="mobile_no" class="col-form-label text-md-right">{{ __('Mobile No.') }}</label>
                        </div>
                        <div class="col-md-2">
                            <input id="mobile_no" readonly type="text" class="form-control" name="mobile_no" value="{{$booking_details->mobile_no}}" required autocomplete="Mobile Number">
                        </div>

                        <div class="col-md-2">
                            <label for="national_id" class="col-form-label text-md-right">{{ __('National Id') }}</label>
                        </div>
                        <div class="col-md-2">
                            <input id="national_id"  readonly type="text" class="form-control" value="{{$booking_details->national_id}}">
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2">
                            <label for="passport_no" class="col-form-label text-md-right">{{ __('Passport No') }}</label>
                        </div>
                        <div class="col-md-2">
                                <input id="passport_no" readonly type="text" class="form-control" name="passport_no" value="{{$booking_details->passport_no}}" >
                        </div>

                        <div class="col-md-2">
                            <label for="mobile_two" class="col-form-label text-md-right">{{ __('Additional Number ') }}</label>
                        </div>
                        <div class="col-md-2">
                            <input id="mobile_two" readonly type="text" value="{{$booking_details->mobile_two}}" class="form-control" name="mobile_two">
                        </div>

                        <div class="col-md-2">
                            <label for="occupation" class="col-form-label text-md-right">{{ __('Occupation') }} </label>
                        </div>
                        <div class="col-md-2">
                            <input id="occupation" readonly type="text" class="form-control" name="occupation" value="{{$booking_details->occupation}}" required autocomplete="Last Name">
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2">
                            <label for="address" class="col-form-label text-md-right">{{ __('Address 1') }} </label>
                        </div>
                        <div class="col-md-2">
                             <textarea id="address" class="form-control" name="address" required>{{$booking_details->address}}</textarea>
                        </div>
                        <div class="col-md-2">
                            <label for="city" class="col-form-label text-md-right">{{ __('City') }} </label>
                        </div>
                        <div class="col-md-2">
                            <input id="city" readonly type="text" class="form-control" value="{{$booking_details->city}}">
                        </div>

                        <div class="col-md-2">
                            <label for="Country" class="col-form-label text-md-right">{{ __('Country') }} </label>
                        </div>
                        <div class="col-md-2">
                            <input id="city" readonly type="text" class="form-control" value="{{$booking_details->country}}">
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2"  style="padding-bottom: 30px">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        </div>
                        <div class="col-md-4">
                             <input id="email"  readonly type="email" class="form-control" name="email" value="{{ $booking_details->email_address}}">
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-lg-12">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
                    </div>
                    <div class="card-body">
                        <?php $i=1; ?>
                        @foreach($payment as $item)
                            <div class="form-group row">
                                <div class="col-md-2">
                                <label  class="col-form-label text-md-right">{{ __('Payment') }} {{$i++}}</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" readonly class="form-control"  value="{{$item->paid_amount}}">
                                </div>
                                <div class="col-md-1">
                                    <label  class="col-form-label text-md-right">{{ __('Time') }}</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" readonly class="form-control"  value="{{$item->created_at}}">
                                </div>
                                <div class="col-md-2">
                                    <label  class="col-form-label text-md-right">{{ __('Received By') }}</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" readonly class="form-control"  value="{{$user->EmployeeName($item->received_by)->name}}">
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <div class="col-lg-12">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-success">Service Information</h6>
                    </div>
                    <div class="card-body">
                        <?php $i=1; ?>
                        @foreach($service as $item)
                            <div class="form-group row">
                                <div class="col-md-2">
                                <label  class="col-form-label text-md-right">{{ __('Product') }} {{$i++}}</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" readonly class="form-control" value="{{$item->product_name}}">
                                </div>
                                <div class="col-md-1">
                                    <label  class="col-form-label text-md-right">{{ __('Quantity') }}</label>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" readonly class="form-control" value="{{$item->quantity}}">
                                </div>
                                <div class="col-md-1">
                                    <label  class="col-form-label text-md-right">{{ __('Total') }}</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" readonly class="form-control"  value="{{$item->total_price}}">
                                </div>
                                <div class="col-md-1">
                                    <label  class="col-form-label text-md-right">{{ __('Assured By') }}</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" readonly class="form-control"  value="{{$user->EmployeeName($item->created_by)->name}}">
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
            <div class="col-lg-12">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6  class="m-0 font-weight-bold text-info">Edited History</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead style="background-color: #1b4b72; color: white">
                                <tr>
                                    <th>Edit ID</th>
                                    <th>Last Check-Out</th>
                                    <th>Last Total</th>
                                    <th>Last Partial Amount</th>
                                    <th>Edited By</th>
                                    <th>Edited At</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($editInfo as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->check_out}}</td>
                                        <td>{{$data->total_rent}}</td>
                                        <td>{{$data->partial_payment}}</td>
                                        <td>{{$data->name}}({{$data->created_by}})</td>
                                        <td>{{$data->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- DataTales Example -->
        </div>
        <!-- /.container-fluid -->
@endsection


@extends('Backend.master')

@section('title')
    Advance Bookings
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .blinking{
            animation:blinkingText 1.2s infinite;
        }
        @keyframes blinkingText{
            0%{     color: red;    }
            49%{    color: red; }
            60%{    color: transparent; }
            99%{    color:transparent;  }
            100%{   color: red;    }
        }
    </style>
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">All Advance Bookings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Mobile Number</th>
                            <th>Name</th>
                            <th>Room No.</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Created By</th>
                            <th>Confirmation Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($advanceBookings as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->mobile_no}}</td>
                                <td>{{$data->full_name}}</td>
                                <td>{{$data->room_id}}</td>
                                <td>{{$data->check_in}}</td>
                                <td>{{$data->check_out}}</td>
                                <td>{{$userName->employeeName($data->created_by)->name}}</td>
                                <td>{{$data->created_at}}</td>
                                <td>
                                    @if($data->check_out< $current_date_time)
                                            <span class="blinking" style="color: red">  <i class="fas fa-exclamation-triangle"></i> Expired!</span>
                                        @else
                                        <span style="color: #2fa360"><b>Active</b></span>
                                        @endif
                                </td>
                                <td>
                                    <a href="{{ url('/confirm-advance-bookings/'.$data->id) }}" class="btn btn-primary btn-xl" title="Confirm">
                                        <span><i class="fas fa-check-circle"></i></span>
                                    </a>
                                    @if($data->check_out > $current_date_time)
                                    <a onclick="return confirm('Do you sure to Cancel the booking?')" href="{{ url('/cancel-advance-booking/'.$data->id.'/'.$data->room_id) }}" class="btn btn-danger btn-xl" title="Cancel Booking">
                                        <span><i class="fas fa-trash-alt"></i></span>
                                    </a>
                                    @endif
                                    <a href="{{ url('/view-bookings-by-id/'.$data->id) }}" class="btn btn-info btn-xl" title="View">
                                        <span><i class="fas fa-eye"></i></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->



@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection

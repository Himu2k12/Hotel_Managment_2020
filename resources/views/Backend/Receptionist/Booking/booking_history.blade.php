@extends('Backend.master')

@section('title')
    Manage Bookings
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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Booking History</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Mobile Number</th>
                            <th>Name</th>
                            <th>Room number</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Booking ID</th>
                            <th>Mobile Number</th>
                            <th>Name</th>
                            <th>Room number</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($currentBookings as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->mobile_no}}</td>
                                <td>{{$data->full_name}}</td>
                                <td>{{$data->room_id}}</td>
                                <td>{{$data->check_in}}</td>
                                <td>{{$data->check_out}}</td>
                                <td>
                                    <a target="_blank" href="{{ url('/invoice-generate/'.$data->id) }}" class="btn btn-info btn-xl" title="Voucher">
                                        <span><i class="fas fa-file-pdf"></i></span>
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

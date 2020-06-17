@extends('Backend.master')

@section('title')
    View Canceled Bookings
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Canceled Booking History</h5>
                <h6 style="text-align: center" class="text-danger">{{ Session::get('message') }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Room number</th>
                            <th>Customer ID</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Discount</th>
                            <th>Total Rent</th>
                            <th>Refund Amount</th>
                            <th>Cancel Time</th>
                            <th>Canceled By(ID)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deletedBookings as $data)
                            <tr>
                                <td>{{$data->booking_id}}</td>
                                <td>{{$data->room_id}}</td>
                                <td>{{$data->customer_id}}</td>
                                <td>{{$data->check_in}}</td>
                                <td>{{$data->check_out}}</td>
                                <td>{{$data->discount}} %</td>
                                <td>{{$data->total_rent}}</td>
                                <td>{{$data->refund_amount}}</td>
                                <td>{{$data->created_at}}</td>
                                <td>{{$data->created_by}}</td>
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

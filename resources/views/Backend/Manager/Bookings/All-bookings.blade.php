@extends('Backend.master')

@section('title')
    Manage Bookings
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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Booking History</h6>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allBookings as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->room_id}}</td>
                                <td>{{$data->customer_id}}</td>
                                <td>{{$data->check_in}}</td>
                                <td>{{$data->check_out}}</td>
                                <td>{{$data->discount}} %</td>
                                <td>{{$data->total_rent}}</td>
                                <td>
                                    <div class="row">
                                    <div class="col-sm-5">
                                        <a target="_blank" href="{{ url('/view-details-booking/'.$data->id) }}" class="btn btn-info btn-xl" title="View Details">
                                            <span><i class="fas fa-eye"></i></span>
                                        </a>
                                    </div>
                                     <div class="col-sm-1" style="text-align: center">
                                        |
                                     </div>
                                    <div class="col-sm-2">
                                    <a target="_blank" href="{{ url('/invoice-generate/'.$data->id) }}" class="btn btn-success btn-xl" title="Voucher">
                                        <span><i class="fas fa-file-pdf"></i></span>
                                    </a>
                                    </div>
                                    </div>
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

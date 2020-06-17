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
                <h6 style="text-align: center;" class="m-0 font-weight-bold text-info">All Edited Bookings History</h6>
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
    <!-- /.container-fluid -->



@endsection


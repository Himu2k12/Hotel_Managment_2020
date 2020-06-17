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

        <!-- After Booking room service section starts here -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Today After Booking Room Services</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Booking ID</th>
                            <th>Staff Name</th>
                            <th>Allocation Time</th>
                            <th>Finishing Time</th>
                            <th>Staff Comment</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dailyAfterRoomService as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->booking_id}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->allocation_time}}</td>
                                <td>{{$data->finishing_time}}</td>
                                <td>{!! $data->staff_comment !!}</td>
                                <td>
                                    @if($data->status==2)
                                        <span style="color: #2fa360"><b>Done</b></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- After Booking room service section Ends here -->


        <!-- Regular service section starts here -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Today Regular Services</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Allocation Area</th>
                            <th>Staff Name</th>
                            <th>Allocation Time</th>
                            <th>Finishing Time</th>
                            <th>Staff Comment</th>
                            <th>Status</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dailyRegularService as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->service_area}}@if($data->room_no!==null){{$data->room_no}})@endif</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->allocation_time}}</td>
                                <td>{{$data->finishing_time}}</td>
                                <td>{!! $data->staff_comment!!}</td>
                                <td>
                                    @if($data->status==2)
                                        <span style="color: #2fa360"><b>Done</b></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Regular service section Ends here -->

    </div>
    <!-- /.container-fluid -->
@endsection

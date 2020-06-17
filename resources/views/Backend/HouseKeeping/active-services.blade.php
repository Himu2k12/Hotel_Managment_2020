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
                <h5 style="text-align: center;" class="m-0 font-weight-bold text-primary">All Active Room Services</h5>
                <h6 style="text-align: center" class="text-success">{{ Session::get('Message') }}</h6>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ActiveServices as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->booking_id}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->allocation_time}}</td>
                                <td>
                                    @if($data->status==2)
                                        <span class="blinking" style="color: red">  <i class="fas fa-exclamation-triangle"></i> Need To clean</span>
                                    @else
                                        <span style="color: #2fa360"><b>Active</b></span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/complete-tasks/'.$data->id) }}" class="btn btn-primary btn-xl" title="Complete Task">
                                        <span><i class="fas fa-upload"></i></span>
                                    </a>
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
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">All Active Regular Services</h6>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($regularServices as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$data->service_area}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->allocation_time}}</td>
                                <td>
                                    @if($data->status==2)
                                        <span class="blinking" style="color: red">  <i class="fas fa-exclamation-triangle"></i> Need To clean</span>
                                    @else
                                        <span style="color: #2fa360"><b>Active</b></span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/complete-regular-tasks/'.$data->id) }}" class="btn btn-primary btn-xl" title="Complete Task">
                                        <span><i class="fas fa-upload"></i></span>
                                    </a>
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

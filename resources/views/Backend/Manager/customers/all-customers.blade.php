@extends('Backend.master')

@section('title')
    Manage Customers
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">All Customers</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead style="background: #214b80; color: #ffffff;">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Mobile No</th>
                            <th>National ID</th>
                            <th>Passport</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Occupation</th>
                            <th>Mobile 2</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->full_name}}</td>
                                <td>{{$customer->mobile_no}}</td>
                                <td>{{$customer->national_id}}</td>
                                <td>{{$customer->passport_no}}</td>
                                <td>{{$customer->address}}</td>
                                <td>{{$customer->city}}</td>
                                <td>{{$customer->country}}</td>
                                <td>{{$customer->email_address}}</td>
                                <td>{{$customer->occupation}}</td>
                                <td>{{$customer->mobile_two}}</td>
                                <td>
                                    <a href="{{ url('/edit-customer/'.$customer->id) }}" class="btn btn-primary btn-xl" title="Edit">
                                        <span><i class="fas fa-edit"></i></span>
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

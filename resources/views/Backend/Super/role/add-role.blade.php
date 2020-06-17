@extends('Backend.master')

@section('title')
    Manage Role
@endsection

@section('style')
    <link href="{{asset('/Assets/')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Role</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
        <div class="card mb-4 py-3 border-left-success">
            <div class="card-body">

                <form class="form-inline" action="{{url('/add-role')}}" method="post">
                    {{ csrf_field() }}
                    <label style="margin-left: 20px" class="col-sm-4" for="email">Role<span style="color:red ">*</span></label>
                     <input type="text" name="role" class="col-sm-4 form-control" placeholder="Enter Role Name">
                    <button style="margin-left: 20px" type="submit" class="btn btn-success">Submit</button>
                </form>
                <div class="offset-4 col-sm-4">
                    <span style="color: red;padding-left: 10px">{{ $errors->has('role') ? $errors->first('role') : ' ' }}</span>
                </div>

            </div>
        </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">All Roles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->role}}</td>
                            <td> @if($role->status==1)
                                <a  class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                                    <span class="text">{{$role->status==1?"Active": "Deactive"}}</span>
                                </a>
                                    @else

                                    <a  class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                                        <span class="text">{{$role->status==1?"Active": "Deactive"}}</span>
                                    </a>
                                @endif
                                </td>
                            <td>
                                @if($role->id!=1)
                                @if($role->status ==1)
                                    <a href="{{ url('/inactive-role/'.$role->id) }}" class="btn btn-danger btn-xl" title="Disable Role">
                                        <i class="fas fa-arrow-circle-down"></i>
                                    </a>
                                @else
                                    <a href="{{ url('/active-role/'.$role->id) }}" class="btn btn-success btn-xl" title="Enable Role">
                                        <i class="fas fa-arrow-circle-up"></i>
                                    </a>
                                @endif


                                <a href="{{ url('/edit-role/'.$role->id) }}" class="btn btn-primary btn-xl" title="Edit Role">
                                    <span><i class="fas fa-edit"></i></span>
                                </a>
                                @endif
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

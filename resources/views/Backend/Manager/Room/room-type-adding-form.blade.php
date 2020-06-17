@extends('Backend.master')

@section('title')
    Manage Room Type
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
                @if(isset($roomType))
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Edit Room Type</h4>
                @else
                    <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Room Type</h4>
                    @endif
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">


                    @if(isset($roomType))
                        <form name="editType" class="form-inline" action="{{url('/update-room-type')}}" method="post">
                            {{ csrf_field() }}
                            <label style="margin-left: 20px" class="col-sm-2" for="room_type">Room Type</label>
                            <input type="hidden" name="id" value="{{$roomType->id}}">
                            <input type="text" name="room_type" value="{{$roomType->room_type}}" class="col-sm-2 form-control" placeholder="Enter Room Type">
                            <label style="margin-left: 20px" class="col-sm-2" for="room_type">Status</label>
                            <select name="status" class="col-sm-2 form-control">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            <button style="margin-left: 20px" type="submit" class="btn btn-success">Update</button>
                        </form>
                        <script>
                            document.forms['editType'].elements['status'].value = '{{ $roomType->status}}';
                        </script>
                        @else
                        <form  class="form-inline" action="{{url('/new-room-type')}}" method="post">
                            {{ csrf_field() }}
                            <label style="margin-left: 20px" class="col-sm-4" for="room_type">Room Type</label>
                            <input type="text" name="room_type" class="col-sm-4 form-control" placeholder="Enter Room Type">
                            <button style="margin-left: 20px" type="submit" class="btn btn-success">Submit</button>
                        </form>
                        @endif

                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">All Room Types</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Room Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($roomTypes as $roomType)
                            <tr>
                                <td>{{$roomType->id}}</td>
                                <td>{{$roomType->room_type}}</td>
                                <td> @if($roomType->status==1)
                                        <a  class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                              <i style="color: white"  class="fas fa-check"></i>
                                            </span>
                                            <span style="color: white"  class="text">{{$roomType->status==1?"Active": "Deactive"}}</span>
                                        </a>
                                    @else
                                        <a  class="btn btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                              <i style="color: white"  class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span style="color: white" class="text">{{$roomType->status==1?"Active": "Deactive"}}</span>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('edit-room-type/'.$roomType->id) }}" class="btn btn-primary btn-xl" title="Edit Role">
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

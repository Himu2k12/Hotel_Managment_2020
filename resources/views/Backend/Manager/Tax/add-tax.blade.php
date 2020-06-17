@extends('Backend.master')

@section('title')
    Manage VAT
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">VAT</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
        <div class="card mb-4 py-3 border-left-success">
            <div class="card-body">

                <form class="form-inline" action="{{url('/add-tax')}}" method="post">
                    {{ csrf_field() }}
                    <label style="margin-left: 20px" class="col-sm-4" for="email">VAT Percentage<span style="color: red">*</span></label>
                    <input type="number" name="taxPercent" class="col-sm-4 form-control" placeholder="Enter Vat Amount">
                    <button style="margin-left: 20px" type="submit" class="btn btn-success">Submit</button>
                </form>

            </div>
        </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Current Active VAT</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>VAT Amount(%)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($taxes as $tax)
                        <tr>
                            <td>{{$tax->id}}</td>
                            <td>{{$tax->tax_percent}}</td>
                            <td> @if($tax->status==1)
                                <a  class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                                    <span class="text">{{$tax->status==1?"Active": "Deactive"}}</span>
                                </a>
                                    @else

                                    <a  class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-exclamation-triangle"></i>
                    </span>
                                        <span class="text">{{$tax->status==1?"Active": "Deactive"}}</span>
                                    </a>
                                @endif
                                </td>
                            <td>
                                <a href="{{ url('/delete-tax/'.$tax->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger btn-xl" title="Delete Tax">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <a href="{{ url('/edit-tax/'.$tax->id) }}" class="btn btn-primary btn-xl" title="Edit Role">
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
    <script>

    </script>

    @endsection

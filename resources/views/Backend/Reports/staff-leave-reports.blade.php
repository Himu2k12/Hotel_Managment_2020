@extends('Backend.master')

@section('title')
    Leave Reports
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body" style="text-align: center">
                    <h4 style="text-align: center">Staff Leave Records</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{url('staff-leave-reports')}}" method="get">
                    @csrf
                    <div class="row">
                        <div class="col-sm-1" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <label for="exampleInputEmail1"><b>From</b></label>
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <input type="date" onfocusout="checkDate()" class="form-control" id="From" name="from" required @if(isset($from)) value="{{$from}}"@else Date @endif>
                            </div>
                        </div>
                        <div class="col-sm-1" style="margin: auto;">
                            <div class="form-group" style="text-align: center;margin: auto;">
                                <label for="exampleInputEmail1"><b>To</b></label>
                            </div>
                        </div><!-- modal-body -->
                        <div class="col-sm-4" style="margin: auto">
                            <div class="form-group" style="margin: auto">
                                <input type="date" class="form-control" id="to" aria-describedby="emailHelp"  name="to" required @if(isset($to)) value="{{$to}}" @else Date @endif>
                            </div>
                        </div>
                        <div class="col-sm-2" style="margin: auto">
                            <div class="form-group" style="margin: auto">

                                <button type="submit" class="form-control btn btn-info">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
        @if(isset($leaveRecords) && !$leaveRecords->IsEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">Leave Records From {{$from}} to {{$to}}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Leave ID</th>
                                <th>Staff Name</th>
                                <th>Leave From</th>
                                <th>Leave To</th>
                                <th>Approved By</th>
                                <th>Sanction Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leaveRecords as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->leave_from}}</td>
                                    <td>{{$data->leave_to}}</td>
                                    <td>{{$OfficerName->EmployeeName($data->approved_by)->name}}({{$data->approved_by}})</td>
                                    <td>{{$data->created_at}}</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        @if($leaveRecords)
                            <form action="{{url('generate-pdf-for-Staff-leave')}}" method="post" target="_blank">
                                @csrf
                                <input type="hidden" name="from" @if(isset($from)) value="{{$from}}" @endif>
                                <input type="hidden" name="to" @if(isset($to)) value="{{$to}}" @endif>
                                <button type="submit" class="btn btn-success">Print</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @else
            @if(isset($from) && isset($to))
                <div class="card-header py-3">
                    <h6 style="text-align: center" class="m-0 font-weight-bold text-danger">No Records From {{$from}} to {{$to}}</h6>
                </div>
             @endif
    @endif
    <!-- DataTales Example -->

    </div>

@endsection


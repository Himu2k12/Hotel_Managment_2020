@extends('Backend.master')

@section('title')
    Salary Sheet
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body" style="text-align: center">
                    <h4 style="text-align: center">Salary Sheet</h4>
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
                <form class="form-inline" name="checkBooking" action="{{url('/check-salary')}}" method="GET">
                    {{ csrf_field() }}
                    <label class="col-sm-3" for="check_in">Salary Month</label>
                    <input id="salary" type="month" name="salary_month" @if(isset($MonthOfSalary)) value="{{$MonthOfSalary}}" style="background-color: dodgerblue; color: white"  @endif class="col-sm-2 form-control">
                    <button style="padding-left: 0px; padding-right: 0px"  type="submit" class="offset-1 col-sm-2 btn btn-success"><i class="far fa-calendar-check"></i> Check</button>
                </form>
            </div>

        </div>
        <div class="col-lg-12">
            @if(isset($salaries))
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 style="text-align: center" class="m-0 font-weight-bold text-primary">Salaries Of {{$MonthOfSalary}}</h6>
                    </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead style="background: #214b80; color: #ffffff;">
                            <tr>
                                <th>Salary ID</th>
                                <th>Staff Name</th>
                                <th>Salary Date</th>
                                <th>Over Time(Hour)</th>
                                <th>Per Hour Cost</th>
                                <th>Total Over Time</th>
                                <th>Total Salary</th>
                                <th>Description</th>
                                <th>Distributed_By</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($salaries as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$userName->EmployeeName($data->staff_id)->name}}({{$data->staff_id}})</td>
                                    <td>{{$data->salary_date}}</td>
                                    <td>{{$data->over_time}} </td>
                                    <td>{{$data->per_hour_cost}}</td>
                                    <td>{{$data->over_time_total}}</td>
                                    <td>{{$data->total_salary}}.00</td>
                                    <td>{!! $data->description !!}</td>
                                    <td>{{$userName->EmployeeName($data->assigned_by)->name}}({{$data->assigned_by}})</td>
                                    <td>
                                        <a href="{{ url('/edit-salary-info/'.$data->id) }}" class="btn btn-primary btn-xl" title="Edit">
                                        <span><i class="fas fa-edit"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($salaries)
                            <form action="{{url('print-salary-statement')}}" method="post" target="_blank">
                                @csrf
                                <input type="hidden" name="month" @if(isset($MonthOfSalary)) value="{{$MonthOfSalary}}" @endif>
                                <button type="submit" class="btn btn-success">Print</button>
                            </form>
                        @endif
                    </div>
                </div>
                </div>
            @endif
        </div>


        <!-- DataTales Example -->

    </div>
    <!-- /.container-fluid -->

    <script>
        document.forms['checkBooking'].element['room_type'].value='@if(isset($roomType)){{$roomType}}@endif';

    </script>

@endsection


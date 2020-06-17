@extends('Backend.master')

@section('title')
    Manage Leave
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Store Leave Records</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('create-leave') }}" name="leave_form">
                        @csrf
                        <div class="form-group row">
                            <label for="room_type" class="col-md-4 col-form-label text-md-right">{{ __('Staff Name') }}<span style="color: red">*</span></label>

                            <div class="col-md-4">
                                <select class="form-control @error('staff_Name') is-invalid @enderror" name="staff_Name" required>
                                    <option value="">>-----------Select One-----------<</option>
                                    @foreach($staffs as $data)
                                        <option value="{{$data->id}}">{{$data->name}}({{$data->id}})</option>
                                    @endforeach
                                </select>
                                @error('staff_Name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="leave-from" class="col-md-4 col-form-label text-md-right">{{ __('Leave From') }}<span style="color: red">*</span></label>

                            <div class="col-md-4">
                                <input id="leave-from" type="date" class="form-control" name="leave_from"  value="{{ old('leave_from') }}" required >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leave-to" class="col-md-4 col-form-label text-md-right">{{ __('Leave To') }}<span style="color: red">*</span></label>

                            <div class="col-md-4">
                                <input id="leave-to" type="date" class="form-control" name="leave_to"  value="{{ old('leave_to') }}" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Reason Of Leave') }}<span style="color: red">*</span></label>
                            <div class="col-md-4">
                                <textarea id="summernote"  class="form-control @error('Reason_Of_leave') is-invalid @enderror" name="Reason_Of_leave" >{{ old('Reason_Of_leave') }}</textarea>
                                @error('Reason_Of_leave')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-5">
                                <button type="submit"  class="col-md-5 btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">All Leave Records</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Staff Name</th>
                            <th>Leave From</th>
                            <th>Leave To</th>
                            <th>Reasons</th>
                            <th>Approved By</th>
                            <th>Approval Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Staff Name</th>
                            <th>Leave From</th>
                            <th>Leave To</th>
                            <th>Reasons</th>
                            <th>Approved By</th>
                            <th>Approval Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($leaves as $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>{{$userName->EmployeeName($data->staff_Name)->name}}</td>
                                <td>{{$data->leave_from}}</td>
                                <td>{{$data->leave_to}}</td>
                                <td>{!! $data->Reason_Of_leave !!}</td>
                                <td>{{$userName->EmployeeName($data->approved_by)->name}} (#{{$data->approved_by}})</td>
                                <td>{{$data->created_at}}</td>
                                <td>@if($data->status==1)
                                        <a  class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                              <i style="color: white" class="fas fa-check"></i>
                                            </span>
                                            <span style="color: white" class="text">{{$data->status==1?"Done": "Canceled"}}</span>
                                        </a>
                                    @else

                                        <a  class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                              <i style="color: white" class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span style="color: white" class="text">{{$data->status==1?"Done": "Canceled"}}</span>
                                        </a>
                                    @endif</td>
                                <td><a href="{{ url('/edit-leave-records/'.$data->id) }}" class="btn btn-primary btn-xl" title="Edit">
                                        <span><i class="fas fa-edit"></i></span>
                                    </a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    <script>
        $('#summernote').summernote({
            placeholder: 'Enter comment here',
            tabsize: 3,
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        document.forms['leave_form'].elements['staff_Name'].value = '{{ old('staff_Name') }}';

    </script>
@endsection
@section('additionalScript')
    <!-- Page level plugins -->
@endsection

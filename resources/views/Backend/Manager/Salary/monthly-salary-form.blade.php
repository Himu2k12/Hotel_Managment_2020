@extends('Backend.master')

@section('title')
    Manage Salary Details
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Add Salary Info</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                <h6 style="text-align: center" class="text-danger">{{ Session::get('Dmessage') }}</h6>
            </div>
            <div class="offset-md-2 col-md-8 card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('create-salary-info') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="staff_id" class="col-md-4 col-form-label text-md-right">{{ __('Employee Name') }}<span style="color: red">*</span></label>
                            <div class="col-md-6">
                                <select class="form-control @error('staff_id') is-invalid @enderror" name="staff_id">
                                    <option value="">Please Select One</option>
                                    @foreach($staffs as $data)
                                        <option value="{{$data->id}}">{{$data->name}}({{$data->id}})</option>
                                    @endforeach
                                </select>
                                 @error('staff_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="month_of_salary" class="col-md-4 col-form-label text-md-right">{{ __('Month Of Salary') }}<span style="color: red">*</span></label>
                            <div class="col-md-6">
                                <input id="month_of_salary" type="month" class="form-control @error('month_of_salary') is-invalid @enderror" name="month_of_salary" value="{{ old('month_of_salary') }}" required  autofocus>
                                @error('month_of_salary')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Salary Date') }}<span style="color: red">*</span></label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('salary_date') is-invalid @enderror" name="salary_date" value="{{ old('salary_date') }}" required  autofocus>
                                @error('salary_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="basic_salary" class="col-md-2 col-form-label text-md-right">{{ __('Basic Salary') }}</label>
                            <div class="col-md-4">
                                <input id="basic_salary" type="number" class="form-control @error('basic_salary') is-invalid @enderror" name="basic_salary" value="{{ old('basic_salary') }}"   autofocus>
                                @error('basic_salary')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="allowances" class="col-md-2 col-form-label text-md-right">{{ __('Allowances') }}</label>
                            <div class="col-md-4">
                                <input id="allowances" type="number" class="form-control @error('allowances') is-invalid @enderror" name="allowances" value="{{ old('allowances') }}"   autofocus>
                                @error('allowances')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="professional_tax" class="col-md-3 col-form-label text-md-left">{{ __('Professional Tax') }}</label>
                            <div class="col-md-3">
                                <input id="professional_tax" type="number" class="form-control @error('professional_tax') is-invalid @enderror" name="professional_tax" value="{{ old('professional_tax') }}"   autofocus>
                                @error('professional_tax')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="Perquisites" class="col-md-2 col-form-label text-md-right">{{ __('Perquisites') }}</label>
                            <div class="col-md-4">
                                <input id="Perquisites" type="number" class="form-control @error('Perquisites') is-invalid @enderror" name="Perquisites" value="{{ old('perquisites') }}"   autofocus>
                                @error('Perquisites')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="over_time" class="col-md-3 col-form-label text-md-right">{{ __('Over Time(Hour)') }}</label>
                            <div class="col-md-3">
                                <input id="over_time"  onfocusout="overtimeTotal()" min="0" type="text" class="form-control @error('over_time') is-invalid @enderror" name="over_time" value="{{ old('over_time') }}"   autofocus>
                                @error('over_time')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="per_hour_cost" class="col-md-3 col-form-label text-md-right">{{ __('Per hour cost') }}</label>
                            <div class="col-md-3">
                                <input id="per_hour_cost" onfocusout="overtimeTotal()" min="0" type="number" class="form-control @error('per_hour_cost') is-invalid @enderror" name="per_hour_cost" value="{{ old('per_hour_cost') }}"   autofocus>
                                @error('per_hour_cost')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="over_time_total" class="col-md-3 col-form-label text-md-right">{{ __('Over Time(Amount)') }}</label>
                            <div class="col-md-3">
                                <input id="over_time_total" type="text" class="form-control @error('over_time_total') is-invalid @enderror" name="over_time_total" value="{{ old('over_time_total') }}"   autofocus>
                                @error('over_time_total')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="total_salary" class="col-md-4 col-form-label text-md-right">{{ __('Total Salary') }}<span style="color: red">*</span></label>
                            <div class="col-md-6">
                                <input id="total_salary" type="number" min="1" class="form-control @error('total_salary') is-invalid @enderror" name="total_salary" value="{{ old('total_salary') }}" required  autofocus>
                                @error('total_salary')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>
                            <div class="col-md-8">
                                <textarea id="summernote"  name="description">{{ old('description') }}</textarea>
                                @error('description')
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
                                    {{ __('Store') }}
                                </button>
                            </div>
                        </div>
                    </form>
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

        function overtimeTotal() {
            var hour = document.getElementById('over_time').value;
            var rate = document.getElementById('per_hour_cost').value;
            document.getElementById('over_time_total').value=hour*rate;
        }
    </script>
@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection

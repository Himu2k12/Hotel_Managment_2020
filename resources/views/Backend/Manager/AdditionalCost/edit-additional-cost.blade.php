@extends('Backend.master')

@section('title')
    Manage Additional Expenses
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Edit Additional Expense</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="offset-md-2 col-md-8 card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('update-additional-cost') }}" name="room_add">
                        @csrf
                        <div class="form-group row">
                            <label for="cost_amount" class="col-md-4 col-form-label text-md-right">{{ __('Cost Amount') }}</label>
                            <div class="col-md-6">
                                <input id="cost_amount" type="text" class="form-control @error('cost_amount') is-invalid @enderror" name="cost_amount" value="{{$editInfo->additional_cost}}" required  autofocus>
                                @error('cost_amount')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $editInfo->date_of_cost }}" required  autofocus>
                                <input type="hidden" value="{{ $editInfo->id }}" name="id">
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-8">
                                <textarea id="summernote"  name="description" required>{!! $editInfo->description !!}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-5">
                                <button type="submit"  class="col-md-8 btn btn-success">
                                    <i class="fas fa-tools"></i>
                                    {{ __('Update') }}
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
    </script>
@endsection
@section('additionalScript')
    <!-- Page level plugins -->

@endsection

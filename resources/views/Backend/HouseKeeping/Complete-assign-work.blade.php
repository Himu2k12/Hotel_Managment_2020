@extends('Backend.master')

@section('title')
    Home
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">After Booking Service Completion</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                </div>
            </div>
        </div>
        <form method="post" action="{{route('complete-afterBooking-service')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-2"></div>

                <div class="col-lg-8">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Task Completion</h6>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="Partial_payment" class="col-md-4 col-form-label text-md-right">{{ __('Closure Time') }}<span style="color: red">*</span></label>
                                <div class="col-md-8">
                                    <input id="finising_time"  type="time" class="form-control" name="finishing_time" required >
                                    <input type="hidden" class="form-control" value="{{$formInfo->id}}" name="id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Partial_payment" class="col-md-4 col-form-label text-md-right">{{ __('Comments') }}<span style="color: red">*</span></label>
                                <div class="col-md-8">
                                    <textarea id="summernote" name="staff_comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row mb-0">

                        <div class="col-md-5 offset-md-5">
                            <button  type="submit" class="btn btn-primary col-sm-4">
                                {{ __('Confirm') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- DataTales Example -->
            </div>
        </form>
        <!-- /.container-fluid -->
        <script>
            $('#summernote').summernote({
                placeholder: 'Enter comment here',
                tabsize: 2,
                height: 120,
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


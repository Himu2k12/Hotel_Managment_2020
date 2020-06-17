@extends('Backend.master')

@section('title')
    Edit Room Info
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
                <h4 style="text-align: center" class="m-0 font-weight-bold text-primary">Add Room</h4>
                <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
            </div>
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('update-room') }}" name="room_update">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Room Number') }}</label>

                            <div class="col-md-4">
                                <input readonly id="room_number" type="text" class="form-control @error('room_number') is-invalid @enderror" name="room_number" value="{{$editRoom->room_number}}" required  autofocus>

                                @error('room_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_type" class="col-md-4 col-form-label text-md-right">{{ __('Room Type') }}</label>

                            <div class="col-md-4">
                                <select class="form-control @error('room_type') is-invalid @enderror" name="room_type" required>
                                    <option value="">>-----------Select One-----------<</option>
                                    @foreach($roomTypes as $roomType)
                                        <option value="{{$roomType->id}}">{{$roomType->room_type}}</option>
                                    @endforeach
                                </select>
                                @error('room_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floor_number" class="col-md-4 col-form-label text-md-right">{{ __('Floor Number') }}</label>

                            <div class="col-md-4">
                                <select class="form-control @error('floor_number') is-invalid @enderror" name="floor_number" >
                                    <option value="">>-----------Select One-----------<</option>
                                    <option value="1"> 1st</option>
                                    <option value="2"> 2nd</option>
                                    <option value="3"> 3rd</option>
                                    <option value="4"> 4th</option>
                                    <option value="5"> 5th</option>
                                </select>
                                @error('floor_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Price Per day') }}</label>

                            <div class="col-md-4">
                                <input id="password-confirm" type="number" min="0" class="form-control" name="price_per_day"  value="{{ $editRoom->price_per_day}}" required >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Availability') }}</label>
                            <div class="col-md-4">
                                <select class="form-control @error('availability') is-invalid @enderror" name="availability" required>
                                    <option value="">>-----------Select One-----------<</option>
                                    <option value="1">Available</option>
                                    <option value="0">UnAvailable</option>

                                </select>
                                @error('availability')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-4">
                                <textarea id="mytextarea"  class="form-control @error('description') is-invalid @enderror" name="description" required>{{ $editRoom->description}}</textarea>

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
                                    <i class="fas fa-hammer"></i>
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
        document.forms['room_update'].elements['room_type'].value = '{{$editRoom->room_type_id}}';
        document.forms['room_update'].elements['availability'].value = '{{ $editRoom->availability }}';
        document.forms['room_update'].elements['floor_number'].value = '{{ $editRoom->floor_number }}';
        document.forms['room_update'].elements['room_number'].value = '{{ $editRoom->room_number }}';
    </script>
@endsection
@section('additionalScript')
    <!-- Page level plugins -->
    <script>

        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection

@extends('Backend.master')

@section('title')
    Manage Room
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
                    <form method="POST" action="{{ route('create-room') }}" name="room_add">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Room Number') }}</label>

                            <div class="col-md-4">
                                <input id="room_number" type="text" class="form-control @error('room_number') is-invalid @enderror" name="room_number" value="{{ old('room_number') }}" required  autofocus>

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
                                <input id="password-confirm" type="number" min="0" class="form-control" name="price_per_day"  value="{{ old('price_per_day') }}" required >
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
                                <textarea id="mytextarea"  class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>

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
                <h5 style="text-align: center" class="m-0 font-weight-bold text-primary">All Rooms</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Floor Number</th>
                            <th>Price Per Day(Tk)</th>
                            <th>Description</th>
                            <th>Created By (#ID)</th>
                            <th>Created at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Floor Number</th>
                            <th>Price Per Day(Tk)</th>
                            <th>Description</th>
                            <th>Created By (#ID)</th>
                            <th>Created at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($rooms as $room)
                            <tr>
                                <td>{{$room->id}}</td>
                                <td>{{$room->room_number}}</td>
                                <td>{{$room->roomType->room_type}}</td>
                                <td>{{$room->floor_number}}</td>
                                <td>{{$room->price_per_day}}</td>
                                <td>{{$room->description}}</td>
                                <td>{{$room->managementName->name}} (#{{$room->management_id}})</td>
                                <td>{{$room->created_at}}</td>
                                <td>@if($room->availability==1)
                                        <a  class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                              <i style="color: white" class="fas fa-check"></i>
                                            </span>
                                            <span style="color: white" class="text">{{$room->availability==1?"Available": "Unavailable"}}</span>
                                        </a>
                                    @else

                                        <a  class="btn btn-danger btn-icon-split">
                                            <span class="icon text-white-50">
                                              <i style="color: white" class="fas fa-exclamation-triangle"></i>
                                            </span>
                                            <span style="color: white" class="text">{{$room->availability==1?"Available": "Unavailable"}}</span>
                                        </a>
                                    @endif</td>
                                <td><a href="{{ url('/edit-room/'.$room->room_number) }}" class="btn btn-primary btn-xl" title="Edit">
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
    document.forms['room_add'].elements['room_type'].value = '{{ old('room_type') }}';
    document.forms['room_add'].elements['availability'].value = '{{ old('availability') }}';
    document.forms['room_add'].elements['floor_number'].value = '{{ old('floor_number') }}';
    document.forms['room_add'].elements['room_number'].value = '{{ old('room_number') }}';
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

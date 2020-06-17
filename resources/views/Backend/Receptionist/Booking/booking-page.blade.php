@extends('Backend.master')

@section('title')
    Booking
@endsection
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body" style="text-align: center">
                    <h4 style="text-align: center">Hotel New York Booking</h4>
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
                <form class="form-inline" name="checkBooking" action="{{url('/check-bookings')}}" method="GET">
                    {{ csrf_field() }}
                    <label class="col-sm-1" style="padding: 0;" for="check_in">Check In<span style="color: red">*</span></label>
                    <input id="checkIn"  type="date" min="{{Date('Y-m-d', time() - 86400)}}" name="check_in" @if(isset($CheckIn)) value="{{$CheckIn}}" style="background-color: dodgerblue; color: white"  @endif class="col-sm-2 form-control">
                    <label class="col-sm-2"  for="check_out">Check Out<span style="color: red">*</span></label>
                    <input id="checkOut" min="{{Date('Y-m-d')}}" type="date" name="check_out" @if(isset($checkOut)) value="{{$checkOut}}" style="background-color: dodgerblue; color: white" @endif class="col-sm-2 form-control">
                    <label  class="col-sm-2" for="room_type">Room Type<span style="color: red">*</span></label>
                    <select name="room_type" class="col-sm-2 form-control">
                        <option value="">Select One</option>
                        @foreach($roomTypes as $item)
                        <option value="{{$item->id}}">{{$item->room_type}}</option>
                        @endforeach
                    </select>
                    <button style="padding-left: 0px; padding-right: 0px"  type="submit" class="col-sm-1 btn btn-success"><i class="far fa-calendar-check"></i> Check</button>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            @if(isset($rooms))
                @foreach($rooms as $room)
            <div class="card mb-4 py-3 border-left-primary">
                <div class="card-body">
                    <form class="form-inline" action="{{url('/attempt-bookings')}}" method="GET">
                        {{ csrf_field() }}
                        <label class="col-sm-2" for="roomNumber">Room No.</label>
                        <input type="text" value="{{$room->room_number}}" name="room_number" style="border: 0px" readonly  class="col-sm-1">
                        <input type="hidden" name="check_in" @if(isset($CheckIn)) value="{{$CheckIn}}" style="background-color: dodgerblue; color: white"  @endif class="col-sm-2 form-control">
                        <input type="hidden" name="check_out" @if(isset($checkOut)) value="{{$checkOut}}" style="background-color: dodgerblue; color: white" @endif class="col-sm-2 form-control">
                        <label class="col-sm-1" for="Floor">Floor No</label>
                        <input type="text" value="{{$room->floor_number}}" name="floor_number" style="border: 0px" readonly  class="col-sm-1">
                        <label  class="col-sm-1" for="room_type">Room Type</label>
                        <input type="text" value="{{$room->roomType->room_type}}" style="border: 0px" readonly  class="col-sm-2">
                        <input type="hidden" value="{{$room->room_type_id}}" name="room_type_id">
                        <label  class="col-sm-2 " for="price_per_day">Price Per Day</label>
                        <input type="text" value="{{$room->price_per_day}}" name="price_per_day" style="border: 0px" readonly  class="col-sm-1">
                        <button type="submit" class="col-sm-1 btn btn-info">Book</button>
                    </form>
                </div>

            </div>
                @endforeach
            @endif
        </div>


        <!-- DataTales Example -->

    </div>
    <!-- /.container-fluid -->
    @endsection


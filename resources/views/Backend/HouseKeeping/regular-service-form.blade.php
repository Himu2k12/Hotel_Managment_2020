@extends('Backend.master')

@section('title')
    House Keeping
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h4 style="text-align: center">House Keeping Staff Allocation</h4>
                    <h6 style="text-align: center" class="text-success">{{ Session::get('message') }}</h6>
                </div>
            </div>
        </div>
        <form method="post" name="regularService" action="{{route('regular-hotel-services')}}">
            @csrf
            <div class="row">

                <div class="col-lg-3">
                    <!-- Basic Card Example -->
                </div>
                <div class="col-lg-6">
                    <!-- Basic Card Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success" style="text-align: center">Staff Allocation</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="BookingID" class="col-md-5 col-form-label text-md-right">{{ __('Service Area') }}<span style="color: red">*</span></label>
                                <div class="col-md-7">
                                    <select id="service_area" required onchange="serviceArea()" class="form-control " name="service_area">
                                        <option value="">Please Select One</option>
                                        <option value="Room">Room</option>
                                        <option value="Kitchen">Kitchen</option>
                                        <option value="Restroom">Restroom</option>
                                        <option value="Lobby">Lobby</option>
                                        <option value="Cafeteria">Cafeteria</option>
                                        <option value="Outside ground">Outside ground</option>
                                        <option value="Business center ">Business center</option>
                                        <option value="Stairwells">Stairwells</option>
                                        <option value="Ground floor windows">Ground floor windows</option>
                                    </select>
                                    <span style="color: red;">{{ $errors->has('service_area') ? $errors->first('service_area') : ' ' }}</span>
                                    <span style="color: red;">{{ $errors->has('room_no') ? $errors->first('room_no') : ' ' }}</span>
                                </div>

                            </div>
                            <div id="RoomNo">
                                <div class="form-group row">
                                    <label for="service_area" class="col-md-5 col-form-label text-md-right">{{ __('Room No') }}<span style="color: red">*</span></label>
                                    <div class="col-md-7">
                                        <input id="room_no"  type="text" class="form-control" value="" name="room_no">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="BookingID" class="col-md-5 col-form-label text-md-right">{{ __('Staff Name') }}<span style="color: red">*</span></label>
                                <div class="col-md-7">
                                    <select required class="form-control" name="staff_id">
                                        <option value="">Please Select One</option>
                                        @foreach($staffs as $staff)
                                            <option value="{{$staff->id}}">{{$staff->name}}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red;">{{ $errors->has('staff_id') ? $errors->first('staff_id') : ' ' }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="allocation_time" class="col-md-5 col-form-label text-md-right">{{ __('Allocation Time') }}<span style="color: red">*</span></label>
                                <div class="col-md-7">
                                    <input id="room_id"  type="time" class="form-control" value="allocation_time" name="allocation_time" required >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row mb-0">

                        <div class="col-md-5 offset-md-5">
                            <button  type="submit" class="btn btn-primary col-sm-4">
                                {{ __('Allocate') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- DataTales Example -->
            </div>
        </form>
        <!-- /.container-fluid -->
<script>
    document.getElementById("RoomNo").style.display = "none";
    function serviceArea() {
        var x=document.getElementById("service_area").value;
        // alert(x);
        if(x=="Room"){
            document.getElementById("RoomNo").style.display = "block";
        }else{
            document.getElementById("RoomNo").style.display = "none";
        }
    }



    document.forms['regularService'].elements['staff_id'].value = '{{old('staff_id') }}';



    </script>

@endsection


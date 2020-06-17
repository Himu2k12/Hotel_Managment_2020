<?php

namespace App\Http\Controllers;

use App\Booking;
use App\HouseKeepingRecords;
use App\RegularServiceRecords;
use App\RoomType;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class HouseKeepingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewHouseKeepingDashboard(){
        return view('Backend.HouseKeeping.dashboard');
    }
    public function roomstatusPreview(){

        $hotelRoomsForClean=Booking::where('status',2)->get();
        return view('Backend.HouseKeeping.room-status',['hotelRoomsForClean'=>$hotelRoomsForClean]);
    }
    public function staffAssigning($id){
        $bookingInfo=Booking::find($id);
        $staffs=User::whereNotIn('role_id',[1,2,3,4])->where('access',1)->get();
        return view('backend.HouseKeeping.staff-assign-form',['bookingInfo'=>$bookingInfo,'staffs'=>$staffs]);
    }
    public function NewRoomService(Request $request){
        $RoomServiceAfterBooking=new HouseKeepingRecords();
        $RoomServiceAfterBooking->booking_id=$request->booking_id;
        $RoomServiceAfterBooking->staff_id=$request->staff_id;
        $RoomServiceAfterBooking->allocated_by=Auth::user()->id;
        $RoomServiceAfterBooking->allocation_time=$request->allocation_time;
        $RoomServiceAfterBooking->save();

        $bookingInfo=Booking::find($request->booking_id);
        $bookingInfo->status=3;
        $bookingInfo->save();

        return redirect('/active-Services')->with('Message','Staff Allocated to Room Service!');
    }
    public function ActiveServices(){
        $ActiveServices=DB::table('house_keeping_records')
            ->join('users','users.id','=','house_keeping_records.staff_id')
            ->where('house_keeping_records.status','=',1)
            ->select('house_keeping_records.*','users.name')
            ->get();
        $regularServices=DB::table('regular_service_records')
            ->join('users','users.id','=','regular_service_records.staff_id')
            ->where('regular_service_records.status','=',1)
            ->select('regular_service_records.*','users.name')
            ->get();

        return view('Backend.HouseKeeping.active-services',['ActiveServices'=>$ActiveServices,'regularServices'=>$regularServices]);
    }
    public function CompleteAssigningTaskForm($id){
        $formInfo=HouseKeepingRecords::find($id);

        return view('Backend.HouseKeeping.Complete-assign-work',['formInfo'=>$formInfo]);
    }
    public function CompleteAssignedTask(Request $request){

        $CompleteTask=HouseKeepingRecords::find($request->id);
        $CompleteTask->finishing_time=$request->finishing_time;
        $CompleteTask->staff_comment=$request->staff_comment;
        $CompleteTask->status=2;
        $CompleteTask->save();
        return redirect('/active-Services')->with('Message','Service Completed!');
    }
    public function RegularRoomServices(){
        $staffs=User::where('role_id','!=',1)->get();
        return view('Backend.HouseKeeping.regular-service-form',['staffs'=>$staffs]);
    }
    public function RegularHotelServices(Request $request){

        if ($request->service_area=="Room"){
            $this->validate($request,[
                'service_area'=>'required',
                'staff_id'=>'required',
                'room_no'=>'required',
                'allocation_time'=>'required',
            ],[
                'staff_id.required'=>'Please Choose a staff for HouseKeeping!',
                'room_no.required'=>'Please enter room number with Service Area->(Room)!',
            ]);

        }else{
            $this->validate($request,[
                'service_area'=>'required',
                'staff_id'=>'required',
                'allocation_time'=>'required',
            ],[
                'staff_id.required'=>'Please Choose a staff for HouseKeeping!',
            ]);

        }

        $dailyServices=new RegularServiceRecords();
        $dailyServices->service_area=$request->service_area;
        $dailyServices->room_no=$request->room_no;
        $dailyServices->staff_id=$request->staff_id;
        $dailyServices->allocation_time=$request->allocation_time;
        $dailyServices->finishing_time=$request->finishing_time;
        $dailyServices->staff_comment=$request->staff_comment;
        $dailyServices->allocated_by=Auth::user()->id;
        $dailyServices->save();

        return redirect('/active-Services')->with('message','Service allocated Successfully!');
    }

    public function CompleteRegularAssigningTaskForm($id){
        $formInfo=RegularServiceRecords::find($id);

        return view('Backend.HouseKeeping.regular-assign-work-completion',['formInfo'=>$formInfo]);
    }
    public function RegularTaskCompletion(Request $request){

        $CompleteTask=RegularServiceRecords::find($request->id);
        $CompleteTask->finishing_time=$request->finishing_time;
        $CompleteTask->staff_comment=$request->staff_comment;
        $CompleteTask->status=2;
        $CompleteTask->save();
        return redirect('/active-Services')->with('message','Service Completed!');
    }

    public function dailyServiceHistory(){
        $today=Date('Y-m-d');
//        dd($today);
        $dailyAfterRoomService=DB::table('house_keeping_records')
            ->join('users','users.id','=','house_keeping_records.staff_id')
            ->select('house_keeping_records.*','users.name')
            ->whereDate('house_keeping_records.created_at',$today)
            ->where('house_keeping_records.status','=',2)
            ->get();

        $dailyRegularService=DB::table('regular_service_records')
            ->join('users','users.id','=','regular_service_records.staff_id')
            ->select('regular_service_records.*','users.name')
            ->whereDate('regular_service_records.created_at',$today)
            ->where('regular_service_records.status','=',2)
            ->get();
        return view('Backend.HouseKeeping.daily-history',['dailyAfterRoomService'=>$dailyAfterRoomService,'dailyRegularService'=>$dailyRegularService]);
    }
}

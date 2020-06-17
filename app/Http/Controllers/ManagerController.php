<?php

namespace App\Http\Controllers;

use App\AdditionalCost;
use App\Booking;
use App\Customer;
use App\LeaveRecord;
use App\Payment;
use App\Role;
use App\Room;
use App\RoomType;
use App\SalaryInfo;
use App\ServiceCost;
use App\StaffInformation;
use App\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Gate;
use View;
use App;
use App\Tax;
use App\CancelBooking;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        return view('Backend.Manager.Dashboard');
    }

    //This function is for opening new page for add new rooms.it also provides the room types to the room add form. so that room info can be added with types
    public function roomAddForm(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $roomTypes=RoomType::where('status',1)->get();
        $rooms=Room::all();
        return view('backend.Manager.Room.room-adding-form',compact('roomTypes','rooms'));
    }
    //This function is for adding new room types along with all existing room types
    public function roomTypeForm(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $roomTypes=RoomType::all();

        return view('backend.Manager.Room.room-type-adding-form',compact('roomTypes'));
    }
    //This function is for inserting new Room Types to the database
    public function newRoomType(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
            'room_type'=>'required|max:100',
        ]);
        $newType= new RoomType();
        $newType->room_type=$request->room_type;
        $newType->management_id=Auth::user()->id;
        $newType->save();
        return redirect('/add-room-type')->with('message','New Room Type Created Successfully!');;
    }
    //This function is for inserting new Rooms to the database
    public function newRoom(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
           'room_number' =>'required|unique:rooms',
           'room_type' =>'required',
           'floor_number' =>'required',
           'availability' =>'required',
           'description' =>'required',
            'price_per_day' =>'required|min:0|max:1000000',
        ]);

        $newRoom= new Room();
        $newRoom->room_number=$request->room_number;
        $newRoom->room_type_id=$request->room_type;
        $newRoom->floor_number=$request->floor_number;
        $newRoom->price_per_day=$request->price_per_day;
        $newRoom->description=$request->description;
        $newRoom->availability=$request->availability;
        $newRoom->management_id=Auth::user()->id;
        $newRoom->save();

        return redirect('/room-add-form')->with('message','New Room Added Successfully!');
    }
    //This function is for editing Rooms. all information from specific room id which need to to be edited will be attached with the editing form.
    public function editRoom($id){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $editRoom=Room::where('room_number',$id)->first();
        $roomTypes=RoomType::where('status',1)->get();
        return view('backend.Manager.Room.Edit-room-info',compact('editRoom','roomTypes'));
    }
    //this function will Update the editing information and store to the database
    public function updateRoomInfo(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }

        $this->validate($request,[
            'room_type' =>'required',
            'floor_number' =>'required',
            'availability' =>'required',
            'description' =>'required',
            'price_per_day' =>'required|min:0|max:1000000',
        ]);

        $newRoom= Room::where('room_number',$request->room_number)->first();
        $newRoom->room_type_id=$request->room_type;
        $newRoom->floor_number=$request->floor_number;
        $newRoom->price_per_day=$request->price_per_day;
        $newRoom->description=$request->description;
        $newRoom->availability=$request->availability;
        $newRoom->save();

        return redirect('/room-add-form')->with('message','Room Info Updated Successfully!');
    }
    //This function is for editing Room types. all information from specific room type id which need to to be edited will be attached with the editing form.
    public function editRoomTypeForm($id){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $roomType=RoomType::find($id);//specific information from room type table will be stored in roomType variable
        $roomTypes=RoomType::all();

        return view('backend.Manager.Room.room-type-adding-form',compact('roomTypes','roomType'));
    }
    //this function will Update the editing information of roomtype and store to the database
   public function UpdateRoomType(Request $request){
       if(!Gate::allows(['isManager'])){
           abort('404','you cannot access here');
       }
        $roomType=RoomType::find($request->id);
        $roomType->room_type=$request->room_type;
        $roomType->status=$request->status;
        $roomType->save();

        return redirect('/add-room-type')->with('message','Room Type Updated Successfully!');
    }
    //this function will retrieve all booking information and send to the view
   public function ShowBookings(){
       if(!Gate::allows(['isManager'])){
           abort('404','you cannot access here');
       }
        $allBookings=DB::table('bookings')
            ->join('users','users.id','=','bookings.customer_id')
            ->where('bookings.status','!=',1)
            ->select('users.name','bookings.*')
            ->get();


        return view('backend.Manager.Bookings.All-bookings',['allBookings'=>$allBookings]);
   }
   //this function will retrieve all bookings which are already running
//    public function showActiveBookings(){
//        if(!Gate::any(['isManager'])){
//            abort('404','you cannot access here');
//        }
//        $allBookings=DB::table('bookings')
//            ->join('users','users.id','=','bookings.customer_id')
//            ->join('customers','customers.id','=','bookings.customer_id')
//            ->where('bookings.status','=',1)
//            ->select('users.name','bookings.*','customers.mobile_no','customers.full_name')
//            ->get();
//        $current_date_time = Carbon::now()->toDateTimeString();
//
//        return view('backend.Manager.Bookings.running-bookings',['allBookings'=>$allBookings,'current_date_time'=>$current_date_time]);
//    }


   //This function will represent all details of a specific Booking
    public function viewBookingDetails($id){
       if(!Gate::allows(['isManager'])){
           abort('404','you cannot access here');
       }
       $booking_details=DB::table('bookings')
           ->join('customers','customers.id','=','bookings.customer_id')
           ->where('bookings.id','=',$id)
           ->where('bookings.status','!=',1)
           ->select('bookings.id as book_id','bookings.check_in','bookings.check_out','bookings.room_id','bookings.adults','bookings.children','bookings.booking_days','bookings.basic_rent','bookings.discount','bookings.total_rent','bookings.status as bookstatus','customers.*')
           ->first();

       $payment=Payment::where('booking_id',$id)->where('status',1)->get();
       $service=ServiceCost::where('booking_id',$id)->where('status',1)->get();
       $user=New User();
       $editInfo=DB::table('booking_edit_histories')
           ->join('users','users.id','=','booking_edit_histories.created_by')
           ->where('booking_id',$booking_details->book_id)
           ->select('booking_edit_histories.*','users.name')
           ->get();
       return view('Backend.Manager.Bookings.booking-details',[
                                                                            'booking_details'=>$booking_details,
                                                                            'payment'=>$payment,
                                                                            'service'=>$service,
                                                                            'editInfo'=>$editInfo,
                                                                            'user'=>$user,
       ]);
   }
    public function ShowEditedBookings(){
       if(!Gate::allows(['isManager'])){
           abort('404','you cannot access here');
       }
       $editInfo=DB::table('booking_edit_histories')
           ->join('users','users.id','=','booking_edit_histories.created_by')
           ->select('booking_edit_histories.*','users.name')
           ->get();

       return view('Backend.Manager.Bookings.edited-bookings-history',['editInfo'=>$editInfo]);
   }
    //Employee CRUD related Functions starts from here
    public function viewEmployeePage(){

        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }
        $users=User::where('role_id','!=',1)->where('role_id','!=','2')->get();
        $role=Role::where('id','!=',1)->where('id','!=',2)->where('status',1)->get();

        return view('Backend.Manager.Employee.add-employee',['users'=>$users,'role'=>$role]);
    }
    protected function newEmployee(Request $request)
    {
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $users=new User();
        $users->name = $request['name'];
        $users->email = $request['email'];
        $users->password= Hash::make($request['password']);
        $users->role_id= $request['role'];
        $users->access = 1;
        $users->save();

        return redirect('/employee-registration-page')->with('message','New Employee Added Successfully!');

    }
    public function editEmployee($id){
        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }
        $userInfo=User::find($id);
        $role=Role::where('id','!=',1)->where('id','!=',2)->where('status',1)->get();
        return view('Backend.Manager.Employee.edit-employee',compact('userInfo','role'));
    }
    public function UpdateEmployee(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
        ]);
        $users=User::find($request->id);
        $users->name = $request['name'];
        $users->role_id= $request['role'];
        $users->save();

        return redirect('/employee-registration-page')->with('message','Employee Info Updated Successfully!');
    }
    public function inactiveEmployeeInfo($id){
        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }
        $roleById = User::find($id);
        $roleById->access = 0;
        $roleById->save();
        return redirect('/employee-registration-page')->with('message', 'Role info Inactive successfully');
    }
    public function activeEmployeeInfo($id){
        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }
        $roleById = User::find($id);
        $roleById->access = 1;
        $roleById->save();
        return redirect('/employee-registration-page')->with('message', 'Role info Active successfully');
    }
    //Employee CRUD related functions end here

    //Staff Management related functions starts from here
    public function NewStaffInfoForm($id){
        if(!Gate::any(['isManager','isSuper'])){
            abort('404','you cannot access here');
        }

        $ExistingStaffInfo=StaffInformation::where('user_id',$id)->first();
        $StaffInfo=User::find($id);
        $StaffRole=User::find($id)->role;

        return view('Backend.Manager.Employee.employee-Info-form',['ExistingStaffInfo'=>$ExistingStaffInfo,'StaffInfo'=>$StaffInfo,'StaffRole'=>$StaffRole]);
    }
    public function storeStaffInfo(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'fathers_name'=>'required',
            'mothers_name'=>'required',
            'present_address'=>'required',
            'permanent_address'=>'required',
            'date_of_birth'=>'required',
            'joining_date'=>'required',
            'designation'=>'required',
            'blood_group'=>'required',
            'cv_doc'=>'required',
            'description'=>'required',
            'bank_account_no'=>'required',
            'bank_name'=>'required',
            'branch_name'=>'required',
            'account_holder_name'=>'required',
            'salary_amount'=>'required',
            'staff_photo'=>'required',
        ]);


        $file=$request->file('staff_photo');
        $fileName = $file->getClientOriginalName() ;
        $name=explode('.',$fileName)[0];
        $destinationPath = public_path().'/Staff_photos/' ;
        $temp = explode(".", $fileName);
        $newfilename= round(microtime(true)) . '.' . end($temp);
        $finalName=$name.$newfilename;
        $file->move($destinationPath,$finalName);

        $cv=$request->file('cv_doc');
        $CVName = $cv->getClientOriginalName() ;
        $nam=explode('.',$CVName)[0];
        $destinationPath = public_path().'/Staff_photos/' ;
        $temp2 = explode(".", $CVName);
        $newCVname= round(microtime(true)) . '.' . end($temp2);
        $finalCVName=$nam.$newCVname;
        $cv->move($destinationPath,$finalCVName);

        $newStaff=new StaffInformation();
        $newStaff->user_id=$request->user_id;
        $newStaff->first_name=$request->first_name;
        $newStaff->last_name=$request->last_name;
        $newStaff->fathers_name=$request->fathers_name;
        $newStaff->mothers_name=$request->mothers_name;
        $newStaff->present_address=$request->present_address;
        $newStaff->permanent_address=$request->permanent_address;
        $newStaff->date_of_birth=$request->date_of_birth;
        $newStaff->joining_date=$request->joining_date;
        $newStaff->designation=$request->designation;
        $newStaff->blood_group=$request->blood_group;
        $newStaff->cv_doc=$finalCVName;
        $newStaff->description=$request->description;
        $newStaff->bank_account_no=$request->bank_account_no;
        $newStaff->bank_name=$request->bank_name;
        $newStaff->branch_name=$request->branch_name;
        $newStaff->account_holder_name=$request->account_holder_name;
        $newStaff->salary_amount=$request->salary_amount;
        $newStaff->staff_photo=$finalName;
        $newStaff->save();

        return redirect('/employee-registration-page')->with('message','Staff Info Added Successfully!');
    }
    public function UpdateStaffInfo(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
            $updateStaffInfo=StaffInformation::where('id',$request->id)->first();
        if ($request->file('staff_photo') && $request->file('cv_doc')){
            $file=$request->file('staff_photo');
            $fileName = $file->getClientOriginalName() ;
            $name=explode('.',$fileName)[0];
            $destinationPath = public_path().'/Staff_photos/' ;
            $temp = explode(".", $fileName);
            $newfilename= round(microtime(true)) . '.' . end($temp);
            $finalName=$name.$newfilename;
            $file->move($destinationPath,$finalName);

            $cv=$request->file('cv_doc');
            $CVName = $cv->getClientOriginalName() ;
            $nam=explode('.',$CVName)[0];
            $destinationPath = public_path().'/Staff_photos/' ;
            $temp2 = explode(".", $CVName);
            $newCVname= round(microtime(true)) . '.' . end($temp2);
            $finalCVName=$nam.$newCVname;
            $cv->move($destinationPath,$finalCVName);
            $updateStaffInfo->cv_doc=$finalCVName;
            $updateStaffInfo->staff_photo=$finalName;
        }elseif($request->file('cv_doc')){

            $cv=$request->file('cv_doc');
            $CVName = $cv->getClientOriginalName() ;
            $nam=explode('.',$CVName)[0];
            $destinationPath = public_path().'/Staff_photos/' ;
            $temp2 = explode(".", $CVName);
            $newCVname= round(microtime(true)) . '.' . end($temp2);
            $finalCVName=$nam.$newCVname;
            $cv->move($destinationPath,$finalCVName);
            $updateStaffInfo->cv_doc=$finalCVName;

        }elseif($request->file('staff_photo')){
            $file=$request->file('staff_photo');
            $fileName = $file->getClientOriginalName() ;
            $name=explode('.',$fileName)[0];
            $destinationPath = public_path().'/Staff_photos/' ;
            $temp = explode(".", $fileName);
            $newfilename= round(microtime(true)) . '.' . end($temp);
            $finalName=$name.$newfilename;
            $file->move($destinationPath,$finalName);
            $updateStaffInfo->staff_photo=$finalName;
        }
        $updateStaffInfo->first_name=$request->first_name;
        $updateStaffInfo->last_name=$request->last_name;
        $updateStaffInfo->fathers_name=$request->fathers_name;
        $updateStaffInfo->mothers_name=$request->mothers_name;
        $updateStaffInfo->present_address=$request->present_address;
        $updateStaffInfo->permanent_address=$request->permanent_address;
        $updateStaffInfo->date_of_birth=$request->date_of_birth;
        $updateStaffInfo->joining_date=$request->joining_date;
        $updateStaffInfo->designation=$request->designation;
        $updateStaffInfo->blood_group=$request->blood_group;
        $updateStaffInfo->description=$request->description;
        $updateStaffInfo->bank_account_no=$request->bank_account_no;
        $updateStaffInfo->bank_name=$request->bank_name;
        $updateStaffInfo->branch_name=$request->branch_name;
        $updateStaffInfo->account_holder_name=$request->account_holder_name;
        $updateStaffInfo->salary_amount=$request->salary_amount;
        $updateStaffInfo->save();

        return redirect('/employee-registration-page')->with('message','Staff Info Updated Successfully!');
    }
    //Staffs Management related Functions ends here

    //customer management related routes starts from here
    public function showCustomerForm(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        return view('Backend.Manager.customers.add-customers');
    }
    public function createCustomer(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
           'mobile_no'=>'unique:customers',
        ]);

        $customer= new Customer();
        $customer->full_name=$request->full_name;
        $customer->mobile_no=$request->mobile_no;
        $customer->occupation=$request->occupation;
        $customer->purpose_of_visit=$request->purpose_of_visit;
        $customer->address=$request->address;
        $customer->city=$request->city;
        $customer->country=$request->country;
        $customer->email_address=$request->email;
        $customer->national_id=$request->national_id;
        $customer->passport_no=$request->passport_no;
        $customer->mobile_two=$request->mobile_two;
        $customer->created_by=Auth::user()->id;
        $customer->save();

        return redirect('show-all-customers')->with('message','Customer Info Added Successfully!');
    }
    public function allCustomers(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $customers=Customer::all();
        $username=new User();
        return view('Backend.Manager.customers.all-customers',['customers'=>$customers,'username'=>$username]);
    }
    public function editCustomer($id){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $customers=Customer::find($id);
        return view('Backend.Manager.customers.edit-customer',['customers'=>$customers]);
    }
    public function updateCustomer(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }

        $customer=Customer::find($request->id);
        $customer->full_name=$request->full_name;
        $customer->mobile_no=$request->mobile_no;
        $customer->occupation=$request->occupation;
        $customer->purpose_of_visit=$request->purpose_of_visit;
        $customer->address=$request->address;
        $customer->city=$request->city;
        $customer->country=$request->country;
        $customer->email_address=$request->email;
        $customer->national_id=$request->national_id;
        $customer->passport_no=$request->passport_no;
        $customer->mobile_two=$request->mobile_two;
        $customer->created_by=Auth::user()->id;
        $customer->save();

        return redirect('show-all-customers')->with('message','Customer Info Updated Successfully!');
    }
    //customer management related functions ends here

    //Advance booking cancel and refund functions starts here
    public function cancelForm($id,$room){

        $bookingInfo=DB::table('bookings')
            ->join('customers','customers.id','=','bookings.customer_id')
            ->where('bookings.id','=',$id)
            ->select('bookings.*','customers.full_name','customers.mobile_no')
            ->first();
        $paymentamount=Payment::where('booking_id',$id)->sum('paid_amount');

        return view('backend.Manager.Refund.refund-form',['bookingInfo'=>$bookingInfo,'paymentamount'=>$paymentamount]);
    }
    public function cancelBooking(Request $request){

        $bookingInfo=Booking::find($request->booking_id);
        $cancelBooking=new CancelBooking();
        $cancelBooking->booking_id=$bookingInfo->id;
        $cancelBooking->room_id=$bookingInfo->room_id;
        $cancelBooking->customer_id=$bookingInfo->customer_id;
        $cancelBooking->check_in=$bookingInfo->check_in;
        $cancelBooking->check_out=$bookingInfo->check_out;
        $cancelBooking->booking_days=$bookingInfo->booking_days;
        $cancelBooking->basic_rent=$bookingInfo->basic_rent;
        $cancelBooking->total_rent=$bookingInfo->total_rent;
        $cancelBooking->discount=$bookingInfo->discount;
        $cancelBooking->adults=$bookingInfo->adults;
        $cancelBooking->children=$bookingInfo->children;
        $cancelBooking->payment_status=$bookingInfo->payment_status;
        $cancelBooking->status=$bookingInfo->status;
        if ($request->refund){
            $cancelBooking->refund_amount=$request->refund_amount;
        }else{
            $cancelBooking->refund_amount=0;
        }
        $cancelBooking->created_by=Auth::user()->id;
        $cancelBooking->save();

        $deleteData=Booking::find($request->booking_id);
        $deleteData->forceDelete();
        if ($request->refund){
            $deleteData=Payment::where('booking_id',$request->booking_id)->get();
           foreach ($deleteData as $datum){
               $data=Payment::find($datum->id);
               $data->forceDelete();
           }
        }
        return redirect('/all-cancel-bookings')->with('message','Booking Canceled!');
    }
    public function allCancelBookings(){
        $deletedBookings=CancelBooking::all();
        return view('backend.Manager.Refund.cancel-bookings',['deletedBookings'=>$deletedBookings]);
    }
    //Advance booking refund and cancel functions ends here


// Additional Expense Related Functions are starting from here
    public function viewAdditionalExpence(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $allCosts=DB::table('additional_costs')
            ->join('users','users.id','=','additional_costs.created_by')
            ->select('additional_costs.*','users.name')
            ->get();

        return view('Backend.Manager.AdditionalCost.additional-cost-form',['allCosts'=>$allCosts]);
    }
    public function createAdditionalCost(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
           'cost_amount'=>'required',
           'date'=>'required',
           'description'=>'required',
        ]);

        $additionalCost=new AdditionalCost();
        $additionalCost->additional_cost=$request->cost_amount;
        $additionalCost->date_of_cost=$request->date;
        $additionalCost->description=$request->description;
        $additionalCost->created_by=Auth::user()->id;
        $additionalCost->save();

        return back()->with('message','Additional Cost added Successfully!');
    }
    public function editAdditionalCost($id){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $editInfo=AdditionalCost::find($id);
       return view('Backend.Manager.AdditionalCost.edit-additional-cost',['editInfo'=>$editInfo]);
    }
    public function UpdateAdditioanlCost(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $editInfo=AdditionalCost::find($request->id);
        $editInfo->additional_cost=$request->cost_amount;
        $editInfo->date_of_cost=$request->date;
        $editInfo->description=$request->description;
        $editInfo->created_by=Auth::user()->id;
        $editInfo->save();

        return redirect('additional-cost-form')->with('message','Expense Info Updated successfully!');
    }
//Additional Expense Related Functions Ends here
//Salary related functions starts from here
    public function salaryForm(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $staffs=User::where('access',1)->get();
        return view('Backend.Manager.Salary.monthly-salary-form',['staffs'=>$staffs]);
    }
    public function newSalary(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
           'staff_id'=>'required',
           'month_of_salary'=>'required',
           'total_salary'=>'required|min:1',
        ],[
            'staff_id.required'=>'Please Select an Employee for Salary!'
        ]);
        $check=SalaryInfo::where('month_of_salary',$request->month_of_salary)->where('staff_id',$request->staff_id)->first();
       if ($check==null) {
           $salaryInsert=new SalaryInfo();
           $salaryInsert->staff_id=$request->staff_id;
           $salaryInsert->month_of_salary=$request->month_of_salary;
           $salaryInsert->salary_date=$request->salary_date;
           $salaryInsert->basic_salary=$request->basic_salary;
           $salaryInsert->allowances=$request->allowances;
           $salaryInsert->professional_tax=$request->professional_tax;
           $salaryInsert->Perquisites=$request->Perquisites;
           $salaryInsert->over_time=$request->over_time;
           $salaryInsert->per_hour_cost=$request->per_hour_cost;
           $salaryInsert->over_time_total=$request->over_time_total;
           $salaryInsert->total_salary=$request->total_salary;
           $salaryInsert->description=$request->description;
           $salaryInsert->assigned_by=Auth::user()->id;
           $salaryInsert->save();

           return redirect('/salary-form')->with('message','Salary Info Stored Successfully');
       }else{
           return redirect('/salary-form')->with('Dmessage','This month\'s salary already added for this user!');
       }



    }
    public function searchFormForSalary(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }

        return view('Backend.Manager.Salary.salary-sheet');
    }
    public function checkSalary(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $salaries=SalaryInfo::where('month_of_salary','=',$request->salary_month)->get();
        $userName=new User();
        $MonthOfSalary=$request->salary_month;

        return view('Backend.Manager.Salary.salary-sheet',['salaries'=>$salaries,'userName'=>$userName,'MonthOfSalary'=>$MonthOfSalary]);
    }
    public function EditSalary($id){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $salaries=SalaryInfo::where('id','=',$id)->where('status',1)->first();
        $userName=new User();

        return view('Backend.Manager.Salary.edit-salary-form',['salaries'=>$salaries,'userName'=>$userName]);
    }
    public function UpdateSalary(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
            'staff_id'=>'required',
            'total_salary'=>'required|min:1',
        ],[
            'staff_id.required'=>'Please Select an Employee for Salary!'
        ]);



        $salaryInsert=SalaryInfo::find($request->staff_id);
        $salaryInsert->salary_date=$request->salary_date;
        $salaryInsert->basic_salary=$request->basic_salary;
        $salaryInsert->allowances=$request->allowances;
        $salaryInsert->professional_tax=$request->professional_tax;
        $salaryInsert->Perquisites=$request->Perquisites;
        $salaryInsert->over_time=$request->over_time;
        $salaryInsert->per_hour_cost=$request->per_hour_cost;
        $salaryInsert->over_time_total=$request->over_time_total;
        $salaryInsert->total_salary=$request->total_salary;
        $salaryInsert->description=$request->description;
        $salaryInsert->assigned_by=Auth::user()->id;
        $salaryInsert->save();

        return redirect('/salary-form')->with('message','Salary Info Updated Successfully');
    }
//Salary related Functions ends here

//Staffs Leave related Functions starts from here
    public function StaffLeaveForm(){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $staffs=User::where('access','=',1)->get();
        $leaves=LeaveRecord::where('status',1)->get();
        $userName=new User();
        return view('Backend.Manager.Employee.Leave-applications',['staffs'=>$staffs,'leaves'=>$leaves,'userName'=>$userName]);
    }
    public function createStaffLeave(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
           'Reason_Of_leave'=>'required',
        ]);
        $newLeave=new LeaveRecord();
        $newLeave->staff_Name=$request->staff_Name;
        $newLeave->leave_from=$request->leave_from;
        $newLeave->leave_to=$request->leave_to;
        $newLeave->Reason_Of_leave=$request->Reason_Of_leave;
        $newLeave->approved_by=Auth::user()->id;
        $newLeave->save();

        Return redirect('/leave-records-staffs')->with('message','Leave Records stored Successfully!');
    }
    public function PrintSalary(Request $request){
        if(!Gate::allows(['isManager'])){
            abort('404','you cannot access here');
        }
        $month=$request->month;
        $salaries=DB::table('salary_infos')
            ->where('month_of_salary','=',$month)
            ->where('status','=',1)
            ->get();
        $userName=new User();

        $data = array_merge(['userName'=>$userName,'salaries'=>$salaries,'month'=>$month]);

        $invoice_render = View::make('Backend.Manager.Salary.salary-sheet-pdf', $data)->render();

        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
//staffs leave related functions ends here

//Vat related functions starts from here
    public function addTaxPage(){

        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }else{
            $taxes=Tax::where('status',1)->get();
            return view('Backend.Manager.Tax.add-tax',['taxes'=>$taxes]);
        }
    }
    public function CreateTax(Request $request){
        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }
        $tax=new Tax();
        $tax->tax_percent=$request->taxPercent;
        $tax->status=1;
        $tax->save();
        return back()->with('message','Tax Successfully Created!');
    }
    public function editTax($id) {
        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }
        $editById = Tax::find($id);
        return view('Backend.Manager.Tax.edit-tax', ['editById'=>$editById]);
    }
    public function deleteTax($id) {
        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }
        $editById = Tax::find($id);
        $editById->status=2;
        $editById->save();

        return redirect('/view-tax-page')->with('message', 'Tax info Deleted successfully');
    }
    public function updateTax(Request $request){
        if(!Gate::allows('isManager')){
            abort('404','you cannot access here');
        }
        $this->validate($request, [
            'taxPercent'=>'required',
        ]);
        $updateRoleById = Tax::find($request->id);
        $updateRoleById->tax_percent=$request->taxPercent;
        $updateRoleById->status=$request->status;
        $updateRoleById->save();
        return redirect('/view-tax-page')->with('message', 'Tax info Updated successfully');
    }
//vat related functions ends here
}

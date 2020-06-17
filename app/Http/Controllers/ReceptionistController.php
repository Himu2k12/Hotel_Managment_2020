<?php

namespace App\Http\Controllers;

use App\Booking;
use App\BookingEditHistory;
use App\Customer;
use App\Payment;
use App\Room;
use App\RoomType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Gate;

class ReceptionistController extends Controller
{
    public $roomTypes;
    public function __construct()
    {
        $this->roomTypes=RoomType::where('status',1)->get();
        $this->middleware('auth');
    }
    public function viewHome(){
        if(!Gate::any(['isReceptionist'])){
            abort('404','you cannot access here');
        }
        return view('Backend.Receptionist.home');
    }
    public function checkBookingPage(){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        return view('Backend.Receptionist.Booking.booking-page',['roomTypes'=>$this->roomTypes]);
    }
    public function QueryBooking(Request $request){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
            'check_in'=>'Required|date',
            'check_out'=>'Required|date|after:check_in',
            'room_type'=>'Required',
        ],[
            'check_out.after' => 'Check-Out Date must be greater than Check-In!',
        ]);
        $CheckIn=$request->check_in;
        $CheckOut=$request->check_out;
       $bookings=DB::table('bookings')
           ->whereBetween('check_in',[$CheckIn.' 12:00:00',$CheckOut.' 11.59.59'])
           ->OrwhereBetween('check_out',[$CheckIn.' 12:00:00',$CheckOut.' 11.59.59'])
           ->orWhere([['check_in','<',$CheckIn.' 12:00:00'],['check_out','>',$CheckOut.' 11.59.59']])
           ->select('room_id')
           ->get();
       $data=array();
       foreach ($bookings as $booking){
           $data[]=$booking->room_id;
       }
       $rooms=Room::where('room_type_id','=',$request->room_type)
           ->where('availability','=',1)
           ->whereNotIn('room_number',$data)
           ->get();
        $roomTypes=RoomType::where('status',1)->get();
        return view('Backend.Receptionist.Booking.booking-page',['roomTypes'=>$roomTypes,
                                                                        'rooms'=>$rooms,
                                                                        'CheckIn'=>$CheckIn,
                                                                        'checkOut'=>$CheckOut,

        ]);
    }
    public function ConfirmBookingPage(){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        return view('Backend.Receptionist.Booking.confirm-booking-page');
    }
    public function attemptbooking(Request $request){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $CheckIn=$request->check_in;
        $checkOut=$request->check_out;
        $RoomNumber=$request->room_number;
        $RoomType=RoomType::find($request->room_type_id);
        $PricePerDay=$request->price_per_day;
        $date1 = strtotime($request->check_in);
        $date2 = strtotime($request->check_out);
        $days=($date2-$date1)/60/60/24;
        $totalPayment=$days*$PricePerDay;


        return view('Backend.Receptionist.Booking.confirm-booking-page',['CheckIn'=>$CheckIn,
            'checkOut'=>$checkOut,
            'RoomType'=>$RoomType,
            'RoomNumber'=>$RoomNumber,
            'PricePerDay'=>$PricePerDay,
            'days'=>$days,
            'totalPayment'=>$totalPayment,
        ]);
    }
    public function fetchCustomerData(Request $request){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $customerInfo=Customer::where('mobile_no',$request->mobile)->first();
        if (isset($customerInfo)) {
            return response($customerInfo);
        }else{
            return response(null);
        }
    }
    public function createBooking(Request $request){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        //validation of all booking data
        $this->validate($request,[
            'full_name' => ['required', 'string', 'max:255'],
            'mobile_no' => ['required', 'numeric', 'digits:11'],
            'occupation' => ['required', 'string', 'max:255'],
            'address' => ['required','string'],
            'city' => ['required','string'],
            'country' => ['required','string'],
        ]);
        if (isset($request->old_customer_id)){
            //updating old users for booking

            $customer=Customer::find($request->old_customer_id);
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
        }else{
            //creating new users for booking
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
        }

        $Rent=Room::where('room_number',$request->room_id)->first();
        $basicRent=$Rent->price_per_day;
        $Afterdiscount=$request->total_rent-($request->total_rent*$request->discount/100);
        $customerID=$customer->id;
        //creating booking for users
        $booking=new Booking();
        $booking->room_id=$request->room_id;
        $booking->customer_id=$customerID;
        $booking->check_in=($request->check_in." 12:00:00");
        $booking->check_out=$request->check_out." 11:59:59";
        $booking->booking_days=$request->booking_days;
        $booking->basic_rent=$basicRent;
        $booking->total_rent=$Afterdiscount;
        $booking->discount=$request->discount;
        $booking->adults=$request->number_of_adult;
        $booking->children=$request->number_of_children;
        $booking->payment_status=0;
        $booking->status=$request->booking_type;
        $booking->created_by=Auth::user()->id;
        $booking->save();

        $bookingId=$booking->id;
        $payment=new Payment();
        $payment->paid_amount=$request->Partial_payment;
        $payment->booking_id=$bookingId;
        $payment->received_by=Auth::user()->id;
        $payment->save();

//        $roomsUpdate=Room::where('room_number',$request->room_id)->first();
//        $roomsUpdate->availability=2;// 1= available, 2=booked, 0=under Maintainence for room
//        $roomsUpdate->save();

        return redirect('/all-current-bookings')->with('message','The Booking is confirmed!');
    }
    public function EditBookingsForm($id){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $bookingInfo=Booking::find($id);
        $paymentPartial=Payment::where('booking_id',$id)->sum('paid_amount');

        return view('Backend.Receptionist.Booking.edit-booking',['bookingInfo'=>$bookingInfo,'paymentPartial'=>$paymentPartial]);
    }
    public function UpdateBookings(Request $request){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
            'total_rent'=>'required',
            'adjust_rent'=>'required',
        ]);
        $bookingInfo=Booking::find($request->booking_id);

        $PreviousBookings=DB::table('bookings')
            ->where('room_id','=',$bookingInfo->room_id)
            ->where('id','!=',$bookingInfo->id)
            ->whereBetween('check_in',[$bookingInfo->check_in.' 12:00:00',$request->check_out.' 11.59.59'])
            ->select('*')
            ->get();
        //dd($PreviousBookings);
        if (!$PreviousBookings->isEmpty()){
            return redirect('/edit-bookings/'.$bookingInfo->id)->with('Message','Room Already Booked on this day!');
        }

        $paymentPartial=Payment::where('booking_id',$bookingInfo->booking_id)->sum('paid_amount');

        $editHistory=new BookingEditHistory();
        $editHistory->booking_id=$request->booking_id;
        $editHistory->check_out=$bookingInfo->check_out;
        $editHistory->total_rent=$bookingInfo->total_rent;
        $editHistory->partial_payment=$paymentPartial;
        $editHistory->created_by=Auth::user()->id;
        $editHistory->save();

        $bookingInfo->check_out=$request->check_out." 11:59:59";
        $bookingInfo->booking_days=$request->booking_days;
        $bookingInfo->total_rent = $request->total_rent;
        $bookingInfo->save();
        if ($request->partial_payment) {
            $newPartialPayment = new Payment();
            $newPartialPayment->paid_amount = $request->partial_payment;
            $newPartialPayment->booking_id = $request->booking_id;
            $newPartialPayment->received_by = Auth::user()->id;
            $newPartialPayment->save();
        }

        return redirect('/all-current-bookings')->with('message','Booking Info Updated!');
    }
    public function CurrentBookings(){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $currentBookings=DB::table('bookings')
            ->join('customers','customers.id','=','bookings.customer_id')
            ->select('customers.mobile_no','customers.full_name','bookings.*')
            ->where('status','=',1)
            ->get();
        $current_date_time = Carbon::now()->toDateTimeString();


        return view('Backend.Receptionist.Booking.running-bookings',['currentBookings'=>$currentBookings,'current_date_time'=>$current_date_time]);
    }
    public function BookingsHistory(){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $currentBookings=DB::table('bookings')
            ->join('customers','customers.id','=','bookings.customer_id')
            ->select('customers.mobile_no','customers.full_name','bookings.*')
            ->where('status','=',2)
            ->latest('id')
            ->get();

//        dd($currentBookings);
        $current_date_time = Carbon::now()->toDateTimeString();


        return view('Backend.Receptionist.Booking.booking_history',['currentBookings'=>$currentBookings,'current_date_time'=>$current_date_time]);
    }
    public function dateCalculation(Request $request){
        $date1 = strtotime($request->checkIn);
        $date2 = strtotime($request->checkOut);
        $r=($date2-$date1)/60/60/24;

        return response($r);
    }
    public function viewBookingDetails($id){

            $booking_details=DB::table('bookings')
                ->join('customers','customers.id','=','bookings.customer_id')
                ->where('bookings.id','=',$id)
                ->whereIn('bookings.status',[1,4])
                ->select('bookings.id as book_id','bookings.check_in','bookings.check_out',
                    'bookings.room_id','bookings.adults','bookings.children','bookings.booking_days'
                    ,'bookings.basic_rent','bookings.discount','bookings.total_rent','bookings.status as bookstatus',
                    'customers.*')
                ->first();
            $payment=Payment::where('booking_id',$id)->where('status',1)->get();
            $userName=new User();
            $temp=explode(' ',$booking_details->check_in);
            $temp2=explode(' ',$booking_details->check_out);

            return view('Backend.Receptionist.Booking.view-booking-details',['temp'=>$temp,'temp2'=>$temp2,'userName'=>$userName,'booking_details'=>$booking_details,'payment'=>$payment]);
        }
    public function AdvanceBookings(){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $advanceBookings=DB::table('bookings')
            ->join('customers','customers.id','=','bookings.customer_id')
            ->select('customers.mobile_no','customers.full_name','bookings.*')
            ->where('status','=',4)
            ->get();
        $userName=new User();
        $current_date_time = Carbon::now()->toDateTimeString();
        return view('Backend.Receptionist.Booking.advance-bookings',['userName'=>$userName,'advanceBookings'=>$advanceBookings,'current_date_time'=>$current_date_time]);
    }
    public function ConfirmAvdanceBookingToRegular($id){

            $paymentPartial=Payment::where('booking_id',$id)->sum('paid_amount');
            $bookingInfo=Booking::find($id);
            $editHistory=new BookingEditHistory();
            $editHistory->booking_id=$bookingInfo->id;
            $editHistory->check_out=$bookingInfo->check_out;
            $editHistory->total_rent=$bookingInfo->total_rent;
            $editHistory->partial_payment=$paymentPartial;
            $editHistory->created_by=Auth::user()->id;
            $editHistory->save();

            $Bookings=Booking::find($id);
            $Bookings->status=1;
            $Bookings->Save();
            return redirect('/show-all-active-bookings')->with('message','Advance Booking Turn into Regular!');
        }
    public function CancelAdvanceBooking($id){
        $Bookings=Booking::find($id);
        $Bookings->status=5;
        $Bookings->Save();
        return redirect('/advance-bookings')->with('Message','Advance Booking Cancelled!');

    }
    public function dailyTransaction(){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $today=date('Y-m-d');
        //dd($today);
        $dailyTransaction=DB::table('payments')
            ->join('users','users.id','=','payments.received_by')
            ->select('payments.*','users.name')
            ->whereDate('payments.created_at','=',$today)
            ->get();
        //dd($dailyTransaction);
        return view('Backend.Receptionist.Transaction.daily',['dailyTransaction'=>$dailyTransaction]);
    }

}

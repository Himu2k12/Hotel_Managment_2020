<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Checkout;
use App\Customer;
use App\Payment;
use App\RoomType;
use App\ServiceCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use View;
use PDF;
use App;
use Carbon\Carbon;
use App\Tax;
use Gate;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewPaymentForm($id){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $bookingId=Booking::find($id);
        $particularPayments=Payment::where('booking_id',$id)->get();
        $sumPay=Payment::where('booking_id',$id)->sum('paid_amount');
        return view('backend.Receptionist.Payment.partial-payment',['bookingId'=>$bookingId,
                                                                           'particularPayments'=>$particularPayments,
                                                                           'sumPay'=>$sumPay,
            ]);
    }
    public function storePayment(Request $request){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $newPayment=new Payment();
        $newPayment->booking_id=$request->booking_id;
        $newPayment->paid_amount=$request->paid_amount;
        $newPayment->received_by=Auth::user()->id;
        $newPayment->save();
        return back()->with('message','New Payment Added Successfully!');
    }
    public function ServiceCostForm($id){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $service=ServiceCost::where('booking_id',$id)->get();
        return view('backend.Receptionist.Payment.service-equipment-form',['id'=>$id,'service'=>$service]);
    }
    public function storeServiceInfo(Request $request){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $productName=$request->product_name;
        $price=$request->price;
        $quantity=$request->quantity;


        for($i = 0; $i < Count($productName); ++$i) {
            $newService=new ServiceCost();
            $newService->product_name=$productName[$i];
            $newService->price=$price[$i];
            $newService->quantity=$quantity[$i];
            $newService->total_price=$quantity[$i]*$price[$i];
            $newService->booking_id=$request->booking_id;
            $newService->created_by=Auth::user()->id;
            $newService->save();
        }
        return redirect('all-current-bookings')->with('message','Service Info saved Successfully!');
    }
    public function checkOutForm($id){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $bookingId=Booking::find($id);
        $particularPayments=Payment::where('booking_id',$id)->get();
        $serviceInfo=ServiceCost::where('booking_id',$id)->get();
        $Tax=Tax::where('status',1)->first();
        $totalService=0;
        $totalPaid=0;
        foreach($particularPayments as $particularPayment) {
            $totalPaid = $totalPaid + $particularPayment->paid_amount;

        }
        foreach ($serviceInfo as $data){
            $totalService+=$data->total_price;
        }
      if (isset($Tax)) {
          $totalAmount = $bookingId->total_rent + $totalService +($bookingId->total_rent*$Tax->tax_percent/100);
        }else{
          $totalAmount = $bookingId->total_rent + $totalService;
      }
        $totalDue=$totalAmount-$totalPaid;

        return view('backend.Receptionist.CheckOut.checkout',['totalDue'=>$totalDue,'totalPaid'=>$totalPaid,'totalAmount'=>$totalAmount,'Tax'=>$Tax,'bookingId'=>$bookingId,'particularPayments'=>$particularPayments,'serviceInfo'=>$serviceInfo,'totalService'=>$totalService]);
    }
    public function storeCheckoutInfo(Request $request){
        if(!Gate::any(['isReceptionist','isDeputyManager','isManager'])){
            abort('404','you cannot access here');
        }
        $newPayment=new Payment();
        $newPayment->booking_id=$request->booking_id;
        $newPayment->paid_amount=$request->due_amount;
        $newPayment->received_by=Auth::user()->id;
        $newPayment->save();

        $bookingId=Booking::find($request->booking_id);
        $bookingId->status=2;
        $bookingId->payment_status=1;
        $bookingId->save();

        $checkOut=new Checkout();
        $checkOut->booking_id=$request->booking_id;
        $checkOut->payment_type=$request->payment_type;
        $checkOut->tax_amount=$request->tax_amount;
        $checkOut->created_by=Auth::user()->id;
        $checkOut->save();

        return redirect("/invoice-generate/".$request->booking_id);


//        $booking=DB::table('bookings')
//            ->join('rooms','rooms.room_number','=','bookings.room_id')
//            ->join('room_types','room_types.id','=','rooms.room_type_id')
//            ->where('bookings.id','=',$request->booking_id)
//            ->select('bookings.*','room_types.room_type')
//            ->first();
//        $customers=Customer::find($booking->customer_id);
//        $TotalServiceCharge=ServiceCost::where('booking_id',$request->booking_id)->sum('total_price');
//        $totalPayment=Payment::where('booking_id',$request->booking_id)->sum('paid_amount');
//        $paymentMethod=Checkout::where('booking_id',$request->booking_id)->first();
//        $current_date_time = Carbon::now()->toDateTimeString();
//
//
//        $data = array_merge(['paymentMethod'=>$paymentMethod,'current_date_time'=>$current_date_time,'booking' => $booking, 'customers' => $customers,'TotalServiceCharge'=>$TotalServiceCharge,'totalPayment'=>$totalPayment]);
//
//        $invoice_render = View::make('Backend.Invoices.invoice', $data)->render();
//        $pdf = App::make('dompdf.wrapper');
//        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadHTML($invoice_render);
//        return $pdf->stream();
    }
}

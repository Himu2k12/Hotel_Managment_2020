<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Customer;
use App\ServiceCost;
use App\Payment;
use App\Tax;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\DB;
use View;
use Barryvdh\DomPDF\PDF;
use App\Checkout;
use App\User;
use Gate;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //customer invoice and bill reports starts from here
    public function generateBill($id){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        $booking=Booking::find($id);
        $customers=Customer::find($booking->customer_id);
        $serviceCharge=ServiceCost::where('booking_id',$id)->get();
        $totalPayment=Payment::where('booking_id',$id)->sum('paid_amount');
        $Tax=Tax::where('status',1)->first();

        $data = array_merge(['Tax'=>$Tax,'booking' => $booking, 'customers' => $customers,'serviceCharge'=>$serviceCharge,'totalPayment'=>$totalPayment]);

        $invoice_render = View::make('Backend.Invoices.bill', $data)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function GenerateInvoice($id){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        $booking=DB::table('bookings')
            ->join('rooms','rooms.room_number','=','bookings.room_id')
            ->join('room_types','room_types.id','=','rooms.room_type_id')
            ->where('bookings.id','=',$id)
            ->select('bookings.*','room_types.room_type')
            ->first();
        $customers=Customer::find($booking->customer_id);
        $TotalServiceCharge=ServiceCost::where('booking_id',$id)->sum('total_price');
        $totalPayment=Payment::where('booking_id',$id)->sum('paid_amount');
        $paymentMethod=Checkout::where('booking_id',$id)->first();
        $current_date_time = Carbon::now()->toDateTimeString();
        $Tax=Checkout::where('booking_id',$id)->first();
        $checkOutBy=User::where('id',$Tax->created_by)->first();
        $data = array_merge(['checkOutBy'=>$checkOutBy,'Tax'=>$Tax,'current_date_time'=>$current_date_time,'paymentMethod'=>$paymentMethod,'booking' => $booking, 'customers' => $customers,'TotalServiceCharge'=>$TotalServiceCharge,'totalPayment'=>$totalPayment]);

        $invoice_render = View::make('Backend.Invoices.invoice', $data)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadHTML($invoice_render);
        return $pdf->stream();
    }

    // Hotel reports methods are starting from here
    public function OverallReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){

            $from=$request->from;
            $to=$request->to;

            $bookings=DB::table('bookings')
                ->join('checkouts','checkouts.booking_id','=','bookings.id')
                ->whereBetween('bookings.check_in',[$request->from.' 12:00:00',$request->to.' 12.00.00'])
                ->select('bookings.*','checkouts.tax_amount as tax')
                ->get();

            $totalRent=0;
            $totalservice=0;
            $totalTax=0;
            $Grandtotal=0;
            $totalExpense=0;
            $totalSalary=0;
            foreach ($bookings as $item){

                $totalservice +=DB::table('service_costs')
                    ->where('booking_id',$item->id)
                    ->sum('total_price');

                $totalRent+=$item->total_rent;
                $totalTax+=$item->tax ;

            }
            $Grandtotal+=$totalservice+$totalTax;

            $expenses=DB::table('additional_costs')
                ->join('users','users.id','=','additional_costs.created_by')
                ->whereBetween('additional_costs.created_at',[$request->from,$request->to])
                ->select('additional_costs.*','users.name')
                ->get();

            foreach ($expenses as $item){
                $totalExpense+=$item->additional_cost;
            }
            $salary=DB::table('salary_infos')
                ->whereBetween('salary_date',[$request->from,$request->to])
                ->where('status','=',1)
                ->select('total_salary')
                ->get();

            foreach ($salary as $item){
                $totalSalary+=$item->total_salary;
            }

            return view('Backend.Reports.overall-summery',['totalTax'=>$totalTax,'from'=>$from,'to'=>$to,
                                                                 'totalRent'=>$totalRent,'totalservice'=>$totalservice,
                                                                  'Grandtotal'=>$Grandtotal,'totalExpense'=>$totalExpense,
                                                                  'totalSalary'=>$totalSalary]);

            }else{
            return view('Backend.Reports.overall-summery');
        }
    }
    public function PdfOfOverallReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        $from=$request->from;
        $to=$request->to;

        $bookings=DB::table('bookings')
            ->join('checkouts','checkouts.booking_id','=','bookings.id')
            ->whereBetween('bookings.check_in',[$request->from.' 12:00:00',$request->to.' 12.00.00'])
            ->select('bookings.*','checkouts.tax_amount as tax')
            ->get();

        $totalRent=0;
        $totalservice=0;
        $totalTax=0;
        $Grandtotal=0;
        $totalExpense=0;
        $totalSalary=0;
        foreach ($bookings as $item){

            $totalservice +=DB::table('service_costs')
                ->where('booking_id',$item->id)
                ->sum('total_price');

            $totalRent+=$item->total_rent;
            $totalTax+=$item->tax ;

        }
        $Grandtotal+=$totalservice+$totalTax;

        $expenses=DB::table('additional_costs')
            ->join('users','users.id','=','additional_costs.created_by')
            ->whereBetween('additional_costs.created_at',[$request->from,$request->to])
            ->select('additional_costs.*','users.name')
            ->get();

        foreach ($expenses as $item){
            $totalExpense+=$item->additional_cost;
        }
        $salary=DB::table('salary_infos')
            ->whereBetween('salary_date',[$request->from,$request->to])
            ->where('status','=',1)
            ->select('total_salary')
            ->get();

        foreach ($salary as $item){
            $totalSalary+=$item->total_salary;
        }

        $data = array_merge(['totalTax'=>$totalTax,'from'=>$from,'to'=>$to,
            'totalRent'=>$totalRent,'totalservice'=>$totalservice,
            'Grandtotal'=>$Grandtotal,'totalExpense'=>$totalExpense,
            'totalSalary'=>$totalSalary]);

        $invoice_render = View::make('Backend.Reports.overall-summery-pdf', $data)->render();

        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function BookingReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){

            $from=$request->from;
            $to=$request->to;
            $bookings=DB::table('bookings')
                ->join('checkouts','checkouts.booking_id','=','bookings.id')
                ->whereBetween('bookings.check_in',[$request->from.' 12:00:00',$request->to.' 12.00.00'])
                ->select('bookings.*','checkouts.tax_amount as tax')
                ->get();
            $serviceCost=new ServiceCost();

            return view('Backend.Reports.booking-reports',['serviceCost'=>$serviceCost,'bookings'=>$bookings,'from'=>$from,'to'=>$to]);
        }else{
            return view('Backend.Reports.booking-reports');
        }

    }
    public function PfdOfBookingReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        $bookings=DB::table('bookings')
            ->join('checkouts','checkouts.booking_id','=','bookings.id')
            ->whereBetween('bookings.check_in',[$request->from.' 12:00:00',$request->to.' 12.00.00'])
            ->select('bookings.*','checkouts.tax_amount as tax')
            ->get();
        $from=$request->from;
        $to=$request->to;
        $totalRent=0;
        $totalservice=0;
        $totalTax=0;
        $Grandtotal=0;

        foreach ($bookings as $item){
            $totalRent+=$item->total_rent;
            $totalservice+=DB::table('service_costs')
                ->where('booking_id',$item->id)
                ->sum('total_price');
            $totalTax+=$item->tax ;
            $Grandtotal+=$item->tax+$totalservice+$item->total_rent;
        }
        $serviceCost=new ServiceCost();

        $data = array_merge(['serviceCost'=>$serviceCost,'from'=>$from,'to'=>$to,'bookings'=>$bookings,'totalRent' => $totalRent, 'totalservice' => $totalservice,'totalTax'=>$totalTax,'Grandtotal'=>$Grandtotal]);

        $invoice_render = View::make('Backend.Reports.booking-reports-pdf', $data)->render();

        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function StaffLeaveReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){

            $from=$request->from;
            $to=$request->to;
            $leaveRecords=DB::table('leave_records')
                ->join('users','users.id','=','leave_records.staff_Name')
                ->whereBetween('leave_records.created_at',[$request->from,$request->to])
                ->select('leave_records.*','users.name')
                ->get();

            $OfficerName=new User();

            return view('Backend.Reports.staff-leave-reports',['OfficerName'=>$OfficerName,'leaveRecords'=>$leaveRecords,'from'=>$from,'to'=>$to]);
        }else{
            return view('Backend.Reports.staff-leave-reports');
        }

    }
    public function PfdOfStaffLeaveReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        $from=$request->from;
        $to=$request->to;
        $leaveRecords=DB::table('leave_records')
            ->join('users','users.id','=','leave_records.staff_Name')
            ->whereBetween('leave_records.created_at',[$request->from,$request->to])
            ->select('leave_records.*','users.name')
            ->get();
        $OfficerName=new User();
        $data = array_merge(['from'=>$from,'to'=>$to,'leaveRecords'=>$leaveRecords,'OfficerName'=>$OfficerName]);

        $invoice_render = View::make('Backend.Reports.staff-leave-report-pdf', $data)->render();

        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }

    public function ExpenseReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
            $expenses=DB::table('additional_costs')
                ->join('users','users.id','=','additional_costs.created_by')
                ->whereBetween('additional_costs.created_at',[$request->from,$request->to])
                ->select('additional_costs.*','users.name')
                ->get();
            return view('Backend.Reports.additional-costs-report',['expenses'=>$expenses,'from'=>$from,'to'=>$to]);
        }else{
            return view('Backend.Reports.additional-costs-report');
        }

    }
    public function PfdOfExpenseReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        $expenses=DB::table('additional_costs')
            ->join('users','users.id','=','additional_costs.created_by')
            ->whereBetween('additional_costs.created_at',[$request->from,$request->to])
            ->select('additional_costs.*','users.name')
            ->get();
        $from=$request->from;
        $to=$request->to;
        $totalCost=0;

        foreach ($expenses as $item){
            $totalCost+=$item->additional_cost;
        }
        $data = array_merge(['from'=>$from,'to'=>$to,'expenses'=>$expenses,'totalCost' => $totalCost]);
        $invoice_render = View::make('Backend.Reports.additional-expense-report-pdf', $data)->render();
        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function HouseKeepingReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
        $records=DB::table('house_keeping_records')
            ->join('bookings','bookings.id','=','house_keeping_records.booking_id')
            ->whereBetween('house_keeping_records.created_at',[$request->from,$request->to])
            ->select('house_keeping_records.*','bookings.room_id')
            ->get();
        $userName=new User();
            return view('Backend.Reports.room-service-report',['records'=>$records,'from'=>$from,'to'=>$to,'userName'=>$userName]);
        }else{
            return view('Backend.Reports.room-service-report');
        }

    }
    public function PfdOfAfterBookingServiceReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        $from=$request->from;
        $to=$request->to;
        $records=DB::table('house_keeping_records')
            ->join('bookings','bookings.id','=','house_keeping_records.booking_id')
            ->whereBetween('house_keeping_records.created_at',[$request->from,$request->to])
            ->select('house_keeping_records.*','bookings.room_id')
            ->get();
        $userName=new User();

        $data = array_merge(['userName'=>$userName,'records'=>$records,'from'=>$from,'to'=>$to]);

        $invoice_render = View::make('Backend.Reports.room-service-report-pdf', $data)->render();

        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
    public function RegularHouseKeepingReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        if($request->from!==null){
            $from=$request->from;
            $to=$request->to;
            $records=DB::table('regular_service_records')
                ->whereBetween('created_at',[$request->from,$request->to])
                ->select('*')
                ->get();
            $userName=new User();
            return view('Backend.Reports.regular-service-report',['records'=>$records,'from'=>$from,'to'=>$to,'userName'=>$userName]);
        }else{
            return view('Backend.Reports.regular-service-report');
        }
    }
    public function PfdOfRegularHouseKeepingReports(Request $request){
        if(!Gate::any(['isSuper','isManager'])){
            abort('404','you cannot access here');
        }
        $from=$request->from;
        $to=$request->to;
        $records=DB::table('regular_service_records')
            ->whereBetween('regular_service_records.created_at',[$request->from,$request->to])
            ->get();
        $userName=new User();

        $data = array_merge(['userName'=>$userName,'records'=>$records,'from'=>$from,'to'=>$to]);

        $invoice_render = View::make('Backend.Reports.regular-service-report-pdf', $data)->render();

        $pdf = new Dompdf();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($invoice_render);
        return $pdf->stream();
    }
}

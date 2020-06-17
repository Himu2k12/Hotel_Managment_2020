<?php

namespace App\Http\Controllers;

use App\Role;
use App\RoomType;
use App\StaffInformation;
use App\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Faker\ORM\Mandango\Populator;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use View;
use App;

class SuperAdminController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function viewIndex()
    {

        $ProfilePhotos = StaffInformation::where('user_id', Auth::id())->Select('staff_photo')->first();
        //dd($ProfilePhotos);

        if (Gate::allows('isSuper')) {
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            if ($month > 9) {
                $date1 = $year . '-' . $month . '-01';
                $date2 = $year . '-' . $month . '-31';

            } else {
                $date1 = $year . '-0' . $month . '-01';
                $date2 = $year . '-0' . $month . '-31';
            }
            $yearlyDate1 = $year . '-01-01 12:00:00';
            $yearlyDate2 = $year . '-12-31 12:00:00';

            $bookingsCurrentMonthCollection = DB::table('bookings')
                ->whereBetween('check_in', [$date1 . ' 12:00:00', $date2 . ' 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalMonthlyamount = 0;
            foreach ($bookingsCurrentMonthCollection as $data) {
                $totalMonthlyamount += $data->total_rent;
            }
            $bookingsCurrentYearCollection = DB::table('bookings')
                ->whereBetween('check_in', [$yearlyDate1, $yearlyDate2])
                ->select('total_rent')
                ->get();

            $totalYearlyamount = 0;
            foreach ($bookingsCurrentYearCollection as $data) {
                $totalYearlyamount += $data->total_rent;
            }
            $totalAdditional = 0;
            $totalAdditionalYearlyCost = DB::table('additional_costs')
                ->whereBetween('date_of_cost', [$yearlyDate1, $yearlyDate2])
                ->select('additional_cost')
                ->get();
            foreach ($totalAdditionalYearlyCost as $data) {
                $totalAdditional += $data->additional_cost;
            }
            $totalSalary = 0;
            $totalSalaryYearlyCost = DB::table('salary_infos')
                ->whereBetween('month_of_salary', [$year . '-01', $year . '-12'])
                ->select('total_salary')
                ->get();
            foreach ($totalSalaryYearlyCost as $data) {
                $totalSalary += $data->total_salary;
            }

            $grandTotal = $totalYearlyamount + $totalSalary + $totalAdditional;
            $incomeRatio = round(($totalYearlyamount / $grandTotal * 100), 2);
            $salaryRatio = round(($totalSalary / $grandTotal * 100), 2);
            $expenseRatio = round(($totalAdditional / $grandTotal * 100), 2);

            $numberofBookingInRunningYear = DB::table('bookings')
                ->whereBetween('check_in', [$yearlyDate1, $yearlyDate2])
                ->select('total_rent')
                ->count();
            //monthly earnings without tax and service charge of running year
            $januaryIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-01-01 12:00:00', $year . '-01-31 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalJanAmount = 0;
            foreach ($januaryIncome as $data) {
                $totalJanAmount += $data->total_rent;
            }
            $FebIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-02-01 12:00:00', $year . '-02-29 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalFebAmount = 0;
            foreach ($FebIncome as $data) {
                $totalFebAmount += $data->total_rent;
            }
            $MarIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-03-01 12:00:00', $year . '-03-31 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalMarAmount = 0;
            foreach ($MarIncome as $data) {
                $totalMarAmount += $data->total_rent;
            }
            $AprIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-04-01 12:00:00', $year . '-04-30 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalAprAmount = 0;
            foreach ($AprIncome as $data) {
                $totalAprAmount += $data->total_rent;
            }
            $MayIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-05-01 12:00:00', $year . '-05-31 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalMayAmount = 0;
            foreach ($MayIncome as $data) {
                $totalMayAmount += $data->total_rent;
            }

            $JunIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-06-01 12:00:00', $year . '-06-30 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalJunAmount = 0;
            foreach ($JunIncome as $data) {
                $totalJunAmount += $data->total_rent;
            }
            $JulyIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-07-01 12:00:00', $year . '-07-31 12:00:00'])
                ->select('total_rent')
                ->get();

            $totaljulyAmount = 0;
            foreach ($JulyIncome as $data) {
                $totaljulyAmount += $data->total_rent;
            }
            $AugIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-08-01 12:00:00', $year . '-08-31 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalAugAmount = 0;
            foreach ($AugIncome as $data) {
                $totalAugAmount += $data->total_rent;
            }

            $SepIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-09-01 12:00:00', $year . '-09-30 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalSepAmount = 0;
            foreach ($SepIncome as $data) {
                $totalSepAmount += $data->total_rent;
            }
            $OctIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-10-01 12:00:00', $year . '-10-31 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalOctAmount = 0;
            foreach ($OctIncome as $data) {
                $totalOctAmount += $data->total_rent;
            }
            $NovIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-11-01 12:00:00', $year . '-11-30 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalNovAmount = 0;
            foreach ($NovIncome as $data) {
                $totalNovAmount += $data->total_rent;
            }
            $DecIncome = DB::table('bookings')
                ->whereBetween('check_in', [$year . '-12-01 12:00:00', $year . '-12-31 12:00:00'])
                ->select('total_rent')
                ->get();

            $totalDecAmount = 0;
            foreach ($DecIncome as $data) {
                $totalDecAmount += $data->total_rent;
            }


            return view('Backend.Super.super-home', ['totalMonthlyamount' => $totalMonthlyamount,
                'totalYearlyamount' => $totalYearlyamount,
                'totalAdditional' => $totalAdditional,
                'numberofBookingInRunningYear' => $numberofBookingInRunningYear,
                'totalJanAmount' => $totalJanAmount,
                'totalFebAmount' => $totalFebAmount,
                'totalMarAmount' => $totalMarAmount,
                'totalAprAmount' => $totalAprAmount,
                'totalMayAmount' => $totalMayAmount,
                'totalJunAmount' => $totalJunAmount,
                'totaljulyAmount' => $totaljulyAmount,
                'totalAugAmount' => $totalAugAmount,
                'totalSepAmount' => $totalSepAmount,
                'totalOctAmount' => $totalOctAmount,
                'totalNovAmount' => $totalNovAmount,
                'totalDecAmount' => $totalDecAmount,
                'incomeRatio' => $incomeRatio,
                'salaryRatio' => $salaryRatio,
                'expenseRatio' => $expenseRatio,

            ]);
        } elseif (Gate::allows('isManager')) {
            return redirect('/dashboard-GM');
        } elseif (Gate::allows('isReceptionist')) {
            return redirect('/front-desk');
        } elseif (Gate::allows('isDeputyManager')){
            return redirect('/dm-panel');
        }else{
            Auth::logout();
            return redirect('/login');
            abort('404','you cannot access here');
        }

    }

    public function addRolePage(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }else{
            $roles=Role::all();
            return view('Backend.Super.role.add-role',['roles'=>$roles]);
        }
    }
    public function CreateRole(Request $request){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $this->validate($request,[
           'role'=>'unique:roles|required',
        ]);
        $role=new Role();
        $role->role=$request->role;
        $role->status=1;
        $role->save();
        return back()->with('message','New Role Successfully Created!');
    }

    public function inactiveRoleInfo($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $roleById = Role::find($id);
        $roleById->status = 0;
        $roleById->save();
        return redirect('/view-add-role-page')->with('message', 'Role info Inactive successfully');
    }
    public function activeRoleInfo($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $roleById = Role::find($id);
        $roleById->status = 1;
        $roleById->save();
        return redirect('/view-add-role-page')->with('message', 'Role info Active successfully');
    }
    public function editRole($id) {
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }

        $editById = Role::find($id);
        return view('Backend.Super.role.edit-role', ['editById'=>$editById]);
    }

    public function updateRoleInfo(Request $request){

        $this->validate($request, [
            'role'=>'required|min:2|max:50|unique:roles',
            'status'=>'required',
        ]);
        $updateRoleById = Role::find($request->id);
        $updateRoleById->role=$request->role;
        $updateRoleById->status=$request->status;
        $updateRoleById->save();
        return redirect('/view-add-role-page')->with('message', 'Role info Updated successfully');
    }
    public function viewTeam(){
        $staffInfo=StaffInformation::where('status',1)->get();
        return view('Backend.Manager.Employee.Hotel-Team',['staffInfo'=>$staffInfo]);
    }
    public function viewEmployeePage(){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
            $users=User::where('role_id','!=',1)->where('role_id','=','2')->get();
            $role=Role::where('id','!=',1)->where('id','=',2)->get();

        return view('Backend.Super.Employee.add-employee',['users'=>$users,'role'=>$role]);
    }
    protected function newEmployee(Request $request)
    {
        if(!Gate::allows('isSuper')){
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
        $users->access = 0;
        $users->save();

        return redirect('/manager-registration-page')->with('message','New Manager Enrolled Successfully!');

    }
    public function editEmployee($id){

        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $userInfo=User::find($id);
        $role=Role::where('id','!=',1)->where('status',1)->get();
        return view('Backend.Super.Employee.edit-employee',compact('userInfo','role'));
    }
    public function UpdateEmployee(Request $request){
        if(!Gate::allows('isSuper')){
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

        return redirect('/manager-registration-page')->with('message','Manager Info Updated!');
    }
    public function inactiveEmployeeInfo($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $roleById = User::find($id);
        $roleById->access = 0;
        $roleById->save();
        return redirect('/manager-registration-page')->with('message', 'Manager Access Deactivated!');
    }
    public function activeEmployeeInfo($id){
        if(!Gate::allows('isSuper')){
            abort('404','you cannot access here');
        }
        $roleById = User::find($id);
        $roleById->access = 1;
        $roleById->save();
        return redirect('/manager-registration-page')->with('message', 'Manager Access Activated!');
    }
}

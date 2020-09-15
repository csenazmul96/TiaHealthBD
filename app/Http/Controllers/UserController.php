<?php

namespace App\Http\Controllers;

use App\User;
use App\Permission;
use App\Transation;
use App\Models\Pharma\Purchase;
use App\Expense;
use App\Models\Pharma\Product;
use App\Models\diagnostic\Bill;
use App\Models\Pharma\Batch;
use App\Models\Pharma\Sale;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\hospital\HmsAdmission;
use App\Models\hospital\HmsEmergency;
use App\Models\doctor\DocAppointment;
use App\Models\hospital\HmsOperation;
use App\Models\doctor\Prescription;
use App\Models\doctor\PreMedicineItem;
use App\Models\doctor\PreMedicine;
use App\Models\diagnostic\BillItem;
use App\Models\laboratory\LabReport;
use App\Doctor;
use App\Patient;
use Pharma;
use Sentinel;
use Session;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('authorized');
    }

    public function dashboard(){
        if(Sentinel::getUser()->inRole('admin')){
            return $this->adminDashboard();
        }elseif(Sentinel::getUser()->inRole('doctor')){
            return $this->doctorDashboard();
        }
    }

    private function adminDashboard(){
        //  dd($userTransaction);
        return view('dashboard.admin-dashboard');
    }

   

    private function doctorDashboard(){
       $doctor = Pharma::getDoctor();
       $NumPres = Prescription::where('doctor_id',$doctor->id)->where('status','Active')->count('invoice');    
       $NumDraftPres = Prescription::where('doctor_id',$doctor->id)->where('status','Draft')->count('invoice');
       $PreMedi = PreMedicine::count('name');  
       $Todayappoin = DocAppointment::where('doctor_id',$doctor->id)->where('status','Paid','Confirmed')->count('invoice');   
       $Prescription = Prescription::take(10)->where('status','Active')->orderBy('invoice','ASC')->get(); 
       $DraftPres = Prescription::take(10)->where('status','Draft')->orderBy('invoice','ASC')->get();   
       $barData = $this->DoctorBarChartData();
    //    dd($barData ) ; 
       return view('dashboard.doctor-dashboard',compact('NumPres','NumDraftPres','PreMedi','Todayappoin','Prescription','DraftPres','barData'));
    }

   


    private function DoctorBarChartData(){
        $startDate =  date('Y-m-d H:i:s');
        $startDate =  date('Y-m-d H:i:s', strtotime($startDate . ' -30 day'));
        $lebels = '';
        $amounts = '';
        for($i=0;$i<30;$i++){
            $nextDay = date('Y-m-d H:i:s', strtotime($startDate . ' +1 day'));
            $totalPrescription = Prescription::where('date',date('Y-m-d',strtotime($nextDay)))->where('status','Active')->count();
            $startDate = $nextDay;
            $amounts .= ', '.$totalPrescription;
            $lebels .= ', "'.date('d M', strtotime($nextDay)).'"';
        }
        $data['BarItems'] = ltrim($lebels,', ');
        $data['Barvalue'] = ltrim($amounts,', ');
        return $data;
    }



    private function adminBarChartData(){
        $startDate =  date('Y-m-d H:i:s');
        $startDate =  date('Y-m-d H:i:s', strtotime($startDate . ' -10 day'));
        $lebels = '';
        $amounts = '';
        for($i=0;$i<10;$i++){
            $nextDay = date('Y-m-d H:i:s', strtotime($startDate . ' +1 day'));
            $saleAmount = Sale::where('date',date('Y-m-d',strtotime($nextDay)))->where('status','Active')->sum('paid_amount');
            $startDate = $nextDay;
            $amounts .= ', '.$saleAmount;
            $lebels .= ', "'.date('d M', strtotime($nextDay)).'"';
            
        }
        $data['BarItems'] = ltrim($lebels,', ');
        $data['Barvalue'] = ltrim($amounts,', ');
        return $data;
    }

    private function adminlineChartData(){
        $payments = Transation::selectRaw('year(date) year, monthname(date) month, sum(amount) amount')
                ->groupBy('year', 'month')
                ->whereDate('date', '>=', date('Y-01-01 00:00:00'))
                ->whereDate('date', '<=', date('Y-12-31 23:59:59'))
                ->where('status', 'Active') 
                ->where('transaction_type', 'Payment')
                ->get();
        $received = Transation::selectRaw('year(date) year, monthname(date) month, sum(amount) amount')
                ->groupBy('year', 'month')
                ->whereDate('date', '>=', date('Y-01-01 00:00:00'))
                ->whereDate('date', '<=', date('Y-12-31 23:59:59'))
                ->where('status', 'Active') 
                ->where('transaction_type', 'Received')
                ->get();

        $pay = $this->lineLevelData($payments);
        $rec = $this->lineLevelData($received);
        $data['label']  = $pay['label'];
        $data['paymentValue']  = $pay['value'];
        $data['receivedValue']  = $rec['value'];
        return $data;
    }

    private function lineLevelData($data){
        $label = '';
        $value = '';

        $array = [
            'Jan-'.date('Y')    => 0,
            'Feb-'.date('Y')    => 0,
            'Mar-'.date('Y')    => 0,
            'Apr-'.date('Y')    => 0,
            'May-'.date('Y')    => 0,
            'Jun-'.date('Y')    => 0,
            'Jul-'.date('Y')    => 0,
            'Aug-'.date('Y')    => 0,
            'Sep-'.date('Y')    => 0,
            'Oct-'.date('Y')    => 0,
            'Nov-'.date('Y')    => 0,
            'Dec-'.date('Y')    => 0,
        ];

        if(!empty($data)){
            foreach($data as $row){
                $index = substr($row->month, 0, 3).'-'.$row->year;
                $array[$index] = $row->amount;
            }
        }
        foreach($array as $key => $val){
            $label .= "'".$key."' , ";
            $value .= $val.',';
        }
        $data['label'] = rtrim($label,' ,');
        $data['value'] = rtrim($value,',');
        return $data;
    }




    public function myProfile()
    {
        $user = Sentinel::getUser();
        return view('users.my_profile', compact('user'));
    }

    public function updateMyProfile(Request $request)
    {
        $this->formValidate($request);
        $user = Sentinel::findById(Sentinel::getUser()->id);
        $profile_banar = $request->old_profile_banar;
        $profile_image = $request->old_profile_image;
        if ($request->hasFile('profile_image')) {
            $profile_image = $request->profile_image->store('public/profileImage/user');
            Storage::delete($request->old_profile_image);
        }
        if ($request->hasFile('profile_banar')) {
            $profile_banar = $request->profile_banar->store('public/profileImage/banar');
            Storage::delete($request->old_profile_banar);
        }
        // dd($profile_banar);
        $credentials = [
            'profile_image' => $profile_image,
            'profile_banar' => $profile_banar,
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'name'          => $request->first_name . ' ' . $request->last_name
        ];
        if (!empty($request->password)) {
            $credentials['password'] = $request->password;
        }
        $user = Sentinel::update($user, $credentials);
        Pharma::sendNotification([1], 'Update own profile', '/users');
        Pharma::activities("Edit", "Users", "Edit a user");
        Session::flash('success', 'Profile updated succeed!');
        return redirect('myprofile');
    }

    public function userCreate()
    {
        if (!Sentinel::hasAccess('user-add')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $roles = DB::table('roles')->get();
        return view('users.user.create', compact('roles'));
    }

    public function userStore(Request $request)
    {
        if (!Sentinel::hasAccess('user-add')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $this->formValidate($request);
        $request->validate(['role' => 'required', 'password' => 'required']);
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name'      => $request->first_name . " " . $request->last_name,
        ];
        $user = Sentinel::registerAndActivate($credentials);
        $role = Sentinel::findRoleBySlug($request->role);
        $role->users()->attach($user->id);
        Session::flash('success', 'User registration Succeed!');
        Pharma::activities("Store", "Users", "Store a user");
        return redirect('users');
    }

    public function index()
    {
        if (!Sentinel::hasAccess('user-index')) {
            Session::flash('warning', 'Permission Denied!');
            return redirect()->back();
        }
        $users = User::orderBy('id', 'ASC')->get();
        return view('users.user.index', compact('users'));
    }

    public function userEdit($id)
    {
        if (!Sentinel::hasAccess('user-edit')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $user = Sentinel::findById($id);
        return view('users.user.edit', compact('user'));
    }

    public function userUpdate($id, Request $request)
    {
        if (!Sentinel::hasAccess('user-update')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $this->formValidate($request);
        $user = Sentinel::findById($id);
        // dd($user);
        $credentials = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name'      => $request->first_name . ' ' . $request->last_name
        ];
        if (!empty($request->password)) {
            $credentials['password'] = $request->password;
        }
        $user = Sentinel::update($user, $credentials);
        Session::flash('success', 'User updated succeed!');
        Pharma::activities("Edit", "Users", "Edit a user");
        return redirect('users');
    }

    public function userDelete($id)
    {
        if (!Sentinel::hasAccess('user-delete')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        if (Sentinel::getUser()->id == $id) {
            Session::flash('success', 'You cannot delete your account!');
            return redirect()->back();
        }
        $user = Sentinel::findById($id);
        $user->delete();
        Session::flash('success', 'User deleted successed!');
        Pharma::activities("Delete", "Users", "Delete a user");
        return redirect('users');
    }

    private function formValidate($request)
    {
        $request->validate([
            'email'         => 'sometimes|nullable|email|unique:users,email',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'password'      => 'sometimes|nullable|min:6',
        ]);
    }

    public function indexRole()
    {
        if (!Sentinel::hasAccess('role-index')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $roles = EloquentRole::all();
        return view('users.role.index', compact('roles'));
    }

    public function createRole()
    {
        if (!Sentinel::hasAccess('role-add')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $data = array();
        $permissions = Permission::where('parent_id', 0)->get();
        return view('users.role.create', compact('permissions'));
    }

    public function storeRole(Request $request)
    {
        if (!Sentinel::hasAccess('role-store')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $role = new EloquentRole();
        $role->name = $request->name;
        $role->slug = Pharma::getUniqueSlug($role, $request->name);
        $role->save();
        if (!empty($request->permission)) {
            foreach ($request->permission as $key) {
                $role->updatePermission($key, true, true)->save();
            }
        }
        Session::flash('success', 'Role added succeed!');
        Pharma::activities("store", "Role", "Store a Role");
        return redirect('users/roles');
    }

    public function editRole($id)
    {
        if (!Sentinel::hasAccess('role-edit')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $data = array();
        $permissions = Permission::where('parent_id', 0)->get();

        $role = EloquentRole::find($id);
        return view('users.role.edit', compact('permissions', 'role'));
    }

    public function updateRole(Request $request, $id)
    {
        if (!Sentinel::hasAccess('role-update')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        $role = EloquentRole::find($id);
        $role->name = $request->name;
        $role->permissions = array();
        $role->save();
        //remove permissions which have not been ticked
        //create and/or update permissions
        if (!empty($request->permission)) {
            foreach ($request->permission as $key) {
                $role->updatePermission($key, true, true)->save();
            }
        }
        Session::flash('success', 'Succeed!');
        Pharma::activities("Update", "Role", "Update a Role");
        return redirect('users/role/' . $id . '/edit');
    }

    public function deleteRole($id)
    {
        if (!Sentinel::hasAccess('role-delete')) {
            Session::flash('error', 'Permission Denied!');
            return redirect()->back();
        }
        if (Pharma::countUserinRole($id) == 0) {
            EloquentRole::destroy($id);
            Session::flash('success', 'Role deleted succeed!');
            return redirect('users/roles');
        } else {
            Session::flash('danger', 'Some user is already assign on this role!');
            return redirect()->back();
        }
    }
}

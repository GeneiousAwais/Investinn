<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Laratrust\Helper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Expertise;
use App\Models\Country;
use App\Models\InvestmentRange;
use App\Models\Sector;
use App\Models\UserType;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::with(['roles','permissions'])->get();
        // dd($data->toArray());
        //dd($data[5]->employee->user_id);
        if ($request->ajax()) {
            $data = User::with(['roles','permissions'])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    // if(isset($row->employee->id)){
                    $actionBtn = '
                        <button type="button" class="btn btn-sm btn-info btn-icon waves-effect waves-light show-modal"  data-target="#profileEmpModal"><i class="mdi mdi-account"></i></button>
                    ';
                    // }else
                    // {
                    //     $actionBtn = '';
                    // }

                    return $actionBtn;
                })
                ->addColumn('roles', function($row){
                    $count = ($row->roles->count());
                    return $count;
                })
                ->addColumn('permissions', function($row){
                    $count = ($row->permissions->count());
                    return $count;
                })
                ->rawColumns(['action', 'roles', 'permissions'])
                ->make(true);
        }
        return view('employees.index');
    }
    // roles permissions assignments
    public function userRolesPermissionList(Request $request){

        $modelsKeys = array_keys(Config::get('laratrust.user_models'));
        $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
        //dd(User::with(['roles','permissions'])->get()->toArray());
        if ($request->ajax()) {
            $data = User::with(['roles','permissions'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '
                        <a class="btn btn-sm btn-success btn-icon waves-effect waves-light" href="'.route("edit-with-role-permissions", ['id' => $row->id]).'"><i class="mdi mdi-lead-pencil"></i></a>
                    ';

                    return $actionBtn;
                })
                ->addColumn('roles', function($row){
                    $count = ($row->roles->count());
                    return $count;
                })
                ->addColumn('permissions', function($row){
                    $count = ($row->permissions->count());
                    return $count;
                })
                ->rawColumns(['action', 'roles', 'permissions'])
                ->make(true);
        }

        return view('role_permissions_assignment.index',[
            'models' => $modelsKeys,
            'modelKey' => $modelKey,
        ]);
    }

    public function editUserRolesPermissions(Request $request, $id){
            if(\Auth::user()->hasRole('admin')){
            $user = User::query()
                ->with(['roles:id,name', 'permissions:id,name'])
                ->findOrFail($id);
            $roles = Role::orderBy('name')->get(['id', 'name', 'display_name' ,'description'])
                ->map(function ($role) use ($user) {
                    $role->assigned = $user->roles
                    ->pluck('id')
                        ->contains($role->id);
                    $role->isRemovable = Helper::roleIsRemovable($role);

                    return $role;
                });
            $permissions = Permission::orderBy('name')
            ->get(['id', 'name', 'display_name' ,'description'])
            ->map(function ($permission) use ($user) {
                $permission->assigned = $user->permissions
                    ->pluck('id')
                    ->contains($permission->id);

                return $permission;
            });



            $data['roles'] = $roles;
            $data['permissions'] = $permissions;
            $data['user'] = $user;

            return view('role_permissions_assignment.edit', $data);
        }
    }


    public function updateUserRolesPermissions(Request $request, $id)
    {
        $modelKey = 'users';
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;

        if (!$userModel) {
        //'Model was not specified in the request';
        //return redirect()->back()->with('error','Unfortunately not able to update the role assignment');
        }

        $user = $userModel::findOrFail($id);
        $user->syncRoles($request->get('roles') ?? []);
        $user->syncPermissions($request->get('permissions') ?? []);

        return redirect()->back()->with('success', 'Your details for the user have been successfully updated!');;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $loged_user = \Auth::user()->id;
        $requestFrom = $request->form_info;

        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'user_type_id' => 'required',
            'user_name' => 'required | unique:users',
            'password' => 'required | min:8',
        ]);

        $input = $request->all();

        if($request->is_active == 1){
            $input['email_verified_at'] = date("Y-m-d h:m:s");
            $input['is_approved'] = 1;
            $input['approved_by'] = $loged_user;
        }

        if($request->is_active == 0){
            $input['email_verified_at'] = NULL;
            $input['is_approved'] = 0;
            $input['approved_by'] = NULL;
        }

        if($request->password){
            $input['password'] = bcrypt($request->password);
        }

        if ($request->base64data) {
            $path = public_path() . '/files/user_profiles/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $image_parts = explode(";base64,", $request->base64data);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $imageFullPath = $path.$imageName;
            file_put_contents($imageFullPath, $image_base64);
            $input['profile_picture'] = $imageName;
        }
        
        if($request->has('user_type_id')){
            $input['user_type_id'] = $request->user_type_id;    
        } else{
            $input['user_type_id'] = 4;    
        }

        $user = User::create($input);

        if($user){
            $user = User::findOrFail($user->id);

            if($requestFrom == 'entrepreneurs'){
                return redirect(route('entrepreneurs.edit', $user->id). '?tab=company')->with('success', 'Entrepreneur successfully Created.');       
            }
            else if($requestFrom == 'staff'){
                return redirect(route('staff.index'))->with('success', 'Staff successfully Created.');       
            }
            else if($requestFrom == 'volunteer'){
                // return redirect(route('volunteer.index'))->with('success', 'Volunteer successfully Created.');
                return redirect(route('volunteers.edit', $user->id ) . '?tab=otherdetails')->with('success', 'Volunteer successfully Created.');       
            }
            else{
                return redirect(route('shareholders.edit', $user->id ) . '?tab=otherdetails')->with('success', 'Investor successfully Created.');       
            }
                 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userTypes = UserType::get();
        $user_info = User::where('id', $id)->first();
        
        $data = [
            'personaldetails' => 'active',
            'userTypes'=> $userTypes,
            'user_info' => $user_info,
        ];


        return view('employees.profile', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users,email,'. $user->id,
            'user_name' => 'required | unique:users,user_name,'. $user->id
        ]);
        
        $loged_user = \Auth::user()->id;
        $input = $request->all();

        if($request->is_active == 1){
            $input['email_verified_at'] = date("Y-m-d h:m:s");
            $input['is_approved'] = 1;
            $input['approved_by'] = $loged_user;
        }

        if($request->is_active == 0){
            $input['email_verified_at'] = NULL;
            $input['is_approved'] = 0;
            $input['approved_by'] = NULL;
        }

        if($request->password){
            $input['password'] = bcrypt($request->password);
        }

        if($request->profile_picture == NULL){
            unset($input['profile_picture']);
        }

        if ($request->base64data) {
            $path = public_path() . '/files/user_profiles/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $image_parts = explode(";base64,", $request->base64data);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $imageFullPath = $path.$imageName;
            file_put_contents($imageFullPath, $image_base64);
            $input['profile_picture'] = $imageName;
        }



        $user->update($input);
        

        if($request->form_info == 'profile'){
            return redirect(route('users.edit', $user->id) . '?tab=personaldetails_edit')->with('success', 'User personal detail has been saved successfully.');

        }
        else if($request->form_info == 'staff'){

            return redirect(route('staff.index'))->with('success', 'Staff successfully updated.');     
           
        }

        else if($request->form_info == 'changePassword'){

            if($user->id ==  $loged_user){
               \Session::flush();
               \Auth::logout();
               return redirect('login');
           }
           else{
             return redirect(route('shareholders.index'))->with('success', 'Investor password has been created successfully.');

           }
           
        }

        else if($request->form_info == 'changePasswordVolunteer'){

            if($user->id ==  $loged_user){
               \Session::flush();
               \Auth::logout();
               return redirect('login');
           }
           else{
             return redirect(route('volunteer.index'))->with('success', 'Volunteer password has been created successfully.');

           }
           
        }

        
        else if($request->form_info == 'changePasswordEnt'){

            if($user->id ==  $loged_user){
               \Session::flush();
               \Auth::logout();
               return redirect('login');
           }
           else{
              return redirect(route('entrepreneurs.index'))->with('success', 'Entrepreneur password successfully Created.');  
           }
           
        }
        else if($request->form_info == 'changePasswordStaff'){

            if($user->id ==  $loged_user){
               \Session::flush();
               \Auth::logout();
               return redirect('login');
           }
           else{
             return redirect(route('staff.index'))->with('success', 'Staff password has been created successfully.');

           }
           
        }

        else if($request->form_info == 'entrepreneurs'){
            // return redirect(route('entrepreneurs.index'))->with('success', 'Entrepreneur successfully Created.');

            return redirect(route('entrepreneurs.edit', $user->id). '?tab=company')->with('success', 'Entrepreneur successfully Created.');     
        }
        else if($request->form_info == 'volunteer'){
                // return redirect(route('volunteer.index'))->with('success', 'Volunteer successfully Created.');
            return redirect(route('volunteers.edit', $user->id ) . '?tab=otherdetails')->with('success', 'Volunteer successfully Created.');       
        }
        else{
            return redirect(route('shareholders.edit', $user->id) . '?tab=otherdetails')->with('success', 'User personal detail has been saved successfully.');
        }
        
    }

    public function uploadCropImage(Request $request)
    {
        $data = $request->all();
        $folderPath = public_path() . '/files/user_profiles/';
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath.$imageName;
        file_put_contents($imageFullPath, $image_base64);
         $exist_record = User::where('id',$request->id)->first();
         $data['profile_picture'] = $imageName;

         if($exist_record){
            $exist_record->update($data);
        }
        else{
            User::create($data);
        }
        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }

    public function restoreArchiveUser($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect(route('shareholders.index'))->with('success', 'Archive user successfully restored.');
    }

    public function restoreArchiveStaff($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect(route('staff.index'))->with('success', 'Archive user successfully restored.');
    }

    public function archivedstaff(Request $request)
    {
        if ($request->ajax()) {

             $data = User::onlyTrashed()->where('user_type_id',4)->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('staff.restore',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('staff.archived_staff');
    }

    public function archivedVolunteer(Request $request)
    {
        if ($request->ajax()) {

            $data = User::onlyTrashed()->where('user_type_id',5)->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('volunteers.restore',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('volunteers.archived_volunteer');
    }

    public function restoreArchiveVolunteer($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect(route('volunteers.index'))->with('success', 'Volunteer user successfully restored.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy(User $user)
    {
        try {
            return $user->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}

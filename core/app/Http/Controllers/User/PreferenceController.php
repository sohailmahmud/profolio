<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UserPermissionHelper;
use App\Models\User\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        $permissions= null;
        $user_permissions= UserPermission::where('user_id',Auth::id())->first();
        if(!is_null($user_permissions)){
            $permissions = json_decode($user_permissions->permissions,true);
        }
        $data['permissions'] = $permissions;
        return view('user.preference.manage',$data);
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $permissions = json_encode($request->permissions);
        $user_permissions= UserPermission::where('user_id',Auth::id())->first();
        $package = UserPermissionHelper::userPackage(Auth::id());
        if(!is_null($user_permissions)){
            $user_permissions->permissions = $permissions;
            $user_permissions->package_id = $package->package_id;
            $user_permissions->user_id = Auth::id();
            $user_permissions->save();
        }else{
            $permission = new UserPermission();
            $permission->permissions = $permissions;
            $permission->package_id = $package->package_id;
            $permission->user_id = Auth::id();
            $permission->save();
        }
        Session::flash('success', "Preference updated successfully");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

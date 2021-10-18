<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(
            'permission:permission-list|permission-create|permission-edit|permission-delete',
            ['only'=>['index', 'store']]
        );
        $this->middleware('permission:permission-create',['only'=>['create','store']]);

        $this->middleware('permission:permission-edit',['only'=>['edit','update']]);

        $this->middleware('permission:permission-delete',['only'=>['delete','destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('id','desc')->paginate(5);

        return view('permissions.index', compact(['permissions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();

        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate([
            'name'=>'required|unique:permissions,name',
        ]);

        $permission = Permission::create(['name'=>$request->input('name')]);

        $permission->syncPermissions($request->input('permission'));

        return  redirect()->route('permissions.index')->with('success','permission created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request,['name'=>'required']);

        $permission->name = $request->input('name');
        $permission->save();
        $permission->syncPermissions($request->input('permission'));

        return redirect()->route('permissions.index')->with('success','Permission Updated Successfully');
    }

    public function delete(Permission $permission)
    {
        //TODO: Exercise add a delete confirmation page
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission '. $permission->name . ' is Successfully deleted');
    }
}

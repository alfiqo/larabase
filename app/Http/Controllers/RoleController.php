<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $perPage;

    public function __construct()
    {
        $this->middleware(['permission:create roles|edit roles|delete roles']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->perPage = (int) config('custom.perPage');

        $roles = Role::latest()->paginate($this->perPage);
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Role::create([
            'name' => strtolower($request->name)
        ]);

        return redirect()->route('roles.index')->with([
            'status' => 'Role telah berhasil disimpan',
            'alert' => 'success'
        ]);
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
    public function edit(Role $role)
    {
        return view('role.create', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect()->route('roles.index')->with([
            'status' => 'Role telah berhasil diubah',
            'alert' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with([
            'status' => 'Role telah berhasil dihapus',
            'alert' => 'danger'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setting(Role $role)
    {
        $permissions = Permission::whereNotIn('id',  $role->permissions->pluck('id'))->get();

        return view('role.setting', ['role' => $role, 'permissions' => $permissions]);
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission->name);

        return redirect()->route('roles.setting', $role)->with([
            'status' => 'Permission telah berhasil dihapus',
            'alert' => 'danger'
        ]);
    }

    public function givePermission(Role $role, Request $request)
    {
        $role->givePermissionTo($request->permission);

        return redirect()->route('roles.setting', $role)->with([
            'status' => 'Permission telah berhasil diberikan',
            'alert' => 'success'
        ]);
    }
}

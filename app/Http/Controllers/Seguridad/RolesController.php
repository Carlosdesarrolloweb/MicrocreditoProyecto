<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(){
        $roles = Role::select('id','name')->with('permissions')->orderByDesc('id')->get();
        return view('Seguridad/Roles',compact('roles'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        $role = Role::create(['name' => $request->name]);

        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, Role $rol)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $rol->id,
        ]);

        $rol->name = $request->name;
        $rol->save();

        $permissions = $request->input('permissions', []);
        $rol->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $rol)
    {
        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}

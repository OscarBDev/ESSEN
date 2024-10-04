<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{

    // public static function middleware(): array
    // {
    //     return [
    //         'permission:ver-rol|crear-rol|editar-rol|borrar-rol' => ['only' => ['index']],
    //         'permission:crear-rol' => ['only' => ['create', 'store']],
    //         'permission:editar-rol' => ['only' => ['edit', 'update']],
    //         'permission:borrar-rol' => ['only' => ['destroy']],
    //     ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ocupamos paginacion
        $roles = Role::paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.crear', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required|array',
        ]);

        $role = Role::create([
            'name' => $request->input('name')
        ]);

        $permissions = Permission::whereIn('id', $request->input('permission'))->get();

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //para editar el rol
        $role = Role::findOrFail($id);
        $permissions = Permission::get();

        // Obtener permisos asignados al rol de forma más eficiente
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.editar', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //hacemos la actualizacion
        $request->validate([
            'name' => 'required',
            'permission' => 'required|array',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->input('name')]);

        $permissions = Permission::whereIn('id', $request->input('permission'))->get();

        $role->syncPermissions($permissions);
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //DB::table('roles')->where('id', $id)->delete();
        Role::findOrFail($id)->delete();
        return redirect()->route('roles.index');
    }
}

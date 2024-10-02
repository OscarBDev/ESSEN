<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
{
    public static function middleware(): array
    {
        return [
            'permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario' => ['only' => ['index']],
            'permission:crear-usuario' => ['only' => ['create', 'store']],
            'permission:editar-usuario' => ['only' => ['edit', 'update']],
            'permission:borrar-usuario' => ['only' => ['destroy']],
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('usuarios.crear', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //procesamiento para alamacenar 
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required|array'
        ]);
        $input = $request->all(); //verificamos todas alas validaciones

        // Hasheamos la contraseña antes de almacenarla
        $input['password'] = Hash::make($input['password']);

        // Asignamos el rol seleccionado al usuario
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        //mandamos a la vista(plantilla)
        return redirect()->route('usuarios.index');
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
        $user = User::with('roles')->findOrFail($id); //el id para capturar los datos de cierto registro
        $roles = Role::pluck('name', 'name')->all(); //y obtnemos todos los datos
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',  //se quita el requerid de password para hacer que la por que ppodemos ser un usuario admin modificamndo a otro usuario
            'roles' => 'required|array'
        ]);

        $input = $request->all(); //validamos todos los datos 
        //aca en el if estamos dejando a un lado la password por lo menscionado 

        if (!empty($input['password'])) {
            $input['password'] =  Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        // Eliminamos roles anteriores y asignamos el nuevo rol
        DB::table('model_has_roles')->where('model_id', $id)->delete(); //hacemos referencia a la tabla de model_id

        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
//controladores
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\EmpleadosController;
use App\Models\Persona;
use App\Models\Empleado;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    // public static function middleware(): array
    // {
    //     return [
    //         'permission:ver-usuario|crear-usuario|editar-usuario|borrar-usuario' => ['only' => ['index']],
    //         'permission:crear-usuario' => ['only' => ['create', 'store']],
    //         'permission:editar-usuario' => ['only' => ['edit', 'update']],
    //         'permission:borrar-usuario' => ['only' => ['destroy']],
    //     ];
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::with('empleados.personas')->paginate(10);
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

        //logica: creamos el registro de usuarios y despues el de personas para poder juntar las id en la tabla empleados
        $request->validate([
            //'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required|array',
            //Validaciones para la tabla personas
            'ci' => 'required|numeric|unique:personas,ci',
            'nombre' => 'required|string',
            'apellido_paterno' => 'required|string',
            'apellido_materno' => 'required|string',
            'telefono_1' => 'nullable|numeric',
            'telefono_2' => 'nullable|numeric',
        ]);

        //iniciamos la transacción
        DB::transaction(function () use ($request) {
            //Usuaurio
            $input = $request->all();  //verificamos todas alas validaciones de usuario
            $input['password'] = Hash::make($input['password']);  // Hasheamos la contraseña antes de almacenarla

            $user = User::create($input);   //creamos el usuario
            $user->assignRole($request->input('roles'));   // Asignamos el rol seleccionado al usuario

            //creamos la persona 
            $persona = Persona::create([
                'ci' => $request->ci,
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'telefono_1' => $request->telefono_1,
                'telefono_2' => $request->telefono_2
            ]);

            //creamos el empleado 
            Empleado::create([
                'id' => $user->id,  //ID del usuario
                'id_persona' => $persona->id_persona, //ID de la persona 
            ]);
        });

        //redirigimos a la vista(plantilla)
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
        //cargamos el usuario con sus roles
        $user = User::with('roles')->findOrFail($id); //el id para capturar los datos de cierto registro

        // Obtener todos los roles
        $roles = Role::pluck('name', 'name')->all();

        // Obtener los roles asiganados al usuario
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::transaction(function () use ($request, $id) {
            //cargamos usuario con su empleado y persona
            $user = User::with('empleados.personas')->find($id);

            //validaciones
            $request->validate([
                //'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'same:confirm-password',  //se quita el requerid de password para hacer que la por que ppodemos ser un usuario admin modificamndo a otro usuario
                'roles' => 'required|array',
                //Validaciones para la tabla personas
                'ci' => ['required', 'numeric', Rule::unique('personas')->ignore($user->empleados->personas->id_persona, 'id_persona')],
                'nombre' => 'required|string',
                'apellido_paterno' => 'required|string',
                'apellido_materno' => 'required|string',
                'telefono_1' => 'nullable|numeric',
                'telefono_2' => 'nullable|numeric',
            ]);

            // ACTUALIZAMOS EL USUARIO
            $input = $request->all(); //validamos todos los datos 
            //aca en el if estamos dejando a un lado la password por lo menscionado 
            if (!empty($input['password'])) {
                $input['password'] =  Hash::make($input['password']);
            } else {
                $input = Arr::except($input, array('password'));
            }

            //$user = User::find($id);
            //actualizamos el usuario
            $user->update($input);

            // Eliminamos roles anteriores y asignamos el nuevo rol
            DB::table('model_has_roles')->where('model_id', $id)->delete(); //hacemos referencia a la tabla de model_id
            $user->assignRole($request->input('roles'));

            // ACTUALIZAMOS LA PERSONA
            $persona = $user->empleados->personas; // Obtener persona relacionada usando el ID proporcionado
            $persona->update([
                'ci' => $request->ci,
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'telefono_1' => $request->telefono_1,
                'telefono_2' => $request->telefono_2
            ]);
        });
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //eliminacion de usuarios, empleados y personas asociados
        DB::transaction(function () use ($id) {
            //encontramos el usuario por su id 
            $user = User::with('empleados.personas')->find($id);

            //verifiamos si el usuario existe 
            if ($user) {
                //verificamos si el usuario tiene enpleados asociados 
                if ($user->empleados) {
                    //eliminamos el emplaedo
                    $user->empleados->delete();

                    //luego eliminamos la persona asociada al enpleado
                    if ($user->empleados->personas) {
                        $user->empleados->personas->delete();
                    }
                }
                // Finalmente eliminamos el usuario
                $user->delete();
            }
        });
        //redireccionamos al inicio 
        return redirect()->route('usuarios.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        $empresa_id = Auth::user()->empresa_id;
        $usuarios = User::where('empresa_id',$empresa_id)->get();
        /* $usuarios = User::all(); */
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* $datos = request()->all();
        return response()->json($datos); */

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',
        ]);

        $usuarios = new User();

        $usuarios->name = $request->name;
        $usuarios->email = $request->email;
        $usuarios->password = Hash::make($request->password);
        $usuarios->empresa_id = Auth::user()->empresa_id;

        $usuarios->save();

        $usuarios->assignRole($request->role);


        return redirect()->route('admin.usuarios.index')
        ->with('mensaje','se registro al usuario de la manera correcta')
        ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /* $datos = request()->all();
        return response()->json($datos); */

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id,
            'password'=>'confirmed',
        ]);

        $usuarios = User::find($id);

        $usuarios->name = $request->name;
        $usuarios->email = $request->email;
        if ($request->filled('password')) {
            $usuarios->password = Hash::make($request->password);
        }
        $usuarios->empresa_id = Auth::user()->empresa_id;

        $usuarios->save();

        $usuarios->syncRoles($request->role);


        return redirect()->route('admin.usuarios.index')
        ->with('mensaje','se modifico al usuario de la manera correcta')
        ->with('icono', 'success');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.usuarios.index')
        ->with('mensaje','se elimino el usuario de la manera correcta')
        ->with('icono', 'success');
    }

    public function reporte(){
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $usuarios = User::all();
        $pdf = PDF::loadView('admin.usuarios.reportes', compact('usuarios','empresa'));
        return $pdf->stream();
    }
}

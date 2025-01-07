<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* $datos = request()->all();
        return response()->json($datos); */

        $request->validate([
            'name'=>'required|unique:roles',
        ]);

        $rol = new Role();

        $rol->name = $request->name;
        $rol->guard_name = 'web';

        $rol->save();

        return redirect()->route('admin.roles.index')
        ->with('mensaje','se registro el rol de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::find($id);
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /* $datos = request()->all();
        return response()->json($datos); */

        $request->validate([
            'name'=>'required|unique:roles,name,'.$id,
        ]);

        $rol = Role::find($id);

        $rol->name = $request->name;
        $rol->guard_name = 'web';

        $rol->save();

        return redirect()->route('admin.roles.index')
        ->with('mensaje','se actualizo el rol de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('admin.roles.index')
        ->with('mensaje','se elimino el rol de la manera correcta')
        ->with('icono', 'success');
    }

    public function reporte(){
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $roles = Role::all();
        $pdf = PDF::loadView('admin.roles.reportes', compact('roles','empresa'));
        return $pdf->stream();
    }

    public function asignar($id){
        $rol = Role::find($id);
        $permisos = Permission::all()->groupBy(function ($permiso){
            if (stripos($permiso->name, 'config') !== false) {
                return 'Configuracion';
            }else if (stripos($permiso->name, 'rol') !== false) {
                return 'Roles';
            }else if (stripos($permiso->name, 'permi') !== false) {
                return 'Permisos';
            }else if (stripos($permiso->name, 'usu') !== false) {
                return 'Usuarios';
            }else if (stripos($permiso->name, 'cat') !== false) {
                return 'Categorias';
            }else if (stripos($permiso->name, 'prod') !== false) {
                return 'Productos';
            }else if (stripos($permiso->name, 'prov') !== false) {
                return 'Proveedores';
            }else if (stripos($permiso->name, 'comp') !== false) {
                return 'Compras';
            }else if (stripos($permiso->name, 'ven') !== false) {
                return 'Ventas';
            }else if (stripos($permiso->name, 'arq') !== false) {
                return 'Arqueo';
            }else if (stripos($permiso->name, 'cli') !== false) {
                return 'Clientes';
            }
        });
        return view('admin.roles.asignar' , compact('rol', 'permisos'));
    }

    public function update_asignar(Request $request, $id){
        $rol = Role::find($id);
        $rol->permissions()->sync($request->permisos);
        return redirect()->route('admin.roles.index')
        ->with('mensaje','se actualizo los permisos al rol de la manera correcta')
        ->with('icono', 'success');
    }
}

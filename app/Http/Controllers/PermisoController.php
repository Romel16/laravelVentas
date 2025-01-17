<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    public function __construct()
    {
        //Si el usuario esta autenticado, obtener la empresa y compartirla en la vista
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                //Obtener la empresa segun el id de la empresa del usuario autenticas
                $empresa = Empresa::find(Auth::user()->empresa_id)->first();
                //compartir la variable 'empresa' con todas las vistas
                view()->share('empresa', $empresa);
            }
            return $next($request);
        });
    }
    public function index()
    {
        $permisos = Permission::all();
        return view('admin.permisos.index', compact('permisos'));
    }

    public function create()
    {
        return view('admin.permisos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);
        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'se registro el permiso de la manera correcta')
            ->with('icono', 'success');
    }
    public function show($id)
    {
        $permiso = Permission::find($id);
        return view('admin.permisos.show', compact('permiso'));
    }
    public function edit($id)
    {
        $permiso = Permission::find($id);
        return view('admin.permisos.edit', compact('permiso'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permiso = Permission::find($id);
        $permiso->update(['name' => $request->name]);

        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'se actualizo el permiso de la manera correcta')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return redirect()->route('admin.permisos.index')
            ->with('mensaje', 'se elimino el permiso de la manera correcta')
            ->with('icono', 'success');
    }
}

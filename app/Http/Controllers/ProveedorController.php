<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        return view('admin.proveedor.index', compact('proveedores', 'empresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedor.create', compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* $datos = request()->all();
        return response()->json($datos); */


        $request->validate([
            'empresa'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'nombre'=>'required',
            'celular'=>'required',
        ]);

        $proveedores = new Proveedor();

        $proveedores->empresa = $request->empresa;
        $proveedores->direccion = $request->direccion;
        $proveedores->telefono = $request->telefono;
        $proveedores->email = $request->email;
        $proveedores->nombre = $request->nombre;
        $proveedores->celular = $request->celular;
        $proveedores->empresa_id = Auth::user()->empresa_id;

        $proveedores->save();


        return redirect()->route('admin.proveedor.index')
        ->with('mensaje','se registro al proveedor de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedor.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view('admin.proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'empresa'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'nombre'=>'required',
            'celular'=>'required',
        ]);

        $proveedores = Proveedor::find($id);

        $proveedores->empresa = $request->empresa;
        $proveedores->direccion = $request->direccion;
        $proveedores->telefono = $request->telefono;
        $proveedores->email = $request->email;
        $proveedores->nombre = $request->nombre;
        $proveedores->celular = $request->celular;
        $proveedores->empresa_id = Auth::user()->empresa_id;

        $proveedores->save();


        return redirect()->route('admin.proveedor.index')
        ->with('mensaje','se modifico al proveedor de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        Proveedor::destroy($id);
        return redirect()->route('admin.proveedor.index')
        ->with('mensaje','se elimino el proveedor de la manera correcta')
        ->with('icono', 'success');
    }
}

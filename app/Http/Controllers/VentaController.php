<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\TmpVenta;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('detallesVenta','cliente');
        return view('admin.ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->get();



        $session_id = session()->getId();
        $tmp_ventas = TmpVenta::where('session_id',$session_id)->get();
        return view('admin.ventas.create', compact('productos','clientes', 'tmp_ventas'));
    }


    public function cliente_stores(Request $request){

        $validate = $request->validate([
            'nombre_cliente'=>'required',
            'nit_codigo'=>'required',
            'telefono'=>'required',
            'email'=>'required',
        ]);

        $clientes = new Cliente();
        $clientes->nombre_cliente = $request->nombre_cliente;
        $clientes->nit_codigo = $request->nit_codigo;
        $clientes->telefono = $request->telefono;
        $clientes->email = $request->email;
        $clientes->empresa_id = Auth::user()->empresa_id;
        $clientes->save();

        return response()->json(['success' => 'Cliente registrado']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\TmpVenta;
use App\Models\Venta;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('detallesVenta','cliente')->get();
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
        /* $datos = request()->all();
        return response()->json($datos); */

        $request->validate([
            'fecha'=>'required',
            'precio_total'=>'required',
        ]);

        $session_id = session()->getId();

        $venta = new Venta();

        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->precio_total;
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->cliente_id = $request->id_clientes ?? null;
        $venta->save();


        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();
        foreach ($tmp_ventas as $tmp_venta) {
            $producto = Producto::where('id',$tmp_venta->producto_id)->first();

            $detalle_venta = new DetalleVenta();
            $detalle_venta->cantidad = $tmp_venta->cantidad;
            $detalle_venta->venta_id = $venta->id;
            $detalle_venta->producto_id = $tmp_venta->producto_id;
            $detalle_venta->save();

            $producto->stock -= $detalle_venta->cantidad;
            $producto->save();
        }

        TmpVenta::where('session_id',$session_id)->delete();

        return redirect()->route('admin.ventas.index')
        ->with('mensaje','se registro la venta de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::with('cliente', 'detallesVenta')->findOrFail($id);
        return view('admin.ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productos = Producto::all();
        $clientes = Cliente::all();
        $venta = Venta::with('cliente', 'detallesVenta')->findOrFail($id);
        return view('admin.ventas.edit', compact('venta', 'productos','clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /* $datos = request()->all();
        return response()->json($datos); */

        $request->validate([
            'fecha'=>'required',
            'precio_total'=>'required',
        ]);

        $venta = Venta::find($id);

        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->precio_total;
        $venta->cliente_id = $request->id_clientes;
        $venta->empresa_id = Auth::user()->empresa_id;

        foreach ($venta->detallesVenta as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        $venta->save();

        return redirect()->route('admin.ventas.index')
        ->with('mensaje','se actualizó la venta de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::find($id);

        // Resta la cantidad del stock que se desea eliminar
        foreach ($venta->detallesVenta as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        $venta->detallesVenta()->delete();
        Venta::destroy($id);
        return redirect()->route('admin.ventas.index')
        ->with('mensaje','se elimino la venta de la manera correcta')
        ->with('icono', 'success');
    }
}

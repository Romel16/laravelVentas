<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TmpCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('detalles')->get();
        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();



        $session_id = session()->getId();
        $tmp_compras = TmpCompra::where('session_id',$session_id)->get();

        return view('admin.compras.create', compact('productos','proveedores','tmp_compras'));
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
            'comprobante'=>'required',
            'precio_total'=>'required',
        ]);

        $session_id = session()->getId();

        $compra = new Compra();

        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->empresa_id = Auth::user()->empresa_id;

        $compra->save();


        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();
        foreach ($tmp_compras as $tmp_compra) {
            $producto = Producto::where('id',$tmp_compra->producto_id)->first();

            $detalle_compra = new DetalleCompra();
            $detalle_compra->cantidad = $tmp_compra->cantidad;
            $detalle_compra->precio_compra = $producto->precio_compra;
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $producto->id;
            $detalle_compra->proveedor_id = $request->id_proveedor;
            $detalle_compra->save();

            $producto->stock += $tmp_compra->cantidad;
            $producto->save();
        }

        TmpCompra::where('session_id',$session_id)->delete();

        return redirect()->route('admin.compras.index')
        ->with('mensaje','se registro la compra de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::with('detalles','proveedor')->findOrFail($id);
        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);

        $proveedores = Proveedor::all();

        $productos = Producto::all();

        return view('admin.compras.edit',compact('compra', 'proveedores', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }
}

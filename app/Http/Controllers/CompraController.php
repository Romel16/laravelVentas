<?php

namespace App\Http\Controllers;

use App\Models\Arqueo;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Empresa;
use App\Models\MovimientoCaja;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TmpCompra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $arqueoAbierto = Arqueo::whereNull('fecha_cierre')
            ->where('empresa_id', Auth::user()->empresa_id)
            ->first();
        $compras = Compra::with('detalles','proveedor')->get();
        return view('admin.compras.index', compact('compras','arqueoAbierto'));
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
        $compra->proveedor_id = $request->id_proveedor;
        $compra->empresa_id = Auth::user()->empresa_id;
        $compra->save();

        //REGISTRO EN EL ARQUEO
        $arqueo_id = Arqueo::whereNull('fecha_cierre')->where('empresa_id', Auth::user()->empresa_id)->first();
        /* dd($arqueo_id);  */// Muestra el resultado de la consulta
        $movimiento = new MovimientoCaja();
        $movimiento->tipo = "EGRESO";
        $movimiento->monto = $request->precio_total;
        $movimiento->descripcion = "compra de productos";
        $movimiento->arqueo_id = $arqueo_id->id;
        $movimiento->save();
        //REGISTRO EN EL ARQUEO


        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();
        foreach ($tmp_compras as $tmp_compra) {
            $producto = Producto::where('id',$tmp_compra->producto_id)->first();

            $detalle_compra = new DetalleCompra();
            $detalle_compra->cantidad = $tmp_compra->cantidad;
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $producto->id;
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

        $proveedores = Proveedor::where('empresa_id', Auth::user()->empresa_id)->get();

        $productos = Producto::where('empresa_id', Auth::user()->empresa_id)->get();

        return view('admin.compras.edit',compact('compra', 'proveedores', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        /* $datos = request()->all();
        return response()->json($datos);  */

       /*  $request->validate([
            'fecha'=>'required',
            'comprobante'=>'required',
            'precio_total'=>'required',
        ]);

        $compra = Compra::find($id);

        $compra->fecha = $request->fecha;
        $compra->comprobante = $request->comprobante;
        $compra->precio_total = $request->precio_total;
        $compra->proveedor_id = $request->id_proveedor;
        $compra->empresa_id = Auth::user()->empresa_id;

        foreach ($compra->detalles as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        $compra->save();

        return redirect()->route('admin.compras.index')
        ->with('mensaje','se actualizó la compra de la manera correcta')
        ->with('icono', 'success'); */


            // Validación de los campos
        $request->validate([
            'fecha' => 'required',
            'comprobante' => 'required',
            'precio_total' => 'required',
        ]);

        // Buscar la compra
        $compra = Compra::find($id);

        if (!$compra) {
            return redirect()->route('admin.compras.index')
                ->with('mensaje', 'Compra no encontrada')
                ->with('icono', 'error');
        }

        // Iniciar transacción
        DB::beginTransaction();
        try {
            // Actualizar la compra
            $compra->fecha = $request->fecha;
            $compra->comprobante = $request->comprobante;
            $compra->precio_total = $request->precio_total;
            $compra->proveedor_id = $request->id_proveedor;
            $compra->empresa_id = Auth::user()->empresa_id;

            // Actualizar los productos relacionados
            foreach ($compra->detalles as $detalle) {
                $producto = Producto::find($detalle->producto_id);

                if ($producto) {
                    $producto->stock += $detalle->cantidad;

                    // Verificar que el stock no sea negativo
                    if ($producto->stock < 0) {
                        throw new \Exception('El stock no puede ser negativo para el producto ID: ' . $producto->id);
                    }

                    $producto->save();
                }
            }

            // Guardar la compra actualizada
            $compra->save();

            // Confirmar la transacción
            DB::commit();

            return redirect()->route('admin.compras.index')
                ->with('mensaje', 'Se actualizó la compra de manera correcta')
                ->with('icono', 'success');

        } catch (\Exception $e) {
            // Revertir cambios si hay algún error
            DB::rollBack();
            return redirect()->route('admin.compras.index')
                ->with('mensaje', 'Error al actualizar la compra: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compra = Compra::find($id);

        // Resta la cantidad del stock que se desea eliminar
        foreach ($compra->detalles as $detalle) {
            $producto = Producto::find($detalle->producto_id);
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        $compra->detalles()->delete();
        Compra::destroy($id);
        return redirect()->route('admin.compras.index')
        ->with('mensaje','se elimino la compra de la manera correcta')
        ->with('icono', 'success');
    }

    public function reporte(){
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $compras = Compra::where('empresa_id', Auth::user()->empresa_id)->get();
        $pdf = PDF::loadView('admin.compras.reportes', compact('compras','empresa'));
        return $pdf->stream();
    }
}

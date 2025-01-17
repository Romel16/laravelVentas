<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
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

        $productos = Producto::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* $datos = request()->all();
        return response()->json($datos); */


        $request->validate([
            'codigo'=>'required|unique:productos,codigo',
            'nombre'=>'required',
            'stock'=>'required',
            'stock_minimo'=>'required',
            'stock_maximo'=>'required',
            'precio_compra'=>'required',
            'precio_venta'=>'required',
            'fecha_ingreso'=>'required',
        ]);

        $producto= new Producto();

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->empresa_id = Auth::user()->empresa_id;

        if ($request->hasFile('imagen')) {
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();


        return redirect()->route('admin.productos.index')
        ->with('mensaje','se registro el producto de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto','categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo'=>'required|unique:productos,codigo,'.$id,
            'nombre'=>'required',
            'stock'=>'required',
            'stock_minimo'=>'required',
            'stock_maximo'=>'required',
            'precio_compra'=>'required',
            'precio_venta'=>'required',
            'fecha_ingreso'=>'required',
        ]);

        $producto = Producto::find($id);

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->stock = $request->stock;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->empresa_id = Auth::user()->empresa_id;

        if ($request->hasFile('imagen')) {
            Storage::delete('public/'.$producto->imagen);
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();


        return redirect()->route('admin.productos.index')
        ->with('mensaje','se actualizó el producto de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect()->route('admin.productos.index')
        ->with('mensaje','se elimino el producto de la manera correcta')
        ->with('icono', 'success');
    }

    public function reporte(){
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $productos = Producto::all();
        $pdf = PDF::loadView('admin.productos.reportes', compact('productos','empresa'));
        return $pdf->stream();
    }
}

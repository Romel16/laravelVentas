<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empresa;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
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
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
/*         $datos = $request->all();
        return response()->json($datos); */

        $request->validate([
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

        return redirect()->route('admin.clientes.index')
        ->with('mensaje','se registro al cliente de la manera correcta')
        ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $cliente = Cliente::find($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_cliente'=>'required',
            'nit_codigo'=>'required',
            'telefono'=>'required',
            'email'=>'required',
        ]);

        $clientes = Cliente::find($id);
        $clientes->nombre_cliente = $request->nombre_cliente;
        $clientes->nit_codigo = $request->nit_codigo;
        $clientes->telefono = $request->telefono;
        $clientes->email = $request->email;
        $clientes->empresa_id = Auth::user()->empresa_id;

        $clientes->save();

        return redirect()->route('admin.clientes.index')
        ->with('mensaje','se modifico al cliente de la manera correcta')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        return redirect()->route('admin.clientes.index')
        ->with('mensaje','se elimino el proveedor de la manera correcta')
        ->with('icono', 'success');
    }

/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Genera un reporte de compras en formato PDF
     *
     * @return \Illuminate\Http\Response
     */
/******  72f4e4f4-aa40-4837-a4cc-65fbd4f9097e  *******/
    public function reporte(){
        $empresa = Empresa::where('id', Auth::user()->empresa_id)->first();
        $clientes = Cliente::all();
        $pdf = PDF::loadView('admin.clientes.reportes', compact('clientes','empresa'));
        return $pdf->stream();
    }
}

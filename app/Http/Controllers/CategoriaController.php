<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required|unique:categorias',
            'descripcion'=>'required',
        ]);

        $categorias = new Categoria();

        $categorias->nombre = $request->nombre;
        $categorias->descripcion = $request->descripcion;
        $categorias->empresa_id = Auth::user()->empresa_id;

        $categorias->save();


        return redirect()->route('admin.categorias.index')
        ->with('mensaje','se registro la categoria de la manera correcta')
        ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'nombre'=>'required|unique:categorias,nombre,'.$id,
            'descripcion'=>'required',
        ]);

        $categoria = Categoria::find($id);

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;

        $categoria->empresa_id = Auth::user()->empresa_id;

        $categoria->save();


        return redirect()->route('admin.categorias.index')
        ->with('mensaje','se modifico la categoria de la manera correcta')
        ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect()->route('admin.categorias.index')
        ->with('mensaje','se elimino la categoria de la manera correcta')
        ->with('icono', 'success');
    }
}
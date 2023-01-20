<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-grupo|crear-grupo|editar-grupo|borrar-grupo')->only('index');
        $this->middleware('permission:crear-grupo', ['only' => ['create','store']]);
        $this->middleware('permission:editar-grupo', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-grupo', ['only' => ['destroy']]);
    }

    public function index()
    {
        //$grupos=Grupo::paginate(10);
        $grupos=Grupo::all();
        $contador_grupos=Contador::where('nombre',"contador_grupo")->first();
        $contador_grupos->update(['count'=>$contador_grupos->count+1]);
        return view('grupos.index',compact('grupos','contador_grupos'));
    }

    public function create()
    {
        return view('grupos.crear');
    }

    public function store(Request $request)
    {
        request()->validate([
            'nombre'=>['required','max:100'],
        ]);

        Grupo::create($request->all());
        return redirect()->route('grupos.index');
    }

    public function show(Grupo $grupo)
    {
        //
    }

    public function edit(Grupo $grupo)
    {
        return view('grupos.editar',compact('grupo'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        request()->validate([
            'nombre'=>['required','max:100'],
        ]);
        $grupo->update($request->all());
        return redirect()->route('grupos.index');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();
        return redirect()->route('grupos.index');
    }
}

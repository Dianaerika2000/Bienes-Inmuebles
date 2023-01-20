<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-estado |crear-estado|editar-estado|borrar-estado')->only('index');
        $this->middleware('permission:crear-estado', ['only' => ['create','store']]);
        $this->middleware('permission:editar-estado', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-estado', ['only' => ['destroy']]);
    }

    public function index()
    {
        //$estados=Estado::paginate(10);
        $estados=Estado::all();
        $contador_estados=Contador::where('nombre',"contador_estado")->first();
        $contador_estados->update(['count'=>$contador_estados->count+1]);
        return view('estados.index',compact('estados','contador_estados'));
    }

    public function create()
    {
        return view('estados.crear');
    }

    public function store(Request $request)
    {
        request()->validate([
            'nombre'=>['required','max:100'],
        ]);

        Estado::create($request->all());
        return redirect()->route('estados.index');
    }

    public function show(Estado $estado)
    {
        //
    }

    public function edit(Estado $estado)
    {
        return view('estados.editar',compact('estado'));
    }

    public function update(Request $request, Estado $estado)
    {
        request()->validate([
            'nombre'=>['required','max:100'],
        ]);
        $estado->update($request->all());
        return redirect()->route('estados.index');
    }

    public function destroy(Estado $estado)
    {
        $estado->delete();
        return redirect()->route('estados.index');
    }
}

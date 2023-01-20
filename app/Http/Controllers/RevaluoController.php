<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Informe;
use App\Models\Inmueble;
use App\Models\Revaluo;
use Illuminate\Http\Request;

class RevaluoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-revaluo|crear-revaluo|editar-revaluo|borrar-revaluo')->only('index');
        $this->middleware('permission:crear-revaluo', ['only' => ['create','store']]);
        $this->middleware('permission:editar-revaluo', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-revaluo', ['only' => ['destroy']]);
    }

    public function index()
    {
        //$revaluos=Revaluo::paginate(10);
        $revaluos=Revaluo::all();
        $informes=Informe::all();
        $contador_revaluos=Contador::where('nombre',"contador_inmueble")->first();
        $contador_revaluos->update(['count'=>$contador_revaluos->count+1]);
        return view('revaluos.index',compact('revaluos','contador_revaluos', 'informes'));
    }

    public function create()
    {
        $inmuebles = Inmueble::all();
        return view('revaluos.crear', compact('inmuebles'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'idInmueble'=>['required','max:100'],
            'fechaRevaluo' => 'required',
            'costo' => 'required',
            'costoActualizado' => 'required',
            'depreciacionAcumulada' => 'required',
            'valorNeto' => 'required',
        ]);
        Revaluo::create($request->all());
        return redirect()->route('revaluos.index');
    }

    public function show(Revaluo $revaluo)
    {
        //
    }

    public function edit(Revaluo $revaluo)
    {
        $inmuebles = Inmueble::all();
        return view('revaluos.editar',compact('revaluo','inmuebles'));
    }

    public function update(Request $request, Revaluo $revaluo)
    {
        request()->validate([
            'idInmueble'=>['required','max:100'],
            'fechaRevaluo' => 'required',
            'costo' => 'required',
            'costoActualizado' => 'required',
            'depreciacionAcumulada' => 'required',
            'valorNeto' => 'required',
        ]);
        $revaluo->update($request->all());
        return redirect()->route('revaluos.index');
    }

    public function destroy(Revaluo $revaluo)
    {
        $revaluo->delete();
        return redirect()->route('revaluos.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use Illuminate\Http\Request;

use App\Models\Responsable;

class ResponsableController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-responsable|crear-responsable|editar-responsable|borrar-responsable')->only('index');
         $this->middleware('permission:crear-responsable', ['only' => ['create','store']]);
         $this->middleware('permission:editar-responsable', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-responsable', ['only' => ['destroy']]);
    }
    public function index()
    {
        $responsables = Responsable::paginate(10);
        $contador_responsable=Contador::where('nombre',"contador_responsable")->first();
        $contador_responsable->update(['count'=>$contador_responsable->count+1]);
        return view('responsables.index',compact('responsables', 'contador_responsable'));
    }

    public function create()
    {
        return view('responsables.crear');
    }

    public function store(Request $request)
    {
        request()->validate([
            'codigoAsignado'=>['required','max:100'],
            'nombre'=>['required','max:100'],
            'Apellido'=>['required','max:100'],
        ]);
    
        Responsable::create($request->all());
    
        return redirect()->route('responsables.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Responsable $responsable)
    {
        return view('responsables.editar',compact('responsable'));
    }

    public function update(Request $request, Responsable $responsable)
    {
         request()->validate([
             'codigoAsignado'=>['required','max:100'],
             'nombre'=>['required','max:100'],
             'Apellido'=>['required','max:100'],
        ]);
    
        $responsable->update($request->all());
    
        return redirect()->route('responsables.index');
    }

    public function destroy(Responsable $responsable)
    {
        $responsable->delete();
    
        return redirect()->route('responsables.index');
    }
}

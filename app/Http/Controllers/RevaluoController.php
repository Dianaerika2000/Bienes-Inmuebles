<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Informe;
use App\Models\Inmueble;
use App\Models\Revaluo;
use Illuminate\Http\Request;
use PhpParser\Lexer\TokenEmulator\ReverseEmulator;

class RevaluoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-revaluo|crear-revaluo|editar-revaluo|borrar-revaluo')->only('index');
        $this->middleware('permission:crear-revaluo', ['only' => ['create','store']]);
        $this->middleware('permission:editar-revaluo', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-revaluo', ['only' => ['destroy']]);
    }

    public function index($id)
    {
        // dd($id);
        $inmueble=Inmueble::find($id);
        $revaluos=Revaluo::where('idInmueble', $id)->get();
        $informes=Informe::all();
        $contador_revaluos=Contador::where('nombre',"contador_inmueble")->first();
        $contador_revaluos->update(['count'=>$contador_revaluos->count+1]);
        return view('revaluos.index',compact('revaluos','contador_revaluos','informes', 'inmueble'));
    }

    public function create($id)
    {
        $inmueble = Inmueble::find($id);
        return view('revaluos.crear', compact('inmueble'));
    }
    public function store(Request $request, $id)
    {
        request()->validate([
            // 'idInmueble'=>'required',
            'fechaRevaluo' => 'required',
            'costoActualizado' => 'required',
            'valorNeto' => 'required',
        ]);
            $revaluo = new Revaluo();

            $revaluo->idInmueble = $id;
            $revaluo->descripcion = $request->get('descripcion');
            $revaluo->fechaRevaluo = $request->get('fechaRevaluo');
            $revaluo->costoActualizado = $request->get('costoActualizado');
            $revaluo->valorNeto = $request->get('valorNeto');
            $revaluo->save();

            // Revaluo::create($request->all());
            return redirect()->route('revaluos.index', $id);
        }

        public function show(Revaluo $revaluo)
        {
            //
        }

        public function edit(Revaluo $revaluo)
        {
            // dd($revaluo);
            $idInmu= $revaluo->idInmueble;
            // dd($idInmu);
            $inmueble = Inmueble::find($idInmu);
            return view('revaluos.editar',compact('revaluo','inmueble'));
        }

        public function update(Request $request, $id)
        {
            request()->validate([
                'fechaRevaluo' => 'required',
                'costoActualizado' => 'required',
                'valorNeto' => 'required',
            ]);
            $revaluo=Revaluo::find($id);

            $revaluo->update($request->all());
            return redirect()->route('revaluos.index', $revaluo->idInmueble);
        }

    public function destroy(Revaluo $revaluo)
    {
        $idInmueble = $revaluo->idInmueble;
        $revaluo->delete();
        return redirect()->route('revaluos.index', $idInmueble);
    }
}

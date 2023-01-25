<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Grupo;
use App\Models\Inmueble;
use App\Models\Revaluo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class ReporteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-reporte|crear-reporte|editar-reporte|borrar-reporte')->only('index');
        $this->middleware('permission:crear-reporte', ['only' => ['create','store']]);
        $this->middleware('permission:editar-reporte', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-reporte', ['only' => ['destroy']]);
    }

    public function index()
    {
        $revaluosInmuebles = DB::table('revaluos')->pluck('idInmueble');
        $revaluosInmueblesSinD = array_unique($revaluosInmuebles->toArray());
        $valorActual=[];
        $valorAnterior=[];
        $data=[];
        foreach($revaluosInmueblesSinD as $key => $revaluo){
            $i = DB::table('inmuebles')->find($revaluo);
            
            if ($i->idGrupo === 1) {
                // DB::table('revaluos')->sum('costoActualizado');
                $aux = DB::table('revaluos')->where('idInmueble', '=', $revaluo)->sum('costoActualizado');
                $valorActual['A'][] = $aux;
                $aux2 = DB::table('revaluos')->where('idInmueble', '=', $revaluo)->sum('valorNeto');
                $valorAnterior['A'][] = $aux2;
            } elseif ($i->idGrupo === 2) {
                $aux = DB::table('revaluos')->where('idInmueble', '=', $revaluo)->value('costoActualizado');
                $valorActual['B'][] = $aux;
                $aux2 = DB::table('revaluos')->where('idInmueble', '=', $revaluo)->sum('valorNeto');
                $valorAnterior['B'][] = $aux2;
                
            } else {
                $aux = DB::table('revaluos')->where('idInmueble', '=', $revaluo)->value('costoActualizado');
                $valorActual['C'][] = $aux;
                $aux2 = DB::table('revaluos')->where('idInmueble', '=', $revaluo)->sum('valorNeto');
                $valorAnterior['C'][] = $aux2;
            }
        }
        // $data['valorActualA'][]=array_sum($valorActual['A']);
        // $data['valorActualB'][]=array_sum($valorActual['B']);
        // $data['valorActualC'][]= array_sum($valorActual['C']);
        // $data['valorAnteriorA'][]=array_sum($valorAnterior['A']);
        // $data['valorAnteriorB'][]=array_sum($valorAnterior['B']);
        // $data['valorAnteriorC'][]=array_sum($valorAnterior['C']);
        $data['data'][] = array_sum($valorAnterior['A']);
        $data['data'][] = array_sum($valorActual['A']);
        $data['data'][]= array_sum($valorAnterior['B']);
        $data['data'][]= array_sum($valorActual['B']);
        $data['data'][]= array_sum($valorAnterior['C']);
        $data['data'][]= array_sum($valorActual['C']);
        // dd($data['data']);

        $usuarios = User::all();
        $contador_reportes = Contador::where('nombre', 'contador_reporte')->first();
        $contador_reportes->update(['count' => $contador_reportes->count + 1]);
        $grupos=Grupo::all();
        $inmuebles=Inmueble::all();
        $revaluos=Revaluo::all();

        $inmueblesData=[];
        foreach ($inmuebles as $inmueble ) {
            $inmueblesData[] = ['name' => $inmueble->grupo->nombre, 'y' => floatval($inmueble->monto), 'drilldown' => $inmueble->grupo->nombre];
        }

        $revaluosData=[];
        foreach ($revaluos as $revaluo) {
            $revaluosData[] = ['name' => $revaluo->descripcion, 'y' => floatval($revaluo->valorNeto), 'drilldown' => $revaluo->descripcion];
        }

        return view('reportes.index', compact('contador_reportes', 'usuarios', 'grupos', 'inmuebles', 'revaluos'),
            ["inmueblesData"=>json_encode($inmueblesData),"revaluosData" => json_encode($revaluosData), 'data' => $data ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function reporteVistas()
    {
        $usuarios = User::all();
        $contador_reportes = Contador::where('nombre', 'contador_reporte')->first();
        $contador_reportes->update(['count' => $contador_reportes->count + 1]);
        $grupos=Grupo::all();
        $inmuebles=Inmueble::all();
        $revaluos=Revaluo::all();

        $inmueblesData=[];
        foreach ($inmuebles as $inmueble ) {
            $inmueblesData[] = ['name' => $inmueble->grupo->nombre, 'y' => floatval($inmueble->monto), 'drilldown' => $inmueble->grupo->nombre];
        }

        $revaluosData=[];
        foreach ($revaluos as $revaluo) {
            $revaluosData[] = ['name' => $revaluo->descripcion, 'y' => floatval($revaluo->valorNeto), 'drilldown' => $revaluo->descripcion];
        }

        return view('reportes.index', compact('contador_reportes', 'usuarios', 'grupos', 'inmuebles', 'revaluos'),
            ["inmueblesData"=>json_encode($inmueblesData),"revaluosData" => json_encode($revaluosData)]);
    }

    public function reporteInmueblesView(){
        $inmubles = Inmueble::all();
        $revaluos = Revaluo::all();
        return view('reportes.reporteInmuebleView',compact('inmubles', 'revaluos'));
    }

    public function reporteInmueblesDoc(Request $request){

        $tipoBase = $request->get('tipo');

        if ($request->get('tipo')=='inmuebles'){
            //$activos = Inmueble::all();
            $activos= Inmueble::where('fechaAdquisicion','>=',$request->get('desde'))
                ->where('fechaAdquisicion','<=',$request->get('hasta'))->get();
        }else{
            $activos= Revaluo::where('fechaRevaluo','>=',$request->get('desde'))
                ->where('fechaRevaluo','<=',$request->get('hasta'))->get();
        }

        $desde=$request->get('desde');
        $hasta=$request->get('hasta');

        $contador_reportes = Contador::where('nombre', 'contador_reporte')->first();
        $contador_reportes->update(['count' => $contador_reportes->count + 1]);
        return view('reportes.reporteRevaluoInmueble',compact('tipoBase','activos', 'desde', 'hasta', 'contador_reportes'));
    }
    
    public function reporteInmueblesDocGrupo(Request $request){

        $tipoBase = $request->get('tipo');
        $codigoB = $request->get('terreno');
        $idB = Inmueble::where('codigo', '=', $codigoB)->value('id');

        if ($request->get('tipo')=='edificios'){
            $activos= Inmueble::where('idGrupo', '=', 1)->where('idInmueble','=', $idB)->get();
            // dd($activos);
        }else{
            $activos= Inmueble::where('idGrupo', '=', 3)->where('idInmueble','=', $idB)->get();
        }

        $contador_reportes = Contador::where('nombre', 'contador_reporte')->first();
        $contador_reportes->update(['count' => $contador_reportes->count + 1]);
        return view('reportes.reporteGrupoInmueble',compact('tipoBase','activos','codigoB'));
    }
}

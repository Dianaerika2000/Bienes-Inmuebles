<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Informe;
use App\Models\Revaluo;
use Illuminate\Http\Request;

class InformeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-informe|crear-informe|editar-informe|borrar-informe')->only('index');
        $this->middleware('permission:crear-informe', ['only' => ['create','store']]);
        $this->middleware('permission:editar-informe', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-informe', ['only' => ['destroy']]);
    }

    public function index()
    {
        //$informes=Informe::paginate(10);
        $informes=Informe::all();
        $contador_informes=Contador::where('nombre',"contador_informe")->first();
        $contador_informes->update(['count'=>$contador_informes->count+1]);
        return view('informes.index',compact('informes','contador_informes'));
    }

    public function create()
    {
        $revaluos = Revaluo::all();
        return view('informes.crear', compact('revaluos'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'url' => 'required',
            'fechaRealizada' => 'required',
            'idRevaluo' => 'required',
        ]);

        $informe = new Informe();
        if ($request->hasFile('url')){
            $file=$request->file('url');
            $destinationPath='documentos/';
            $filename=$file->getClientOriginalName();
            $uploadSuccess = $request->file('url')->move($destinationPath,$filename);
            $informe->url=$destinationPath . $filename;
        }
        $informe->descripcion=$request->get('descripcion');
        $informe->fechaRealizada=$request->get('fechaRealizada');
        $informe->idRevaluo=$request->get('idRevaluo');
        $informe->save();

        //Informe::create($request->all() + ['url' => $informe]);
        return redirect()->route('informes.index');
    }

    public function show(Informe $informe)
    {
        //
    }

    public function edit(Informe $informe)
    {
        $revaluos = Revaluo::all();
        return view('informes.editar',compact('informe','revaluos'));
    }

    public function update(Request $request, Informe $informe)
    {
        request()->validate([
            'url' => 'required',
            'fechaRealizada' => 'required',
            'idRevaluo' => 'required',
        ]);

        if ($request->hasFile('url')){
            $file=$request->file('url');
            $destinationPath='documentos/';
            $filename=$file->getClientOriginalName();
            $uploadSuccess = $request->file('url')->move($destinationPath,$filename);
            $informe->url=$destinationPath . $filename;
        }
        $informe->descripcion=$request->get('descripcion');
        $informe->fechaRealizada=$request->get('fechaRealizada');
        $informe->idRevaluo=$request->get('idRevaluo');
        $informe->save();

        //$informe->update($request->all());
        return redirect()->route('informes.index');
    }

    public function destroy(Informe $informe)
    {
        $informe->delete();
        return redirect()->route('informes.index');
    }
}

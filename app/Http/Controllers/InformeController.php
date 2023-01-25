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

    public function index($id)
    {
        //$informes=Informe::paginate(10);
        // $revaluos=Revaluo::where('idInmueble', $id)->get();
        $revaluo=Revaluo::find($id);
        $informes=Informe::where('idRevaluo', $id)->get();
        // dd($informe);
        $contador_informes=Contador::where('nombre',"contador_informe")->first();
        $contador_informes->update(['count'=>$contador_informes->count+1]);
        return view('informes.index',compact('informes','contador_informes','revaluo'));
    }

    public function create($id)
    {
        $revaluo=Revaluo::find($id);
        return view('informes.crear', compact('revaluo'));
    }

    public function store(Request $request, $id)
    {
        request()->validate([
            'url' => 'required',
            'fechaRealizada' => 'required',
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
        return redirect()->route('informes.index', $id);
    }

    public function show(Informe $informe)
    {
        //
    }

    public function edit(Informe $informe)
    {
        $revaluo = Revaluo::find($informe->idRevaluo);
        return view('informes.editar',compact('informe','revaluo'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'url' => 'required',
            'fechaRealizada' => 'required',
            'idRevaluo' => 'required',
        ]);

        $informe=Informe::find($id);

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
        return redirect()->route('informes.index', $id);
    }

    public function destroy(Informe $informe)
    {
        $informe->delete();
        return redirect()->route('informes.index', $informe->idRevaluo);
    }
}

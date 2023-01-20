<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Fotografia;
use App\Models\Inmueble;
use Illuminate\Http\Request;

class FotografiaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-fotografia|crear-fotografia|editar-fotografia|borrar-fotografia')->only('index');
        $this->middleware('permission:crear-fotografia', ['only' => ['create','store']]);
        $this->middleware('permission:editar-fotografia', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-fotografia', ['only' => ['destroy']]);
    }

    public function index()
    {
        //$fotografias=Fotografia::paginate(10);
        $fotografias=Fotografia::all();
        $contador_fotografias=Contador::where('nombre',"contador_fotografia")->first();
        $contador_fotografias->update(['count'=>$contador_fotografias->count+1]);
        return view('fotografias.index',compact('fotografias','contador_fotografias'));
    }

    public function create()
    {
        $inmuebles = Inmueble::all();
        return view('fotografias.crear',compact('inmuebles'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'url' => 'required',
            'detalle' => 'required',
            'fechaSubida' => 'required',
            'idInmueble' => 'required',
        ]);

        $fotografia = new Fotografia();
        if ($request->hasFile('url')){
            $file=$request->file('url');
            $destinationPath='images/fotos/';
            $filename=time().'-'.$file->getClientOriginalName();
            $uploadSuccess = $request->file('url')->move($destinationPath,$filename);
            $fotografia->url=$destinationPath . $filename;
        }
        $fotografia->detalle = $request->get('detalle');
        $fotografia->fechaSubida = $request->get('fechaSubida');
        $fotografia->idInmueble = $request->get('idInmueble');
        $fotografia->save();

        return redirect()->route('fotografias.index');

    }

    public function show(Fotografia $fotografia)
    {
        //
    }

    public function edit(Fotografia $fotografia)
    {
        $inmuebles = Inmueble::all();
        return view('fotografias.editar',compact('fotografia','inmuebles'));
    }

    public function update(Request $request, Fotografia $fotografia)
    {
        //return dd($request);
        request()->validate([
            'detalle' => 'required',
            'fechaSubida' => 'required',
            'idInmueble' => 'required',
        ]);

        if ($request->url!=null && $request->hasFile('url')){
            $file=$request->file('url');
            $destinationPath='images/fotos/';
            $filename=time().'-'.$file->getClientOriginalName();
            $uploadSuccess = $request->file('url')->move($destinationPath,$filename);
            $fotografia->url=$destinationPath . $filename;
        }
        $fotografia->detalle = $request->get('detalle');
        $fotografia->fechaSubida = $request->get('fechaSubida');
        $fotografia->idInmueble = $request->get('idInmueble');
        $fotografia->save();
        return redirect()->route('fotografias.index');
    }

    public function destroy(Fotografia $fotografia)
    {
        $fotografia->delete();
        return redirect()->route('fotografias.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Direccion;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Scalar\MagicConst\Dir;

class DireccionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-direccion|crear-direccion|editar-direccion|borrar-direccion')->only('index');
        $this->middleware('permission:crear-direccion', ['only' => ['create','store']]);
        $this->middleware('permission:editar-direccion', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-direccion', ['only' => ['destroy']]);
    }

    public function index()
    {
        //$direcciones=Direccion::paginate(10);
        $direcciones=Direccion::all();
        $contador_direcciones=Contador::where('nombre',"contador_direccion")->first();
        $contador_direcciones->update(['count'=>$contador_direcciones->count+1]);
        return view('direcciones.index',compact('direcciones','contador_direcciones'));
    }

    public function create()
    {
        return view('direcciones.crear');
    }

    public function store(Request $request)
    {
        request()->validate([
            'ubicacion' => 'required',
        ]);

        $ubicacion = new Direccion();
        $ubicacion->ubicacion = $request->get('ubicacion');
        $ubicacion->latitud = $request->get('lat');
        $ubicacion->longitud = $request->get('lng');
        $ubicacion->descripcion = $request->get('descripcion');
        $ubicacion->save();
        //Direccion::create($request->all());

        return redirect()->route('direcciones.index');

    }

    public function show(Direccion $direccion)
    {
        dd($direccion->idDireccion);
    }

    public function edit(Direccion $direccione)
    {
        return view('direcciones.editar',compact('direccione'));
    }

    public function update(Request $request, Direccion $direccione)
    {
        request()->validate([
            'ubicacion' => 'required',
        ]);

        $direccione->ubicacion = $request->get('ubicacion');
        $direccione->latitud = $request->get('lat');
        $direccione->longitud = $request->get('lng');
        $direccione->descripcion = $request->get('descripcion');
        $direccione->save();
        return redirect()->route('direcciones.index');
    }

    public function destroy(Direccion $direccione)
    {
        $direccione->delete();
        //Direccion::destroy($direccion->id);
        return redirect()->route('direcciones.index');
    }


}

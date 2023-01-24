<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Direccion;
use App\Models\Estado;
use App\Models\Grupo;
use App\Models\Inmueble;
use App\Models\Responsable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InmuebleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-inmueble|crear-inmueble|editar-inmueble|borrar-inmueble')->only('index');
        $this->middleware('permission:crear-inmueble', ['only' => ['create','store']]);
        $this->middleware('permission:editar-inmueble', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-inmueble', ['only' => ['destroy']]);
    }

    public function index()
    {
        //$inmuebles=Inmueble::paginate(10);
        $inmuebles=Inmueble::all();
        $contador_inmuebles=Contador::where('nombre',"contador_revaluo")->first();
        $contador_inmuebles->update(['count'=>$contador_inmuebles->count+1]);
        return view('inmuebles.index',compact('inmuebles','contador_inmuebles'));
    }

    public function create()
    {
        $estados=Estado::all();
        $direcciones=Direccion::all();
        $grupos=Grupo::all();
        $usuarios=User::all();
        $responsables=Responsable::all();
        $inmuebles=Inmueble::where('idGrupo',2)->get();
        return view('inmuebles.crear',compact('estados','direcciones','grupos','usuarios','responsables','inmuebles'));
    }

    public function store(Request $request)
    {
        //return dd($request);
        request()->validate([
            'codigo'=>['required','max:100'],
            'monto'=>['required','max:100'],
            'fechaAdquisicion'=>['required','max:100'],
            'idResponsable'=>['required','max:100'],
            'idEstado'=>['required','max:100'],
            'idGrupo'=>['required','max:100'],
        ]);

        if($request->idDireccion==null AND $request->lat!=null){
            $ubicacion = Direccion::create($request->all() + ['latitud' => $request->get('lat'), 'longitud' => $request->get('lng')]);
            $ubicacion = $ubicacion->id;
            //$ubicacion = Direccion::select('id')->orderBy('id', 'desc')->first();
            //Inmueble::create($request->all() + ['idDireccion' => $ubicacion->id , 'idUsuario'=> auth()->id()]);
        }else{
            //Inmueble::create($request->all() + ['idUsuario'=> auth()->id()]);
            $ubicacion= $request->get('idDireccion');
        }

        if($request->idInmueble!=null){
            $CodigoInmueble=Inmueble::where('id',$request->idInmueble)->first();
            $CodigoInmueble=Str::limit($CodigoInmueble->codigo, 5,'');
        }else{
            $CodigoInmueble=null;
        }

        if ($request->get('idGrupo')!=2){
            $CodigoIDInmueble=$request->get('idInmueble');
        }else{
            $CodigoIDInmueble=null;
        }

        DB::table('inmuebles')->insert(
            array(
                'codigo'     =>   $CodigoInmueble .''. $request->get('codigo'),
                'descripcionGlosa'   =>   $request->get('descripcionGlosa'),
                'fechaAdquisicion'   =>   $request->get('fechaAdquisicion'),
                'monto'   =>   $request->get('monto'),
                'idUsuario'   =>   Auth::user()->id,
                'idResponsable'   =>   $request->get('idResponsable'),
                'idEstado'   =>   $request->get('idEstado'),
                'idGrupo'   =>   $request->get('idGrupo'),
                'idDireccion'   =>   $ubicacion,
                'idInmueble'   =>   $CodigoIDInmueble,
            )
        );

        //Inmueble::create($request->all() + ['idDireccion' => $ubicacion->id, 'idUsuario'=> auth()->id()]);
        return redirect()->route('inmuebles.index');
    }

    public function show(Inmueble $inmueble)
    {
        $direccion = Direccion::find($inmueble->idDireccion);
        // dd($inmueble->idDireccion);
        // dd($direccion);
        $lat = $direccion->latitud;
        $lng = $direccion->longitud;
        return view('inmuebles.show', compact('direccion'));
    }

    public function edit(Inmueble $inmueble)
    {
        $estados=Estado::all();
        $direcciones=Direccion::all();
        $grupos=Grupo::all();
        $usuarios=User::all();
        $responsables=Responsable::all();
        $inmuebles=Inmueble::where('idGrupo',2)->get();
        return view('inmuebles.editar',compact('inmueble','estados','direcciones','grupos','usuarios','responsables','inmuebles'));
    }

    public function update(Request $request, Inmueble $inmueble)
    {
        //return dd($request);
        request()->validate([
            'codigo'=>['required','max:100'],
            'monto'=>['required','max:100'],
            'fechaAdquisicion'=>['required','max:100'],
            'idResponsable'=>['required','max:100'],
            'idEstado'=>['required','max:100'],
            'idGrupo'=>['required','max:100'],
        ]);

        if($request->idDireccion==null AND $request->lat!=null){
            $ubicacion = Direccion::create($request->all() + ['latitud' => $request->get('lat'), 'longitud' => $request->get('lng')]);
            $ubicacion = $ubicacion->id;
        }else{
            $ubicacion= $request->get('idDireccion');
        }

        if($request->idInmueble!=null){
            $CodigoInmueble=Inmueble::where('id',$request->idInmueble)->first();
            $CodigoInmueble=Str::limit($CodigoInmueble->codigo, 5,'');
        }else{
            $CodigoInmueble=null;
        }

        if ($request->get('idGrupo')!=2){
            $CodigoIDInmueble=$request->get('idInmueble');
        }else{
            $CodigoIDInmueble=null;
        }

        DB::table('inmuebles')->where('id','=',$inmueble->id)->update(
            array(
                'codigo'     =>   $CodigoInmueble .''. $request->get('codigo'),
                'descripcionGlosa'   =>   $request->get('descripcionGlosa'),
                'fechaAdquisicion'   =>   $request->get('fechaAdquisicion'),
                'monto'   =>   $request->get('monto'),
                'idUsuario'   =>   Auth::user()->id,
                'idResponsable'   =>   $request->get('idResponsable'),
                'idEstado'   =>   $request->get('idEstado'),
                'idGrupo'   =>   $request->get('idGrupo'),
                'idDireccion'   =>   $ubicacion,
                'idInmueble'   =>   $CodigoIDInmueble,
            )
        );

        //Inmueble::create($request->all() + ['idDireccion' => $ubicacion->id, 'idUsuario'=> auth()->id()]);
        return redirect()->route('inmuebles.index');
        return redirect()->route('inmuebles.index');
    }

    public function destroy(Inmueble $inmueble)
    {
        $inmueble->delete();
        return redirect()->route('inmuebles.index');
    }
}

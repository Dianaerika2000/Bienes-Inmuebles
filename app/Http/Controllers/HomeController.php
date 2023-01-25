<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use App\Models\Direccion;
use App\Models\Estado;
use App\Models\Fotografia;
use App\Models\Grupo;
use App\Models\Informe;
use App\Models\Inmueble;
use App\Models\Responsable;
use App\Models\Revaluo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $usuarios = User::all();
        $inmuebles = Inmueble::all();
        $grupos = Grupo::all();
        $contador_menu = Contador::where('nombre',"contador_menu")->first();
        $contador_menu->update(['count'=>$contador_menu->count+1]);

        $datosInmueble = Inmueble::where('id','=',$request->get('idInmueble'))->first();
        $id = trim($request->get('idInmueble'));
        $busqueda = trim($request->get('busqueda'));

        $getUsuarios= User::where('nombre','like',"%{$request->busqueda}%")
            ->orWhere('apellido','like',"%{$request->busqueda}%")
            ->orWhere('nacionalidad','like',"%{$request->busqueda}%")
            ->orWhere('ci','like',"%{$request->busqueda}%")
            ->orWhere('celular','like',"%{$request->busqueda}%")
            ->orWhere('direccion','like',"%{$request->busqueda}%")
            ->orWhere('email','like',"%{$request->busqueda}%")
            ->orderBy('nombre','asc')
            ->get();

        $getResponsables= Responsable::where('codigoAsignado','like',"%{$request->busqueda}%")
            ->orWhere('nombre','like',"%{$request->busqueda}%")
            ->orWhere('Apellido','like',"%{$request->busqueda}%")
            ->orderBy('codigoAsignado','asc')
            ->get();

        $getRoles= Role::where('name','like',"%{$request->busqueda}%")
            ->orderBy('name','asc')
            ->get();

        $getDirecciones= Direccion::where('ubicacion','like',"%{$request->busqueda}%")
            ->orWhere('descripcion','like',"%{$request->busqueda}%")
            ->orWhere('latitud','like',"%{$request->busqueda}%")
            ->orWhere('longitud','like',"%{$request->busqueda}%")
            ->orderBy('ubicacion','asc')
            ->get();

        $getEstados= Estado::where('nombre','like',"%{$request->busqueda}%")
            ->orWhere('descripcion','like',"%{$request->busqueda}%")
            ->orderBy('nombre','asc')
            ->get();

        $getGrupos= Grupo::where('nombre','like',"%{$request->busqueda}%")
            ->orderBy('nombre','asc')
            ->get();

        $getInmuebles= Inmueble::where('codigo','like',"%{$request->busqueda}%")
            ->orWhere('descripcionGlosa','like',"%{$request->busqueda}%")
            ->orWhere('fechaAdquisicion','like',"%{$request->busqueda}%")
            ->orWhere('monto','like',"%{$request->busqueda}%")
            ->orderBy('codigo','asc')
            ->get();

        $getFotografias= Fotografia::where('url','like',"%{$request->busqueda}%")
            ->orWhere('detalle','like',"%{$request->busqueda}%")
            ->orWhere('fechaSubida','like',"%{$request->busqueda}%")
            ->orderBy('url','asc')
            ->get();

        $getRevaluos= Revaluo::where('descripcion','like',"%{$request->busqueda}%")
            ->orWhere('fechaRevaluo','like',"%{$request->busqueda}%")
            ->orWhere('costoActualizado','like',"%{$request->busqueda}%")
            ->orWhere('valorNeto','like',"%{$request->busqueda}%")
            ->orderBy('descripcion','asc')
            ->get();

        $getInformes= Informe::where('descripcion','like',"%{$request->busqueda}%")
            ->orWhere('url','like',"%{$request->busqueda}%")
            ->orWhere('fechaRealizada','like',"%{$request->busqueda}%")
            ->orderBy('descripcion','asc')
            ->get();

        return view('home',compact('contador_menu', 'usuarios','inmuebles', 'grupos', 'datosInmueble', 'id','busqueda',
            'getUsuarios', 'getResponsables', 'getRoles','getDirecciones', 'getEstados', 'getGrupos', 'getInmuebles', 'getFotografias',
            'getRevaluos', 'getInformes'));
    }

    public function buscadorGlobal()
    {
        $usuarios = User::all();
        $responsables = Responsable::all();
        $roles = Role::all();
        $grupos = Grupo::all();
        $estados = Estado::all();
        $direcciones = Direccion::all();
        $inmuebles = Inmueble::all();
        $informes = Informe::all();
        $revaluos = Revaluo::all();
        return view('home',compact('usuarios', 'responsables','roles', 'grupos', 'estados', 'direcciones', 'inmuebles', 'informes', 'revaluos'));
    }
}

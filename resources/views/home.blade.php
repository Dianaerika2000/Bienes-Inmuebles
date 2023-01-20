@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/css/bootstrap.min.css" title="main">
<!-- SELECT2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ asset('select2/dist/js/select2.js') }}">
<link href="{{ asset('select2/dist/css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('content')
    <style>
        #map-canvas {
            width: 850px;
            max-width: 100%;
            height: 670px;
            max-height: 100vh;
        }
    </style>

    <section class="section">

        <div class="section-header" style="background-color: {{ auth()->user()->color}}">
            <h3 class="page__heading">Panel de Control</h3>
        </div>
        <div class="section-body">

            {{--BUSCADOR--}}
            <div class="alert alert-primary text-center"><strong>Busqueda Global</strong></div>

            <div class="search-bar">
                 <form action="{{ route('home') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" name="busqueda" placeholder="Palabra a buscar" class="input" value="{{$busqueda}}">
                        <input type="submit" class="btn btn-primary button" value="Buscar">
                    </div>
                </form>
                <hr class="sidebar-divider d-none d-md-block">
            </div>

            {{-- default tab de lsitar usuarios --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Busquedas</h4>
                    </div>
                    <div class="card-body">
                        <div class="default-tab">

                            <ul class="nav nav-tabs" role="tablist">
                                {{--PERSONAL--}}
                                @if(!empty($busqueda) And count($getUsuarios) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#usuarios">Usuarios</a>
                                    </li>
                                @endif
                                @if(!empty($busqueda) And count($getResponsables) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#responsables">Responsables</a>
                                    </li>
                                @endif
                                @if(!empty($busqueda) And count($getRoles) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#roles">Roles</a>
                                    </li>
                                @endif

                                {{--INMUEBLES--}}
                                @if(!empty($busqueda) And count($getEstados) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#Estados">Estados</a>
                                    </li>
                                @endif
                                @if(!empty($busqueda) And count($getGrupos) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#Grupos">Grupos</a>
                                    </li>
                                @endif
                                @if(!empty($busqueda) And count($getDirecciones) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#Direcciones">Direcciones</a>
                                    </li>
                                @endif
                                @if(!empty($busqueda) And count($getInmuebles) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#Inmuebles">Inmuebles</a>
                                    </li>
                                @endif
                                @if(!empty($busqueda) And count($getFotografias) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#Fotografias">Fotografias</a>
                                    </li>
                                @endif

                                {{--INFORMES--}}
                                @if(!empty($busqueda) And count($getRevaluos) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#Revaluos">Revaluos</a>
                                    </li>
                                @endif
                                @if(!empty($busqueda) And count($getInformes) >= 1 )
                                    <li class="nav-item">
                                        <a class="nav-link fw-bold" data-toggle="tab" href="#Informes">Informes</a>
                                    </li>
                                @endif
                            </ul>

                            <div class="tab-content">
                                {{--usuarios--}}
                                @if(!empty($busqueda) And count($getUsuarios) >= 1 )
                                <div class="tab-pane fade" id="usuarios" role="tabpanel">
                                    <div class="pt-4">
                                        <table class="table table-responsive-sm table-light">
                                            <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Nacionalidad</th>
                                                <th>Cédula de Identidad</th>
                                                <th>Celular</th>
                                                <th>Direccion</th>
                                                <th>Email</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-dark">
                                            @foreach ($getUsuarios as $usuario)
                                                <tr>
                                                    <td>{{ $usuario->nombre }}</td>
                                                    <td>{{ $usuario->apellido }}</td>
                                                    <td>{{ $usuario->nacionalidad }}</td>
                                                    <td>{{ $usuario->ci }}</td>
                                                    <td>{{ $usuario->celular }}</td>
                                                    <td>{{ $usuario->direccion }}</td>
                                                    <td>{{ $usuario->email }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                                {{--responsables--}}
                                @if(!empty($busqueda) And count($getResponsables) >= 1 )
                                <div class="tab-pane fade" id="responsables">
                                    <div class="pt-4">
                                        <table class="table table-responsive-sm table-light">
                                            <thead>
                                            <tr>
                                                <th>Código administrativo</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-dark">
                                            @foreach ($getResponsables as $responsable)
                                                <tr>
                                                    <td>{{ $responsable->codigoAsignado }}</td>
                                                    <td>{{ $responsable->nombre }}</td>
                                                    <td>{{ $responsable->Apellido }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                                {{--roles--}}
                                @if(!empty($busqueda) And count($getRoles) >= 1 )
                                <div class="tab-pane fade" id="roles">
                                    <div class="pt-4">
                                        <table class="table table-responsive-sm table-light">
                                            <thead>
                                            <tr>
                                                <th>Nombre</th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-dark">
                                            @foreach ($getRoles as $rol)
                                                <tr>
                                                    <td>{{ $rol->name }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif

                                {{--Estados--}}
                                @if(!empty($busqueda) And count($getEstados) >= 1 )
                                    <div class="tab-pane fade" id="Estados" role="tabpanel">
                                        <div class="pt-4">
                                            <table class="table table-responsive-sm table-light">
                                                <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-dark">
                                                @foreach ($getEstados as $estado)
                                                    <tr>
                                                        <td>{{ $estado->nombre }}</td>
                                                        <td>{{ $estado->descripcion }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                {{--Grupos--}}
                                @if(!empty($busqueda) And count($getGrupos) >= 1 )
                                    <div class="tab-pane fade" id="Grupos">
                                        <div class="pt-4">
                                            <table class="table table-responsive-sm table-light">
                                                <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-dark">
                                                @foreach ($getGrupos as $grupo)
                                                    <tr>
                                                        <td>{{ $grupo->nombre }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                {{--Direcciones--}}
                                @if(!empty($busqueda) And count($getDirecciones) >= 1 )
                                    <div class="tab-pane fade" id="Direcciones">
                                        <div class="pt-4">
                                            <table class="table table-responsive-sm table-light">
                                                <thead>
                                                <tr>
                                                    <th>Ubicación</th>
                                                    <th>Latitud</th>
                                                    <th>Longitud</th>
                                                    <th>Descripción</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-dark">
                                                @foreach ($getDirecciones as $direccion)
                                                    <tr>
                                                        <td>{{ $direccion->ubicacion }}</td>
                                                        <td>{{ $direccion->latitud }}</td>
                                                        <td>{{ $direccion->longitud }}</td>
                                                        <td>{{ $direccion->descripcion }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                {{--Inmuebles--}}
                                @if(!empty($busqueda) And count($getInmuebles) >= 1 )
                                    <div class="tab-pane fade" id="Inmuebles">
                                        <div class="pt-4">
                                            <table class="table table-responsive-sm table-light">
                                                <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>>Fecha Adquisición</th>
                                                    <th>Monto</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-dark">
                                                @foreach ($getInmuebles as $inmueble)
                                                    <tr>
                                                        <td>{{ $inmueble->codigo }}</td>
                                                        <td>{{ $inmueble->descripcionGlosa }}</td>
                                                        <td>{{ $inmueble->fechaAdquisicion }}</td>
                                                        <td>{{ $inmueble->monto }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                {{--Fotografias--}}
                                @if(!empty($busqueda) And count($getFotografias) >= 1 )
                                    <div class="tab-pane fade" id="Fotografias">
                                        <div class="pt-4">
                                            <table class="table table-responsive-sm table-light">
                                                <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <th>Fotografía</th>
                                                    <th>Fecha</th>
                                                    <th>Inmueble</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-dark">
                                                @foreach ($getFotografias as $fotografia)
                                                    <tr>
                                                        <td>{{ $fotografia->detalle }}</td>
                                                        <td>
                                                            <center>
                                                                <img height="300px" width="300px" class="img-thumbnail" src="{{asset($fotografia->url)}}" alt="{{$fotografia->url}}" >
                                                                <p><a href="{{asset($fotografia->url)}}" target="_blank" rel="noopener noreferrer">{{$fotografia->url}}</a></p>
                                                            </center>
                                                        </td>
                                                        <td>{{ $fotografia->fechaSubida }}</td>
                                                        <td>{{ $fotografia->inmueble->codigo }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                {{--Revaluos--}}
                                @if(!empty($busqueda) And count($getRevaluos) >= 1 )
                                    <div class="tab-pane fade" id="Revaluos">
                                        <div class="pt-4">
                                            <table class="table table-responsive-sm table-light">
                                                <thead>
                                                <tr>
                                                    <th>Descripción</th>
                                                    <th>Fecha Revaluo</th>
                                                    <th>Costo</th>
                                                    <th>Costo Actualizado</th>
                                                    <th>Depreciación</th>
                                                    <th>Valor Neto</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-dark">
                                                @foreach ($getRevaluos as $revaluo)
                                                    <tr>
                                                        <td>{{ $revaluo->descripcion }}</td>
                                                        <td>{{ $revaluo->fechaRevaluo }}</td>
                                                        <td>{{ $revaluo->costo }} Bs.</td>
                                                        <td>{{ $revaluo->costoActualizado }} Bs.</td>
                                                        <td>{{ $revaluo->depreciacionAcumulada }} Bs.</td>
                                                        <td>{{ $revaluo->valorNeto }} Bs.</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                                {{--Informes--}}
                                @if(!empty($busqueda) And count($getInformes) >= 1 )
                                    <div class="tab-pane fade" id="Informes">
                                        <div class="pt-4">
                                            <table class="table table-responsive-sm table-light">
                                                <thead>
                                                <tr>
                                                    <th>Documento</th>
                                                    <th>Descripción</th>
                                                    <th>Fecha</th>
                                                    <th>Revaluo</th>
                                                </tr>
                                                </thead>
                                                <tbody class="text-dark">
                                                @foreach ($getInformes as $informe)
                                                    <tr>
                                                        <td style="display: none;">{{ $informe->id }}</td>
                                                        <td>
                                                            <p>Descargar <a href="{{$informe->url}}" target="_blank" rel="noopener noreferrer">{{$informe->url}}</a></p>
                                                        </td>
                                                        <td>{{ $informe->descripcion }}</td>
                                                        <td>{{ $informe->fechaRealizada }}</td>
                                                        <td>{{ $informe->reevaluo->descripcion }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--TARJETAS--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                            <div class="card-block">
                                            <h5>Usuarios</h5>
                                                @php
                                                 use App\Models\User;
                                                $cant_usuarios = User::count();
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{$cant_usuarios}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('usuarios.index') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                                            <div class="card-block">
                                            <h5>Roles</h5>
                                                @php
                                                use Spatie\Permission\Models\Role;
                                                 $cant_roles = Role::count();
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-user-lock f-left"></i><span>{{$cant_roles}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('roles.index') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xl-4">
                                        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                            <div class="card-block">
                                                <h5>Responsables</h5>
                                                @php
                                                    use App\Models\Responsable;
                                                   $cant_responsables = Responsable::count();
                                                @endphp
                                                <h2 class="text-right"><i class="fa fa-user-tag f-left"></i><span>{{$cant_responsables}}</span></h2>
                                                <p class="m-b-0 text-right"><a href="{{ route('responsables.index') }}" class="text-white">Ver más</a></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAPA --}}
            <div class="row">
                <div class="col-lg-8 col-sm-8 col-sm-11 col-xs-12">
                    <div class="form-group">
                        <div id="map-canvas" name="map"></div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-4 col-sm-11 col-xs-12">
                    {{--href="{{ route('home') }}"--}}
                    <form class="user" action="{{ route('home') }}" method="GET">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="ubicacion" id="label1">Inmuebles: </label>
                            <div class="col-md-12 col-sm-12 ">
                                {{--<select name="idInmueble" class="form-control-select2" id="idInmueble" onchange="onchangeEmpleadoId(this)">--}}
                                <select name="idInmueble" class="select2" id="idInmueble">
                                    <option value="">Seleccione un inmueble</option>
                                    @foreach ($inmuebles as $inmueble )
                                        <option value="{{ $inmueble->id }}" {{old('id',$inmueble->id)== $id ? 'selected':''}}>
                                            {{ $inmueble->codigo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Buscar">
                        <hr>
                    </form>

                    <div class="form-group">
                        <label for="ubicacion" id="label1">Grupo de Inmuebles: </label>
                        <div class="col-md-12 col-sm-12 ">
                            <select name="idGrupo" class="select2" id="idGrupo">
                                <option value="">Seleccione un grupo</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <footer class="card border-left-success border-bottom-secondary">
        <div class="container my-auto">
            <div class="text-center my-auto text-xs font-weight-bold text-ligth text-uppercase mb-1">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                <span>Contador de paginas: {{ $contador_menu->count }}</span>
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    {{--
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('change','.form-control-select2',function () {
                var prod_id=$(this).val();

                var a=$(this).parent();
                console.log(prod_id);
                var op="";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findPrice')!!}',
                    data:{'id':prod_id},
                    dataType:'json',//return data will be json
                    success:function(data){
                        console.log("latitud");
                        console.log(data.latitud);
                        // here latitud is coloumn name in products table data.coln name
                        a.find('.prod_price').val(data.latitud);
                    },
                    error:function(){
                    }
                });
            });
        });
    </script>

    <script>
        function onchangeEmpleadoId(element){
            let empleadoId = $(element).val();
            if (empleadoId){
                let ActividadFechaSelect = $('[name="ActividadFechaAnos[]"]');
                ActividadFechaSelect.empty();
                $.get(`/api/Empleados/${empleadoId}/Acciones`, function(xhr){
                    let ActividadPersonaAnos = xhr.ActividadPersonaAnos;
                    ActividadPersonaAnos.sort(function(a, b){return a - b});
                    for(let ano of ActividadPersonaAnos){
                        ActividadFechaSelect.append(`<option value="${ano}">${ano}</option>`)
                    }
                });
                ActividadFechaSelect.select2();
            }
        }
    </script>--}}

    {{-- MAPA --}}
    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'), {

            center: {
                @if(!empty($datosInmueble))
                lat: {{$datosInmueble->direccion->latitud}},
                lng: {{$datosInmueble->direccion->longitud}}
                @else
                    lat: -17.7762548,
                    lng: -63.1950715
                @endif
            },
            zoom: 15
        });

        var marker = new google.maps.Marker({
            position: {
                @if(!empty($datosInmueble))
                    lat: {{$datosInmueble->direccion->latitud}},
                    lng: {{$datosInmueble->direccion->longitud}}
                @else
                    lat: -17.7762548,
                    lng: -63.1950715
                @endif
            },
            map: map,
            draggable: true
        });

        var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
        google.maps.event.addListener(searchBox, 'places_changed', function () {
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;
            for (i = 0; place = places[i]; i++) {
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
            }
            map.fitBounds(bounds);
            map.setZoom(17);
        });
        google.maps.event.addListener(marker, 'position_changed', function () {
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            $('#lat').val(lat);
            $('#lng').val(lng);
        });
    </script>
@endsection


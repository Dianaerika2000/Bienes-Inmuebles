@extends('layouts.app')

@section('content')
    <style>
        #map-canvas {
            width: 500px;
            max-width: 100%;
            height: 370px;
            max-height: 100vh;
        }
    </style>
    <section class="section">
        <div class="section-header" style="background-color: {{ auth()->user()->color}}">
            <h3 class="page__heading">Registrar Nuevo Inmueble</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos! </strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-dark">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('inmuebles.store') }}" method="POST">
                                {{ csrf_field() }}
                                {{--@csrf--}}
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="idGrupo">Grupo
                                            <span class="required">*</span>
                                        </label>
                                        <div class="form-group">
                                            <select name="idGrupo" class="form-control" id="idGrupo">
                                                <option value="">Seleccione un grupo</option>
                                                @foreach ($grupos as $grupo )
                                                    <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <label class="col-form-label col-md-12 col-sm-12 label-align" id="idInmuebleLabel" for="idInmuebleLabel">Código del Terreno
                                                    <span class="required">*</span>
                                                </label>
                                                <select name="idInmueble" class="form-control" id="idInmueble">
                                                    <option value="">Seleccione un inmueble</option>
                                                    @foreach ($inmuebles as $inmueble)
                                                        <option value="{{ $inmueble->id }}"> <b>PREFIJO: {{ \Illuminate\Support\Str::limit($inmueble->codigo, 3,'')}}</b>
                                                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                            DETALLE: {{ $inmueble->descripcionGlosa}} ({{ $inmueble->codigo}})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="codigo">Código
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" id="codigo" name="codigo" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                            <label for="descripcionGlosa">Descripción</label>
                                            <textarea class="form-control" name="descripcionGlosa" style="height: 100px"></textarea>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <label class="col-form-label col-md-12 col-sm-12 label-align" for="fechaAdquisicion">Fecha de Adquisición
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="date" id="fechaAdquisicion" name="fechaAdquisicion"
                                                           required="required" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <label class="col-form-label col-md-12 col-sm-12 label-align" for="monto">Monto (Bs)<span class="required">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="number" step='0.01' id="monto" name="monto" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="col-form-label col-md-12 col-sm-12 label-align" for="idResponsable">Responsable
                                            <span class="required">*</span>
                                        </label>
                                        <div class="form-group">
                                            <select name="idResponsable" class="form-control" id="idResponsable" required>
                                                <option value="">Seleccione responsable</option>
                                                @foreach($responsables as $responsable)
                                                    <option value="{{$responsable->id}}">{{$responsable->nombre}} {{$responsable->Apellido}} - {{$responsable->codigoAsignado}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="col-form-label col-md-12 col-sm-12 label-align" for="idEstado">Estado
                                            <span class="required">*</span>
                                        </label>
                                        <div class="form-group">
                                            <select name="idEstado" class="form-control" id="idEstado" required>
                                                <option value="">Seleccione estado</option>
                                                @foreach ($estados as $estado )
                                                    <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="idDireccion2">Dirección
                                        </label>
                                        <div class="form-group">
                                            <select name="idDireccion" class="form-control" id="idDireccion" >
                                                <option value="">Seleccione una dirección</option>
                                                @foreach ($direcciones as $direccion )
                                                    <option value="{{ $direccion->id }}">{{ $direccion->ubicacion }}</option>
                                                    {{--<input type="text" id="latitud" name="latitud" class="form-control" value="{{$direccion->latitud}}">--}}
                                                    <?php $latitud=$direccion->latitud;
                                                    $longitud=$direccion->longitud;?>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    {{--MAPA DE DIRECCIÓN--}}
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="map-canvas" id="label0">Registrar Dirección
                                            <span class="required">*</span>
                                        </label>

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <div class="form-group">
                                                    <div id="map-canvas" name="map"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <div class="form-group">
                                                    <label for="ubicacion" id="label1">Ubicación: </label>
                                                    <input class="form-control input-sm" value="{{old('ubicacion')}}" type="text"
                                                           name="ubicacion" id="searchmap" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="lat" id="label2">Latitud: </label>
                                                    <input value="{{old('lat')}}" type="text"
                                                           class="form-control input-sm"
                                                           name="lat" id="lat">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lng" id="label3">Longitud: </label>
                                                    <input value="{{old('lng')}}" type="text"
                                                           class="form-control input-sm"
                                                           name="lng" id="lng">
                                                </div>
                                                <div class="form-group">
                                                    <label for="descripcion" id="label4">Descripción</label>
                                                    <textarea value="{{old('descripcion')}}" class="form-control input-sm" name="descripcion" id="descripcion" style="height: 100px"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 py-2">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a class="btn btn-secondary" href="{{route('inmuebles.index')}}">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>

        $(function () {
            $('#idInmueble').hide();
            $('#idInmuebleLabel').hide();
            $('#idGrupo').change(function () {
                if($('#idGrupo').val()!=2){
                    $('#idInmueble').show();
                    $('#idInmuebleLabel').show();
                }else{
                    $('#idInmueble').hide();
                    $('#idInmuebleLabel').hide();
                }
            });
        });

        $(function () {
            $('#idDireccion').change(function () {
                if($('#idDireccion').val()>0){

                    $('#label0').hide();
                    $('#label1').hide();
                    $('#label2').hide();
                    $('#label3').hide();
                    $('#label4').hide();

                    $('#map-canvas').hide();
                    $('#searchmap').hide();
                    $('#lat').hide();
                    $('#lng').hide();
                    $('#descripcion').hide();
                }else{
                    $('#label0').show();
                    $('#label1').show();
                    $('#label2').show();
                    $('#label3').show();
                    $('#label4').show();

                    $('#map-canvas').show();
                    $('#searchmap').show();
                    $('#lat').show();
                    $('#lng').show();
                    $('#descripcion').show();
                }
            });
        });

        var map = new google.maps.Map(document.getElementById('map-canvas'), {


            center: {
                lat: -17.7762548,
                lng: -63.1950715
            },
            zoom: 17
        });

        var marker = new google.maps.Marker({
            position: {
                lat: -17.7762548,
                lng: -63.1950715
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

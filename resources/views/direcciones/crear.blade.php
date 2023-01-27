@extends('adminlte::page')

@section('title', 'Crear Direccion')

@section('content_header')
<style>
    #map-canvas {
        width: 500px;
        max-width: 100%;
        height: 370px;
        max-height: 100vh;
    }
</style>

        <h3 class="page__heading">Registrar Nueva Dirección</h3>
@stop

@section('content')
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

                    <form action="{{ route('direcciones.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                <div class="form-group">
                                    <div id="map-canvas" name="map"></div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">

                                <div class="form-group">
                                    <label for="ubicacion">Ubicación</label>
                                    <input type="text" name="ubicacion" id="searchmap" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="lat">Latitud: </label>
                                    <input type="text"
                                           class="form-control input-sm"
                                           name="lat" id="lat" required>
                                </div>
                                <div class="form-group">
                                    <label for="lng">Longitud: </label>
                                    <input type="text"
                                           class="form-control input-sm"
                                           name="lng" id="lng" required>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <label for="descripcion">Descripción</label>
                                        <textarea class="form-control" name="descripcion" id="descripcion" style="height: 100px"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a class="btn btn-secondary" href="{{route('direcciones.index')}}">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
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
@stop

@section('css')
@stop

@section('js')
@stop

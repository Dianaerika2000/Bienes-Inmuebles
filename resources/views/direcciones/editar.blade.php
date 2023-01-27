@extends('adminlte::page')

@section('title', 'Editar Direccion')

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
        @section('content_header')
            <h3 class="page__heading">Editar Dirección</h3>
        @stop
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

                            <form action="{{ route('direcciones.update',$direccione->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                        <div class="form-group">
                                            <div id="map-canvas" name="map"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">

                                        <div class="form-group">
                                            <label for="ubicacion">Ubicación</label>
                                            <input type="text" name="ubicacion" id="searchmap"  value="{{$direccione->ubicacion}}" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="lat">Latitud: </label>
                                            <input value="{{$direccione->latitud}}" type="text"
                                                   class="form-control input-sm"
                                                   name="lat" id="lat" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lng">Longitud: </label>
                                            <input value="{{$direccione->longitud}}" type="text"
                                                   class="form-control input-sm"
                                                   name="lng" id="lng" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="descripcion">Descripción: </label>
                                            <input value="{{$direccione->descripcion}}" type="text" style="height: 100px"
                                                   class="form-control input-sm"
                                                   name="descripcion" id="descripcion">
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
    </section>

    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: {
                lat: {{$direccione->latitud}},
                lng: {{$direccione->longitud}}
            },
            zoom: 17
        });

        var marker = new google.maps.Marker({
            position: {
                lat: {{$direccione->latitud}},
                lng: {{$direccione->longitud}}
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


@extends('layouts.app')

@section('datatable_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endsection

@section('content')
    <style>
        #map-canvas {
            width: 100%;
            max-width: 100%;
            height: 600px;
            max-height: 100vh;
        }
    </style>

    <section class="section">
        <div class="section-header" style="background-color: {{ auth()->user()->color}}">
            <h3 class="page__heading">Ubicacion del Inmueble</h3>
        </div>
        <div class="section-body">
            <a class="btn btn-primary btn-lg my-2" href="{{ route('inmuebles.index') }}">
                <i class="bi bi-arrow-left-circle-fill"></i>
                Listado de inmuebles
            </a>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-sm-11 col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead style="background-color:#2239E8">
                                                <th style="display: none;">ID</th>
                                                <th style="color:#fff;">Ubicación</th>
                                                <th style="color:#fff;">Latitud</th>
                                                <th style="color:#fff;">Longitud</th>
                                                <th style="color:#fff;">Descripción</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="display: none;">{{ $direccion->id }}</td>
                                                    <td>{{$direccion->ubicacion}}</td>
                                                    <td>{{$direccion->latitud}}</td>
                                                    <td>{{$direccion->longitud}}</td>
                                                    <td>{{$direccion->descripcion}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-sm-11 col-xs-12">
                                    <div id="map-canvas" name="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: {
                lat: {{$direccion->latitud}},
                lng: {{$direccion->longitud}}
            },
            zoom: 17
        });

        var marker = new google.maps.Marker({
            position: {
                lat: {{$direccion->latitud}},
                lng: {{$direccion->longitud}}
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


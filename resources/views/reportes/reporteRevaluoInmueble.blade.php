<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Reporte</title>
        <link rel="stylesheet" href="{{ asset('UsuarioFacturar/assets/css/main.css') }}">
    </head>

    @if($tipoBase == 'inmuebles')
        <body>
        <div class="control-bar" style="background-color: #9A0000 !important">
            <div class="container">
                <div class="row">
                    <div class="col-2-4">
                        {{-- <div class="slogan">Capital de los activo fijo </div>

                        <label for="config_note">Nota:
                            <input type="checkbox" id="config_note" />
                        </label> --}}

                    </div>
                    <div class="col-4 text-right">
                        <a href="javascript:window.print()" style="color: #2A3964 !important">Imprimir</a>
                    </div>
                </div>
            </div>
        </div>

        <header class="row">
            <div class="logoholder text-center">
                <img src="{{ asset('UsuarioFacturar/assets/img/logo.png') }}">
            </div>

            <div class="me">
                <p>
                    <strong>ACTIVOS FIJO - INMUEBLES UAGRM</strong><br>
                    Santa Cruz de la Sierra<br>
                    Bolivia.<br>
                </p>
            </div>

            <div class="info">
                <p>
                    Web: <a href="">www.activos_fijos.com</a><br>
                    E-mail: <a href="mailto:grupo9_sa@gmail.com">Grupo9_sa@gmail.com</a><br>
                    Tel: +591-70837250<br>
                </p>
            </div>

            <div class="bank">
                <p contenteditable>
                    Usuario activo: {{\Illuminate\Support\Facades\Auth::user()->nombre}}<br>
                    Cargo: {{\Illuminate\Support\Facades\Auth::user()->getRoleNames()}} <br>
                    Fecha: {{\Carbon\Carbon::now()}}<br>
                </p>
            </div>
        </header>


        <div class="row section">
            <div class="col-2">
                <h1 contenteditable style="color: #2A3964 !important">Inmuebles</h1>
            </div>

            <div class="col-2 text-right details1">
                <p>
                    {{-- Reporte #: {{ $contador_reportes->count }}<br> --}}
                    Desde: {{$desde}}<br>
                    Hasta: {{$hasta}}
                </p>
            </div>

            <div class="col-2  details2">
                <p class="client">
                    <b>Detalle de los inmuebles: </b><br>
                    Activos Fijos: <input type="text" placeholder="UAGRM" /><br>
                </p>
            </div>
        </div>

        <div class="invoicelist-body">
            <table>
                <thead {{-- contenteditable --}}>
                    <th width="5%">Código</th>
                    {{--<th width="40%">Descripción</th>--}}
                    <th width="10%">Fecha Adquisición</th>
                    <th width="5%">Monto</th>
                    <th width="10%">Responsable</th>
                    <th width="10%">Grupo</th>
                    <th width="10%">Estado</th>
                    <th width="10%">Dirección</th>
                </thead>

                <tbody>
                @foreach ($activos as $activo)
                    <tr>
                        <td>{{ $activo->codigo }}</td>
                        {{--<td>{{ $activo->descripcionGlosa }}</td>--}}
                        <td>{{ $activo->fechaAdquisicion }}</td>
                        <td>{{ $activo->monto }}</td>
                        <td>{{ $activo->responsable->nombre}} {{ $activo->responsable->Apellido}}</td>
                        <td>{{ $activo->grupo->nombre}}</td>
                        <td>{{ $activo->estado->nombre }}</td>
                        @if($activo->direccion!=null)
                            <td>{{ $activo->direccion->ubicacion}}</td>
                        @else
                            <td>Sin dirección asignada</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>

            </table>
            {{--<a class="control newRow" href="#">+ Nueva fila</a>--}}
        </div>

        {{--<div class="invoicelist-footer">
            <table contenteditable>
                <tr>
                    <td><strong>Total:</strong></td>
                    <td id="total_price"></td>
                </tr>
            </table>
        </div>--}}

        <div class="note" contenteditable>
            <h2>Nota:</h2>
        </div>

        <footer class="row">
            <div class="col-1 text-center">
                <p class="notaxrelated" contenteditable>UAGRM - ACTIVOS FIJOS - BIENES INMUEBLES.</p>
            </div>
        </footer>

        <script>
            window.jQuery || document.write('<script src="{{ asset('UsuarioFacturar/assets/bower_components/jquery/dist/jquery.min.js') }}"><\/script>')
        </script>
        <script src="{{ asset('UsuarioFacturar/assets/js/main.js') }}"></script>

        </body>


    @else
        {{--REVALUOS--}}
        <body>
        <div class="control-bar" style="background-color: #9A0000 !important">
            <div class="container">
                <div class="row">
                    <div class="col-2-4">
                        {{-- <div class="slogan">Revaluos de los Activos Fijos</div>

                        <label for="config_note">Nota:
                            <input type="checkbox" id="config_note" />
                        </label> --}}

                    </div>
                    <div class="col-4 text-right">
                        <a href="javascript:window.print()" style="color: #2A3964 !important">Imprimir</a>
                    </div>
                </div>
            </div>
        </div>

        <header class="row">
            <div class="logoholder text-center">
                <img src="{{ asset('UsuarioFacturar/assets/img/logo.png') }}">
            </div>

            <div class="me">
                <p>
                    <strong>ACTIVOS FIJO - INMUEBLES UAGRM</strong><br>
                    Santa Cruz de la Sierra<br>
                    Bolivia.<br>
                </p>
            </div>

            <div class="info">
                <p>
                    Web: <a href="">www.activos_fijos.com</a><br>
                    E-mail: <a href="mailto:grupo9_sa@gmail.com">Grupo9_sa@gmail.com</a><br>
                    Tel: +591-78445533<br>
                </p>
            </div>

            <div class="bank">
                <p contenteditable>
                    Usuario activo: {{\Illuminate\Support\Facades\Auth::user()->nombre}}<br>
                    Cargo: {{\Illuminate\Support\Facades\Auth::user()->getRoleNames()}} <br>
                    Fecha: {{\Carbon\Carbon::now()}}<br>
                </p>
            </div>
        </header>


        <div class="row section">
            <div class="col-2">
                <h1 contenteditable style="color: #2A3964 !important">Revaluos de Inmuebles</h1>
            </div>

            <div class="col-2 text-right details1">
                <p>
                    {{-- Reporte #: {{ $contador_reportes->count }}<br> --}}
                    Desde: {{$desde}}<br>
                    Hasta: {{$hasta}}
                </p>
            </div>

            <div class="col-2  details2">
                <p class="client">
                    <b>Detalle de los Revaluos: </b><br>
                    Activos Fijos: <input type="text" placeholder="UAGRM" /><br>
                </p>
            </div>
        </div>

        <div class="invoicelist-body">
            <table>
                <thead {{-- contenteditable --}}>
                <th width="40%">Descripción</th>
                <th width="10%">Fecha Revaluo</th>
                <th width="10%">Costo Actualizado</th>
                <th width="10%">Valor Neto</th>
                <th width="10%">Inmueble</th>
                </thead>

                <tbody>
                @foreach ($activos as $activo)
                    <tr>
                        <td>{{ $activo->descripcion }}</td>
                        <td>{{ $activo->fechaRevaluo }}</td>
                        <td>{{ $activo->costoActualizado }} Bs.</td>
                        <td>{{ $activo->valorNeto }} Bs.</td>
                        <td>{{ $activo->inmueble->codigo }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            {{--<a class="control newRow" href="#">+ Nueva fila</a>--}}
        </div>

        {{--<div class="invoicelist-footer">
            <table contenteditable>
                <tr>
                    <td><strong>Total:</strong></td>
                    <td id="total_price"></td>
                </tr>
            </table>
        </div>--}}

        <div class="note" contenteditable>
            <h2>Nota:</h2>
        </div>

        <footer class="row">
            <div class="col-1 text-center">
                <p class="notaxrelated" contenteditable>UAGRM - ACTIVOS FIJOS - BIENES INMUEBLES.</p>
            </div>
        </footer>

        <script>
            window.jQuery || document.write('<script src="{{ asset('UsuarioFacturar/assets/bower_components/jquery/dist/jquery.min.js') }}"><\/script>')
        </script>
        <script src="{{ asset('UsuarioFacturar/assets/js/main.js') }}"></script>

        </body>
    @endif
</html>

@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="background-color: {{ auth()->user()->color}}">
            <h3 class="page__heading">Crear Nuevo Revaluo</h3>
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

                            <div class="alert alert-warning" role="alert">
                                <strong>CODIGO DE INMUEBLE:</strong> &nbsp;{{$inmueble->codigo}}
                            </div>

                            <form action="{{ route('revaluos.store', $inmueble->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{--@csrf--}}
                                <div class="row">
{{--
                                    <div class="col-lg-12 col-sm-12 col-sm-11 col-xs-12">
                                        <label class="col-form-label col-md-12 col-sm-12 label-align" for="idInmueble">Código del Inmueble
                                            <span class="required">*</span>
                                        </label>
                                        <select name="idInmueble" class="form-control" id="idInmueble">
                                            <option value="">Seleccione un inmueble</option>
                                            @foreach ($inmuebles as $inmueble)
                                                <option value="{{ $inmueble->id }}">
                                                    {{ $inmueble->codigo}} - DETALLE: {{ $inmueble->descripcionGlosa}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
{{--
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="idInmueble">{{$inmueble->codigo}}</label>
                                            <input style="display: none" type="date" name="idInmueble" id="idInmueble" class="form-control" value="{{$inmueble->id}}">
                                        </div>
                                    </div> --}}

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <label for="descripcion">Descripción</label>
                                        <textarea class="form-control" name="descripcion" style="height: 100px"></textarea>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaRevaluo">Fecha de Revaluo</label>
                                            <input type="date" name="fechaRevaluo" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="costo">Valor Actualizado en Revaluo (Bs)</label>
                                            <input type="number" step='0.01' id="costoActualizado" name="costoActualizado" required="required" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="costo">Valor anterior del Activo (Bs)</label>
                                            <input type="number" step='0.01' id="valorNeto" name="valorNeto" required="required" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <input type="text" class="form-control " name="idUsuario"
                                               value="{{ Auth::user()->id }}" hidden>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 py-2">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a class="btn btn-secondary" href="{{route('revaluos.index', $inmueble->id)}}">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

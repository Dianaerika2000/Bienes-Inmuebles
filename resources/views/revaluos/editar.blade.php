@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="background-color: {{ auth()->user()->color}}">
            <h3 class="page__heading">Editar Responsable</h3>
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

                    <form action="{{ route('revaluos.update',$revaluo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-lg-12 col-sm-12 col-sm-11 col-xs-12">
                                <label class="col-form-label col-md-12 col-sm-12 label-align" for="idInmueble">Código del Inmueble
                                    <span class="required">*</span>
                                </label>
                                <select name="idInmueble" class="form-control" id="idInmueble">
                                    <option value="">Seleccione un inmueble</option>
                                    @foreach ($inmuebles as $inmueble)
                                        <option value="{{ $inmueble->id }}"
                                                {{old('idInmueble',$inmueble->id)== $revaluo->idInmueble ? 'selected':''}}>
                                            {{ $inmueble->codigo}} - {{ $inmueble->descripcionGlosa}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="descripcionGlosa">Descripción</label>
                                <div class="form-group">
                                    <input type="text" id="descripcion" name="descripcion" value = "{{$revaluo->descripcion}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="fechaRevaluo">Fecha de Revaluo</label>
                                    <input type="date" name="fechaRevaluo" value = "{{$revaluo->fechaRevaluo}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="costo">Costo (Bs)</label>
                                    <input type="number" step='0.01' id="costo" name="costo" value = "{{$revaluo->costo}}" required="required" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="costo">Costo Actualizado (Bs)</label>
                                    <input type="number" step='0.01' id="costoActualizado" name="costoActualizado" value = "{{$revaluo->costoActualizado}}" required="required" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="costo">Depreciación Acumulada (Bs)</label>
                                    <input type="number" step='0.01' id="depreciacionAcumulada" name="depreciacionAcumulada" value = "{{$revaluo->depreciacionAcumulada}}" required="required" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="costo">Valor Neto (Bs)</label>
                                    <input type="number" step='0.01' id="valorNeto" name="valorNeto" value = "{{$revaluo->valorNeto}}" required="required" class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="text" class="form-control " name="idUsuario"
                                       value="{{ Auth::user()->id }}" hidden>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 py-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a class="btn btn-secondary" href="{{route('revaluos.index')}}">Cancelar</a>
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

@extends('adminlte::page')

@section('title', 'Crear fotografia')

@section('content')
    <section class="section">
    @section('content_header')
        <h3 class="page__heading">Asignar Fotografía</h3>
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

                            <form action="{{ route('fotografias.store') }}" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                {{--@csrf--}}
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <select name="idInmueble" class="form-control" id="idInmueble" required>
                                                <option value="">Seleccione un inmueble</option>
                                                @foreach ($inmuebles as $inmueble)
                                                    <option value="{{ $inmueble->id }}">
                                                        {{ $inmueble->grupo->nombre}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INMUEBLE: {{ $inmueble->descripcionGlosa}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="detalle">Detalle</label>
                                            <input type="text" name="detalle" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="url">Foto del inmueble/activo:</label>
                                            <input type="file" name="url" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaSubida">Fecha de Subida</label>
                                            <input type="date" name="fechaSubida" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a class="btn btn-secondary" href="{{route('fotografias.index')}}">Cancelar</a>
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

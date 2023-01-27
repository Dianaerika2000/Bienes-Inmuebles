@extends('adminlte::page')
@section('title', 'Responsables')
@section('content')
    <section class="section">
        @section('content_header')
        <h3 class="page__heading">Editar Responsable</h3>
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

                    <form action="{{ route('responsables.update',$responsable->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="codigoAsignado">Código</label>
                                   <input type="number" name="codigoAsignado" class="form-control" value="{{ $responsable->codigoAsignado }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" value="{{ $responsable->nombre }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="Apellido">Apellido</label>
                                    <input type="text" name="Apellido" class="form-control" value="{{ $responsable->Apellido }}">
                                </div>
                            </div>

                            {{--
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-floating">
                                    <label for="descripcion">Descripción</label>
                                    <textarea class="form-control" name="descripcion" style="height: 100px">{{ $responsable->descripcion }}</textarea>
                                </div>
                            </div>
                            --}}

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a class="btn btn-secondary" href="{{route('responsables.index')}}">Cancelar</a>
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

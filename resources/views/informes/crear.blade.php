@extends('adminlte::page')
@section('title', 'Crear Informe')
@section('content')
    <section class="section">
        @section('content_header')
        <h3 class="page__heading">Registrar Nuevo Informe</h3>
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

                            <div class="alert alert-success d-flex justify-content-between" role="alert">
                                <div>
                                    <strong>REVALUO DESCRIPCION:&nbsp;&nbsp;</strong>{{$revaluo->descripcion}}
                                </div>
                                <div>
                                    <strong>VALOR ACT. DE REVALUO:&nbsp;&nbsp;</strong>{{$revaluo->costoActualizado}} Bs.
                                </div>
                            </div>

                            <form action="{{ route('informes.store',$revaluo->id) }}" enctype="multipart/form-data" method="POST">
                                {{ csrf_field() }}
                                {{--@csrf--}}
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="url">Documento a subir:</label>
                                            <input type="file" name="url" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción:</label>
                                            <input type="text" name="descripcion" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="fechaRealizada">Fecha del informe realizado :</label>
                                            <input type="date" name="fechaRealizada" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="idRevaluo" class="form-control" value="{{$revaluo->id}}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 py-2">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <a class="btn btn-secondary" href="{{route('informes.index', $revaluo->id)}}">Cancelar</a>
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

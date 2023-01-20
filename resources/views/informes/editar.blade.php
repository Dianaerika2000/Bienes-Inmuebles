@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header" style="background-color: {{ auth()->user()->color}}">
            <h3 class="page__heading">Editar Informe</h3>
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

                    <form action="{{ route('informes.update',$informe->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="url">Documento a subir:</label>
                                    <p>Documento Actual:  <a href="{{asset($informe->url)}}" target="_blank" rel="noopener noreferrer">{{$informe->url}}</a></p>
                                    <input type="file" name="url" value="{{$informe->url}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input type="text" name="descripcion" class="form-control" value="{{ $informe->descripcion }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="fechaRealizada">Fecha del informe realizado :</label>
                                    <input type="date" name="fechaRealizada" value="{{$informe->fechaRealizada}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <select name="idRevaluo" class="form-control" id="idRevaluo" required>
                                        <option value="">Seleccione el reevaluo correspondiente</option>
                                        @foreach($revaluos as $revaluo )
                                            <option value="{{$revaluo->id}}"
                                                    {{old('idRevaluo',$revaluo->id)== $informe->idRevaluo ? 'selected':''}}
                                            >{{$revaluo->descripcion}} {{$revaluo->valorNeto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 py-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a class="btn btn-secondary" href="{{route('informes.index')}}">Cancelar</a>
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

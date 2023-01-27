@extends('adminlte::page')
@section('title', 'Editar fotografia')

@section('content')
    <section class="section">
        @section('content_header')
            <h3 class="page__heading">Editar Asignación de Fotografía</h3>
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

                    <form action="{{ route('fotografias.update',$fotografia->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <center>
                                        <img height="500px" width="500px" class="img-thumbnail" src="{{asset($fotografia->url)}}" alt="{{$fotografia->url}}">
                                    </center>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <select name="idInmueble" class="form-control" id="idInmueble" required>
                                        <option value="">Seleccione un inmueble</option>
                                        @foreach ($inmuebles as $inmueble)
                                            <option value="{{ $inmueble->id }}"
                                                    {{old('idInmueble',$inmueble->id)== $fotografia->idInmueble ? 'selected':''}}>
                                                {{ $inmueble->grupo->nombre}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INMUEBLE: {{ $inmueble->descripcionGlosa}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="detalle">Detalle</label>
                                    <input type="text" name="detalle" value="{{$fotografia->detalle}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="url">Foto del inmueble/activo:</label>
                                    <p>Fotografía Actual:  <a href="{{asset($fotografia->url)}}" target="_blank" rel="noopener noreferrer">{{$fotografia->url}}</a></p>
                                    <input type="file" name="url" value="{{$fotografia->url}}" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="fechaSubida">Fecha de Subida</label>
                                    <input type="date" name="fechaSubida" value="{{$fotografia->fechaSubida}}" class="form-control">
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

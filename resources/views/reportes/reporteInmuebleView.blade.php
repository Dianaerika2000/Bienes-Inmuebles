@extends('adminlte::page')
@section('title', 'Reportes')
@section('content')
    <section class="section">
        @section('content_header')
        <h3 class="page__heading">Generar Reporte</h3>
        @stop

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reportes por fechas</h5>
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

                            <form action="{{ route('reporteD') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <label class="col-form-label col-md-12 col-sm-12 label-align"
                                                    for="desde">Desde :
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="date" id="desde" name="desde" required="required"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <label class="col-form-label col-md-12 col-sm-12 label-align"
                                                    for="hasta">Hasta :
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="date" id="hasta" name="hasta" required="required"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">

                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <div class="form-group">
                                                    <select name="tipo" class="form-control" id="tipo" required>
                                                        <option value="">Seleccione una opción</option>
                                                        <option selected value="inmuebles">Inmuebles</option>
                                                        <option value="revaluos">Revaluos</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <button type="submit" target="_blank"
                                                    class="btn btn-primary">Generar</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reportes por grupos</h5>
                            <form action="{{ route('reporteDG') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <label class="col-form-label col-md-12 col-sm-12 label-align"
                                                    for="terreno">Codigo Inmueble Tipo B
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <input type="text" id="terreno" name="terreno" required="required"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <label class="col-form-label col-md-12 col-sm-12 label-align"
                                                    for="tipo">Grupo de Inmuebles
                                                    <span class="required">*</span>
                                                </label>
                                                <div class="form-group">
                                                    <select name="tipo" class="form-control" id="tipo" required>
                                                        <option selected value="">Seleccione una opción</option>
                                                        <option value="edificios">Grupo A - Edificios</option>
                                                        <option value="construcciones">Grupo C - Construcciones Complementarias</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-6 col-sm-11 col-xs-12">
                                                <button type="submit" target="_blank"
                                                    class="btn btn-primary">Generar</button>
                                            </div>
                                        </div>
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

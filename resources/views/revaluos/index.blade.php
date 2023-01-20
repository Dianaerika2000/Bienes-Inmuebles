@extends('layouts.app')

@section('datatable_css')

<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">


<link rel="stylesheet" href="{{ asset('css/main.css') }}">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap4.min.css"/>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

@endsection

@section('content')
    <section class="section">
        <div class="section-header" style="background-color: {{ auth()->user()->color}}">
            <h3 class="page__heading">Revaluos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        @can('crear-revaluo')
                        <a class="btn btn-warning my-2" href="{{ route('revaluos.create') }}">Nuevo</a>
                        @endcan
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead style="background-color:#2239E8">
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Descripción</th>
                                    <th style="color:#fff;">Fecha Revaluo</th>
                                    <th style="color:#fff;">Costo</th>
                                    <th style="color:#fff;">Costo Actualizado</th>
                                    <th style="color:#fff;">Depreciación</th>
                                    <th style="color:#fff;">Valor Neto</th>
                                    <th style="color:#fff;">Inmueble</th>
                                    <th style="color:#fff;">Acciones</th>
                              </thead>
                              <tbody>
                            @foreach ($revaluos as $revaluo)
                            <tr>
                                <td style="display: none;">{{ $revaluo->id }}</td>
                                <td>{{ $revaluo->descripcion }}</td>
                                <td>{{ $revaluo->fechaRevaluo }}</td>
                                <td>{{ $revaluo->costo }} Bs.</td>
                                <td>{{ $revaluo->costoActualizado }} Bs.</td>
                                <td>{{ $revaluo->depreciacionAcumulada }} Bs.</td>
                                <td>{{ $revaluo->valorNeto }} Bs.</td>
                                <td>{{ $revaluo->inmueble->codigo }} - {{ $revaluo->inmueble->descripcionGlosa }}</td>
                                <td>
                                    <form action="{{ route('revaluos.destroy',$revaluo->id) }}" method="POST" class="form-delete">
                                    @can('editar-revaluo')
                                        <a class="btn btn-info" href="{{ route('revaluos.edit',$revaluo->id) }}">Editar</a>
                                    @endcan

                                        @csrf
                                        @method('DELETE')
                                    @can('borrar-revaluo')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                    @endcan
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                            <!-- Ubicamos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {{--{!! $responsables->links() !!}--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="card border-left-success border-bottom-secondary">
            <div class="container my-auto">
                <div class="text-center my-auto text-xs font-weight-bold text-ligth text-uppercase mb-1">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    <span>Contador de visitas: {{ $contador_revaluos->count }}</span>
                </div>
            </div>
        </footer>
    </section>
@endsection

@section('scripts')
    {{-- cdn sweetAlert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'Revaluo eliminado con éxito.',
                'success'
            )
        </script>
    @endif
    <script>
        $('.form-delete').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estas seguro?',
                text: "¡Este revaluo se eliminara definitvamente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>



<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
                },
                //para usar los botones
                responsive: "true",
                // dom: 'Bfrtilp',
        dom: 'Bflrtip',
        buttons:[
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
                extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
                extend:    'print',
				text:      '<i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			},
		]
    });
});
</script>

@endsection

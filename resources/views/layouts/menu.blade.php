<body style="background-color:{{ auth()->user()->color }};">

    <ul class="navbar-nav accordion" id="accordionSidebar" style="background-color: {{ auth()->user()->color }}">

        <hr class="sidebar-divider my-0" style="background-color: {{ auth()->user()->color }}">
        <!-- PANEL ADMINISTRATIVO -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('home') }}" style="background-color: {{ auth()->user()->color }}">
                @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                    <i class="fas fa-fw fa-tachometer-alt" style="color:black"></i><span style="color:black">Panel
                        Administrativo</span>
                @elseif(auth()->user()->color === 'black')
                    <i class="fas fa-fw fa-tachometer-alt" style="color:white"></i><span style="color:white">Panel
                        Administrativo</span>
                @else
                    <i class="fas fa-fw fa-tachometer-alt" style="color:#1c0f5e"></i><span
                        style="color:#1c0f5e">Panel Administrativo</span>
                @endif
            </a>
        </li>
        <hr class="sidebar-divider" style="background-color: {{ auth()->user()->color }}">

        <!-- ADM. DE PERSONAL -->
        <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne" style="background-color: {{ auth()->user()->color }}">
                @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                    <i class="fas fa-fw fa-users" style="color:black"></i><span style="color:black">Adm. de
                        Personal</span>
                @elseif(auth()->user()->color === 'black')
                    <i class="fas fa-fw fa-users" style="color:white"></i><span style="color:white">Adm. de
                        Personal</span>
                @else
                    <i class="fas fa-fw fa-users" style="color:#1c0f5e"></i><span style="color:#1c0f5e">Adm. de
                        Personal</span>
                @endif
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('ver-usuario')
                        <a class="nav-link" href="{{ route('usuarios.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-users" style="color:black"></i><span style="color:black">Usuarios</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-users" style="color:white"></i><span style="color:white">Usuarios</span>
                            @else
                                <i class=" fas fa-users" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Usuarios</span>
                            @endif
                        </a>
                    @endcan
                    @can('ver-rol')
                        <a class="nav-link" href="{{ route('roles.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-user-lock" style="color:black"></i><span style="color:black">Roles</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-user-lock" style="color:white"></i><span style="color:white">Roles</span>
                            @else
                                <i class=" fas fa-user-lock" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Roles</span>
                            @endif
                        </a>
                    @endcan

                </div>
            </div>
        </li>

        <!-- ADM. DE INMUEBLES -->
        <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">

            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo" style="background-color: {{ auth()->user()->color }}">
                @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                    <i class="fas fa-fw fa-university" style="color:black"></i><span style="color:black">Adm. de
                        Inmuebles</span>
                @elseif(auth()->user()->color === 'black')
                    <i class="fas fa-fw fa-university" style="color:white"></i><span style="color:white">Adm. de
                        Inmuebles</span>
                @else
                    <i class="fas fa-fw fa-university" style="color:#1c0f5e"></i><span
                        style="color:#1c0f5e">Adm. de Inmuebles</span>
                @endif
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('ver-responsable')
                        <a class="nav-link" href="{{ route('responsables.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-user-tag" style="color:black"></i><span
                                    style="color:black">Responsables</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-user-tag" style="color:white"></i><span
                                    style="color:white">Responsables</span>
                            @else
                                <i class=" fas fa-user-tag" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Responsables</span>
                            @endif
                        </a>
                    @endcan
                    @can('ver-direccion')
                        <a class="nav-link" href="{{ route('direcciones.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-code-branch" style="color:black"></i><span
                                    style="color:black">Gestionar Direcciones</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-code-branch" style="color:white"></i><span
                                    style="color:white">Gestionar Direcciones</span>
                            @else
                                <i class=" fas fa-code-branch" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Gestionar Direcciones</span>
                            @endif
                        </a>
                    @endcan
                    @can('ver-fotografia')
                        <a class="nav-link" href="{{ route('fotografias.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-book" style="color:black"></i><span style="color:black">Gestionar
                                    Fotografías</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-book" style="color:white"></i><span style="color:white">Gestionar
                                    Fotografías</span>
                            @else
                                <i class=" fas fa-book" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Gestionar Fotografías</span>
                            @endif
                        </a>
                    @endcan
                    @can('ver-grupo')
                        <a class="nav-link" href="{{ route('grupos.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-book" style="color:black"></i><span style="color:black">Gestionar
                                    Grupos</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-book" style="color:white"></i><span style="color:white">Gestionar
                                    Grupos</span>
                            @else
                                <i class=" fas fa-book" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Gestionar Grupos</span>
                            @endif
                        </a>
                    @endcan
                    @can('ver-estado')
                        <a class="nav-link" href="{{ route('estados.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-book" style="color:black"></i><span style="color:black">Gestionar
                                    Estados</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-book" style="color:white"></i><span style="color:white">Gestionar
                                    Estados</span>
                            @else
                                <i class=" fas fa-book" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Gestionar Estados</span>
                            @endif
                        </a>
                    @endcan
                    @can('ver-inmueble')
                        <a class="nav-link" href="{{ route('inmuebles.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-university" style="color:black"></i><span style="color:black">Gestionar
                                    Inmuebles</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-university" style="color:white"></i><span style="color:white">Gestionar
                                    Inmuebles</span>
                            @else
                                <i class=" fas fa-university" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Gestionar Inmuebles</span>
                            @endif
                        </a>
                    @endcan
                </div>
            </div>
        </li>

        <!-- ADM. DE INFORMES Y PREPORTES -->
        <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree"
                style="background-color: {{ auth()->user()->color }}">
                @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                    <i class="fas fa-fw fa-info-circle" style="color:black"></i><span style="color:black">Adm. de
                        Informes y reportes</span>
                @elseif(auth()->user()->color === 'black')
                    <i class="fas fa-fw fa-info-circle" style="color:white"></i><span style="color:white">Adm. de
                        Informes y reportes</span>
                @else
                    <i class="fas fa-fw fa-info-circle" style="color:#1c0f5e"></i><span
                        style="color:#1c0f5e">Adm. de Informes y reportes</span>
                @endif
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('ver-reporte')
                        <a class="nav-link" href="{{ route('reportes.index') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-book" style="color:black"></i><span style="color:black">Estadísticas</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-book" style="color:white"></i><span style="color:white">Estadísticas</span>
                            @else
                                <i class=" fas fa-book" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Estadísticas</span>
                            @endif
                        </a>

                        <a class="nav-link" href="{{ route('reporteV') }}"
                            style="background-color: {{ auth()->user()->color }}">
                            @if (auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                                <i class=" fas fa-book-dead" style="color:black"></i><span style="color:black">Reporte
                                    PDF</span>
                            @elseif(auth()->user()->color === 'black')
                                <i class=" fas fa-book-dead" style="color:white"></i><span style="color:white">Reporte
                                    PDF</span>
                            @else
                                <i class=" fas fa-book-dead" style="color:#1c0f5e"></i><span
                                    style="color:#1c0f5e">Reporte PDF</span>
                            @endif
                        </a>
                    @endcan

                </div>
            </div>
        </li>
    </ul>

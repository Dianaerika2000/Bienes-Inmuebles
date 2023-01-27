{{-- @extends('adminlte::page') --}}

<form class="form-inline mr-auto" action="#" >
    <ul class="navbar-nav mr-3" >
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>

<ul class="navbar-nav navbar-right" >

    @if(\Illuminate\Support\Facades\Auth::user())
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/logo.png') }}"
                     class="rounded-circle mr-1 thumbnail-rounded user-thumbnail ">
                <div class="d-sm-none d-lg-inline-block">
                    @if(auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                        <div style="color:black">
                            Usuario activo: {{\Illuminate\Support\Facades\Auth::user()->nombre}}</div>
                </div>
                @elseif(auth()->user()->color === 'black')
                    <div style="color:white">
                        Usuario activo: {{\Illuminate\Support\Facades\Auth::user()->nombre}}</div>
                    </div>
                @else
                    <div style="color:white">
                        Usuario activo: {{\Illuminate\Support\Facades\Auth::user()->nombre}}</div>
                    </div>
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">
                    Bienvenido, {{\Illuminate\Support\Facades\Auth::user()->nombre}}</div>

                <a class="dropdown-item has-icon edit-profile" data-toggle="modal" data-target="#EditProfileModal" href="#"
                   data-id="{{ \Auth::id() }}"><i class="fa fa-user"></i>Editar perfil</a>

                <a class="dropdown-item has-icon" data-toggle="modal" data-target="#changePasswordModal" href="#"
                   data-id="{{ \Auth::id() }}"><i class="fa fa-lock"> </i>Cambiar contraseña</a>

                <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Salir
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    @else
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="#" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">{{ __('messages.common.hello') }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ __('messages.common.login') }}
                    / {{ __('messages.common.register') }}</div>
                <a href="{{ route('login') }}" class="dropdown-item has-icon">
                    <i class="fas fa-sign-in-alt"></i> {{ __('messages.common.login') }}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('register') }}" class="dropdown-item has-icon">
                    <i class="fas fa-user-plus"></i> {{ __('messages.common.register') }}
                </a>
            </div>
        </li>
    @endif
</ul>

<ul class="navbar-nav navbar-right" style="background-color: {{ auth()->user()->color}}">

    <li class="dropdown">
        <a href="#" data-toggle="dropdown"
           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            @if(auth()->user()->color === 'white' || auth()->user()->color === 'skyblue')
                <div class="d-sm-none d-lg-inline-block" style="color:black">Estilos:</div>
                <i class="fas fa-list-alt" style="color:black"></i>
            @elseif(auth()->user()->color === 'black')
                <div class="d-sm-none d-lg-inline-block" style="color:white">Estilos:</div>
                <i class="fas fa-list-alt" style="color:white"></i>
            @else
                <div class="d-sm-none d-lg-inline-block" style="color:white">Estilos:</div>
                <i class="fas fa-list-alt" style="color:white"></i>
            @endif
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            {{--Colores--}}
            <form class="px-4 mt-3" method="POST" action="{{ route('fondo') }}">
                {!! csrf_field() !!}
                <a class="dropdown-item has-icon text-danger">
                    <i class="fas fa-adjust"></i><h6 class="control-sidebar-heading">TEMAS</h6>
                    <input id="navbar1" type="radio" name="color" value="skyblue"
                            {{(auth()->user()->color == 'skyblue')? 'checked' : '' }}>Modo Día<br>
                    <input id="navbar2" type="radio" name="color" value="black"
                            {{(auth()->user()->color == 'black')? 'checked' : '' }}>Modo Noche<br>
                    <input id="navbar3" type="radio" name="color" value="yellow"
                            {{(auth()->user()->color == 'yellow')? 'checked' : '' }}>Niños<br>
                    <input id="navbar4" type="radio" name="color" value="purple"
                            {{(auth()->user()->color == 'purple')? 'checked' : '' }}>Jovenes<br>
                    <input id="navbar5" type="radio" name="color" value="green"
                            {{(auth()->user()->color == 'green')? 'checked' : '' }}>Adultos<br>
                    <input id="navbar6" type="radio" name="color" value="blue"
                            {{(auth()->user()->color == 'blue')? 'checked' : '' }}>Azul<br>
                    <input id="navbar7" type="radio" name="color" value="white"
                            {{(auth()->user()->color == 'white')? 'checked' : '' }}>Blanco<br>
                    <input id="navbar8" type="radio" name="color" value="red"
                            {{(auth()->user()->color == 'red')? 'checked' : '' }}>Rojo<br>
                    <input id="navbar9" type="radio" name="color" value=""
                            {{(auth()->user()->color == '')? 'checked' : '' }}>Normal<br>
                    <button class="btn btn-primary" type="submit"><span class="fa fa-save"></span></button>
                </a>
            </form>
            {{--Letras--}}
            <form method="POST" action="{{ route('letra') }}">
                {!! csrf_field() !!}
                <a class="dropdown-item has-icon text-danger">
                    <i class="fas fa-pen-alt"></i><h6 class="control-sidebar-heading">TIPO LETRA</h6>
                    <div class="form-group px-12 mt-2 d-flex justify-content-between">
                        <select name="letra"  class="form-control" >
                            <option value="Courier"{{(auth()->user()->letra == 'Courier')? 'selected':''}}>Courier</option>
                            <option value="Verdana"{{(auth()->user()->letra == 'Verdana')? 'selected':''}}>Verdana </option>
                            <option value="Georgia"{{(auth()->user()->letra == 'Georgia')? 'selected':''}}>Georgia </option>
                            <option value="Helvetica"{{(auth()->user()->letra == 'Helvetica')? 'selected':''}}>Helvetica </option>
                            <option value="Times"{{(auth()->user()->letra == 'Times')? 'selected':''}}>Times</option>
                            <option value="Cursive"{{(auth()->user()->letra == 'Cursive')? 'selected':''}}>Cursiva</option>
                            <option value="Serif"{{(auth()->user()->letra == 'Serif')? 'selected':''}}>Serif</option>
                            <option value="Monospace"{{(auth()->user()->letra == 'Monospace')? 'selected':''}}>Monospace</option>
                            <option value="Fantasy"{{(auth()->user()->letra == 'Fantasy')? 'selected':''}}>Fantasy</option>
                            <option value="Italic"{{(auth()->user()->letra == 'Italic')? 'selected':''}}>Italic</option>
                            <option value="Arial"{{(auth()->user()->letra == 'Arial')? 'selected':''}}>Arial</option>
                            <option value=""{{(auth()->user()->letra == '')? 'selected':''}}>Predeterminado</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span></button>
                    </div>
                </a>
            </form>
        </div>
    </li>
</ul>

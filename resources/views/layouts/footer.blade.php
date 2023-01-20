@if(auth()->user()->color === 'white' || auth()->user()->colorNavbar === 'skyblue')
    <div class="footer-left" style="color:black">
        @yield('contentFooter')
        <small>Todos los derechos reservados - Tecnología Web - Grupo 9 &copy; {{ date('Y') }}</small>
    </div>
@elseif(auth()->user()->color === 'black')
    <div class="footer-left" style="color:white">
        @yield('contentFooter')
        <small>Todos los derechos reservados - Tecnología Web - Grupo 9 &copy; {{ date('Y') }}</small>
    </div>
@else
    <div class="footer-left" style="color:deepskyblue">
        @yield('contentFooter')
        <small>Todos los derechos reservados - Tecnología Web - Grupo 9 &copy; {{ date('Y') }}</small>
    </div>
@endif
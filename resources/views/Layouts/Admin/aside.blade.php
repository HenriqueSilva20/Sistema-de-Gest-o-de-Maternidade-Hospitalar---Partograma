<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        style="background-color: rgb(153, 0, 255) !important;" href="index.html">
        <!--div class="sidebar-brand-icon">
        <img src="img/logo/logo2.png">
        </div--->
        <div class="sidebar-brand-text" style="font-size: 2rem;"><span style="color: rgb(255, 204, 0);">S</span>.G.<span
                style="color: rgb(255, 204, 0);">M</span>.H
        </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('painel.admin') }}">
            <i class="fa fa-fw fa-home"></i>
            <span>Painel</span></a>
    </li>
    @if (Auth::user()->acesso == 1)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('painel.administradores') }}">
                <i class="fa fa-fw fa-user-graduate"></i>
                <span>Administradores</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('painel.medicos') }}">
                <i class="fa fa-fw fa-user-nurse"></i>
                <span>Médicos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('painel.recepcionistas') }}">
                <i class="fa fa-fw fa-user-astronaut"></i>
                <span>Recepcionistas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('painel.pacientes') }}">
                <i class="fa fa-fw fa-users"></i>
                <span>Pacientes</span>
            </a>
        </li>
    @elseif (Auth::user()->acesso == 2)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('painel.pacientes') }}">
                <i class="fa fa-fw fa-users"></i>
                <span>Pacientes</span>
            </a>
        </li>
    @elseif (Auth::user()->acesso == 3)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('painel.pacientes') }}">
                <i class="fa fa-fw fa-users"></i>
                <span>Pacientes</span>
            </a>
        </li>
    @endif
    <!--li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Actividades</span>
        </a>
    </li-->
</ul>
<!-- Sidebar -->

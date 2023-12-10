<!-- BEGIN SIDEBAR -->
<div class="page-sidebar " id="main-menu">
  <!-- BEGIN MINI-PROFILE -->
  <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
    <div class="user-info-wrapper sm">
      <div class="profile-wrapper sm">
        <img src="{{ asset('back/assets/img/profiles/avatar.jpg') }}" alt="" data-src="{{ asset('back/assets/img/profiles/avatar.jpg') }}" data-src-retina="{{ asset('back/assets/img/profiles/avatar2x.jpg') }}" width="69" height="69" />
        <div class="availability-bubble online"></div>
      </div>
      <div class="user-info sm">
        <div class="username">{{ Auth::user()->name }}</div>
        <div class="status">{{ Auth::user()->email }}</div>
      </div>
    </div>
    <!-- END MINI-PROFILE -->
    <!-- BEGIN SIDEBAR MENU -->
    <p class="menu-title sm">ADMIN</p>
    <ul>
      <li class="start ">
        <a href="{{ route('admin.home') }}"> <i class="material-icons">home</i> <span class="title">Dashboard</span> </a>
      </li>
      <li>
        <a href="javascript:;"> <i class="material-icons">airplay</i> <span class="title">Información general</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          <li> <a href="{{ route('generales.index') }}"> Misión & Visión </a> </li>
          <li> <a href="{{ route('miembros.index') }}">Directorio </a> </li>
          <li> <a href="{{ route('generales.index') }}#tabMapa"> Ubicación </a> </li>
          <li> <a href="{{ route('sliders.index') }}">Sliders </a> </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;"> <i class="material-icons">apps</i> <span class="title">Servicios</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          <li><a href="{{ route('formularios.index') }}">Formularios</a></li>
          <li><a href="{{ route('requisitos.index') }}">Requisitos</a></li>
          <li><a href="{{ route('consultas.index') }}">Consultas</a></li>
        </ul>
      </li>
      <li>
        <a href="javascript:;"> <i class="material-icons">apps</i> <span class="title">Turnos</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          <li><a href="{{ route('turnos.index') }}">Calendario</a></li>
        </ul>
      </li>
      <li>
        <a href="javascript:;"> <i class="material-icons">invert_colors</i> <span class="title">Noticias</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          <li> <a href="{{ route('noticias.create') }}">Crear noticia</a> </li>
          <li> <a href="{{ route('noticias.index') }}">Listado</a> </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;"> <i class="material-icons">invert_colors</i> <span class="title">Placas</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          <li> <a href="{{ route('placas.create') }}">Subir placas</a> </li>
          <li> <a href="{{ route('placas.index') }}">Listado</a> </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;"> <i class="material-icons">layers</i> <span class="title">Documentos</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          <li> <a href="{{ route('documentos.index') }}">Listado </a> </li>
          <li> <a href="{{ route('categorias.index') }}">Categorías</a> </li>
        </ul>
      </li>
      <li>
        <a href="javascript:;"> <i class="material-icons">view_stream</i> <span class="title">Lotaip</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          <li> <a href="{{ route('lotaip.index') }}">Documentos </a> </li>
          <li> <a href="{{ route('articulos.index') }}">Artículos</a> </li>
          <li> <a href="{{ route('periodos.index') }}">Periodos</a> </li>
        </ul>
      </li>        
        <li >
          <a href="{{ route('usuarios.index') }}"> <i class="material-icons">person</i> <span class="title">Usuarios</span> </a>
        </li>  

        <li >
          <a href="{{ url('/') }}" target="_blank"> <i class="material-icons">home</i> <span class="title">Ver página de inicio</span> </a>
        </li>
    </ul>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
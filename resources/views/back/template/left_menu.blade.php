<!-- BEGIN SIDEBAR -->
<div class="page-sidebar " id="main-menu">
  <!-- BEGIN MINI-PROFILE -->
  <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
    <div class="user-info-wrapper sm">
      <div class="profile-wrapper sm">
        <img src="{{ asset('front/img/users/'.Auth::user()->imagen) }}" alt="" data-src="{{ asset('front/img/users/'.Auth::user()->imagen ) }}" data-src-retina="{{ asset('back/assets/img/profiles/avatar2x.jpg') }}" width="69" height="69" />
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
      @canany(['listar configs','listar miembros','listar sliders'])
      <li>
        <a href="javascript:;"> <i class="material-icons">airplay</i> <span class="title">Información general</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          @can('listar configs')
          <li> <a href="{{ route('generales.index') }}"> Datos generales </a> </li>
          @endcan
          @can('listar miembros')
          <li> <a href="{{ route('miembros.index') }}">Directorio </a> </li>
          @endcan
          @can('listar sliders')
          <li> <a href="{{ route('sliders.index') }}">Sliders </a> </li>
          @endcan
        </ul>
      </li>
      @endcanany
      @canany(['listar formularios','listar requisitos','listar consultas'])
      <li>
        <a href="javascript:;"> <i class="material-icons">panorama_horizontal</i> <span class="title">Servicios</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          @can('listar formularios')
          <li><a href="{{ route('formularios.index') }}">Formularios</a></li>
          @endcan
          @can('listar requisitos')
          <li><a href="{{ route('requisitos.index') }}">Requisitos</a></li>
          @endcan
          @can('listar consultas')
          <li><a href="{{ route('consultas.index') }}">Consultas</a></li>
          @endcan
        </ul>
      </li>
      @endcanany

      @canany(['listar turnero','crear turnero'])
      <li>
        <a href="javascript:;"> <i class="material-icons">apps</i> <span class="title">Turnos</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          @can('crear turnero')
          <li><a href="{{ route('turnos.create') }}">Crear turno</a></li>
          @endcan
          @can('listar turnero')
          <li><a href="{{ route('turnos.index') }}">Listado</a></li>
          <li><a href="{{ route('sucursales.index') }}">Sucursales</a></li>
          <li><a href="{{ route('digitos.index') }}">Dígitos</a></li>
          <li><a href="{{ route('turnos.reportes') }}">Exportar</a></li>
          @endcan
        </ul>
      </li>
      @endcanany

      @canany(['listar noticias','crear noticias'])
      <li>
        <a href="javascript:;"> <i class="material-icons">invert_colors</i> <span class="title">Noticias</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          @can('crear noticias')
          <li> <a href="{{ route('noticias.create') }}">Crear noticia</a> </li>
          @endcan
          @can('listar noticias')
          <li> <a href="{{ route('noticias.index') }}">Listado</a> </li>
          @endcan
        </ul>
      </li>
      @endcanany

      @canany(['listar placas','subir placas'])
      <li>
        <a href="javascript:;"> <i class="material-icons">view_stream</i> <span class="title">Placas</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          @can('subir placas')
          <li> <a href="{{ route('placas.create') }}">Subir placas</a> </li>
          @endcan
          @can('listar placas')
          <li> <a href="{{ route('placas.index') }}">Listado</a> </li>
          @endcan
        </ul>
      </li>
      @endcanany
      @canany(['listar documentos','listar categorias'])
      <li>
        <a href="javascript:;"> <i class="material-icons">layers</i> <span class="title">Documentos</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          @can('listar documentos')
          <li> <a href="{{ route('documentos.index') }}">Listado </a> </li>
          @endcan
          @can('listar categorias')
          <li> <a href="{{ route('categorias.index') }}">Categorías</a> </li>
          @endcan
        </ul>
      </li>
      @endcanany
      @canany(['listar lotaip ','listar articulos','  listar periodos'])
      <li>
        <a href="javascript:;"> <i class="material-icons">flip</i> <span class="title">Lotaip</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          @can('listar lotaip')
          <li> <a href="{{ route('lotaip.index') }}">Documentos </a> </li>
          @endcan
          @can('listar articulos')
          <li> <a href="{{ route('articulos.index') }}">Artículos</a> </li>
          @endcan
          @can('listar periodos')
          <li> <a href="{{ route('periodos.index') }}">Periodos</a> </li>
          @endcan
        </ul>
      </li>
      @endcanany
      @canany(['listar usuarios ','listar roles','  listar permisos'])
      <li>
        <a href="javascript:;"> <i class="material-icons">person</i> <span class="title">Seguridad</span> <span class=" arrow"></span> </a>
        <ul class="sub-menu">
          @can('listar usuarios')
          <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
          @endcan
          @can('listar roles')
          <li> <a href="{{ route('roles.index') }}">Roles</a></li>
          @endcan
          @can('listar permisos')
          <li> <a href="{{ route('permisos.index') }}">Permisos</a></li>
          @endcan
        </ul>
      </li>
      @endcanany
      @canany (['atender'])
      <li>
        <a href="{{ route('turno.atender') }}"> <i class="material-icons">home</i> <span class="title">Atender</span> </a>
      </li>
      @endcanany
      @canany(['buscar'])
      <li>
        <a href="{{ route('buscar.form') }}"> <i class="material-icons">home</i> <span class="title">Buscar</span> </a>
      </li>
      @endcanany

        <li >
          <a href="{{ url('/') }}" target="_blank"> <i class="material-icons">home</i> <span class="title">Ver página de inicio</span> </a>
        </li>
    </ul>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
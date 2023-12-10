<header>
	<nav class="navbar navbar-default navbar-alt" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			    </button>
                <a class="navbar-brand @if(Request::url()==route('home')) to-top @endif" rel="home" href="{{ route('home') }}">
                	<img src="{{ asset('front/img/assets/logo-negro.png') }}" alt="EPMC" class="logo-big">
                    <img src="{{ asset('front/img/assets/logo-blanco.png') }}" alt="EPMC" class="logo-small">
                </a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="nav navbar-nav  navbar-right">
                    
                    <li><a href="{{ route('home') }}">Inicio</a></li>

                    <li class="dropdown to-section">
                        <a href="#services" class="dropdown-toggle" data-toggle="dropdown">Servicios <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('turnero.seleccion') }}">Sistema de turnos</a></li> 
                            <li><a href="{{ route('consultas') }}">Consultas</a></li> 
                            <li><a href="{{ route('requisitos') }}">Requisitos</a></li>
                            <!--<li><a href="{{ route('solicitudes') }}">Solicitudes</a></li>-->
                            <li><a href="{{ route('formularios') }}">Formularios</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown to-section">
                        <a href="#features" class="dropdown-toggle" data-toggle="dropdown">Institución <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('quienes_somos') }}">Quienes Somos</a></li>
                            <li><a href="{{ route('administrativos') }}">Equipo Administrativo</a></li> 
                            <li><a href="{{ route('directorio') }}">Equipo Directivo</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <span class="dropdown-toggle" data-toggle="dropdown">Transparencia <b class="caret"></b></span>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('lotaip') }}">LOTAIP</a></li>
                            @foreach($categorias_data as $categoria)
                                <li><a href="{{ route('documentos',$categoria->slug) }}">{{ $categoria->categoria }}</a></li>
                            @endforeach
                        </ul>
                    </li> 

                    <li class="to-section"><a href="{{ route('noticias') }}">Informate</a></li>
                    
                    <li class="to-section"><a href="#contact">Contactos</a></li>
                    <li><a class="social-icon" href="{{ $general->where('nombre','=','twitter')->first()->valor}}" target="_blank"><i class="icon icon-social-twitter"></i></a></li>
                    <li><a class="social-icon" href="{{ $general->where('nombre','=','facebook')->first()->valor}}" target="_blank"><i class="icon icon-social-facebook"></i></a></li>
                    <li><a class="social-icon" href="mailto:{{ $general->where('nombre','=','email')->first()->valor}}"><i class="icon icon-support"></i></a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav>
</header>
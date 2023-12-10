<footer id="footer">
    <div class="footer-widgets">
        <div class="container"> 
                
                <div class="col-md-4 col-sm-6 col-twitter">
                    <h4>Últimas noticias</h4>
                    <ul class="contact-details">
                    @foreach($ultimas_noticias as $not)
                        <li><a href="{{ route('noticia',$not->slug) }}">{{ $not->titulo }}</a></li>
                    @endforeach
                    </ul>
                </div>
                
                <div class="col-md-4 col-sm-6 col-footer">
                    <div class="contact">
                        <h4>Contáctanos ahora</h4>
                        <ul class="contact-details">
                            <li><p><i class="icon ion-ios-location-outline highlight"></i>{{ $general->where('nombre','=','direccion')->first()->valor}}</p></li>
                            <li><p><i class="icon ion-ios-telephone highlight"></i> {{ $general->where('nombre','=','telefono')->first()->valor}}</p></li>
                            <li><p><i class="icon ion-android-mail highlight"></i> <a href="{{ $general->where('nombre','=','email')->first()->valor }}">{{ $general->where('nombre','=','email')->first()->valor}}</a></p></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4 col-sm-6 col-footer">
                    <h4>Enlaces útiles</h4>
                     <ul class="contact-details">
                        <li><p><a href="{{ route('noticias') }}">Noticias</a></p></li>
                        <li><p><a href="{{ route('formularios') }}">Formularios</a></p></li>
                        <li><p><a href="{{ route('requisitos') }}">Requisitos</a></li>
                        <li><p><a href="{{ route('consultas') }}">Consultas</a></li>
                        <li><p><a href="{{ route('login') }}">Iniciar sesión</a></li>
                    </ul>
                </div>
                 
        </div>
    </div><!-- End Footer Widgets -->
    
	<div class="footer-copyright">
		<div class="container">
			<div class="row">
					
				<div class="col-md-6 col-sm-12">
					<p>© 2020. Todos los derechos reservados. </p>
				</div>
				<div class="col-md-6 col-sm-12">
	                <ul id="social-icons">
			            <li><a href="{{ $general->where('nombre','=','facebook')->first()->valor}}"><i class="icon ion-social-twitter"></i></a></li> 	
                        <li><a href="{{ $general->where('nombre','=','twitter')->first()->valor}}"><i class="icon ion-social-facebook"></i></a></li> 
                    </ul>
				</div>
			</div>
		</div>
	</div><!-- End Footer Copyright -->
</footer>
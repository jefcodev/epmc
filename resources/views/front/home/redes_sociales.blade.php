<section id="get-connected" class="parallax-section-4">
    <div class="container"> 
    	
        <div class="col-md-12 text-center">
            <!--<h3 class="section-title white wow fadeInUp">Contáctanos.</h3> -->
            <p class="subheading grey wow fadeInUp">Mantente conectado con nosotros a través de nuestras <span class="highlight">redes</span> sociales!</p>
        </div>
        
        <div class="row text-center wow fadeInUp">
        	<ul class="connected-icons text-center">
                
					<li class="connected-icon">
                    <a target="_blank" href="{{ $general->where('nombre','=','facebook')->first()->valor}}">
                        <span class="icon icon-social-facebook size-6x"></span>
                        <h4 class="white">Facebook</h4>
                        <span class="grey">Conócenos</span>
                    </a>
                </li>
                
                <li class="connected-icon">
                    <a target="_blank" href="{{ $general->where('nombre','=','twitter')->first()->valor}}">
                        <span class="icon icon-social-twitter size-6x"></span>
                        <h4 class="white">Twitter</h4>
                        <span class="grey">Síguenos</span>
                    </a>
                </li>
        	</ul>        
    	</div>  
        
    </div>
</section>
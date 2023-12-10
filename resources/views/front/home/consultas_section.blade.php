<section id="features">
    <div class="container">                      
        <div class="row features-row wow fadeInUp">
            <div class="col-md-12 shortcode-title wow fadeIn">
                <h3 class="section-title">Consultas</h3> 
                <p class="subheading">Utiliza nuestros accesos directos para consultar</p>
            </div>
            @foreach($consultas as $consulta)
            <div class="col-md-4 col-sm-12 feature-column">
                <div class="feature-icon">
                    <i class="icon-magnifier-remove size-2x highlight"></i>
                    <i class="icon-magnifier-remove back-icon"></i>
                </div>
                <div class="feature-info">
                    <h4>{{ $consulta->nombre }}</h4>
                    <p class="feature-description"><a href="{{ $consulta->url }}" target="_blank">Consultar</a></p>
                </div>
            </div>
            @endforeach
                    
        </div>   
        
    </div>
</section>
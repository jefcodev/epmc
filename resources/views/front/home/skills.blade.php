<section id="skills" class="parallax-section-2"> 
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 skills-row">
                <h4 class="content-title white wow fadeInUp">Requisitos</h4>         
                <p class="grey wow fadeInUp">
                	<ul>
                		@foreach($requisitos as $r)
                		<li><a href="{{ asset('requisitos/'.$r->ruta) }}" target="_blank">{{ $r->nombre }}</a></li>
                		@endforeach
                	</ul>
                </p> 
            </div>
            
            <div class="col-md-6 col-sm-12 wow fadeInUp">
                <h4 class="content-title white wow fadeInUp">Formularios</h4>         
                <p class="grey wow fadeInUp">
                	<ul>
                		@foreach($formularios as $f)
                		<li><a href="{{ asset('uploads/'.$f->ruta) }}" target="_blank">{{ $f->nombre }}</a></li>
                		@endforeach
                	</ul>
                </p> 
            </div>
        
        </div>
    </div>
</section>
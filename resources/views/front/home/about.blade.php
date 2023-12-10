<section id="about" class="parallax-section-1"> 
    <div class="container">
        <div class="row">
            
            <div class="col-md-6 text-left about-text">
                <h2 class="content-title white wow fadeInUp">{!! $general->where('nombre','=','movilidad_de_cotopaxi')->first()->valor !!}</h2>          
                <p class="grey wow fadeInUp text-justify">
                    {!! $general->where('nombre','=','quienes_somos')->first()->valor !!}
                </p> 
            </div>
            
            <div class="col-md-6 wow fadeInUp about-text">
                <h2 class="content-title white wow fadeInUp">Misión</h2>          
                <p class="grey wow fadeInDown text-justify">{{ $general->where('nombre','=','mision')->first()->valor}}</p>
                <h2 class="content-title white wow fadeInUp">Visión</h2>
                <p class="grey wow fadeInDown text-justify">{{ $general->where('nombre','=','vision')->first()->valor}}</p>
                <!--<div class="video-container">
                    <iframe src="http://player.vimeo.com/video/115919099?title=0&amp;byline=0&amp;portrait=0&amp;color=fff" allowfullscreen></iframe>
                </div>-->
            </div>

        </div>
    </div>
</section>
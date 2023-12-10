<section id="shortcodes"  class="parallax-section-2">
    <div class="container"> 
        <div class="row shortcode-heading">
            
            <div class="col-md-12 shortcode-title wow fadeIn ">
                <h3 class="section-title white">Requisitos</h3> 
                <p class="subheading semi-white">Conoce los requisitos para realizar tus trámites fácilmente</p>
            </div>
            
            @foreach($requisitos->chunk(5) as $chunk)
                <div class="col-md-6">

                        <div class="panel-group wow fadeIn grupo-requisitos" id="toggle">
                            <!-- First Panel -->
                           @foreach($chunk as $r)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                         <h4 class="panel-title collapsed" data-toggle="collapse" data-target="#collapse{{ $r->id }}" data-parent=".grupo-requisitos">
                                             {{ $r->nombre }}
                                         </h4>
                                    </div>
                                    <div id="collapse{{ $r->id }}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <a href="{{ asset('requisitos/'.$r->ruta) }}" target="_blank">
                                                <img src="{{ asset('requisitos/'.$r->ruta) }}" alt="{{ $r->nombre }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                </div>
            @endforeach
            <!--<div class="col-md-12">
                <button id="collapse-init" class="btn btn-primary">Abrir todos</button>
            </div>-->
        </div>
    </div>
</section>
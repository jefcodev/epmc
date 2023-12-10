<section id="shortcodes"  class="parallax-section-2">
    <div class="container"> 
        <div class="row shortcode-heading">
            
            <div class="col-md-12 shortcode-title wow fadeIn ">
                <h3 class="section-title white">Requisitos y Formularios</h3> 
                <p class="subheading">Descarga tus documentos y realiza tus trámites fácilmente</p>
            </div>
            
            <div class="col-md-6">

                    <div class="panel-group wow fadeIn" id="accordion">
                        <!-- First Panel -->
                        @foreach($requisitos as $r)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                     <h4 class="panel-title collapsed" data-toggle="collapse" data-target="#collapse{{ $r->id }}">
                                         {{ $r->nombre }}
                                     </h4>
                                </div>
                                <div id="collapse{{ $r->id }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <a href="{{ asset('requisitos/'.$r->ruta) }}" target="_blank">{{ $r->nombre }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                           

                    </div>

                   <!-- <button id="collapse-init" class="btn btn-primary">Open All</button>-->

            </div>

            <div class="col-md-6">

                    <div class="panel-group wow fadeIn" id="toggle">
                        <!-- First Panel -->
                        @foreach($formularios as $f)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                     <h4 class="panel-title collapsed" data-toggle="collapse" data-target="#collapsed{{ $f->id }}">
                                         {{ $f->nombre }}
                                     </h4>
                                </div>
                                <div id="collapsed{{ $f->id }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                       Formulario: <a href="{{ asset('uploads/'.$f->ruta) }}" target="_blank">{{ $f->nombre }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

            </div>

        </div>
    </div>
</section>
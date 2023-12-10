<section id="shortcodes"  class="parallax-section-2">
    <div class="container"> 
        <div class="row shortcode-heading">
            
            <div class="col-md-12 shortcode-title wow fadeIn ">
                <h3 class="section-title white">Formularios</h3> 
                <p class="subheading semi-white">Descarga tus documentos y realiza tus trámites fácilmente</p>
            </div>
            
            @foreach($formularios->chunk(6) as $chunk)

            <div class="col-md-6">

                    <div class="panel-group wow fadeIn  grupo-formularios" id="toggle">
                        <!-- First Panel -->
                        @foreach($chunk as $f)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                     <h4 class="panel-title collapsed" data-toggle="collapse" data-target="#collapsed{{ $f->id }}"  data-parent=".grupo-formularios">
                                         {{ $f->nombre }}
                                     </h4>
                                </div>
                                <div id="collapsed{{ $f->id }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <iframe src="{{ asset('uploads/'.$f->ruta) }}" width="100%" height="500px"></iframe>
                                       Descargar <a href="{{ asset('uploads/'.$f->ruta) }}" target="_blank">{{ $f->nombre }}</a>
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
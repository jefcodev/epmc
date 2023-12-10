<section id="contact">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <h3 class="section-title wow fadeInUp">Consulta tu placa</h3>
                <p class="text-center">{{ @$general->where('nombre','=','consulta_placa')->first()->valor}}</p>
            </div>
            
            <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                <!-- Contact Form will be functional only on your server. Upload to your server when testing. -->
                <form method="post" action="{{ route('placas.consultar') }}" id="consulta-form" >
                    {{ csrf_field() }}
                    <fieldset>

                        <!--<input name="cedula" type="text" id="cedula" placeholder="Nº Cédula" required />  -->
                        <input name="placa" type="text" id="placa" placeholder="Placa" required/>
                        
                    </fieldset>
                    <div id="message"></div>

                    <input type="submit" class="submit" id="submit" value="Consultar" />
                </form>
            </div>               
        </div>
    </div>
</section>
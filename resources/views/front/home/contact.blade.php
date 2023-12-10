<section id="contact">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <h2 class="section-title wow fadeInUp">Contáctanos</h2> 
            </div>
            
            <div class="col-md-6 col-md-offset-3 text-center wow fadeInUp">
                <div id="message"></div>
                <!-- Contact Form will be functional only on your server. Upload to your server when testing. -->
                <form method="post" action="php/contact-form.php" name="contactform" id="contactform">
                    <fieldset>
                            <input name="name" type="text" id="name" placeholder="Nombre*" required /> 
                            <input name="email" type="text" id="email" placeholder="Correo electrónico*" required />  
                            <input name="subject" type="text" id="subject" placeholder="Número de contacto"/> 
                    </fieldset>
                    <fieldset> 
                            <textarea name="comments" cols="40" rows="3" id="comments" placeholder="Mensaje*" required></textarea>
                    </fieldset>
                    <input type="submit" class="submit" id="submit" value="Enviar mensaje" />
                </form>
            </div>  
            
            <div class="col-md-12 text-center wow fadeInUp" style="margin-top:20px;">
                <p>Encuéntranos en el Terminal Terrestre de Salcedo, Cotopaxi-Ecuador</p>
                <h4>Horario de atención</h4>
                <p>Lunes a Viernes: 08:00 a 17:00<br> (03)-3-700-490 Ext:211</p>
            </div>
                                     
        </div>
    </div>
</section>
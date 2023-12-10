<section id="fun-facts">
	<div class="container">
        
    	<div class="counter-row row text-center wow fadeInUp">
            <div class="col-md-3 col-sm-6 fact-container">
            	<div class="fact">
                	<span class="counter highlight">{{ $hoy_turnos }}</span>
                    <h4>Turnos diarios</h4>
                    <p>Para el <span class="highlight">{{ date('Y-m-d') }}</span></p>
                </div>
            </div>
        	<div class="col-md-3 col-sm-6 fact-container">
            	<div class="fact">
                	<span class="counter highlight">{{ $total_turnos }}</span> 
                    <h4>Turnos generados</h4>
                    <p>Año <span class="highlight">{{ date('Y') }}</span></p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 fact-container">
            	<div class="fact">
                	<h2 class="highlight" id="visitas-totales">{{ $visitas_total }}</h2>
                    <h4>Visitas totales</h4>
                    <p>Desde <span class="highlight">2020-03-01</span></p>
                </div>
            </div> 
            <div class="col-md-3 col-sm-6 fact-container">
            	<div class="fact">
                	<h2 class="highlight"  id="visitas-mensuales">{{ $visitas_mensuales }}</h2>
                    <h4>Visitas mensuales</h4>
                    <p>Usuarios <span class="highlight">{{ date('F') }}</span></p>
                </div>
            </div>
        </div> 
            
    </div>
</section>
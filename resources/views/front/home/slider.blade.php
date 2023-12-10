<section id="home-revolution-slider">
    <div class="hero">
        <div class="tp-banner-container">
            <div class="tp-banner">
                <ul>

                    @foreach($sliders as $slide)
                    <!-- SLIDE 1 -->
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="2000" data-thumb="{{ asset('front/img/slider/'.$slide->imagen ) }}" data-delay="10000"  data-saveperformance="on" data-title="{{ $slide->title }}">
                        <img src="{{ asset('front/img/slider/'.$slide->imagen ) }}" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" > 
                            @if($slide->title)
                            <!-- Home Heading -->
                            <div class="tp-caption sft"
                                data-x="center"  
                                data-y="260"
                                data-speed="1200"
                                data-start="1100"
                                data-easing="Power3.easeInOut"
                                data-splitin="none"
                                data-splitout="none"
                                data-elementdelay="0.1"
                                data-endelementdelay="0.1"
                                data-endspeed="300"
                                style="z-index: 4; max-width: auto; max-height: auto; white-space:normal;">
                                <h2 class="home-heading op-1">{{ $slide->title }}</h2>
                            </div>
                            @endif
                            @if($slide->subtitle)
                            <!-- Home Subheading -->
                            <div class="tp-caption home-subheading sft "
                                data-x="center" 
                                data-y="360" 
                                data-speed="1200"
                                data-start="1350"
                                data-easing="Power3.easeInOut"
                                data-splitin="none"
                                data-splitout="none"
                                data-elementdelay="0.1"
                                data-endelementdelay="0.1"
                                data-endspeed="300"
                                style="z-index: 4; max-width: auto; max-height: auto; white-space:normal;">
                                <div class="op-1">{{ $slide->subtitle }}</div>
                            </div>
                            @endif
                            @if($slide->texto_boton && $slide->url)
                            <!-- Home Button -->
                            <div class="tp-caption home-button sft fadeout"
                                data-x="center" 
                                data-y="400" 
                                data-speed="1200"
                                data-start="1550"
                                data-easing="Power3.easeInOut"
                                data-splitin="none"
                                data-splitout="none"
                                data-elementdelay="0.1"
                                data-endelementdelay="0.1"
                                data-endspeed="300"
                                style="z-index: 4; max-width: auto; max-height: auto; white-space:normal;">
                                <div class="op-1"><a href="{{ $slide->url }}" class="btn btn-primary btn-scroll">{{ $slide->texto_boton }}</a></div>
                            </div>
                            @endif

                    </li>
                    @endforeach
                </ul>
                <div class="tp-bannertimer"></div>	
            </div>

            <div class="home-bottom">
                <div class="container text-center">
                    <div class="move bounce">
                        <a href="#features" class="ion-ios-arrow-down btn-scroll"></a>
                    </div>  
                </div> 
            </div>

        </div>	
    </div>
</section>
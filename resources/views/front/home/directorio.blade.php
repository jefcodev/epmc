<!-- Start Team Section -->
<section id="team">
    <div class="container"> 
        
        <div class="col-md-12 text-center wow fadeInUp">
            <h3 class="section-title">{{ $title }}</h3> 
            <p class="subheading">{{ $subtitle }}</p>
        </div>
        
        <div class="row">
            @foreach($miembros as $miembro)
            <div class="col-md-4 col-sm-4 team-member">
                <div class="effect effects wow fadeInUp">
                    <div class="img">
                        <img src="{{ asset('team/'.$miembro->imagen) }}" class="img-responsive" alt="{{ $miembro->nombre }}" />
                        <div class="overlay">
                            <ul class="expand">
                                @if($miembro->link)
                                <li class="social-icon"><a href="{{$miembro->link}}"  target="blank"><i class="icon-paper-plane"></i></a></li>
                                @endif
                                @if($miembro->facebook)
                                <li class="social-icon"><a href="{{$miembro->facebook}}"  target="blank"><i class="icon-social-facebook"></i></a></li>
                                @endif
                                @if($miembro->twitter)
                                <li class="social-icon"><a href="{{ $miembro->twitter }}" target="blank"><i class="icon-social-twitter"></i></a></li>
                                @endif
                                @if($miembro->email)
                                <li class="social-icon"><a href="mailto:{{$miembro->email}}"><i class=" icon-envelope-open"></i></a></li>
                                @endif
                            </ul>
                            <a class="close-overlay hidden">x</a>
                        </div>
                    </div>
                </div>
                <div class="member-info wow fadeInUp">
                    <h4>{{ $miembro->nombre }}</h4>
                    <h5 class="highlight">{{ $miembro->cargo }}</h5>
                    <p>{{ $miembro->puesto }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Team Section -->
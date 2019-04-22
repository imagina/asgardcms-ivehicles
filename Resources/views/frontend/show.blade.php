@extends('layouts.master')

@section('meta')
    <meta name="description" content="{!! $vehicle->summary !!}">
    <!-- Schema.org para Google+ -->
    <meta itemprop="name" content="{{$vehicle->name}}">
    <meta itemprop="description" content="{!!$vehicle->summary!!}">
    <meta itemprop="image" content=" {{url($vehicle->mainimage) }}">
    <!-- Open Graph para Facebook-->
    <meta property="og:name" content="{{$vehicle->name}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{url($vehicle->slug)}}"/>
    <meta property="og:image" content="{{url($vehicle->mainimage)}}"/>
    <meta property="og:description" content="{!!$vehicle->summary!!}"/>
    <meta property="og:site_name" content="{{Setting::get('core::site-name') }}"/>
    <meta property="og:locale" content="{{config('asgard.iblog.config.oglocal')}}">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="{{ Setting::get('core::site-name') }}">
    <meta name="twitter:name" content="{{$vehicle->name}}">
    <meta name="twitter:description" content="{!! $vehicle->summary !!}">
    <meta name="twitter:creator" content="">
    <meta name="twitter:image:src" content="{{url($vehicle->mainimage)}}">

@stop

@section('title')
    {{ $vehicle->name }} | @parent
@stop

@section('content')

    <div class="page blog single">
        <div class="container" id="body-wrapper">
            <div class="row mt-3">
                <div class="col-xs-12 col-sm-12 column1 mt-5 px-0">
                	<div class="row">
                		<div class="col-sm-6">
                		   <h2 class="text-left v-name-big font-weight-bold">{{ $vehicle->name }}</h2>
                		</div>

                		<div class="col-sm-6">
                		   <h2 class="text-right v-show v-price-big font-weight-bold">{{ $vehicle->price }} COP</h2>
                		</div>
                	</div>
                            <div class="bgimg px-0 mt-4">
                                @if(isset($vehicle->options->mainimage)&&!empty($vehicle->options->mainimage))
                                    <img class="image img-responsive w-100" src="{{url($vehicle->options->mainimage)}}"
                                         alt="{{$vehicle->name}}"/>
                                @else
                                    <img class="image img-responsive"
                                         src="{{url('modules/iblog/img/vehicle/default.jpg')}}" alt="{{$vehicle->name}}"/>
                                @endif
                            </div>
                    <div class="row">
                        <div class="content col-xs-12 col-md-12 col-lg-8 mt-5">
                        	<div class="">
								<h5 class="expo-feria-title my-4">
									<span class="expo-feria-title-wrapper">
										<span>Descripción</span>
								</h5>
			            	</div>
                            {!! $vehicle->description !!}
                        </div>

                       <div class="col-xs-12 col-md-12 col-lg-4 mt-5">
	                       	<div id="contact-inner" class="container">
						        <div class="row justify-content-center">
						        	<div class="col-lg-12 col-md-12 col-12">
								        <div id="contact-form2">

								        	<h5 class="contact-title text-center text-secondary">¿Te interesa este auto?</h5>

								        	{!! iform(2,'iforms::frontend.form.bt-horizontal.form',['rand'=>rand(1,999)]) !!}
							        	</div>
						        	</div>
						        </div>
						    </div>
                       </div>
                    </div>

                   	<div class="row">

                        @include('ivehicles::frontend.gallery.viewline')

                        <div class="content col-xs-12 col-sm-12 mt-5 principal-features">
                        	<div class="row">
	                        	<div class="col-md-6 col-lg-3">
	                        		<div class="row">
	                        			<div class="col-4 pr-0">
	                        				<img class="img-feature" src="{{Theme::url('img/kilo.png')}}">
	                        			</div>
	                        			<div class="col-8 pl-0 pt-3 pl-3">
	                        				<h5>Kilometraje</h5>
	                        				@if($vehicle->mileage != null)
                                                <h5 class="font-weight-bold ">{{$vehicle->mileage}} km</h5>
                                            @else
                                            	<h5 class="font-weight-bold ">0 km</h5>
                                            @endif

	                        			</div>
	                        		</div>
	                        	</div>

	                        	<div class="col-md-6 col-lg-3">
	                        		<div class="row">
	                        			<div class="col-4 pr-0">
	                        				<img class="img-feature" src="{{Theme::url('img/trans.png')}}">
	                        			</div>
	                        			<div  class="col-8 pl-0 pt-3">
	                        				<h5>Transmisión</h5>
	                        				<h5 class="font-weight-bold">{{$vehicle->present()->transmission}}</h5>
	                        			</div>
	                        		</div>
	                        	</div>

	                        	<div class="col-md-6 col-lg-3">
	                        		<div class="row">
	                        			<div class="col-4 pr-0">
	                        				<img class="img-feature" src="{{Theme::url('img/comb.png')}}">
	                        			</div>
	                        			<div class="col-8 pl-0 pt-3">
	                        				<h5>Combustible</h5>
	                        				<h5 class="font-weight-bold">{{$vehicle->present()->fuel}}</h5>
	                        			</div>
	                        		</div>
	                        	</div>

	                        	<div class="col-md-6 col-lg-3">
	                        		<div class="row">
	                        			<div class="col-4 px-0">
	                        				<img class="img-feature" src="{{Theme::url('img/motor.png')}}">
	                        			</div>
	                        			<div class="col-8 pt-3">
	                        				<h5>Motor</h5>
	                        				<h5 class="font-weight-bold">{{$vehicle->engine}}</h5>
	                        			</div>
	                        		</div>
	                        	</div>
                        	</div>
                        </div>
                   	</div>
                </div>
            </div>
        </div>


		@include('ivehicles::frontend.partials.features-vehicle')

    	<div class="container mt-5">
    		<div class="row">
    			<div class="content col-xs-12 col-sm-12">
		            @include('ivehicles::frontend.partials.vehiculos-destacados')
		        </div>
    		</div>
    	</div>
    </div>


@stop

<style type="text/css">
	.bgimg{
		max-height: 600px;
		overflow: hidden;
	}

	.v-name-big{
		color: #444444;
	}

	.v-price-big{
		color: #0051A1;
	}

	.fondo1{
		background-color: #F0F0F0;
	}

	.panel-group .panel-title a{
		color: #0051A1 !important;
	}

	.img-feature{
		height: 70px !important;
		width: auto;
	}

	.principal-features h5{
		line-height: 0.9;
	}


</style>


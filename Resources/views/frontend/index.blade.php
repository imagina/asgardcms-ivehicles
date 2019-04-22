@extends('layouts.master')

@section('title')
 | @parent
@stop
@section('content')

    <div class="page vehicles-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-lg-3">
                    @include('ivehicles::frontend.partials.filter-vehicles-form')
                </div>
                <div class="col-xs-12 col-sm-12 col-lg-9 category-body-1 column1 pl-0">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 mt-4 mb-4 pub-header">
                            <div class="publicidad pub-rectangle w-100">
                                {!!ibanner(1,'ibanners::frontend.widgets.carousel.banners')!!}
                            </div>
                        </div>
                    </div>
                    <div class="bread-crumb my-3 pl-2">
                        <p class="color-secondary">
                        <a href="{{ url('/') }}" class="home-title color-secondary font-weight-bold">Home </a>
                        <span>/</span> Autos</p>
                    </div>

                    <div class="row">
                        @if (count($vehicles) !=0)
                            @php $cont = 0; @endphp
                            @foreach($vehicles as $vehicle)
                                <div class="col-xs-6 col-sm-4 vehicle vehicle{{$vehicle->id}} pb-5 vehicle-list">
                                    <div class="row vehicle-panel">
                                        <div class="col-xs-12">
                                            <div class="bg-imagen">
                                                <a href="{{$vehicle->url}}">
                                                    <img class="image img-responsive"
                                                         src="{{url($vehicle->mediumimage)}}"
                                                         alt="{{$vehicle->title}}"/>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="w-100 text-center text-white featured-box">
                                            @if($vehicle->featured == 1)
                                            <p class="bg-secondary featured-text">DESTACADO</p>
                                            @endif
                                        </div>
                                        <div class="col-xs-12 content-top pt-2 px-3 pb-0 w-100">
                                            <a href="{{$vehicle->url}}"><h6 class="v-name text-capitalize">{{$vehicle->name}}</h6></a>
                                            <p class="v-price" id="price">Precio incial $ {{number_format($vehicle->price)}} COP.</p>
                                        </div>
                                        <div class="col-md-6 pt-2 data-column">
                                            <p class="text-center">Año
                                                @if($vehicle->year != null)
                                                    {{$vehicle->year}}</p>
                                                @else
                                                    -</p>
                                                @endif
                                            <p class="text-center text-capitalize">{{$vehicle->present()->transmission}}</p>
                                        </div>
                                        <div class="col-md-6 pt-2 data-column data-second">
                                            <p class="text-center">
                                                @if($vehicle->fuel != null)
                                                    {{$vehicle->present()->fuel}}</p>
                                                @endif

                                            <p class="text-center">
                                                @if($vehicle->mileage != null)
                                                    {{$vehicle->mileage}} km</p>
                                                @else
                                                    0 km</p>
                                                @endif
                                        </div>
                                        <div class="col-md-6 px-0 bg-primary">
                                            <div class=" w-100 vehicle-share">
                                                <a href="#" class="h-100"><p class="text-center"><i class="fa fa-envelope text-white pt-2"></i></p></a>
                                            </div> 
                                            
                                        </div>
                                        <div class="col-md-6 px-0 bg-gray">
                                            <div class=" w-100 vehicle-share">
                                                <a href="#" class="h-100"><p class="text-center"><i class="fa fa-phone text-white pt-2"></i></p></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php $cont++; @endphp
                                @if($cont%3==0)
                                    <div class="clearfix" style="margin:10px 0"></div>
                                @endif
                            @endforeach
                            <div class="clearfix"></div>
                            <div class="pagination paginacion-blog row pull-right pt-5 pb-4" >
                                <div class="pull-right">
                                    {{$vehicles->links()}}
                                </div>
                            </div>
                        @else
                            <div class="col-xs-12 con-sm-12">
                                <div class="white-box">
                                    <h3>Ups... :(</h3>
                                    <h1>404 vehiculos no encontrados</h1>
                                    <hr>
                                    <p style="text-align: center;">No hemos podido encontrar el Contenido que estás
                                        buscando.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 mt-0 mb-4 pub-header">
                    <div class="publicidad pub-rectangle w-100">
                        {!!ibanner(1,'ibanners::frontend.widgets.carousel.banners')!!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
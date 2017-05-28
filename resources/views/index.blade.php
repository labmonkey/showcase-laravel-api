@extends('layout.base')

@section('head')
    <title>CARS API</title>
@endsection

@section('content')
    <div class="background hidden-xs">
        <div class="background__left">

        </div>
        <div class="background__right">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-sm-offset-3 hidden-xs">
                <h1 class="header--left">CARS</h1>
                @include('partials._menu', ['vehicleModels' => $vehicleModels])
            </div>
            <div class="col-xs-12 col-sm-6">
                <h1 class="header--right">API</h1>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-12">
                                @include('panels._welcome')
                            </div>
                            <div class="col-sm-12">
                                @include('panels._guide')
                            </div>
                            <div class="col-sm-12">
                                @include('panels._playground')
                            </div>
                            @foreach ($vehicleModels as $vehicleModel)
                                <div class="col-sm-12">
                                    @include('partials._vehicle', ['vehicleModel' => $vehicleModel])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
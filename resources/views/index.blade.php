@extends('layout.base')

@section('head')
    <title>CARS API</title>
@endsection

@section('content')
    <div class="background">
        <div class="background__left">

        </div>
        <div class="background__right">

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-md-offset-4">
                <h1 class="header--left">CARS</h1>
                @include('partials._menu', ['vehicleModels' => $vehicleModels])
            </div>
            <div class="col-md-6">
                <h1 class="header--right">API</h1>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                @include('panels._welcome')
                            </div>
                            <div class="col-md-12">
                                @include('panels._guide')
                            </div>
                            <div class="col-md-12">
                                @include('panels._playground')
                            </div>
                            @foreach ($vehicleModels as $vehicleModel)
                                <div class="col-md-12">
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
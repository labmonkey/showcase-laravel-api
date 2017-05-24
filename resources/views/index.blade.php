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
                <div class="#navbar-main">
                    <ul class="nav nav--main nav--vehicles">
                        @foreach ($vehicleModels as $vehicleModel)
                            <li>
                                <a href="#vehicle-{{$vehicleModel->id}}">{{$vehicleModel->manufacturer}} {{$vehicleModel->model}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="header--right">API</h1>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default panel--vehicle">
                                    <div class="panel-heading">Welcome!</div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('api')}}">/api</a> - return all cars</li>
                                            <li><a href="{{ url('api/car')}}">/api/car</a> -
                                                return random car
                                            </li>
                                            <li><a href="{{ url('api/car/5', ['id' => 5])}}">/api/car/5</a>
                                                - return car by ID
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @foreach ($vehicleModels as $vehicleModel)
                                <div class="col-md-12">
                                    <div id="vehicle-{{$vehicleModel->id}}" class="panel panel-default panel--vehicle">
                                        <div class="panel-heading">{{$vehicleModel->manufacturer}} {{$vehicleModel->model}}</div>
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                @foreach ($vehicleModel->toArray() as $attribute => $value)
                                                    <li>
                                                        <b>{{$attribute}}:</b> {{$value}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contentt')
    <div class="container">
        <div class="row">
            @foreach ($vehicleModels as $vehicleModel)
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Vehicle</div>
                        <div class="panel-body">
                            @foreach ($vehicleModel->toArray() as $attribute => $value)
                                <dl>
                                    <dd>
                                        {{$attribute}}:
                                    </dd>
                                    <dt>
                                        {{$value}}
                                    </dt>
                                </dl>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
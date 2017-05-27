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
                <div id="navbar-main">
                    <ul class="nav nav--main nav--vehicles">
                        <li>
                            <a href="#welcome">
                                Welcome
                            </a>
                        </li>
                        <li>
                            <a href="#guide">
                                Guide
                            </a>
                        </li>
                        <li class="li--split">
                            <a href="#playground">
                                Playground
                            </a>
                        </li>
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
                                <div id="welcome" class="panel panel-default panel--vehicle">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Welcome!</h3>
                                    </div>
                                    <div class="panel-body">
                                        <b>Public API access:</b>
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('public/api')}}">/public/api</a> - return all cars</li>
                                            <li><a href="{{ url('public/api/car')}}">/public/api/car</a> -
                                                return random car
                                            </li>
                                            <li>
                                                <a href="{{ url('public/api/car/5', ['id' => 5])}}">/public/api/car/5</a>
                                                - return car by ID
                                            </li>
                                        </ul>
                                        <b>Auth API access:</b>
                                        <ul class="list-unstyled">
                                            <li><a href="{{ url('api')}}">/api</a> - return data based on POST request
                                            </li>
                                            <li><a href="{{ url('api/key')}}">/api/key</a> - return new AUTH key
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="guide" class="panel panel-default panel--vehicle">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">API Guide</h3>
                                    </div>
                                    <div class="panel-body">
                                        All AUTH requests require valid developer key. The POST request requires
                                        following params:
                                        <ul class="list-condensed">
                                            <li>
                                                <b>"key"</b> - Your developer key. Generate one at /api/key
                                            </li>
                                            <li>
                                                <b>"query"</b> - any text that you search for. API will search all
                                                attributes
                                                and return matched Vehicles if any.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="playground" class="panel panel-default panel--vehicle">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Auth API playground</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form id="form-playground" class="form form-horizontal clearfix" action="">
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="pg-key" class="control-label">Key</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <input id="pg-key"
                                                               name="key"
                                                               type="text"
                                                               class="form-control">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary"
                                                                    type="button">Get new</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <label for="pg-query" class="control-label">Query</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="pg-query"
                                                           name="query"
                                                           type="text"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                                        </form>
                                        Result:
                                        <pre></pre>
                                    </div>
                                </div>
                            </div>
                            @foreach ($vehicleModels as $vehicleModel)
                                <div class="col-md-12">
                                    <div id="vehicle-{{$vehicleModel->id}}" class="panel panel-default panel--vehicle">
                                        <div class="panel-heading">{{$vehicleModel->manufacturer}} {{$vehicleModel->model}}</div>
                                        <!-- Table -->
                                        <table class="table">
                                            <tbody>
                                            @foreach ($vehicleModel->toArray() as $attribute => $value)
                                                <tr>
                                                    <th>{{$attribute}}</th>
                                                    <td>{{$value}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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
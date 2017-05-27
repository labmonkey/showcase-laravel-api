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
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
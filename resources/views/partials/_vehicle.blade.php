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
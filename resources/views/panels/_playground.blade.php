<div id="playground" class="panel panel-default panel--vehicle">
    <div class="panel-heading">
        <h3 class="panel-title">Auth API playground</h3>
    </div>
    <div class="panel-body">
        <form id="form-playground" class="form form-horizontal clearfix" action="{{url('api')}}" autocomplete="off"
              method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-xs-12 col-sm-3">
                    <label for="pg-key" class="control-label">Key</label>
                </div>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input id="pg-key"
                               name="key"
                               type="text"
                               class="form-control">
                        <span class="input-group-btn">
                            <button id="api-key-button" class="btn btn-primary"
                                    type="button">Get new</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12 col-sm-3">
                    <label for="pg-query" class="control-label">Query</label>
                </div>
                <div class="col-xs-12 col-sm-9">
                    <input id="pg-query"
                           name="query"
                           type="text"
                           placeholder="Citroen"
                           class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Submit</button>
        </form>
        Result:
        <pre id="api-result"></pre>
    </div>
</div>
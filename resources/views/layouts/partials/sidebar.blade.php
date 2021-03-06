<div class="col-md-3" style="height: 90vh;overflow-y: scroll;float: left;">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Layers & Legend</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Info</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent" >
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            @include('layouts.partials.sidebar-ctdc-dataset')
            @include('layouts.partials.sidebar-ctdc-corridor')
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            @include('layouts.partials.sidebar-info')
        </div>
    </div>
</div>
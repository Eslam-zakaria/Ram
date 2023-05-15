@if(session()->has('success'))
    <div class="alert alert-success solid alert-dismissible fade show">
        <i class="fa fa-check-square-o"></i>
        <strong>Success!</strong> {{session()->get('success')}}
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
@endif

@if(session()->has('danger'))
    <div class="alert alert-warning solid alert-dismissible fade show">
        <i class="fa fa-check-square-o"></i>
        <strong>Success!</strong> {{session()->get('danger')}}
        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
        </button>
    </div>
@endif


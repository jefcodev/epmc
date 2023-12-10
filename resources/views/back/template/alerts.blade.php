@if(session('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    <h4><i class="fa fa-check-circle"></i> Success</h4> {{ session('success') }}
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
    <h4><i class="fa fa-check-circle"></i> Warning</h4> {{ session('warning') }}
</div>
@endif
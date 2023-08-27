@extends("layouts.app")
@section("subtitle","About Us")
@section("content")
<div class="row">
    <div class="col-lg-4 ms-auto">
        <div class="lead">{{ $viewData["description"] }}</div>
    </div>
    <div class="col-lg-4 me-auto">
        <div class="lead">{{ $viewData["name"] }}</div>
    </div>
</div>
@endsection
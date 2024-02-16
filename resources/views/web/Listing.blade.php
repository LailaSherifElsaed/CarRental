@extends('web.layouts\pages')
@section('content')
@include('web.includes.car_listing')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="custom-pagination">
                    {{$cars->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@include('web.includes.testimonials', ['bgClass' => 'bg-white'])
@include('web.includes.waiting')
@endsection
@section('title')
Listings
@endsection
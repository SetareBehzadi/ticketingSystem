@extends('layouts.app')
@section('title' , 'محصولات')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            @include('partials.alerts')
        </div>
        <div class="card-body">
            <div class="row mb-5">
                @each('FrontEnd.Cards.product', $products, 'product')
            </div>
        </div>
    </div>

@endsection

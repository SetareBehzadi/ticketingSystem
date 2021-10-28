
    <div class="col-md-4 mb-5 ">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{$product->image}}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$product->title}}</h5>
                <p class="card-text"> {{$product->description}} </p>
                <a href="{{route('web.basket.add' , $product->id)}}" class="btn btn-primary">@lang('payment.add to basket')</a>
            </div>
        </div>
    </div>


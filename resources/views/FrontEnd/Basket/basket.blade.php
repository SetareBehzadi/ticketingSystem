@extends('layouts.app')

@section('content')


<div class="justify-content-center mt-5">
	<div class="row">
		@include('partials.alerts')
	</div>

	@if ($items->isEmpty())
	<p>
		@lang('payment.empty basket' , ['link' => route('web.products.index')])
	</p>

	@else


	<div class="row">
		<div class="col-md-7 card bg-light mr-3">
			<div class="card-body well">
				<table class="table ">
					<thead>
						<tr>
							<th>@lang('payment.product name')</th>
							<th>@lang('payment.product price')</th>
							<th>@lang('payment.quantity')</th>
						</tr>
					</thead>
					<tbody>
                        @each('FrontEnd.Basket.item',$items,'item')
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-4">
			@include('FrontEnd.Basket.summary')
		<a href="{{route('web.basket.checkout.form')}}" class="btn mt-4  btn-primary btn-lg w-100 d-block">@lang('payment.confirm and continue')</a>
		</div>
	</div>
	@endif
</div>


@endsection


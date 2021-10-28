@inject('basket' , 'App\Services\Basket\Basket')

<div class="card bg-light">
	<div class="card-body">
		<h4>@lang('payment.cart summary')</h4>
		<hr>
		<div class="well">
			<table class='table'>
				<tr>
					<td>@lang('payment.item total')</td>
					<td> {{\App\Helper\Format\Number::PersianNumberFormat($basket->subTotal())}} @lang('payment.toman')</td>
				</tr>
				<tr>
					<td>@lang('payment.shipping')</td>
					<td> {{\App\Helper\Format\Number::PersianNumberFormat(10000)}} @lang('payment.toman')</td>
				</tr>
				<tr>
					<td>@lang('payment.basket total')</td>
					<td> {{\App\Helper\Format\Number::PersianNumberFormat($basket->subTotal() + 10000 )}} @lang('payment.toman')</td>
				</tr>
			</table>
		</div>
	</div>
</div>


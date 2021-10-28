<tr>
    <td> {{$item->title}} </td>
    <td>  {{($item->present()->productPrice)}} </td>
    <td>
        <form action="{{route('web.basket.update' , [$item->id])}}" method="post" class="form-inline">
            @csrf
            <select name="quantity" id="quantity" class="form-control input-sm mr-sm-2">
                @for ($i = 0; $i <= $item->stock; $i++)
                    <option {{$item->quantity == $i ? 'selected' : ''}} value="{{$i}}">{{\App\Helper\Format\Number::PersianNumbers($i)}}</option>
                @endfor
            </select>
            <button type="submit" class="btn btn-primary btn-sm">@lang('payment.update')</button>
        </form>
    </td>
</tr>

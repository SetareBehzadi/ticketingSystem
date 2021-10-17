@extends('layouts.app')
@section('content')
<div class="container">
    @include('partials.alerts')
    <div class="row justify-content-center">
        @if(auth()->user())
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">پنل کاربری</div>
                    <div class="card-body">
                        شما با موفقیت وارد شده اید.
                    </div>

                    <div class="col-md-8 mb-5">
                        <a class="btn btn-info  mr-2" href="{{route('ticket.index')}}"> نمایش تیکت ها </a>
                        @if(!auth()->user()->isAdmin())
                            <a class="btn btn-info mr-2" href="{{route('ticket.new')}}"> ثبت تیکت جدید</a>
                        @endif
                    </div>
                </div>

            </div>
        @else

            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">خانه </div>
                    <div class="card-body">
                      لطفا لاگین کنید...
                    </div>

                </div>

            </div>
        @endif
    </div>
</div>
@endsection

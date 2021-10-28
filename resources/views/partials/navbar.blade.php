@inject('basket','App\Services\Basket\Basket')
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand" href="#"></a>
        <a href="{{route('web.basket.index')}}"  class="btn btn-info mr-2">
            @lang('payment.basket') <span class="badge badge-light">{{$basket->itemCount()}}</span>

    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="auth-btn collapse justify-content-end navbar-collapse">

    @guest
    <a class="btn btn-info  mr-2" href="{{route('auth.login.form')}}"> ورود کاربر </a>
    <a class="btn btn-info mr-2" href="{{route('auth.register.form')}}"> ثبت نام کاربر</a>
    <a class="btn btn-info  mr-2" href="{{route('admin.login.form')}}"> ورود مدیر </a>
    <a class="btn btn-info mr-2" href="{{route('admin.register.form')}}"> ثبت نام مدیر </a>
    @endguest
    @auth
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            {{Auth::user()->name}}
        </a>
        <div class="dropdown-menu logout-btn" aria-labelledby="navbarDropdown">

            {{--<a onclick="event.preventDefault();document.getElementById('logout-form').submit()" class="dropdown-item" href="#">خروج</a>--}}
            <a  class="dropdown-item" href="{{ url('auth/logout')}}">خروج</a>
        </div>
       {{-- <form id="logout-form" action="/auth/logout" method="POST" style="display: none;">
            @csrf
        </form>--}}
        </li>
    </ul>
            <a class="btn btn-info  mr-2" href="{{route('auth.login.form')}}">  </a>
            <a class="btn btn-info mr-2" href="{{route('auth.register.form')}}"> ثبت نام کاربر</a>

    @endauth
    </div>
</nav>

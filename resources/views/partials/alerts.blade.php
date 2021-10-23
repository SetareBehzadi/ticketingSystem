@if(session('success'))
<div class="alert alert-success">
	{{session('success') }}
</div>
@endif
@if(session('registered'))
    <div class="alert alert-success">
        @lang('auth.your registration was successful')
    </div>
@endif
@if(session('error'))
<div class="alert alert-danger">
	{{session('error') }}
</div>
@endif
@if(session('wrongCredentials'))
<div class="alert alert-danger">
    @lang('auth.user or password was wrong')
</div>
@endif

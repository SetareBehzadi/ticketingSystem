@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        @include('partials.alerts')
        <form action="{{route('ticket.create')}}" method='post' enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">عنوان مطلب</label>
                <input type="text" class="form-control" id="title" name="title" >
            </div>
                <div class="form-group">
                    <label for="department_id">بخش</label>
                    <select class="form-control" id="department_id" name="department_id">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->fa_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="priority">اولویت</label>
                    <select class="form-control" id="priority" name="priority">
                        @foreach($priorities as $priority=>$title)
                            <option value="{{$priority}}">{{$title}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="message">متن</label>
                    <textarea class="form-control" id="message" rows="6" name="message"></textarea>
                </div>
                <div class="form-group">
                    <label for="">پیوست</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">فایل را انتخاب کنید</label>
                    </div>
                </div>
                <button type='submit' class='btn btn-primary'>ارسال</button>
        </form>
    </div>
</div>
@endsection

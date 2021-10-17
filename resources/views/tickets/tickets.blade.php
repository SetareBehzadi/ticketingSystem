@extends('layouts.app')

@section('title', 'پیام ها')

@section('content')
<div class="justify-content-center">
    <div class="mt-5">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>شماره پیگیری </th>
                    <th>عنوان</th>
                    <th>کاربر</th>
                    <th>اولویت</th>
                    <th>وضعیت</th>
                    <th>تاریخ </th>
                    <th>عملیات </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>
                        <a href="{{route('ticket.show', $ticket)}}">
                            {{$ticket->present()->ticket_number}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('ticket.show', $ticket)}}">
                            {{$ticket->title}}
                        </a>
                    </td>
                    <td>{{$ticket->user->name}}</td>
                    <td>{{$ticket->priority}}</td>
                    <td>{{$ticket->present()->status}}</td>
                    <td>{{$ticket->present()->created_at}}</td>
                    <td>
                        @if(!$ticket->isClosed())
                        <div class="table__button-group">
                            <a href="{{route('ticket.show', $ticket)}}">پاسخ به تیکت  </a> |
                            <a href="{{route('ticket.close', $ticket)}}"> بستن تیکت </a>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-md-8 mb-5">
            @if(!auth()->user()->isAdmin())
                <a class="btn btn-info mr-2" href="{{route('ticket.new')}}"> ثبت تیکت جدید</a>
            @endif
        </div>
    </div>
</div>


@endsection

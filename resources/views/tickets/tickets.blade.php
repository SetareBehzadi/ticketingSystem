@extends('layouts.app')

@section('title', 'پیام ها')

@section('content')
<div class="justify-content-center">
    <div class="mt-5">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th>عنوان</th>
                    <th>کاربر</th>
                    <th>اولویت</th>
                    <th>وضعیت</th>
                    <th>تاریخ </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr>
                    <td>
                        <a href="{{route('ticket.show', $ticket)}}">
                            {{$ticket->title}}
                        </a>
                    </td>
                    <td>{{$ticket->user->name}}</td>
                    <td>{{$ticket->priority}}</td>
                    <td>{{$ticket->present()->status}}</td>
                    <td>{{$ticket->present()->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

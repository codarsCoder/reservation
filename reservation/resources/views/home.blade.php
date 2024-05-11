@extends('master')
@php
    // dd($joined_events);
    @endphp

@section('title')
Home
@endsection

@section('main')<div class="container">
    <h1>Home</h1>
    <h4>My Events</h4>
    @if (session('success'))
    <div class="alert alert-primary" role="alert">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 20%">Name</th>
                <th style="width: 40%">Description</th>
                <th style="width: 10%">Date</th>
                <th style="width: 10%">Time</th>
                <th style="width: 20%,text-align: end">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ Str::limit($event->description, 100) }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->time }}</td>
                <td>
                    <button class="btn btn-info btn-sm show-event-details" data-event-id="{{ $event->id }}">Show</button>
                    <a href="{{ route('edit.event.page', $event->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('delete.event', $event->id) }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="my-5"></div>
    @if($joined_events->count() > 0)
    <h4>Joined Events</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 20%">Name</th>
                <th style="width: 40%">Description</th>
                <th style="width: 10%">Date</th>
                <th style="width: 10%">Time</th>
                <th style="width: 20%,text-align: end">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($joined_events as $event)
            <tr>
                <td>{{ $event->event->name }}</td>
                <td>{{ Str::limit($event->description, 100) }}</td>
                <td>{{ $event->event->date }}</td>
                <td>{{ $event->event->time }}</td>
                <td>
                    <button class="btn btn-info btn-sm show-event-details" data-event-id="{{ $event->event->id }}">Show</button>
                    {{-- <a href="{{ route('edit.event.page', $event->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
                    <a href="{{ route('unjoin.event', $event->event->id) }}" class="btn btn-primary btn-sm">Un Join</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>



@endsection





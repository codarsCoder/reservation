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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->time }}</td>
                <td>
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
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($joined_events as $event)
            <tr>
                <td>{{ $event->event->name }}</td>
                <td>{{ $event->event->description }}</td>
                <td>{{ $event->event->date }}</td>
                <td>{{ $event->event->time }}</td>
                <td>
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



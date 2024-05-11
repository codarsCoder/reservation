@extends('master')
@php
    // dd($all_events);
    @endphp

@section('title')
Join To Events
@endsection

@section('main')<div class="container">
    <h1 class="mb-5">Join To Events</h1>
    <h4>All Events</h4>
    @if(isset($success))
    <div class="alert alert-primary" role="alert">
        {{ $success }}
    </div>
@endif

@if(isset($error))
        <div class="alert alert-danger" role="alert">
            {{ $error}}
        </div>

@endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 20%">Name</th>
                <th style="width: 50%">Description</th>
                <th style="width: 10%">Date</th>
                <th style="width: 10%">Time</th>
                <th style="width: 10%,text-align: end">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ Str::limit($event->description, 100) }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->time }}</td>
                <td>
                    <button class="btn btn-info btn-sm show-event-details" data-event-id="{{ $event->id }}">Show</button>
                    @if(!$event->joined)
                    <a href="{{ route('join.event', $event->id) }}"
                       class="btn btn-primary btn-sm">Join</a>
                       @else
                       <button disabled
                        class="btn btn-primary btn-sm">Join</button>
                       @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection



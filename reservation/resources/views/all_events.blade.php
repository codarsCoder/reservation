@extends('master')
@php
    // dd($all_events);
    @endphp

@section('title')
Join To Events
@endsection

@section('main')<div class="container">
    <h1>Join To Events</h1>
    <h4>All Events</h4>
    @if(isset($success))
    <div class="alert alert-success" role="alert">
        {{ $success }}
    </div>
@endif

@if(isset($errors))
        <div class="alert alert-danger" role="alert">
            {{ $errors }}
        </div>

@endif
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
            @foreach ($all_events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->time }} {{$event->joined}}</td>
                <td>
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



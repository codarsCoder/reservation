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
                <th style="width: 50%">Description</th>
                <th style="width: 10%">Date</th>
                <th style="width: 10%">Time</th>
                <th style="width: 10%,text-align: end">Action</th>
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
                    {{-- <a href="{{ route('edit.event.page', $event->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
                    <a href="{{ route('unjoin.event', $event->event->id) }}" class="btn btn-primary btn-sm">Un Join</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventDetailsModalLabel">Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5></h5>
                <p id="eventName"></p>
                <p id="eventDetails"></p>
                <p id="eventDate"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    // Butona tıklandığında modalı aç
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('show-event-details')) {
            var eventId = e.target.getAttribute('data-event-id');
            fetchEventDetails(eventId);
        }
    });

    // Etkinlik detaylarını getir
    function fetchEventDetails(eventId) {
        fetch('/event-detail/' + eventId)
            .then(response => response.json())
            .then(data => {
                var eventDetailsModal = document.getElementById('eventDetailsModal');
                var eventName = document.getElementById('eventName');
                var eventDetails = document.getElementById('eventDetails');
                var eventDate = document.getElementById('eventDate');
                eventName.innerText = data ? data.event.name : 'No event found';
                eventDetails.innerText = data.event.description; // Veya başka bir etkinlik detayı alanını kullanın
                eventDate.innerText = data.event.date+' '+data.event.time;
                var modal = new bootstrap.Modal(eventDetailsModal);
                modal.show();
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@endsection



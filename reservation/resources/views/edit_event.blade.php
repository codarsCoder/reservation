@extends('master')

@section('title')
    Edit Event
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <h1 class="mb-5">Edit Event</h1>
                @if (isset($success))
                <div class="alert alert-primary" role="alert">
                    {{ $success }}
                </div>
            @endif
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
                <form action="{{ route('update.event', $event->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Event Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $event->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description</label>
                        <input type="text" name="description" class="form-control" id="description" value="{{ $event->description }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="date" value="{{ $event->date }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>

                        <input type="time" name="time" class="form-control" id="time" value="{{ $event->time }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @endsection
        </div>
    </div>
</div>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('style')
    <style>
        .active {
            color: #085ED6 !important;
        }
    </style>
</head>

<body>
    {{-- Navbar --}}
    @include('navbar')

    @yield('main')

    @include('footer')

    @include('event_detail_modal')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    @yield('script')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            const delay = 3000; // 3 saniye

            if (alerts.length > 0) {
                setTimeout(function() {
                    alerts.forEach(function(alert) {
                        alert.classList.add('d-none');
                    });
                }, delay);
            }
        });

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
                    eventDate.innerText = data.event.date + ' ' + data.event.time;
                    var modal = new bootstrap.Modal(eventDetailsModal);
                    modal.show();
                })
                .catch(error => console.error('Error:', error));
        }
    </script>


</body>

</html>

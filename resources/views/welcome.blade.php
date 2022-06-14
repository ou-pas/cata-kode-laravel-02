<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<main class="flex-shrink-0">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3">
                <form action="{{route('appointments.store')}}" method="post"></form>
                {{ @csrf_field() }}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="schedule_at" class="form-label">Schedule at</label>
                    <input id="schedule_at" type="datetime-local" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <input id="message" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</main>
</body>
</html>

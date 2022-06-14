@extends('layout')

@section('content')
<ul>
    <li>
        name: {{ $appointment->name }}
    </li>
    <li>
        email: {{ $appointment->email }}
    </li>
    <li>
        phone: {{ $appointment->phone }}
    </li>
    <li>
        schedule_at: {{ $appointment->schedule_at }}
    </li>
</ul>
@endsection

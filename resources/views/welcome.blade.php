@extends('layout')

@section('content')

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ __(session('success')) }}
            <a href="{{route('appointments.last')}}">{{__('appointment.click_to_see_last')}}</a>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ __(session('error')) }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 offset-3">
            <form action="{{route('appointments.store')}}" method="post">
                {{ @csrf_field() }}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" name="name" type="text" class="form-control" required value="sdasds">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input id="phone" name="phone" type="text" class="form-control" value="0624475367">
                    @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control" required value="toto@toot.com">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="schedule_at" class="form-label">Schedule at</label>
                    <input id="schedule_at" name="schedule_at" type="text" class="form-control" required value="12/12/2022 12:20">
                    @error('schedule_at')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <input id="message" name="message" class="form-control">
                    @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

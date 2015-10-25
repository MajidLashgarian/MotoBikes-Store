
{{-- add main layout for dashboard  --}}
@extends('layouts.dashboard_layout')

{{-- Head information of HTML  --}}
@section('title', 'Login Admin')

{{-- Add Header Section  --}}
@section('header')

@parent
@endsection

{{-- Add Main Content Section  --}}
@section('page-title', 'Login Admin')
@section('main-content')
@parent
    <form method="POST" action="/admin/login">
        {!! csrf_field() !!}

        <div>
    Email
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
    Password
            <input type="password" name="password" id="password">
        </div>

        <div>
            <input type="checkbox" name="remember"> Remember Me
    </div>

        <div>
            <button type="submit">Login</button>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger" style="color: red;">
            Errors:
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
@endsection
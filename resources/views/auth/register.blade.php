
{{-- add main layout for dashboard  --}}
@extends('layouts.dashboard_layout')

{{-- Head information of HTML  --}}
@section('title', 'Login Admin')

{{-- Add Header Section  --}}
@section('header')

@parent
@endsection

{{-- Add Main Content Section  --}}
@section('page-title', 'Register Admin')
@section('main-content')
@parent
<div style="color: red">It seems there isn't any admin for this web site please register admin user. Note: you can only register admin for first time</div>
<br>
<form method="POST" action="/admin/register">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>
@endsection
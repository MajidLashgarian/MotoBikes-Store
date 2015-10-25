
{{-- add main layout for dashboard  --}}
@extends('layouts.dashboard_layout')

{{-- Head information of HTML  --}}
@section('title', 'Register Success')

{{-- Add Header Section  --}}
@section('header')
@parent
    @if(isset($isAdmin) && $isAdmin==1)
        <p>Last Login : 2014/2/13 13:00:00 </p>
    @endif

@endsection

{{-- Add Main Content Section  --}}
@section('page-title', 'Search Result')
@section('main-content')
@parent
@include('bikes.search')
@include('bikes.biketable')
@if(isset($isAdmin) && $isAdmin==1)
    <button><a href="/">Back to Home</a></button>
    <button><a href="/admin/register_newbike">Create New Motobike</a></button>
@endif
@endsection
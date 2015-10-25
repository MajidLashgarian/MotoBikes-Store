{{-- add main layout for dashboard  --}}
@extends('layouts.dashboard_layout')

{{-- Head information of HTML  --}}
@section('title', 'Show Moto bike')

{{-- Add Header Section  --}}
@section('header')
@parent
@if(isset($isAdmin) && $isAdmin==1)
    <p>Last Login : 2014/2/13 13:00:00 </p>
@endif

@endsection

{{-- Add Main Content Section  --}}
@section('page-title', 'Motobike Information')
@section('main-content')
@parent
<p>Moto bike information</p>
<p>id is : {{ $motobike->id }}</p>
<p>model_name is : {{ $motobike->model_name }}</p>
<p>model_date is : {{ $motobike->model_date }}</p>
<p>vendor is : {{ $motobike->vendor }}</p>
<p>color is : <div style="height: 50px; width: 50px;background-color: {{ $motobike->color}};"></div></p>
<p>cc is : {{ $motobike->cc }}</p>
<p>weight is : {{ $motobike->weight }}</p>
<p>price is : {{ $motobike->price }}</p>
<p>img_src is : <img src="{{$motobike->img_src}}" style="width: 100px"></p>


<button><a href="{{ URL::previous() }}">Back</a></button>
@endsection

{{-- add main layout for dashboard  --}}
    @extends('layouts.dashboard_layout')

{{-- Head information of HTML  --}}
    @section('title', 'Register Success')

{{-- Add Header Section  --}}
    @section('header')
    @parent
    <p>Last Login : 2014/2/13 13:00:00 </p>
    @endsection

{{-- Add Main Content Section  --}}
    @section('page-title', 'Motobike registered successed')
    @section('main-content')
    @parent
        <p>Moto bike information</p>
        <p>id is : {{ $motobike->id }}</p>
        <p>model_name is : {{ $motobike->model_name }}</p>
        <p>model_date is : {{ $motobike->model_date }}</p>
        <p>vendor is : {{ $motobike->vendor }}</p>
        <p>color is : {{ $motobike->color }}</p>
        <p>cc is : {{ $motobike->cc }}</p>
        <p>weight is : {{ $motobike->weight }}</p>
        <p>price is : {{ $motobike->price }}</p>
        <p>img_src is : {{ $motobike->img_src }}</p>

        <button><a href="/">Back to Main</a></button>
        <button><a href="/admin/register_newbike">Create New Motobike</a></button>
    @endsection

{{-- add main layout for dashboard  --}}
    @extends('layouts.dashboard_layout')


{{-- Head information of HTML  --}}
    @section('title', 'Register New bike')


{{-- Add Header Section  --}}
    @section('header')
        @parent
        <p>Last Login : 2014/2/13 13:00:00 </p>

    @endsection


{{-- Add Main Content Section  --}}
    @section('page-title', 'Register New Bike')
    @section('main-content')
        @parent
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
        <form method="POST"  action="/admin/register_newbike" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <fieldset>
                <legend>Motobike information from:</legend>
                <div>
                    Vendor:
                    <input type="text" name="vendor_name" placeholder="BMW" value="{{ old('vendor_name') }}" required>
                </div>
                <div>
                    Model:
                    <input type="text" name="model" placeholder="Race T series" value="{{ old('model') }}" required>
                </div>

                <div>
                    Produce Year(month-year):
                    <input type="month" name="produce_year" value="{{ old('produce_year') }}" required>
                </div>

                <div>
                    Size of engine(CC):
                    <input type="number" name="size_of_motor" value="{{ old('size_of_motor') }}" placeholder="0.0" required>
                </div>
                <div>
                    Color:
                    <input type="color" name="color" value="{{ old('color') }}" required>
                </div>
                <div>
                    Weight(Kg.):
                    <input type="number" name="weight" value="{{ old('weight') }}" placeholder="0" required>
                </div>
                <div>
                    Price($):
                    <input type="number" name="price" value="{{ old('price') }}" placeholder="0.00" required>
                </div>
                <div>
                    Image
                    <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" required>
                </div>

                <div>
                    <button type="submit">Register</button>
                </div>
            </fieldset>
        </form>
    @endsection




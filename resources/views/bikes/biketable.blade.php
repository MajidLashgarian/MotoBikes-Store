
<table style="width:80% ; margin: auto">
    <tbody>
    <tr>
        <th>ID</th>
        <th>Model Name</th>
        <th>Vendor</th>
        <th>Color</th>
        <th>Engine Size(CC)</th>
        <th>Weight</th>
        <th>Price</th>
        <th>Image</th>
        <th>Data added</th>
    </tr>
    @foreach ($products as $product)
    @if(isset($isAdmin) && $isAdmin==1)
    <tr style="cursor: pointer" onclick="window.location.href = '/admin/motobike/{{$product->id}}';">
    @else
    <tr style="cursor: pointer" onclick="window.location.href = '/motobike/{{$product->id}}';">
    @endif
        <td>{{$product->id}}</td>
        <td>{{$product->model_name}}</td>
        <td>{{$product->vendor}}</td>
        <td><div style="height: 50px; width: 50px;background-color: {{$product->color}}; margin: auto"></div></td>
        <td>{{$product->cc}}</td>
        <td>{{$product->weight}}</td>
        <td>{{$product->price}}</td>
        <td><img src="{{$product->img_src}}" style="width: 100px"></td>
        <td>{{$product->created_at}}</td>
    </tr>


    @endforeach
    </tbody>
</table>

{!! $products->render() !!}
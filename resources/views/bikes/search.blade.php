<div style="width: 80%;margin: auto">
    <form method="get" action="/">
        <select name="type">
            <option value="">Please Select Sorting Field</option>
            <option value="price">Price</option>
            <option value="created_at">Date added</option>
            <option value="wieght">wieght</option>
        </select>
        <select name="sort">
            <option value="ASC">Increase</option>
            <option value="DESC">Decrease</option>
        </select>
        <button style="width: 100px;height: 30px" type="submit">Sort</button>
    </form>
    <form method="get" action="/search">
        <input type="color" name="color" value="{{ old('color') }}">
        <button style="width: 100px;height: 30px" type="submit">Filter By color</button>
    </form>
    <br>
    <form method="get" action="/search">
        <input style="width: 400px; height: 30px" type="text" name="query" placeholder="Enter Vendor or Modelname.Regualr expersion accepted ">
        <button style="width: 100px;height: 30px" type="submit">Search</button>
    </form>
</div>
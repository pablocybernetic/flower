@extends('admin/adminlayout')

@section('container')

<!-- Add Menu Button -->
<a href="/add/menu" type="button" class="btn btn-success" style="width:170px;height:35px;padding-top:9px;">+ Add Menu</a>

<br><br>

<!-- Success and Error Alerts -->
@if(Session::has('wrong'))
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Opps !</strong> {{ Session::get('wrong') }}
    </div>
    <br>
@endif
@if(Session::has('success'))
    <div class="success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        <strong>Congrats !</strong> {{ Session::get('success') }}
    </div>
    <br>
@endif

<!-- Table to Display Products -->
<table class="table mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            {{-- <th>Description</th> --}}
            <th>Category</th>
            {{-- <th>Season</th> --}}
            <th>Price</th>
            <th>Availability</th>
            <th>Rating</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach($products as $product)
            <?php
                // Calculate average rating
                $total_rate = DB::table('rates')->where('product_id', $product->id)->sum('star_value');
                $total_voter = DB::table('rates')->where('product_id', $product->id)->count();
                $per_rate = $total_voter > 0 ? number_format($total_rate / $total_voter, 1) : 0;
            ?>
            <tr>
                <td>{{ $i++ }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('assets/images/'.$product->image) }}" alt="Product Image"  style="width: 50px; height: 50px; border-radius: 5px;">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                {{-- <td>{{ $product->description }}</td> --}}
                <td>{{ $product->catagory }}</td>
                {{-- <td>
                    @if($product->session == 0)
                        Breakfast
                    @elseif($product->session == 1)
                        Lunch
                    @elseif($product->session == 2)
                        Day
                    @endif
                </td> --}}
                <td>{{ $product->price }} KES</td>
                <td>
                    @if($product->available == "Stock")
                        In Stock
                    @else
                        Out of Stock
                    @endif
                </td>
                <td>{{ $per_rate }} / 5</td>
                <td>
                    <a href="{{ asset('/menu/edit/'.$product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ asset('/menu/delete/'.$product->id) }}" class="btn btn-danger btn-sm" style="margin-left:10px;">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

<style>
    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
    }

    .success {
        padding: 20px;
        background-color: #4BB543;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>

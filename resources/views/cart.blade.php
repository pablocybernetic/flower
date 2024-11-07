@extends('layout', ['title'=> 'Home'])

@section('page-content')
<br><br>

<div class="container mt-5">
    <!-- Alerts Section -->
    @if(Session::has('wrong'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> {{ Session::get('wrong') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>Congrats!</strong> {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Shopping Cart Section -->
    <div class="cart-container mt-4 shadow-sm p-4 rounded">
        <table class="table" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: none;">Product</th>
                    <th style="border: none;">Qty</th>
                    <th style="border: none;">Total</th>
                    <th style="border: none;">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach($carts as $product)
                    @php $total += $product['price'] * $product['quantity'] @endphp
                    <tr>
                        <td style="border: none;">{{ $product->name }}</td>
                        <td style="border: none;">(x{{ $product->quantity }})</td>
                        <td style="border: none;">Ksh {{ $product->subtotal }}</td>
                        <td style="border: none;">
                            <form method="post" action="{{ route('cart.destroy', $product) }}" onsubmit="return confirm('Are you sure you want to remove this item?')">
                                @csrf
                                <button class="btn btn-danger btn-sm rounded-circle" title="Remove item"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        
                @if($total_price != 0)
                    @foreach($extra_charge as $charge)
                        <tr>
                            <td style="border: none;">{{ $charge->name }}</td>
                            <td style="border: none;"></td>
                            <td style="border: none;">Ksh {{ $charge->price }}</td>
                            <td style="border: none;"></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        
        <!-- Coupon Code Section -->
        <div class="coupon-section mt-4">
            <form method="post" action="{{ route('coupon/apply') }}">
                @csrf
                <div class="d-flex justify-content-between">
                    <div class="coupon-label">
                        <strong>Coupon Code</strong>
                    </div>
                    <div class="coupon-input">
                        <input type="text" name="code" class="form-control form-control-sm" placeholder="Enter Coupon Code">
                    </div>
                    <div class="coupon-action">
                        <button type="submit" class="btn btn-dark btn-sm" {{ $total_price == 0 ? 'disabled' : '' }}>Apply</button>
                    </div>
                </div>
            </form>
        </div>
        

        <!-- Total Price Section -->
        <div class="total-section mt-4">
            <div class="d-flex justify-content-between mb-2">
                <span><strong>Total Ksh {{ $without_discount_price }}</strong></span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span><strong>Discount Ksh {{ $discount_price }}</strong></span>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <h6><strong>Total (With Discount) Ksh {{ $total_price }}</strong></63>
            </div>
        </div>

        <!-- Actions Section -->
        <div class="actions-section mt-4 d-flex justify-content-between">
            <a href="{{ url('/menu') }}" class="btn btn-warning btn-md"><i class="fa fa-angle-left"></i> Continue Shopping</a>
            <form method="post" action="{{ route('cart.checkout', $total) }}">
                @csrf
                <button class="btn btn-success btn-md" {{ $total_price == 0 ? 'disabled' : '' }}>Checkout</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection

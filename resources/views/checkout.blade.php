@extends('layout', ['title'=> 'Home'])

@section('page-content')
<div style="width:80%; margin:auto;">
    <br>
    <br>
    <br>
    <br>
    <h4>Your order amount is Ksh{{$total}}</h4><br>
    <h6 style="color:#75c1d8">Payment Method</h6><br>
    <input ng-model="myVar" type="radio" id="cod" name="cod" value="cod"> 
    <label for="cod"><img style="max-width:150px;" src="{{ asset('assets/images/cod.png')}}"></label><br> 
    <input ng-model="myVar" type="radio" id="bkash" name="bkash" value="bkash">
    <label for="bkash"><img style="max-width:150px;"  src="{{ asset('assets/images/bkash.png')}}"></label><br><br><br>
    <div ng-switch="myVar">
        @if (Auth::check())
            <div ng-switch-when="cod">
             
                <form style="display:inline"  method="post" action="{{route('mails.shipped', $total)}}">
                @csrf
                    <input class="btn btn-success" type="submit" value="Place Order">
                </form>
            </div>
            <div ng-switch-when="bkash">
            <?php
                Session::put('total',$total);
            ?>
            <a href="/ssl/pay"><input class="btn btn-success" type="submit" value="Pay with Mpesa"></a>
                 
                @include('bkash-script')
            </div>
        @else
            <div ng-switch-when="cod">
               
            </div>
            <div ng-switch-when="bkash">
                <a href="/login"><input class="btn btn-success" type="submit" value="Log in"></a>
            </div>
        @endif
    </div>
</form>
</div>
@endsection

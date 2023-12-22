@extends('admin/adminlayout')

@section('container')

<br>

@if(Session::has('wrong'))

    <div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Opps !</strong> {{Session::get('wrong')}}
</div>
<br>
    @endif
    @if(Session::has('success'))

    <div class="success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Congrats !</strong> {{Session::get('success')}}
</div>
    <br>
    @endif


@foreach($products as $product)
<div class="card">
  <h5 class="card-header">Customer Details</h5>
  <div class="card-body">
    <h5 class="card-text">Invoice No : {{  $product->invoice_no }}</h5>
    <br>
    <?php


        $user=DB::table('users')->where('id',$product->user_id)->first();

    ?>
    <p class="card-text">Customer Name : {{ $user->name }}</p>
    <p class="card-text">Customer Phone : {{ $user->phone }}</p>
    <p class="card-text">Customer Email : {{ $user->email }}</p>
    <p class="card-text">Shipping Address : {{ $product->shipping_address }}</p>
    <a href="/customer" class="btn btn-primary"><b>Details</a>
  </div>
</div>

@break;




@endforeach


<br>




<div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Product Details</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          
           
                            <th> Product Name </th>
                            <th> Price </th>
                            <th> Quantity </th>
                            <th> Subtotal </th>
                          
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                          <tr>
                           
                      
                            <td> {{ $product->name }} </td>
                            <td> {{ $product->price }} </td>
                            <td>


                            {{ $product->quantity }}


                            </td>


                            <td>  {{  $product->subtotal }}</td>
                      
                          </tr>

                        @endforeach

                        @foreach($extra_charge as $charge)
                          <tr>
                           
                      
                            <td> {{ $charge->name }} </td>
                      
                           <td>

                           </td>
                           <td></td>


                            <td>  {{  $charge->price }}</td>
                      
                          </tr>

                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total </td>
                            <td class="">  Ksh {{  $wihout_discount_price }}</td>                   
                    
                    
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Discount </td>
                            <td class="">  Ksh {{  $discount_price }}</td>                   
                    
                    
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td><h3>Total (With Discount)</h3> </td>
                            <td class=""><h3>  Ksh {{  $total_price }} </h3></td>                   
                    
                    
                        </tr>
                       
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              @foreach($products as $product)
              @if($product->product_order=="yes")
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Order Process</h4>
                  
                    
          

                    <form class="forms-sample" action="{{ asset('/invoice/approve/'.$product->invoice_no) }}" method="post" enctype="multipart/form-data">

                       @csrf

                      <div class="form-group">
                        <label for="exampleInputName1">Delivery Time</label>
                        <input type="datetime-local" name="time" value="2022-07-28T19:30" class="form-control" id="exampleInputName1">
                      </div>
                 
                    
                      <button type="submit" class="btn btn-primary me-2">Approve Order</button>
                      <a href="{{  asset('/invoice/cancel-order/'.$product->invoice_no) }}" class="btn btn-danger">Cancel Order</a>
                    </form>

                    @break;

   

                  </div>
                </div>

            </div>



            @endif
            @endforeach


         




@endsection()



<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.success {
  padding: 20px;
  background-color: #4BB543 ;
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
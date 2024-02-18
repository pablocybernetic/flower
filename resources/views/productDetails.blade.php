<!-- resources/views/productDetails.blade.php -->
@extends('layout', ['title'=> 'Product Details'])

@section('page-content')
<br><br><br><br><br>
<section class="py-5">
    <div class="container">
      <div class="row gx-5">
        <aside class="col-lg-6">
          <div class="border rounded-4 mb-3 d-flex justify-content-center">
            <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="{{asset('assets/images/'.$product->image)}}">
              <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="{{asset('assets/images/'.$product->image)}}" />
            </a>
          </div>
          <div class="d-flex justify-content-center mb-3">
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="#" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="{{asset('assets/images/'.$product->image)}}" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="#" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="#" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="#" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="#" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="#" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="#" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="#" class="item-thumb">
              <img width="60" height="60" class="rounded-2" src="#" />
            </a>
          </div>
          <!-- thumbs-wrap.// -->
          <!-- gallery-wrap .end// -->
        </aside>
        <main class="col-lg-6">
          <div class="ps-lg-3">
            <h4 class="title text-dark">
                {{ $product->name }}
            </h4>
            <div class="d-flex flex-row my-3">
              <div class="text-warning mb-1 me-2">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span class="ms-1">
                  4.5
                </span>
              </div>
              <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span>
              <span class="text-success ms-2">In stock</span>
            </div>
  
            <div class="mb-3">
              <span class="h5">Ksh {{ $product->price }}</span>
              <span class="text-muted">/per item</span>
            </div>
  
            <p>
                {{ $product->description }} 
            </p>
  
            <div class="row">
              <dt class="col-3">Category:</dt>
              <dd class="col-9">{{ $product->category }}</dd>
  
              <dt class="col-3">Color</dt>
              <dd class="col-9">Brown</dd>
  
              <dt class="col-3">Material</dt>
              <dd class="col-9">Cotton, Jeans</dd>
  
              <dt class="col-3">Brand</dt>
              <dd class="col-9">Reebook</dd>
            </div>
  
            <hr />
  
            <div class="row mb-4">
              <div class="col-md-4 col-6">
                <label class="mb-2">Size</label>
                <select class="form-select border border-secondary" style="height: 35px;">
                  <option>Small</option>
                  <option>Medium</option>
                  <option>Large</option>
                </select>
              </div>
              <!-- col.// -->
              <div class="col-md-4 col-6 mb-3">
                <label class="mb-2 d-block">Quantity</label>
                <div class="input-group mb-3" style="width: 170px;">
                  <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                    <i class="fas fa-minus"></i>
                  </button>
                  <input type="text" class="form-control text-center border border-secondary" placeholder="14" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                  <button class="btn btn-white border border-secondary px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
            </div>
            <form method="post" action="{{ route('cart.store', $product->id) }}">
                @csrf
                <label class="mb-2 d-block">Quantity</label>
                <div class="row row-md-4 row-6 mb-3">
                    <div class="input-group mb-3" style="width: 170px;">
                        <button class="btn btn-white border border-secondary px-3" type="button" id="decrementButton" data-mdb-ripple-color="dark">
                            <i class="fa fa-minus"></i>
                        </button>
                        <input type="text" class="form-control text-center border border-secondary" placeholder="1" id="quantityInput" name="number"  value="1" aria-label="Quantity" aria-describedby="decrementButton incrementButton" />
                        <button class="btn btn-white border border-secondary px-3" type="button" id="incrementButton" data-mdb-ripple-color="dark">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary shadow-0">
                            <i class="me-1 fa fa-shopping-cart"></i> Add to cart                     
                            </button>
                    </div> 
                </div>

                
               
            </form>
            <a href="/cart" class="btn btn-warning shadow-0"> Buy now </a>
            
            <a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i class="me-1 fa fa-heart fa-lg"></i> Save </a>
          </div>
        </main>
      </div>
    </div>
  </section>
<section>
<div class="container">
    <hr>
</div>


<div class="container mt-5">
    

    <hr>

            <h4 class="mb-3">Suggested Products</h4>
</div>
          

</section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="menu-item-carousel">
                <div class="grid-container row gx-4">
                    @foreach($products as $product)
                    <div class="col-6 col-md-3 col-lg-3 mb-4">
                        <div class="card">
                            {{-- <i class="fa fa-pagelines fa-lg pt-3 pb-1 px-3"></i> --}}
                            <a href="/menu/{{ $product->id }}">
                                <div style="padding-bottom: 100%; position: relative;">
                                    <img src="{{asset('assets/images/'.$product->image)}}" class="card-img-top img-fluid" alt="Product Image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                </div></a>
                            <div class="card-body">
                                <h6 class="card-title fs-5">{{ $product->name }}</h6>
                                {{-- <p class="card-text text-muted mb-3 description">{{ $product->description }}</p> --}}
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Total</span>
                                    <span class="fs-6">Ksh {{ $product->price }}</span>
                                </div>
                                <form method="post" action="{{ route('cart.store', $product->id) }}">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <input type="number" name="number" class="form-control form-control-sm" value="1">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-sm rounded-circle">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @if($product->available != "Stock")
                                <h4 class="text-danger fs-6">Out Of Stock</h4>                                            @endif 

                    <span class="product_rating">
                        
                    <?php

                    
                    $total_rate=DB::table('rates')->where('product_id',$product->id)
                    ->sum('star_value');


                    $total_voter=DB::table('rates')->where('product_id',$product->id)
                    ->count();

                    if($total_voter>0)
                    {

                        $per_rate=$total_rate/$total_voter;

                    }
                    else
                    {

                        $per_rate=0;


                    }

                    $per_rate=number_format($per_rate, 1);


                    $whole = floor($per_rate);      // 1
                    $fraction = $per_rate - $whole

                ?>
                        @for($i=1;$i<=$whole;$i++)

                          <i class="fa fa-star "></i>

                          @endfor

                          @if($fraction!=0)

                          <i class="fa fa-star-half"></i>

                          @endif
                              
                              
                          <span class="rating_avg">({{  $per_rate}})</span>
  </span>
<br>
                         <a href="/rate/{{ $product->id }}" style="color:blue;">Rate this</a>

                    <?php

                    
                    $total_rate=DB::table('rates')->where('product_id',$product->id)
                    ->sum('star_value');


                    $total_voter=DB::table('rates')->where('product_id',$product->id)
                    ->count();

                    if($total_voter>0)
                    {

                        $per_rate=$total_rate/$total_voter;

                    }
                    else
                    {

                        $per_rate=0;


                    }

                    $per_rate=number_format($per_rate, 1);


                    $whole = floor($per_rate);      // 1
                    $fraction = $per_rate - $whole

                ?>
                         
                              </div>
                            </div>
                          </div>
                          @endforeach

                        </div>
                      </div>
                  
                


          
        </div>
    </div>
</div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const decrementButton = document.getElementById('decrementButton');
        const incrementButton = document.getElementById('incrementButton');
        const quantityInput = document.getElementById('quantityInput');

        decrementButton.addEventListener('click', function() {
            updateQuantity(-1);
        });

        incrementButton.addEventListener('click', function() {
            updateQuantity(1);
        });

        function updateQuantity(change) {
            let currentValue = parseInt(quantityInput.value) || 0;
            currentValue += change;

            // Ensure quantity is not less than 1
            currentValue = Math.max(currentValue, 1);

            quantityInput.value = currentValue; // Update the hidden form input value
        }
    });
</script>

@endsection

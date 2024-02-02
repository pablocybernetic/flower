{{-- old product item --}}

@foreach($menu as $product)
                       
<div class="grid-item  ">

<?php
    $img=$product->image;
?>
    <div class='card' style="background-image: url({{asset('assets/images/'.$img)}}); background-size: 300px; background-position: center; height: 300px ;"> 

        <div class="price"><h6>Ksh{{ $product->price }}</h6>
        @if($product->available!="Stock")
        <h4 style="">Out Of Stock</h4> 

        @endif
    
    </div>
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
        <div class='info'>
          <h1 class='title'>{{ $product->name }}</h1>
          <p class='description'>{{ $product->description  }}</p>
          <div class="main-text-button">
              <div class="scroll-to-section" >
              <span class="product_rating">
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
              <p>Quantity: </p>
            @if($product->available=="Stock")
              <form method="post" action="{{route('cart.store',$product->id)}}">
                 @csrf
              <input type="number" name="number" style="width:50px;" id="myNumber" value="1">
                <input type="submit" class="btn btn-success" value="Add Chart">
              </form>
            @endif

            @if($product->available!="Stock")
              <form method="post" action="{{route('cart.store',$product->id)}}">
                 @csrf
              <input type="number" name="number" style="width:50px;" id="myNumber" value="1">
                <input type="submit" class="btn btn-success" disabled value="Add Chart">
              </form>
            @endif
            </div>
          </div>
          
        </div>
    </div><div class="row">
        <h1 class='title' style="color: #75c1d8">{{ $product->name }}</h1>
        <h1 class='title' style="color: #75c1d8">Ksh {{ $product->price }}</h1>


    </div>

</div>

@endforeach

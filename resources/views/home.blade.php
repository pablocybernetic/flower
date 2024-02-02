@extends('layout', ['title'=> 'Home'])

@section('page-content')

    <!-- ***** Main Banner Area Start ***** -->
    <div id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="left-content">
                        <div class="inner-content">
                            <h3>Pandakivuli</h3>
                            <h4>We deriver within two hours.</h4>
                            <div class="main-white-button scroll-to-section">
                                <a href="#reservation"><h2>Make A Reservation</h2></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="main-banner header-text">
                        <div class="Modern-Slider">

                        @foreach($banners as $banner)
                          <!-- Item -->
                          <div class="item">
                            <div class="img-fill">
                                <img src="{{ asset('assets/images/'.$banner->image)}}" alt="">
                            </div>
                          </div>

                        @endforeach
                          <!-- // Item -->
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
                           
    <!-- ***** Menu Area Starts ***** -->
    <section class="section"  id="menu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="section-heading" >
                            <h6> our plants</h6>
                            <h2> here's a selection of our plants </h2>
                        </div>
                    </div>
                </div>
            </div>




            
            <div class="menu-item-carousel">
                <div class="col-lg-12">
                    <style>.grid-container {
                        display: grid;
                        /* grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); Adjust the column width as needed */
                        gap: 10px; /* Adjust the gap between grid items as needed */
                      }
                      
                      .grid-item {
                        /* Your individual grid item styles go here */
                        background-color: #eee;
                        padding: 10px;
                        text-align: center;
                      }
                      </style>




                        <div class="grid-container row-lg-1">

                        
                            <section style="background-color: #eee;">
                                <div class="container py-5">
                                  <div class="row justify-content-center">
                                    {{-- begining of single product --}}
                                    {{-- <div class="col-md-8 col-lg-6 col-xl-4">
                                      <div class="card text-black">
                                        <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                                        <img
                                          src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/3.webp"
                                          class="card-img-top"
                                          alt="Apple Computer"
                                        />
                                        <div class="card-body">
                                          <div class="text-center">
                                            <h5 class="card-title">Believing is seeing</h5>
                                            <p class="text-muted mb-4">Apple pro display XDR</p>
                                          </div>
                                          <div>
                                            <div class="d-flex justify-content-between">
                                              <span>Pro Display XDR</span><span>$5,999</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                              <span>Pro stand</span><span>$999</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                              <span>Vesa Mount Adapter</span><span>$199</span>
                                            </div>
                                          </div>
                                          <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                            <span>Total</span><span>$7,197.00</span>
                                          </div>
                                        </div>
                                      </div>
                                    </div> --}}
                                  {{-- end of single item --}}
                                  @foreach($menu as $product)
                                  <?php
                                  $img=$product->image;
                              ?>
                               
                                      <div class="col-md-8 col-lg-6 col-xl-4">
                                        <div class="card text-black">
                                          <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                                          <img
                                            src="{{asset('assets/images/'.$img)}}"
                                            class="card-img-top"
                                            alt="Apple Computer"
                                          />
                                          <div class="card-body">
                                            <div class="text-center">
                                              <h5 class="card-title">{{ $product->name }}</h5>
                                              <p class="text-muted mb-4">{{ $product->description  }}</p>
                                            </div>
                                            <div>
                                              <div class="d-flex justify-content-between">
                                                <span>Pro Display XDR</span><span>Ksh 5,999</span>
                                              </div>
                                              <div class="d-flex justify-content-between">
                                                <span>Pro stand</span><span>Ksh 999</span>
                                              </div>
                                              <div class="d-flex justify-content-between">
                                                <span>Vesa Mount Adapter</span><span>Ksh 199</span>
                                              </div>
                                            </div>
                                            <div class="d-flex justify-content-between total font-weight-bold mt-4">
                                              <span>Total</span><span>Ksh {{ $product->price }}</span>
                                            </div>
                                            <p>Quantity: </p>
                                    @if($product->available=="Stock")
                                      <form method="post" action="{{route('cart.store',$product->id)}}">
                                         @csrf
                                      <input type="number" name="number" style="width:50px;" id="myNumber" value="1">
                                        <input type="submit" class="btn btn-primary" value="Add Chart">
                                        {{-- <button class="btn btn-primary d-flex flex-row" type="button">Add to Cart <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                          </svg>
                                        </button> --}}
                                      </form>
                                    @endif
                                            @if($product->available!="Stock")
                                <h4 style="">Out Of Stock</h4> 
    
                                @endif
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
                              </section>
                            

 
                      
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Menu Area Ends ***** -->

    <!-- ***** About Area Starts ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                        @foreach($about_us as $a_us)
                            <h6>About Us</h6>
                            <h2>{{  $a_us->title  }}</h2>
                        </div>
                        <p>{{  $a_us->description  }}</p>
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('assets/images/'.$a_us->image1)}}" alt="">
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('assets/images/'.$a_us->image2)}}" alt="">
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('assets/images/'.$a_us->image3)}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="right-content">
                        <div class="thumb">
                            <a rel="nofollow" href="{{  $a_us->youtube_link    }}" target="_blank"> <i class="fa fa-play"></i></a>
                            <img src="{{ asset('assets/images/'.$a_us->vd_image)}}" alt="">

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Area Ends ***** -->
    
    <section class="section" id="chefs">
        <div class="container">
          
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        <h6>Our Frourists</h6>
                        <h2>We offer the best freshiest flowers for you</h2>
                    </div>
                </div>
            </div>
           
            <div class="row">
                @foreach($chefs as $chef)
                <div class="col-lg-4">
                    <div class="chef-item">
                        <div class="thumb">
                            <div class="overlay"></div>
                            <ul class="social-icons">
                                <li><a href="{{ $chef->facebook_link  }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{ $chef->twitter_link  }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{ $chef->instragram_link  }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                            <img src="{{ asset('assets/images/'.$chef->image)}}" alt="Chef #1">
                        </div>
                        <div class="down-content">
                            <h4>{{ $chef->name  }}</h4>
                            <span>{{ $chef->job_title  }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>
    </section>
    <!-- ***** Chefs Area Ends ***** -->
     <!-- ***** Menu Area Starts ***** -->
     <section class="section" id="offers">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        <h6>Midway Week</h6>
                        <h2>This Week’s Special Flowers Offers</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row" id="tabs">
                        <div class="col-lg-12">
                            <div class="heading-tabs">
                                <div class="row">
                                    <div class="col-lg-6 offset-lg-3">
                                        <ul>
                                  
                                          <li><a href='#tabs-1'><img src="{{ asset('assets/images/tab-icon-01.png')}}" alt="">Flowers</a></li>
                                          <li><a href='#tabs-2'><img src="{{ asset('assets/images/tab-icon-02.png')}}" alt="">Trees</a></a></li>
                                          <li><a href='#tabs-3'><img src="{{ asset('assets/images/tab-icon-03.png')}}" alt="">Seedlings</a></a></li>
                                      
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="text-align:center;" class="col-lg-12">
                            <section class='tabs-content'>
                                <article id='tabs-1'>
                                    <div class="row">

                                        @foreach($breakfast as $item)

                                        <?php

                            
                                        $total_rate=DB::table('rates')->where('product_id',$item->id)
                                        ->sum('star_value');


                                        $total_voter=DB::table('rates')->where('product_id',$item->id)
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

                                        @if($item->id %2 ==0)
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="left-list">
                                                
                                                    <div class="col-lg-12">
                                                        <div class="tab-item">
                                                            <img src="{{ asset('assets/images/'.$item->image)}}" alt="">
                                                            <h4>{{ $item->name }}</h4>
                                                            <p>{{  $item->description }}</p>
                                                            <div class="price">
                                                                <h6>Ksh{{  $item->price }}</h6>
                                                            </div>
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
                                                        </div>
                                                    </div>
                                                
                                                </div>      
                                            </div>
                                        </div>
                                        @endif

                                        @endforeach
                                        @foreach($breakfast as $item)


                                        <?php

                            
                                        $total_rate=DB::table('rates')->where('product_id',$item->id)
                                        ->sum('star_value');


                                        $total_voter=DB::table('rates')->where('product_id',$item->id)
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

                                        @if($item->id %2 !=0)
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="right-list">
                                                    <div class="col-lg-12">
                                                        <div class="tab-item">
                                                            <img src="{{ asset('assets/images/'.$item->image)}}" alt="">
                                                            <h4>{{ $item->name }}</h4>
                                                            <p>{{  $item->description }}</p>
                                                            <div class="price">
                                                                <h6>Ksh{{  $item->price }}</h6>
                                                            </div>
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
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        @endforeach
                                        
                                      
                                    </div>
                                </article>  
                                <article id='tabs-2'>
                                    <div class="row">
                                    @foreach($lunch as $item)


                                    <?php

                            
                                        $total_rate=DB::table('rates')->where('product_id',$item->id)
                                        ->sum('star_value');


                                        $total_voter=DB::table('rates')->where('product_id',$item->id)
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

                                        @if($item->id %2 ==0)
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="left-list">
                                                
                                                    <div class="col-lg-12">
                                                        <div class="tab-item">
                                                            <img src="{{ asset('assets/images/'.$item->image)}}" alt="">
                                                            <h4>{{ $item->name }}</h4>
                                                            <p>{{  $item->description }}</p>
                                                            <div class="price">
                                                                <h6>Ksh{{  $item->price }}</h6>
                                                            </div>
                                                            <span class="product_rating">
                                                        @for($i=1;$i<=$whole;$i++)

                                                            <i class="fa fa-star "></i>

                                                            @endfor

                                                            @if($fraction!=0)

                                                            <i class="fa fa-star-half"></i>

                                                            @endif
                                                                
                                                                
                                                            <span class="rating_avg">({{  $per_rate}})</span>
                                    </span>
                                                        </div>
                                                    </div>
                                                  
                                                </div>      
                                            </div>
                                        </div>
                                        @endif

                                    @endforeach
                                    @foreach($lunch as $item)

                                    <?php

                            
                                        $total_rate=DB::table('rates')->where('product_id',$item->id)
                                        ->sum('star_value');


                                        $total_voter=DB::table('rates')->where('product_id',$item->id)
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

                                        @if($item->id %2 !=0)
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="right-list">
                                                    <div class="col-lg-12">
                                                        <div class="tab-item">
                                                            <img src="{{ asset('assets/images/'.$item->image)}}" alt="">
                                                            <h4>{{ $item->name }}</h4>
                                                            <p>{{  $item->description }}</p>
                                                            <div class="price">
                                                                <h6>Ksh{{  $item->price }}</h6>
                                                            </div>
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
                                                        </div>
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                    @endforeach
                                      
                                    </div>
                                </article>  
                                <article id='tabs-3'>
                                    <div class="row">
                                    @foreach($dinner as $item)


                                    <?php

                            
                                        $total_rate=DB::table('rates')->where('product_id',$item->id)
                                        ->sum('star_value');


                                        $total_voter=DB::table('rates')->where('product_id',$item->id)
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

                                        @if($item->id %2 ==0)
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="left-list">
                                                
                                                    <div class="col-lg-12">
                                                        <div class="tab-item">
                                                            <img src="{{ asset('assets/images/'.$item->image)}}" alt="">
                                                            <h4>{{ $item->name }}</h4>
                                                            <p>{{  $item->description }}</p>
                                                            <div class="price">
                                                                <h6>Ksh{{  $item->price }}</h6>
                                                            </div>
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
                                  
                                                        </div>
                                                    </div>
                                                
                                                </div>      
                                            </div>
                                        </div>
                                        @endif

                                        @endforeach
                                        @foreach($dinner as $item)


                                        <?php

                            
                                        $total_rate=DB::table('rates')->where('product_id',$item->id)
                                        ->sum('star_value');


                                        $total_voter=DB::table('rates')->where('product_id',$item->id)
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

                                        @if($item->id %2 !=0)
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="right-list">
                                                    <div class="col-lg-12">
                                                        <div class="tab-item">
                                                            <img src="{{ asset('assets/images/'.$item->image)}}" alt="">
                                                            <h4>{{ $item->name }}</h4>
                                                            <p>{{  $item->description }}</p>
                                                            <div class="price">
                                                                <h6>Ksh{{  $item->price }}</h6>
                                                            </div>
                                                            <span class="product_rating">
                                                        @for($i=1;$i<=$whole;$i++)

                                                            <i class="fa fa-star "></i>

                                                            @endfor

                                                            @if($fraction!=0)

                                                            <i class="fa fa-star-half"></i>

                                                            @endif
                                                                
                                                                
                                                            <span class="rating_avg">({{  $per_rate}})</span>
                                    </span>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                    @endforeach
                                     
                                    </div>
                                </article>   
                            </section>
                            <br>
                            <a href="/menu"><input style="color:#fff; background-color:#75c1d8; font-size:20px;"
                            class="btn" type="submit" value="Browse All"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Chefs Area Ends ***** --> 

    <!-- ***** Chefs Area Starts ***** -->

    <!-- ***** Reservation Us Area Starts ***** -->
    <section class="section" id="reservation">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>Contact Us</h6>
                            <h2>Here You Can Make an inquary Or Just walkin to our flowers Store</h2>
                        </div>
                        <p>Members of Pandakivuli  are always active to response your call.</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="phone">
                                    <i class="fa fa-phone"></i>
                                    <h4>Phone Numbers</h4>
                                    <span><a href="#">0705374455</a>
									<br><a href="#">0705374455</a>
									</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="message">
                                    <i class="fa fa-envelope"></i>
                                    <h4>Emails</h4>
                                    <span>
                                        <a href="mailto:support@pandakivuli.com">support@pandakivuli.com</a><br>
                                        <a href="mailto:gitaup08@gmail.com">gitaup08@gmail.com</a><br>
									</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <form id="contact" action="/reserve/confirm" method="post">
                            @csrf
                          <div class="row">
                            <div class="col-lg-12">
                                <h4>Flowers Inquiry</h4>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                                <input name="name" type="text" id="name" placeholder="Your Name*" required="">
                              </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                              <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email Address" required="">
                            </fieldset>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <fieldset>
                                <input name="phone" type="text" id="phone" placeholder="Phone Number*" required="">
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <select value="number-guests" name="no_guest" id="number-guests">
                                    <option value="number-guests">Number Of Flowers</option>
                                    <option name="1" id="1">1</option>
                                    <option name="2" id="2">2</option>
                                    <option name="3" id="3">3</option>
                                    <option name="4" id="4">4</option>
                                    <option name="5" id="5">5</option>
                                    <option name="6" id="6">6</option>
                                    <option name="7" id="7">7</option>
                                    <option name="8" id="8">8</option>
                                    <option name="9" id="9">9</option>
                                    <option name="10" id="10">10</option>
                                    <option name="11" id="11">11</option>
                                    <option name="12" id="12">12</option>
                                </select>
                              </fieldset>
                            </div>
                            <div class="col-lg-6">
                                <div id="filterDate2">    
                                  <div class="input-group date" data-date-format="dd/mm/yyyy">
                                    <input  name="date" id="date" type="text" class="form-control" placeholder="dd/mm/yyyy">
                                    <div class="input-group-addon" >
                                      <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                  </div>
                                </div>   
                            </div>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <select value="time" name="time" id="time">
                                    <option value="time">Time</option>
                                    <option name="Breakfast" id="Breakfast">Breakfast</option>
                                    <option name="Lunch" id="Lunch">Lunch</option>
                                    <option name="Dinner" id="Dinner">Dinner</option>
                                </select>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <textarea name="message" rows="6" id="message" placeholder="Message" required=""></textarea>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="form-submit" class="main-button-icon">Make an Inquiry</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Reservation Area Ends ***** -->

   
    
   @endsection
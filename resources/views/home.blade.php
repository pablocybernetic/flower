@extends('layout', ['title'=> 'Home'])
@section('page-content')
{{-- @include('hero-banner') --}}
<!-- ***** Main Banner Area Start ***** -->
    <div id="top">
        <div class="container-fluid">
            <div class="row">
              
                <div class="col-lg-12">
                    <div class="main-banner header-text">
                        <div class="Modern-Slider">

                        @foreach($banners as $banner)
                          <!-- Item -->
                          <div class="item">
                            <div class="img-fill">
                                <img src="{{ asset('assets/images/'.$banner->image)}}" alt="" style="max-width: 100%; max-height: 30rem; height: auto; object-fit:fill;">
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
    
     <!-- resources/views/search.blade.php -->

     <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <form id="searchForm" class="bg-light p-0 rounded shadow-sm" action="{{ route('home') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="query" id="searchQuery" class="form-control" placeholder="Search products">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to perform search
            function performSearch() {
                var query = $('#searchQuery').val(); // Get the search query
    
                // Send AJAX request
                $.ajax({
                    type: 'GET',
                    url: '{{ route('home') }}', // Replace this with your route
                    data: { query: query },
                    success: function(response) {
                        displayData(response); // Display search results
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
                
            }
    
            // Trigger search whenever the user types something
            $('#searchQuery').on('keyup', function() {
                performSearch();
            });
    
            // Prevent form submission
            $('#searchForm').submit(function(event) {
                event.preventDefault();
            });
        
    
            // Function to display the fetched data on the HTML page
            function displayData(data) {
                // Find the menu-list element
                var menuList = $('#searching');
    
                // Clear any existing content
                menuList.empty();
    
                // Loop through the fetched data and create HTML elements to display it
                $.each(data, function(index, product) {
                    // Create HTML elements to represent the product card
                    var card = $('<div>').addClass('col-6 col-md-3 col-lg-3 mb-4');
                    var cardInnerHtml = `
                        <div class="card" style="min-height: auto;">
                            <a href="/menu/${product.id}">
                                <div style="padding-bottom: 100%; position: relative;">
                                    <img src="assets/images/${product.image}" class="card-img-top img-fluid" alt="Product Image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </a>
                            <div class="card-body">
                                <h6 class="card-title fs-5">${product.name}</h6>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Total</span>
                                    <span class="fs-6">Ksh ${product.price}</span>
                                </div>
                                <form method="post" action="/menu/${product.id}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> <!-- Add this line -->

                                    <div class="row align-items-center">
                                        <div class="col">
                                            <input type="number" name="number" class="form-control form-control-sm" value="1" style="width: 50%">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-sm rounded-circle">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                ${product.available !== "Stock" ? '<p class="text-danger fs-6">Out Of Stock</p>' : ''}
                                <!-- Add the rating section here -->
                                <!-- Assuming product ratings are also fetched from the server -->
                            </div>
                        </div>
                    `;
                    // Set the inner HTML of the card element
                    card.html(cardInnerHtml);
                    // Append the card to the container
                    menuList.append(card);
                });
            }
        });
    </script>
    

            
  <!-- ***** Menu Area Starts ***** -->
<section class="section" id="menu">
    @if(isset($query))
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h6>Our Plants</h6>
                        <h2>Your search results</h2>
                    </div>
                </div>
            </div>
        </div>
        @php
            $displayResults = $searhResults;
        @endphp
    @else
        @php
            $displayResults = $menu;
        @endphp

        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h6>Our Plants</h6>
                        <h2>Here's a selection of our plants</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif

<style>
    .custom-select {
        border-radius: 25px;
    }
</style>

<div class="container" style="padding: 0">
    <div class="row">
        <!-- Filter panel for Desktop on the side, Mobile on top -->
        <div class="col-lg-3 col-12 mb-4">
            <div class="filter-panel p-4 bg-white shadow-lg rounded" style="border-left: 5px solid #28a745;">
                <h5 class="mb-4 text-success text-uppercase fw-bold" style="letter-spacing: 1px;">Filters</h5>
                <!-- Filter Form -->
                <form>
                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label for="category" class="form-label fw-semibold text-secondary">Category</label>
                        <select class="form-select form-control custom-select" id="category">
                            <option value="">All Categories</option>
                            <option value="indoor">Indoor</option>
                            <option value="outdoor">Outdoor</option>
                            <option value="succulents">Succulents</option>
                            <option value="cactus">Cactus</option>
                        </select>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="mb-4">
                        <label for="price" class="form-label fw-semibold text-secondary">Price Range</label>
                        <input type="range" class="form-range form-control" id="price" min="0" max="1000" step="50">
                        <p class="text-muted mt-2">Price: <span id="priceValue" class="fw-bold text-success">500</span> KES</p>
                    </div>

                    <!-- Size Filter -->
                    <div class="mb-4">
                        <label for="size" class="form-label fw-semibold text-secondary">Size</label>
                        <select class="form-select form-control custom-select" id="size">
                            <option value="">All Sizes</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>


            <!-- Light Requirements Filter -->
            <div class="mb-4">
                <label for="light" class="form-label fw-semibold text-secondary">Light Requirements</label>
                <select class="form-select form-control custom-select" id="light">
                    <option value="">All Light Conditions</option>
                    <option value="fullsun">Full Sun</option>
                    <option value="partialsun">Partial Sun</option>
                    <option value="lowlight">Low Light</option>
                </select>
            </div>

            <!-- Watering Needs Filter -->
            <div class="mb-4">
                <label for="watering" class="form-label fw-semibold text-secondary">Watering Needs</label>
                <select class="form-select form-control custom-select" id="watering">
                    <option value="">All Watering Needs</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <!-- Difficulty Level Filter -->
            <div class="mb-4">
                <label for="difficulty" class="form-label fw-semibold text-secondary">Difficulty Level</label>
                <select class="form-select form-control custom-select" id="difficulty">
                    <option value="">All Difficulty Levels</option>
                    <option value="easy">Easy</option>
                    <option value="moderate">Moderate</option>
                    <option value="challenging">Challenging</option>
                </select>
            </div>

            <!-- Growth Rate Filter -->
            <div class="mb-4">
                <label for="growthRate" class="form-label fw-semibold text-secondary">Growth Rate</label>
                <select class="form-select form-control custom-select" id="growthRate">
                    <option value="">All Growth Rates</option>
                    <option value="slow">Slow</option>
                    <option value="medium">Medium</option>
                    <option value="fast">Fast</option>
                </select>
            </div>

            <!-- Pet-Friendly Filter -->
            <div class="mb-4">
                <label for="petFriendly" class="form-label fw-semibold text-secondary">Pet-Friendly</label>
                <select class="form-select form-control custom-select" id="petFriendly">
                    <option value="">All Plants</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
                    <button type="submit" class="btn btn-success w-100 rounded-pill">Apply Filters</button>
                </form>
            </div>
        </div>

        <!-- Product Listing -->
        <div class="col-lg-9 col-12">
            <div class="menu-item-carousel">
                <div class="grid-container row gx-8" id="searching">
                    @foreach($displayResults as $product)
                    <div class="col-6 col-sm-6 col-md-3 col-lg-3 mb-4">
                        <div class="card">
                            <a href="/menu/{{ $product->id }}">
                                <div style="padding-bottom: 100%; position: relative;">
                                    <img src="{{asset('assets/images/'.$product->image)}}" class="card-img-top img-fluid" alt="Product Image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </a>
                            <div class="card-body" style="padding:0.5rem">
                                <strong><span class="fs-6" style="font-size: 20px; font-style:bold;">KES {{ $product->price }}</span></strong>
                                <p class="card-title fs-5" style="color:gray;">{{ $product->name }}</p>

                                @if($product->available == "Stock")
                                <form method="post" action="{{ route('cart.store', $product->id) }}">
                                    @csrf
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <input type="number" name="number" class="form-control form-control-sm" value="1" style="width: 50%; border-radius:30px">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-sm rounded-circle">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <p class="text-danger fs-4" style="font-size: 10px;">Out Of Stock</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for dynamic price range handling
    const minPrice = {{ $displayResults->min('price') }};
    const maxPrice = {{ $displayResults->max('price') }};

    const priceSlider = document.getElementById('price');
    const priceValue = document.getElementById('priceValue');

    // Set the min and max for the slider
    priceSlider.min = minPrice;
    priceSlider.max = maxPrice;

    // Update the displayed value dynamically
    priceSlider.addEventListener('input', function() {
        priceValue.textContent = this.value;
    });
</script>
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
                            <!-- <a href="/menu"><input style="color:#fff; background-color:#75c1d8; font-size:20px;"
                            class="btn" type="submit" value="Browse All"></a> -->
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

   
    <script>
        $(document).ready(function() {
            $('.description').each(function() {
                var $this = $(this);
                var lineHeight = parseInt($this.css('line-height'));
                var maxHeight = lineHeight * 3; // Adjust for three lines
                var actualHeight = $this.prop('scrollHeight');
                
                if (actualHeight > maxHeight) {
                    $this.addClass('more');
                }
            });
        });
    </script>
    
   @endsection
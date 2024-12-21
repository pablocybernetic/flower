@extends('layout', ['title' => 'Home'])
@section('page-content')
    {{-- @include('hero-banner') --}}
    <!-- ***** Main Banner Area Start ***** -->

    <div id="top">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <div class="main-banner header-text">
                        <div class="Modern-Slider">

                            @foreach ($banners as $banner)
                                <!-- Item -->
                                <div class="item">
                                    <div class="img-fill">
                                        <img src="{{ asset('assets/images/' . $banner->image) }}" alt=""
                                            style="max-width: 100%; max-height: 30rem; height: auto; object-fit:fill;">
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
    <style>
        #searchForm {
            border: 1px solid #dee2e6;
            transition: box-shadow 0.3s ease-in-out;
        }

        #searchForm:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #clearFilters {
            transition: background-color 0.3s, color 0.3s;
        }

        #clearFilters:hover {
            background-color: #f8f9fa;
            color: #6c757d;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (for toggle functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- resources/views/search.blade.php -->
    <div class="container mt-5">
        <!-- Search Bar -->
        <div class="mb-4 d-flex justify-content-center">
            <form id="searchForm" class="p-3 bg-white rounded shadow-lg" action="{{ route('search') }}" method="GET"
                style="width: 100%; max-width: 500px;">
                <div class="input-group">
                    <input type="text" name="query" id="searchQuery" class="form-control"
                        placeholder="Search products">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <!-- Filter Section -->
        <div class="col-md-4">
            <label for="priceRange" class="form-label">Price Range</label>
            <input type="range" id="priceRange" class="form-range" min="0" max="1000" step="50">
            <div class="d-flex justify-content-between">
                <span id="minPriceLabel">0</span>
                <label id="currentPriceLabel">Selected Price: Ksh 0</label>

            </div>
        </div>


        <div class="container my-4">
            <!-- Toggle Button for Mobile View -->
            <div class="mb-3 d-lg-none">

                <button class="btn btn-primary w-50" type="button" data-bs-toggle="collapse"
                    data-bs-target="#filterSection" aria-expanded="false" aria-controls="filterSection">
                    Filters
                </button>
            </div>

            <!-- Filters Section (Visible by default on desktop, hidden on mobile until toggle is clicked) -->
            <div class="p-4 rounded shadow-sm bg-light collapse d-lg-block" id="filterSection">
                <h5 class="mb-3 text-secondary">Filters</h5>
                <div class="row gy-3">
                    <div class="col-6 col-md-2">
                        <select id="filterSize" name="size" class="form-select form-select-md">
                            <option value="">Size</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-2">
                        <select id="filterCategory" name="category" class="form-select form-select-md">
                            <option value="">Category</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 col-md-2">
                        <select id="filterLight" name="light" class="form-select form-select-md">
                            <option value="">Light</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select id="filterWater" name="water" class="form-select form-select-md">
                            <option value="">Water</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select id="filterGrowth" name="growth" class="form-select form-select-md">
                            <option value="">Growth</option>
                            <option value="slow">Slow</option>
                            <option value="medium">Medium</option>
                            <option value="fast">Fast</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-2">
                        <select id="filterPet" name="pet" class="form-select form-select-md">
                            <option value="">Pet-Friendly</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-end">
                    <button type="button" id="clearFilters" class="btn btn-outline-secondary btn-sm">Clear
                        Filters</button>
                </div>
            </div>

            <!-- Plants Section -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="section-heading">
                            <h6 class="text-primary">Our Plants</h6>
                            <h2>Here's a selection of our plants</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Search Results -->
        <div id="searching" class="mt-4 row">


        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let fetchedData = [];
            let maxPrice = 0;

            // Function to perform the initial fetch
            function performSearch() {
                var query = $('#searchQuery').val();
                var filters = {
                    size: $('#filterSize').val(),
                    category: $('#filterCategory').val(),
                    light: $('#filterLight').val(),
                    water: $('#filterWater').val(),
                    growth: $('#filterGrowth').val(),
                    pet: $('#filterPet').val()
                };

                $.ajax({
                    type: 'GET',
                    url: '{{ route('home') }}',
                    data: {
                        query: query,
                        filters: filters
                    },
                    success: function(response) {
                        fetchedData = response;
                        updateMaxPrice();
                        applyFilters();
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching data. Please try again later.');
                    }
                });
            }

            // Function to update the maximum price
            function updateMaxPrice() {
                if (fetchedData.length > 0) {
                    maxPrice = Math.max(...fetchedData.map(product => product.price));
                    $('#maxPriceLabel').text(`Max Price: Ksh ${maxPrice}`);
                    $('#priceRange').attr('max', maxPrice).val(maxPrice);
                    $('#currentPriceLabel').text(`Selected Price: Ksh ${maxPrice}`); // Show initial value
                } else {
                    maxPrice = 0;
                    $('#maxPriceLabel').text('Max Price: Ksh 0');
                    $('#priceRange').attr('max', maxPrice).val(0);
                    $('#currentPriceLabel').text('Selected Price: Ksh 0');
                }
            }

            // Function to apply filters locally on fetched data
            function applyFilters() {
                var query = $('#searchQuery').val().toLowerCase();
                var filters = {
                    size: $('#filterSize').val(),
                    category: $('#filterCategory').val(),
                    light: $('#filterLight').val(),
                    water: $('#filterWater').val(),
                    growth: $('#filterGrowth').val(),
                    pet: $('#filterPet').val(),
                    price: parseFloat($('#priceRange').val())
                };

                var filteredData = fetchedData.filter(function(product) {
                    const matchesQuery = query === '' || product.name.toLowerCase().includes(query);
                    const matchesSize = !filters.size || product.size.toLowerCase() === filters.size
                        .toLowerCase();
                    const matchesCategory = !filters.category || product.catagory === filters.category;
                    const matchesLight = !filters.light || product.light.toLowerCase() === filters.light
                        .toLowerCase();
                    const matchesWater = !filters.water || product.water.toLowerCase() === filters.water
                        .toLowerCase();
                    const matchesGrowth = !filters.growth || product.growth.toLowerCase() === filters.growth
                        .toLowerCase();
                    const matchesPet = !filters.pet || product.pet.toLowerCase() === filters.pet
                        .toLowerCase();
                    const matchesPrice = !filters.price || product.price <= filters.price;

                    return (
                        matchesQuery &&
                        matchesSize &&
                        matchesCategory &&
                        matchesLight &&
                        matchesWater &&
                        matchesGrowth &&
                        matchesPet &&
                        matchesPrice
                    );
                });

                displayData(filteredData);
            }

            // Function to display the fetched/filtered data
            function displayData(data) {
                var menuList = $('#searching');
                menuList.empty();

                if (data.length === 0) {
                    menuList.append('<p class="text-center">No results found</p>');
                    return;
                }

                $.each(data, function(index, product) {
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
                        <div class="mb-3 d-flex justify-content-between">
                            <span>Total</span>
                            <span class="fs-6">Ksh ${product.price}</span>
                        </div>
                        <form method="post" action="/menu/${product.id}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                    </div>
                </div>
            `;
                    card.html(cardInnerHtml);
                    menuList.append(card);
                });
            }

            // Event listeners
            $('#priceRange').on('input', function() {
                const currentPrice = $(this).val();
                $('#currentPriceLabel').text(`Selected Price: Ksh ${currentPrice}`); // Update dynamically
                applyFilters(); // Apply filters while sliding
            });

            $('#searchQuery, #filterSize, #filterCategory, #filterLight, #filterWater, #filterGrowth, #filterPet')
                .on('change', applyFilters);

            // Prevent form submission
            $('#searchForm').submit(function(event) {
                event.preventDefault();
            });

            // Perform the initial search
            performSearch();

            // Clear filters functionality
            $('#clearFilters').on('click', function() {
                $('#searchQuery').val('');
                $('#filterSize, #filterCategory, #filterLight, #filterWater, #filterGrowth, #filterPet')
                    .val('');
                $('#priceRange').val(maxPrice);
                $('#currentPriceLabel').text(`Selected Price: Ksh ${maxPrice}`); // Reset displayed price
                applyFilters();
            });
        });
    </script>



    <!-- ***** Menu Area Starts ***** -->


    <!-- ***** Menu Area Ends ***** -->


    {{-- @include('products') --}}


    <!-- ***** About Area Starts ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                            @foreach ($about_us as $a_us)
                                <h6>About Us</h6>
                                <h2>{{ $a_us->title }}</h2>
                        </div>
                        <p>{{ $a_us->description }}</p>
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset('assets/images/' . $a_us->image1) }}" alt="">
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('assets/images/' . $a_us->image2) }}" alt="">
                            </div>
                            <div class="col-4">
                                <img src="{{ asset('assets/images/' . $a_us->image3) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="right-content">
                        <div class="thumb">
                            <a rel="nofollow" href="{{ $a_us->youtube_link }}" target="_blank"> <i
                                    class="fa fa-play"></i></a>
                            <img src="https://pandakivuli.co.ke/assets/images/529514846.png" alt="">
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
                <div class="text-center col-lg-4 offset-lg-4">
                    <div class="section-heading">
                        <h6>Our Team</h6>
                        <!-- <h2>We offer the best freshiest flowers for you</h2> -->
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($chefs as $chef)
                    <div class="col-lg-4">
                        <div class="chef-item">
                            <div class="thumb">
                                <div class="overlay"></div>
                                <ul class="social-icons">
                                    <li><a href="{{ $chef->facebook_link }}" target="_blank"><i
                                                class="fa fa-facebook"></i></a></li>
                                    <li><a href="{{ $chef->twitter_link }}" target="_blank"><i
                                                class="fa fa-twitter"></i></a></li>
                                    <li><a href="{{ $chef->instragram_link }}" target="_blank"><i
                                                class="fa fa-instagram"></i></a></li>
                                </ul>
                                <img src="{{ asset('assets/images/' . $chef->image) }}" alt="Chef #1">
                            </div>
                            <div class="down-content">
                                <h4>{{ $chef->name }}</h4>
                                <span>{{ $chef->job_title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- ***** Chefs Area Ends ***** -->
    <br><br>
    <section class="section" id="offers">
        <div class="container">
            <div class="row">
                <div class="text-center col-lg-4 offset-lg-4">
                    <div class="section-heading">
                        <h6>Our Blogs</h6>
                        <h2>This Week’s Special Offers</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('blogs')




    <!-- ***** Reservation Us Area Starts ***** -->
    <section class="section" id="reservation">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>Contact Us</h6>
                            <h2>Here You Can Make an Inquary Or Just Make an Online Order</h2>
                        </div>
                        <p>Members of Pandakivuli are always active to response your call.</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="phone">
                                    <i class="fa fa-phone"></i>
                                    <h4>Phone Numbers</h4>
                                    <span>
                                        <a href="tel:+254705307007" class="btn btn-link">
                                            <i class="fa fa-phone fa-sm"  style="height: 40px; color:green; background-color:rgba(255, 255, 255, 0);"></i> 0705307007
                                        </a>
                                    </span><br>
                                    <span>
                                        <a href="https://wa.me/254705307007" class="btn btn-link" target="_blank">
                                            <i class="fa fa-whatsapp fa-sm" style="height: 40px; color:green; background-color:rgba(255, 255, 255, 0);" ></i> 0705307007
                                        </a>
                                    </span>
                                    

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="message">
                                    <i class="fa fa-envelope"></i>
                                    <h4>Emails</h4>
                                    <span>
                                        <a href="mailto:support@pandakivuli.co.ke">support@pandakivuli.co.ke</a><br>
                                        <a href="mailto:jiuda47@gmail.com">jiuda47@gmail.com</a><br>
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
                                    <h4>Making a special order</h4>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" id="name" placeholder="Your Name*"
                                            required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                            placeholder="Your Email Address" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <fieldset>
                                        <input name="phone" type="text" id="phone" placeholder="Phone Number*"
                                            required="">
                                    </fieldset>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div id="filterDate2">
                                        <div class="input-group date" data-date-format="dd/mm/yyyy">
                                            <input name="date" id="date" type="text" class="form-control"
                                                placeholder="dd/mm/yyyy">
                                            <div class="input-group-addon">
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
                                        <button type="submit" id="form-submit" class="main-button-icon">Make an
                                            Inquiry</button>
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

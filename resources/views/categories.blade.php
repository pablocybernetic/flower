@extends('layout', ['title' => 'Home'])
@section('page-content')
    {{-- @include('hero-banner') --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (for toggle functionality) -->
    <br><br>



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
    <br><br><br>

    <!-- resources/views/search.blade.php -->
    <div class="container mt-5">
        <!-- Search Bar -->
        <div class="mb-4 d-flex justify-content-center " style="display: none;">
            <form id="searchForm" class="p-3 bg-white rounded shadow-lg" action="{{ route('search') }}" method="GET"
                style="width: 100%; max-width: 500px;">
                <div class="input-group">
                    <input type="text" name="query" id="searchQuery" class="form-control"
                        placeholder="Search from {{ $Pagecategory->name }}">
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
                <h5 class="mb-3 text-secondary">Filters for {{ $Pagecategory->name }}</h5>
                <div class="row gy-3">
                    <div class="col-6 col-md-2">
                        <select id="filterSize" name="size" class="form-select form-select-md">
                            <option value="">Size</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>

                    {{-- category filter was here --}}
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
                            <h6 class="text-primary">{{ $Pagecategory->name }}</h6>
                            <h2>{{ $Pagecategory->description }}</h2>
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
            let categorySlug = '{{ $Pagecategory->slug }}';

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
                    url: `/api/category/${categorySlug}`,
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
    <br><br>
    <section class="section"></section>
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

    <!-- ***** Menu Area Starts ***** -->
    
@endsection

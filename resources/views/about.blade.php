@extends('layout', ['title'=> 'About Us'])

@section('page-content')
<style>
    body {
        margin-top: 20px;
        background: #F0F8FF;
        font-family: Arial, sans-serif;
    }
    .text-custom {
        color: #28a745 !important; /* Plant-inspired green color */
    }
    .btn-custom {
        background-color: #28a745;
        color: white;
        border: none;
    }
    .btn-custom:hover {
        background-color: #218838;
    }
</style>
<br><br><br>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<div class="container">
    <div class="row align-items-center">
        <!-- About Us Content -->
        <div class="order-1 col-lg-6 col-md-6 col-12 order-md-2">
            <div class="section-title ml-lg-5">
                <h5 class="mb-3 text-custom font-weight-normal">About Us</h5>
                <h4 class="mb-4 title" style="color: #28a745">
                    Bringing Nature Closer to You
                </h4>
                <p class="mb-4 text-muted">
                    Welcome to our online plant haven! We are passionate about making greenery accessible to everyone, whether you're a seasoned gardener or a beginner looking to add life to your space. From vibrant indoor plants to garden essentials, we've got you covered.
                </p>
                <p class="mb-4 text-muted">
                    Our mission is to connect you with the best plants and gardening products, helping you create beautiful, sustainable environments that uplift your mood and enhance your living or working spaces.
                </p>

                <div class="row">
                    <div class="pt-2 mt-4 col-lg-6">
                        <div class="p-3 rounded shadow media align-items-center">
                            <i class="mb-0 fa fa-leaf h4 text-custom"></i>
                            <h6 class="mb-0 ml-3"><a href="javascript:void(0)" class="text-dark">Sustainable Products</a></h6>
                        </div>
                    </div>
                    <div class="pt-2 mt-4 col-lg-6">
                        <div class="p-3 rounded shadow media align-items-center">
                            <i class="mb-0 fa fa-shipping-fast h4 text-custom"></i>
                            <h6 class="mb-0 ml-3"><a href="javascript:void(0)" class="text-dark">Fast Delivery</a></h6>
                        </div>
                    </div>
                    <div class="pt-2 mt-4 col-lg-6">
                        <div class="p-3 rounded shadow media align-items-center">
                            <i class="mb-0 fa fa-heart h4 text-custom"></i>
                            <h6 class="mb-0 ml-3"><a href="javascript:void(0)" class="text-dark">Customer Care</a></h6>
                        </div>
                    </div>
                    <div class="pt-2 mt-4 col-lg-6">
                        <div class="p-3 rounded shadow media align-items-center">
                            <i class="mb-0 fa fa-tools h4 text-custom"></i>
                            <h6 class="mb-0 ml-3"><a href="javascript:void(0)" class="text-dark">Expert Guidance</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Images Section -->
        <div class="order-2 pt-2 mt-4 col-lg-6 col-md-6 order-md-1 mt-sm-0 opt-sm-0">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="pt-2 mt-4">
                        <div class="overflow-hidden border-0 rounded shadow-lg card work-desk">
                            <img src="https://www.bootdey.com/image/241x362/98FB98/000000" class="img-fluid" alt="Lush Indoor Plants" />
                            <div class="img-overlay bg-dark"></div>
                        </div>
                    </div>
                    <div class="pt-2 mt-4 text-right">
                        <a href="/" class="btn btn-custom">Shop More <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="pt-2 mt-4">
                        <div class="overflow-hidden border-0 rounded shadow-lg card work-desk">
                            <img src="https://www.bootdey.com/image/337x450/7CFC00/000000" class="img-fluid" alt="Beautiful Garden Tools" />
                            <div class="img-overlay bg-dark"></div>
                        </div>
                    </div>
                    <div class="pt-2 mt-4">
                        <div class="overflow-hidden border-0 rounded shadow-lg card work-desk">
                            <img src="https://www.bootdey.com/image/600x401/66CDAA/000000" class="img-fluid" alt="Outdoor Plant Collection" />
                            <div class="img-overlay bg-dark"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

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
    .image-card {
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        position: relative;
    }
    .image-card img {
        display: block;
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }
    .image-card img:hover {
        transform: scale(1.05);
    }
    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .image-card:hover .img-overlay {
        opacity: 1;
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
                    {{ $abouts->subtitle ?? 'Subtitle not set' }}
                </h4>
                <p class="mb-4 text-muted">
                    {{ $abouts->description ?? 'Description not available' }}
                </p>

                <div class="row">
                    @foreach($abouts->features ?? '[]' as $feature)
                    <div class="pt-2 mt-4 col-lg-6">
                        <div class="p-3 rounded shadow media align-items-center">
                            <i class="mb-0 fa fa-leaf h4 text-custom"></i>
                            <h6 class="mb-0 ml-3"><a href="javascript:void(0)" class="text-dark">{{ $feature }}</a></h6>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Images Section -->
            <!-- Images Section -->
            <div class="order-2 pt-2 mt-4 col-lg-6 col-md-6 order-md-1 mt-sm-0 opt-sm-0">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-6">
                        <div class="pt-2 mt-4">
                            <div class="overflow-hidden border-0 rounded shadow-lg card work-desk">
                                <img src="{{asset( $abouts->image1)  ?? 'https://www.bootdey.com/image/241x362/98FB98/000000'}}" class="img-fluid" alt="Lush Indoor Plants" />
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
                                <img src="{{ $abouts->image2  ?? 'https://www.bootdey.com/image/337x450/7CFC00/000000'}}" class="img-fluid" alt="Beautiful Garden Tools" />
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <div class="pt-2 mt-4">
                            <div class="overflow-hidden border-0 rounded shadow-lg card work-desk">
                                <img src="{{ $abouts->image3  ?? 'https://www.bootdey.com/image/600x401/66CDAA/000000'}}" class="img-fluid" alt="Outdoor Plant Collection" />
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection

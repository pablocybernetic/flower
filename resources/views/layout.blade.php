<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/short.jpg') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">

    <title>Pandakivuli - Your Favourite Flowers</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/css-library.css')}}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/mordern.css')}}"> --}}


    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css')}}">

    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css')}}">

    <script src="{{ asset('assets/js/angular.min.js')}}"></script>
    <script src="{{ asset('assets/js/bKash-checkout.js')}}"></script>
    <script src="{{ asset('assets/js/bKash-checkout-sandbox.js')}}"></script>

    </head>
    
    <body ng-app="">
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    <style>
        @media only screen and (max-width: 767px) {
            .main-nav ul.nav {
                display: none;
                flex-direction: column;
                position: fixed;
                top: 0;
                right: 0;
                background-color: #fff; /* Adjust the background color */
                width: 60%; /* Adjust the width as needed */
                box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }
    
            .main-nav ul.nav.show {
                display: flex;
            }
    
            .main-nav .mobile-menu {
                display: block;
                cursor: pointer;
                position: fixed;
                top: 15px;
                right: 15px;
                z-index: 1001;
            }
    
            .cancel-btn {
                position: absolute;
                top: 15px;
                left: 15px;
                cursor: pointer;
            }
        }
        .bn5 {
  padding: 0.6em 2em;
  border: none;
  outline: none;
  color: rgb(255, 255, 255);
  background: #111;
  cursor: pointer;
  position: relative;
  z-index: 0;
  border-radius: 10px;
}

.bn5:before {
  content: "";
  background: linear-gradient(
    45deg,
    #ff0000,
    #ff7300,
    #fffb00,
    #48ff00,
    #00ffd5,
    #002bff,
    #7a00ff,
    #ff00c8,
    #ff0000
  );
  position: absolute;
  top: -2px;
  left: -2px;
  background-size: 400%;
  z-index: -1;
  filter: blur(5px);
  width: calc(100% + 4px);
  height: calc(100% + 4px);
  animation: glowingbn5 20s linear infinite;
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
  border-radius: 10px;
}

@keyframes glowingbn5 {
  0% {
    background-position: 0 0;
  }
  50% {
    background-position: 400% 0;
  }
  100% {
    background-position: 0 0;
  }
}

.bn5:active {
  color: #000;
}

.bn5:active:after {
  background: transparent;
}

.bn5:hover:before {
  opacity: 1;
}

.bn5:after {
  z-index: -1;
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: #191919;
  left: 0;
  top: 0;
  border-radius: 10px;
}
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var mobileMenu = document.querySelector('.mobile-menu .fixed-top');
            var navList = document.querySelector('.main-nav ul.nav');
            var cancelBtn = document.createElement('div');
            cancelBtn.innerHTML = '<i class="fa fa-times" style=" margin-left: 10%"></i>';
            cancelBtn.className = 'cancel-btn';
    
            mobileMenu.addEventListener('click', function () {
                navList.classList.toggle('show');
                if (navList.classList.contains('show')) {
                    navList.parentElement.appendChild(cancelBtn);
                } else {
                    navList.parentElement.removeChild(cancelBtn);
                }
            });
    
            cancelBtn.addEventListener('click', function () {
                navList.classList.remove('show');
                navList.parentElement.removeChild(cancelBtn);
            });
    
            window.addEventListener('resize', function () {
                if (window.innerWidth > 767) {
                    navList.classList.remove('show');
                    navList.parentElement.removeChild(cancelBtn);
                }
            });
        });
    </script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a href="{{url('home')}}" class="logo" style="padding-right: 10px">
            <img width="100px" src="{{ asset('assets/images/logo.png')}}">
        </a>
       
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/#about">About <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/#menu">Our Plants <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/trace-my-order">Trace Order<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/my-order">My Order<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/#chefs">Our Team<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="/#reservation">Contact Us<span class="sr-only">(current)</span></a>
              </li>
          
                          
                          <li>
                            @if (Route::has('login'))
                            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <li style="margin-top:-13px;">
                                        {{-- <x-app-layout> </x-app-layout> --}}
                                    </li> 
                                @else
                                  <li>
                                    {{-- <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a> --}}
                                    <a class="nav-link" href="{{ route('login') }}">Log in<span class="sr-only">(current)</span></a>

                                  </li>
                                    @if (Route::has('register'))
                                        <li>
                                            {{-- <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a> --}}
                                            <a class="nav-link" href="{{ route('register') }}">Register<span class="sr-only">(current)</span></a>
                                        </li>
                                    @endif
                                @endauth
                            </div>
                            @endif
                            
                        </li>      
            {{-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> --}}
            <li style="padding:10px"><a href="/cart"><i class="fa fa-shopping-cart"></i></a></li>
            <?php
                            
            if(Auth::user())
            {
    
                $cart_amount=DB::table('carts')->where('user_id',Auth::user()->id)->where('product_order','no')->count();
    
    
            }
            else
            {
    
                $cart_amount=0;
    
            }


        ?>


        <span class='badge badge-warning' id='lblCartCount'> {{ $cart_amount }} </span>

        <style>


            .badge {
            padding-left: 9px;
            padding-right: 9px;
            padding-top:10px;
            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 9px;
            height:16px;
            text-align:center;
            }

            .label-warning[href],
            .badge-warning[href] {
            background-color: #c67605;
            }
            #lblCartCount {
                font-size: 12px;
                background: #ff0000;
                color: #fff;
                padding: 0 5px;
                vertical-align: top;
                margin-left: -10px; 
            }
        </style>
            @if (Route::has('login'))
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="{{ route('profile.show') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('profile.show') }}"> {{ __('Manage Account') }}</a>
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                </div>
                
                </div>
              </li>
              @endauth

              @endif

          </ul>
          {{-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" style="border-radius: 20px;" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0"style="border-radius: 20px;" type="submit">Search</button>
          </form> --}}
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
    <!-- ***** Header Area Start ***** -->

<!-- ***** Header Area End ***** -->

    <div style="min-height:750px">
        @yield('page-content')
    </div>

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <div class="right-text-content">
                            <ul class="social-icons">
                                <li><a href="https://web.facebook.com/rahathosenmanik/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/peter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/peter/"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="logo">
                        <a href="{{url('home')}}"><img src="{{ asset('assets/images/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="left-text-content">
                        <p>© Copyright Pandakivuli Garden
							<br>2022-<?php echo date('Y')  ?></p> 
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-2.1.0.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/popper.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/js/owl-carousel.js')}}"></script>
    <script src="{{ asset('assets/js/accordions.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/scrollreveal.min.js')}}"></script>
    <script src="{{ asset('assets/js/waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{ asset('assets/js/imgfix.min.js')}}"></script> 
    <script src="{{ asset('assets/js/slick.js')}}"></script> 
    <script src="{{ asset('assets/js/lightbox.js')}}"></script> 
    <script src="{{ asset('assets/js/isotope.js')}}"></script> 
    
    <!-- Global Init -->
    <script src="{{ asset('assets/js/custom.js')}}"></script>
    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>
  </body>
</html>
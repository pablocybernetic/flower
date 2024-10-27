<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <title>Pandakivuli</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

          
          
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <div class="py-5 text-center">
        <h2>Pandakivuli</h2>

      
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
            </h4>
            <ul class="list-group mb-3">
               
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (Ksh)</span>
                    <strong>{{ $total }}</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Shipping address</h4>
            <form method="POST" action="{{url('confirm_place_order/'.$total)}}" class="needs-validation" novalidate>
               
            @csrf

                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St"
                           value="93 B, New Eskaton Road" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">County</label>
                        <select class="custom-select d-block w-100" id="country" required>
                            <option value="">Choose...</option>
                            <option value="Nairobi">Nairobi</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid county.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">Location</label>
                        <select class="custom-select d-block w-100" id="state" required>
                            <option value="">Choose...</option>
                            <option value="Donholm">Donholm</option>
<option value="Kabete">Kabete</option>
<option value="Kahawa Sukari">Kahawa Sukari</option>
<option value="Kamakis">Kamakis</option>
<option value="Kasarani">Kasarani</option>
<option value="Kileleshwa">Kileleshwa</option>
<option value="Kilimani">Kilimani</option>
<option value="Langata">Langata</option>
<option value="Lavington">Lavington</option>
<option value="Mirema">Mirema</option>
<option value="Nairobi West">Nairobi West</option>
<option value="Parklands">Parklands</option>
<option value="Roysambu">Roysambu</option>
<option value="Ruaka">Ruaka</option>
<option value="South B">South B</option>
<option value="South C">South C</option>
<option value="Thindigua">Thindigua</option>
<option value="Utawala">Utawala</option>
<option value="Westlands">Westlands</option>
<option value="Zimmerman">Zimmerman</option>

                            

                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
              
                <hr class="mb-4">
                <button class="btn btn-primary" 
                     
                        endpoint="{{ url('/confirm_place_order') }}"> Confirm order
                </button>
            </form>
        </div>
    </div>

   
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>


<!-- If you want to use the popup integration, -->
<script>
    var obj = {};
    obj.cus_name = $('#customer_name').val();
    obj.cus_phone = $('#mobile').val();
    obj.cus_email = $('#email').val();
    obj.cus_addr1 = $('#address').val();
    obj.amount = $('#total_amount').val();

    $('#sslczPayBtn').prop('postdata', obj);

    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Pandakivuli Checkout">
    <title>Pandakivuli - Checkout</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .text-muted {
            font-weight: bold;
            color: #6c757d !important;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
        }
        .modal-content {
            border-radius: 10px;
            padding: 1.5rem;
        }
        .modal-header-icon {
            font-size: 2rem;
            margin-right: 0.5rem;
        }
        /* Custom styles for modal messages */
        .modal-success {
            background-color: #d4edda; /* Light green background */
            color: #155724; /* Dark green text */
            border-radius: 10px; /* Border radius for success message */
            padding: 1rem; /* Padding inside the message */
        }
        .modal-error {
            background-color: #f8d7da; /* Light red background */
            color: #721c24; /* Dark red text */
            border-radius: 10px; /* Border radius for error message */
            padding: 1rem; /* Padding inside the message */
        }
        .modal-info {
            background-color: #d1ecf1; /* Light blue background */
            color: #0c5460; /* Dark blue text */
            border-radius: 10px; /* Border radius for info message */
            padding: 1rem; /* Padding inside the message */
        }
        .modal-body {
            padding: 1rem;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="py-5 text-center">
        <h2>Pandakivuli</h2>
        <p class="text-muted">Complete your transaction</p>
    </div>

    <div class="row">
        <!-- Cart Summary -->
        <div class="col-md-4 mb-4">
            <div class="card p-3">
                <h4 class="text-muted mb-3">Your Cart</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Total (Ksh)</span>
                        <strong id="totalAmount">{{ $total }}</strong>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Shipping and Payment Form -->
        <div class="col-md-8">
            <div class="card p-4">
                <h4 class="mb-3">Shipping Address</h4>
                <form id="stkPushForm" novalidate>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">Please enter your shipping address.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="country">County</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <option value="">Choose...</option>
                                <option>Nairobi</option>
                            </select>
                            <div class="invalid-feedback">Please select a valid county.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state">Location</label>
                            <select class="custom-select d-block w-100" id="state" required>
                                <option value="">Choose...</option>
                                <option>Kileleshwa</option>
                            </select>
                            <div class="invalid-feedback">Please select a valid location.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone">Mpesa Phone Number (2547XXXXXXXX)</label>
                        <input type="text" class="form-control" id="phone" required>
                        <div class="invalid-feedback">Mpesa Phone required.</div>
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <span id="modalIcon" class="modal-header-icon"></span>
                <h5 class="modal-title" id="notificationModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="notificationMessage"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@php
    $invoice = strtoupper(substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8));
@endphp

<!-- Now you can use $invoice in your Blade view -->
{{-- <p>Your invoice number is: {{ $invoice }}</p> --}}

<!-- JavaScript for Form Submission and Notifications -->
<script>
document.getElementById("stkPushForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const address = document.getElementById("address").value;
    const phone = document.getElementById("phone").value;
    const totalAmount = document.getElementById("totalAmount").innerText;
    const orderId = @json($invoice); 
    // console.log(orderId);
    

    const phonePattern = /^2547\d{8}$/;
    if (!phonePattern.test(phone)) {
        showModal("Transaction Failed", "Please enter a valid phone number in the format 2547XXXXXXXX.", "error");
        return;
    }

    const data = { address, phone, amount: totalAmount, orderId };

    fetch("{{ url('/stk_push') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": "{{ csrf_token() }}"
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(responseData => {
        if (responseData.errorCode) {
            showModal("Transaction Failed", `STK Push failed: ${responseData.errorMessage}`, "error");
        } else {
            showModal("Transaction Successful", "STK Push successful! Check your phone for the payment prompt.", "success");
        }
    })
    .catch(error => {
        showModal("Transaction Error", "An error occurred during the request. Please try again.", "info");
    });
});

function showModal(title, message, type) {
    const icon = document.getElementById("modalIcon");
    const modalLabel = document.getElementById("notificationModalLabel");
    const modalMessage = document.getElementById("notificationMessage");

    modalLabel.textContent = title;
    modalMessage.textContent = message;

    // Remove existing classes
    modalMessage.classList.remove("modal-success", "modal-error", "modal-info");
    if (type === "success") {
        modalMessage.classList.add("modal-success");
        icon.innerHTML = "&#10004;"; // Checkmark icon
    } else if (type === "error") {
        modalMessage.classList.add("modal-error");
        icon.innerHTML = "&#10006;"; // Cross icon
    } else {
        modalMessage.classList.add("modal-info");
        icon.innerHTML = "&#8505;"; // Info icon
    }

    $('#notificationModal').modal('show');
}
</script>

<!-- Bootstrap and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>

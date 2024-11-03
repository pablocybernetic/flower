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
        /* Custom styles for increased border radius */
        .border-radius-15 {
            border-radius: 1.5rem !important; /* Increase the radius as needed */
        }

        .card {
            border-radius: 1.5rem !important; /* Make sure cards have the same border radius */
        }

        .modal-content {
            border-radius: 1.5rem !important; /* Increase modal border radius */
        }

        /* Custom notification styles */
        .modal-success {
            color: darkgreen;
            background-color: lightgreen;
        }

        .modal-error {
            color: darkred;
            background-color: #f8d7da; /* Light red */
        }

        .modal-info {
            color: darkblue;
            background-color: #cce5ff; /* Light blue */
        }

        .modal-warning {
            color: darkorange;
            background-color: #fff3cd; /* Light yellow */
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="py-5 text-center">
        <h2>Pandakivuli</h2>
        <p class="font-weight-bold text-muted">Complete your transaction</p>
    </div>
    <div id="orderStatusResult">
        <p>Waiting for order status...</p>
    </div>
    
    <div class="row">
        <!-- Cart Summary -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-radius-15">
                <div class="card-body">
                    <h4 class="font-weight-bold text-muted mb-3">Your Cart</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Total (Ksh)</span>
                            <strong id="totalAmount">{{ $total }}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Shipping and Payment Form -->
        <div class="col-md-8">
            <div class="card shadow-sm border-radius-15">
                <div class="card-body">
                    <h4 class="mb-3">Shipping Address</h4>
                    <form id="stkPushForm" novalidate>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">Please enter your shipping address.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country">County</label>
                                <select class="custom-select" id="country" required>
                                    <option value="">Choose...</option>
                                    <option>Nairobi</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid county.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="state">Location</label>
                                <select class="custom-select" id="state" required>
                                    <option value="">Choose...</option>
                                    <option>Kileleshwa</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid location.</div>
                            </div>
                        </div>

                        <div class="form-group">
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
</div>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-radius-15">
            <div class="modal-header align-items-center">
                <span id="modalIcon" class="modal-header-icon"></span>
                <h5 class="modal-title" id="notificationModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="notificationMessage" class="p-3 border-radius-15"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@php
    $invoice = strtoupper(substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8));
    Session::put('orderId',$invoice);

    $tranId = Session::get('orderId');
@endphp

<!-- JavaScript for Form Submission and Notifications -->
<script>
document.getElementById("stkPushForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const address = document.getElementById("address").value;
    const phone = document.getElementById("phone").value;
    const totalAmount = document.getElementById("totalAmount").innerText;
    const orderId = @json($invoice); 
    console.log(orderId);

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
    modalMessage.classList.remove("modal-success", "modal-error", "modal-info", "modal-warning");
    if (type === "success") {
        modalMessage.classList.add("modal-success");
        icon.innerHTML = "&#10004;"; // Checkmark icon
    } else if (type === "error") {
        modalMessage.classList.add("modal-error");
        icon.innerHTML = "&#10006;"; // Cross icon
    } else if (type === "warning") {
        modalMessage.classList.add("modal-warning");
        icon.innerHTML = "&#9888;"; // Warning icon
    } else {
        modalMessage.classList.add("modal-info");
        icon.innerHTML = "&#8505;"; // Info icon
    }

    // Show the modal
    $('#notificationModal').modal('show');
    // if type is "success keep check the database order status"
if (type === "success") {
    // alert("Operation completed successfully!");

    const tranId = @json($tranId); // Replace with the actual transaction ID from your backend
    const endpoint = `/order-status/${tranId}`;
    let elapsedTime = 0; // Track the elapsed time in seconds
    const maxTime = 300; // 5 minutes (300 seconds)
    const intervalTime = 4000; // 4 seconds (4000 milliseconds)

    // Function to make the GET request
    function checkOrderStatus() {
        fetch(endpoint)
            .then(response => response.json())
            .then(data => {
                const resultCode = data.ResultCode; 
                const Description = data.Description;
                const amountPaid = data.AmountPaid;
                const receiptNumber = data.MpesaReceiptNumber;

                // Display data in the HTML element
                const resultDiv = document.getElementById("orderStatusResult");

                if (resultCode === 0) {
                    resultDiv.innerHTML = `
                        <div class="alert alert-success border-radius-15">
                            Payment Successful!<br>
                            Amount: Ksh ${amountPaid}<br>
                            Receipt: ${receiptNumber}
                        </div>`;
                    clearInterval(interval); // Stop polling if successful
                } else if (Description) {
                    resultDiv.innerHTML = `
                        <div class="alert alert-danger border-radius-15">
                            ${Description}
                        </div>`;
                    clearInterval(interval); // Stop polling when a valid description is found
                } else {
                    // Log the request and continue polling if Description is null or empty
                    console.log("Waiting for valid description...");
                }
            })
            .catch(error => {
                console.error('Error fetching order status:', error);
            });
    }

    // Start the interval for checking order status
    const interval = setInterval(() => {
        if (elapsedTime >= maxTime) {
            clearInterval(interval);
            alert("Transaction status check timed out.");
            return;
        }
        checkOrderStatus();
        elapsedTime += intervalTime / 1000; // Convert milliseconds to seconds
    }, intervalTime);
}

   
}
</script>

<!-- jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>

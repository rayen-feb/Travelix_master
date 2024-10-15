<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PDaPAAVUQWw9VpGQdPTuC5hr5dPwLiVdobNUvbQgeeE29uphU7j3kA1LQQxFdlbbgR9XTrXfNNcFZDul93skYtP00emlzyb2M";

\Stripe\Stripe::setApiKey($stripe_secret_key);
// Retrieve the price from the GET parameters
$price = $_GET["Price"]; // Assuming 'Price' is the name of the parameter passed in the URL

// Create a checkout session with the dynamically retrieved price
$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/accomodationManagment/front/travelix-master/mails.php",
    //"cancel_url" => "http://localhost:63342/accomodationManagment/front/travelix-master/mails.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => $price * 100, // Convert the price to cents
                "product_data" => [
                    "name" => "Booking"
                ]
            ]
        ]
    ]
]);

// Redirect to the checkout session URL
http_response_code(303);
header("Location:" . $checkout_session->url);

<?php
require_once('vendor/autoload.php');

$stripe = array(
    "secret_key"      => "sk_test_XGo41WfXZ98Zv4SGWw3U7LT1",
    "publishable_key" => "pk_test_YWKm127CxJYr1T8TAX7Qd4VZ"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>

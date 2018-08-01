<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_Wpbzd7anzuZefMrGUHdAk5Db",
  "publishable_key" => "pk_test_ziCnvgJXeeT1QR88PaEervZ7"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
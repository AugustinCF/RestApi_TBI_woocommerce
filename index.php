<?php
/**AugustinCF */
require __DIR__ . "/vendor/autoload.php";

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
  "http://localhost/servername",
  "ck_10e4a20f4c5c1061f7b2f55e21b88dab71aXXX",
  "cs_287285ed00370df1a698dfafc1ce9f1a340XXX",
  [
    "version" => "wc/v3",
  ]
);

$getdata = file_get_contents('./src/tbi.json');
$getdecode = json_decode($getdata, true);

foreach ($getdecode as $orderData) {
    $order_id = $orderData['order_id'];
    $order_status = $orderData['order_status'];

    if ($order_status === 'Approved') {
               $data = [
            'status' => 'completed'
        ];
        $woocommerce->put("orders/{$order_id}", $data);
 
        echo "Order with ID $order_id has been updated to 'processing' status.\n";
    } else {
        echo "Order with ID $order_id is not 'Approved'. No update needed.\n";
    }
}



?>

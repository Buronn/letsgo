<?php
require_once "../src/Khipu.php";



$Khipu = new Khipu();
// Nos identificamos
$Khipu->authenticate("389471", "54d0a1d56de1e67cbe65171f78fdf1780be84912");
$service = $Khipu->loadService('PaymentStatus');
$data = array(
    'payment_id' => $_POST['id'],
);
$service->setParameters($data);
$consult = $service->consult();
if ($consult) {
    echo $consult;
} else {
    echo $service->getMessage();
}

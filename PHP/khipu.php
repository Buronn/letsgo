<?php
// ...
require_once "../src/Khipu.php";
$titulo = $_POST['titulo'];
$body = $_POST['body'];
$amount = $_POST['amount'];
$mesa = $_POST['mesa'];
$punto = $_POST['punto'];
$Khipu = new Khipu();
$Khipu->authenticate("389471", "54d0a1d56de1e67cbe65171f78fdf1780be84912");
$khipu_service = $Khipu->loadService('CreatePaymentURL');
$payer_email = 'cliente@gmail.com';
$data = array(
    'subject' => $titulo,
    'body' => $body,
    'amount' => $amount,
    'payer_email' => $payer_email,
    'custom' => 'Custom Variable',
    'transaction_id' => 1,
    'payer_email' => 'cliente@gmail.com',
    'notify_url' => 'http://localhost:3000/notificacion.html',
);
if ($_POST['amount'] > 0) {
    $data['amount'] = $_POST['amount'];
}
$khipu_service->setParameters($data);
echo $khipu_service->createUrl();


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
$khipu_service = $Khipu->loadService('CreatePaymentPage');

$data = array(
    'subject' => $titulo,
    'body' => $body,
    'amount' => $amount,
    // Página de exito
    'return_url' => 'http://localhost:3000/comanda.html?pago=0',
    // Página de fracaso
    'cancel_url' => 'http://localhost:3000/comanda.html?pago=1',
    'transaction_id' => 1,
    // Dejar por defecto un correo para recibir el comprobante
    'payer_email' => 'cliente@gmail.com',
    // definimos una url en donde se notificará del pago
    'notify_url' => 'http://localhost:3000/notificacion.html',
);
// Recorremos los datos y se lo asignamos al servicio.
foreach ($data as $name => $value) {
    $khipu_service->setParameter($name, $value);
}
// Luego imprimimos el formulario html
echo $khipu_service->renderForm();

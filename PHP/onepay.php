<?php

require '../vendor/autoload.php';

$amount = $_POST['amount'];
$title = $_POST['title'];
$number = $_POST['number'];


$transaction = new \Transbank\Onepay\Transaction();
$onepaybase = new \Transbank\Onepay\OnepayBase();
$cart = new \Transbank\Onepay\ShoppingCart();
$onepaybase->setApiKey("dKVhq1WGt_XapIYirTXNyUKoWTDFfxaEV63-O5jcsdw");
$onepaybase->setSharedSecret("?XW#WOLG##FBAGEAYSNQ5APD#JF@\$AYZ");
$onepaybase->setAppScheme("mi-app://mi-app/onepay-result");
$onepaybase->setCallbackUrl("http://localhost:3000/");
$onepaybase->setQrWidthHeight(500); // Opcional
$onepaybase->setCommerceLogoUrl("https://some.url/logo"); // Opcional


$cart->add(
    new \Transbank\Onepay\Item('Producto de prueba', 1, 99000, null, 5000)
);

$response = $transaction->create($cart, 0, '000-000-011');
$ott = $response->getOtt();
$qrcode = $response->getQrCodeAsBase64();
$salida = array($ott,$qrcode);
echo json_encode($salida);

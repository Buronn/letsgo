<?php

require 'vendor/autoload.php';

$transaction = new \Transbank\Onepay\Transaction();
$onepaybase = new \Transbank\Onepay\OnepayBase();
$cart = new \Transbank\Onepay\ShoppingCart();
$onepaybase->setApiKey("dKVhq1WGt_XapIYirTXNyUKoWTDFfxaEV63-O5jcsdw");
$onepaybase->setSharedSecret("?XW#WOLG##FBAGEAYSNQ5APD#JF@\$AYZ");
$onepaybase->setAppScheme("mi-app://mi-app/onepay-result");
$onepaybase->setCallbackUrl("http://localhost:3000/");
$onepaybase->setQrWidthHeight(200); // Opcional
$onepaybase->setCommerceLogoUrl("https://some.url/logo"); // Opcional


$cart->add(
    new \Transbank\Onepay\Item('Producto de prueba', 1, 99000, null, 5000)
);

$response = $transaction->create($cart, 0, '000-000-010');

echo $response->getOtt();

?><iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

<form action="https://onepay.ionix.cl/mobile-payment-emulator/home/callUrlCallback" method="post" type="post" name="callUrlCallback" target="dummyframe" id="callUrlCallback">
    <h4>Presione el botón para llamar al callback de la transacción</h4>
    <button type="submit" class="btn btn-primary btn-block status">CALLBACK URL</button>
    <input type="hidden" name="callBackBuyOrder" value="<?php echo $response->getOtt(); ?>" id="callBackBuyOrder">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://unpkg.com/transbank-onepay-frontend-sdk@1/lib/merchant.onepay.min.js"></script>

<script>
    
    var image = new Image();
    //Just getting the source from the span. It was messy in JS.
    image.src = 'data:image/png;base64,<?php echo $response->getQrCodeAsBase64(); ?>';
    document.body.appendChild(image);


    var transaction = {
        occ: <?php echo $response->getOcc(); ?>,
        ott: <?php echo $response->getOtt(); ?>,
        externalUniqueNumber: "<?php echo $response->getExternalUniqueNumber(); ?>",
        qrCodeAsBase64: "<?php echo $response->getQrCodeAsBase64(); ?>",

        paymentStatusHandler: {
            ottAssigned: function() {
                // callback transacción asignada
                console.log("Transacción asignada.");

            },
            authorized: function(occ, externalUniqueNumber) {
                // callback transacción autorizada
                console.log("occ: " + occ);
                console.log("externalUniqueNumber: " +
                    externalUniqueNumber);

                // funcion no incluida en sdk
                sendRedirect("./transaction-commit",
                    occ, externalUniqueNumber);
            },
            canceled: function() {
                // callback rejected by user
                console.log("Transacción cancelada por el usuario.");

            },
            authorizationError: function() {
                // cacllback authorization error
                console.log("Error de autorizacion.");

            },
            unknown: function() {
                // callback to any unknown status recived
                console.log("Estado desconocido.");
            }
        }
    };
    var htmlTagId = 'qr-image';
    Onepay.directQr(transaction, htmlTagId);
</script><?php

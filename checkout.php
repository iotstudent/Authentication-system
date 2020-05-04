<form>
    <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
    <button type="button" onClick="payWithRave()">Pay Now</button>
</form>

<script>
  

    const API_publicKey = "FLWPUBK_TEST-777b90242f595e161688bed7a95e9bfb-X";

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "user@example.com",
            amount: 2000,
            customer_phone: "234099940409",
            currency: "NGN",
            txref: "0011235813",
            meta: [{
                metaname: "flightID",
                metavalue: "AP1234"
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.data.txRef; // collect txRef returned and pass to a server page to complete status check.
                console.log("This is the response returned after a charge", response);
                if (response.tx.chargeResponseCode == "00" || response.tx.chargeResponseCode == "0") {
                    window.location.replace("we.php");
                } else {
                    window.location.replace("we2.php");
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>


<?php

if (isset($_GET['txref'])) {
    $ref = $_GET['txref'];
    $amount = 2000; //Correct Amount from Server
    $currency = "NGN"; //Correct Currency from Server

    $query = array(
        "SECKEY" => "FLWSECK_TEST-5c11e512c43ed1b29fc84e6c25401e55-X",
        "txref" => $ref
    );

    $data_string = json_encode($query);

    $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify ');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);

    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);

    $resp = json_decode($response, true);

    $paymentStatus = $resp['data']['status'];
    $chargeResponsecode = $resp['data']['chargecode'];
    $chargeAmount = $resp['data']['amount'];
    $chargeCurrency = $resp['data']['currency'];

    if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
        header("Location: we.php");
    } else {
        header("Location: we2.php");//Dont Give Value and return to Failure page
    }
}

?> 
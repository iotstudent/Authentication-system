<?php session_start(); ?>
<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location:login.php");
}
?>
<?php

if (isset($_GET['txref'])) {
    $ref = $_GET['txref'];
    $amount = 2000;
    $currency = "NGN";

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
        $transaction_id = $ref;
    } else {
        header("Location: paymentfailed.php"); //Dont Give Value and return to Failure page
    }
}

?>


<?php include "lib/header.php"; ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h2 class="text-center text-success"> Successful payment</h2>
        
            <?php

                echo  "<p>";
                echo " Mr/Mrs " .$_SESSION['fullname']. " ";
                echo  $transaction_id." this is the transaction  Id for this payment ";
                echo " You paid " . $chargeAmount . "Naira for this appointment" ;
                echo "</p>";

                $allAppointments = scandir("db/appointments/");
                $countAllAppointments = count($allAppointments);


                for ($counter = 0; $counter < $countAllAppointments; $counter++) {

                    $currentAppointment = $allAppointments[$counter];


                    if ($currentAppointment == $_SESSION['fullname'] . $_SESSION['appointmentId'] . ".json") {

                        $appointmentString = file_get_contents("db/appointments/" . $currentAppointment);
                        $appointmentObject = json_decode($appointmentString);
                        $appContent = file_get_contents("db/appointments/" . $_SESSION['fullname'] . $_SESSION['appointmentId'] . ".json");
                        $appointmentObject = json_decode($appContent);
                        $appointmentObject->payment_status = "paid";
                        $appointmentObject->Amount_paid = $chargeAmount;
                        $appointmentObject->Date_paid = date("d/m/y");
                        unlink("db/appointments/" . $currentAppointment);
                        file_put_contents("db/appointments/" . $_SESSION['fullname'] . $_SESSION['appointmentId'] . ".json", json_encode($appointmentObject));
                        
                        $email = $_SESSION['email'];
                        $subject = "Payment made";
                        $message = " Your payment for your appointment has been received. Transaction id is ".$transaction_id;
                         $headers="From: no-reply@snh.org" ."\r\n" . "CC:admin@snh.ng";
                         $try = mail($email,$subject,$message,$header);       

                        echo "<p>" ." A mail has been sent to you " . "</p>";
                        die();
                    }
                }
            ?>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
</body>

</html>
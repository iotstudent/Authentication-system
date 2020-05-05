<?php include "lib/header.php"; ?>
 <?php session_start(); ?>
 <?php
 if (!isset($_SESSION['loggedin'])) {
     header("Location:login.php");
 }
 ?>
 <div class="container-fluid">
 <br><br><br>
 <div class="row">
 <div class="col-md-4"></div>
 <div class="col-md-4">
 <h2 class="text-center text-primary"> Go back if you are not ready to pay </h2>

<input type="submit" style="cursor:pointer;" value="Pay Now" id="submit" class="btn btn-success"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('submit').addEventListener('click', function () {

    var flw_ref = "", chargeResponse = "", trxref = "FDKHGK"+ Math.random(), API_publicKey = "FLWPUBK_TEST-777b90242f595e161688bed7a95e9bfb-X";

    getpaidSetup(
      {
        PBFPubKey: API_publicKey,
        customer_email: "<?php echo $_SESSION['email'];?>",
        amount: 2000,
        customer_phone: "234099940409",
        currency: "NGN",
        payment_method: "both",
        txref: "0011235813",
        meta: [{metaname:"flightID", metavalue: "AP1234"}],
        onclose:function(response) {
        },
        callback:function(response) {
          txref = response.tx.txRef, chargeResponse = response.tx.chargeResponseCode;
          if (chargeResponse == "00" || chargeResponse == "0") {
            window.location = "paymentsuccess.php/paymentverification.php?txref="+txref; //Add your success page here
          } else {
            window.location = "paymentfailed.php/paymentverification.php?txref="+txref;  //Add your failure page here
          }
        }
      }
    );
    });
  });
</script>
</div>
<div class="col-md-4"></div>
</div>
</div>
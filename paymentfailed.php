<?php session_start(); ?>
<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location:login.php");
}
?>
<?php include "lib/header.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h2> Something Went Wrong</h2>
                <a href="paybill.php" class="btn">Return</a>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>    
</body>
</html>
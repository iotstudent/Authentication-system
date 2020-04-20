<?php include "lib/header.php"; ?>
<?php session_start(); ?>
<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location:login.php");
}
?>

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-2" style="border-right:2px blue solid;">
            <img src="img/cartoon.jpg" alt="" height="100" width="100"  style="border-radius:50%;">
            <br><br>
            <ul style="list-style-type:none;">
                
                <li><a href="viewappointment.php">View All Appointment</a></li>
                <hr>
                <li><a href="reset.php">Reset Password</a></li>
            </ul>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-6">
            <h2 class="text-center text-primary">Staff Dashboard</h2>
            <br><hr><br>
            <ul style="list-style-type:none;">
                <li>Welcome mr/mrs<span class="text-primary"> <?php echo $_SESSION['fullname']; ?></span> </li>
                <li>Welcome <span class="text-primary"><?php echo $_SESSION['role']; ?> </span></li>
                <li>Department <span class="text-primary"><?php echo $_SESSION['dept']; ?></span></li>
                <li>You Registered On <span class="text-primary"><?php echo $_SESSION['reg_date']; ?></span></li>
                <li>you last loggedin on <span class="text-primary"><?php echo $_SESSION['log_date']; ?></span></li>
            </ul>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-2" style="border-left:2px blue solid;">
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>

     
</div>
</body>
</html>
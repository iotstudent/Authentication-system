<?php include "lib/header.php";?>
<?php session_start(); ?>
<?php include "lib/functions.php"?>
<?php
if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])){
    header("Location:admindashboard.php");
}
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary"> Login</h2>

                <?php
                    success_alert();
                ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="processlogin.php" method="post">

                <p>
                    <?php
                        error_alert();
                    ?>
                </p>
                    
                    <div class="form-group center">
                        <input type="email" placeholder="email" class="form-control" name="email" required
                        value="<?php if (isset($_SESSION['email'])){ echo $_SESSION['email'];}?>">
                    </div>
                    <div class="form-group center">
                        <input type="password" placeholder="password" class="form-control" name="password" required>
                    </div>
                   
                    <input type="submit" name="submit" value="login" class="btn btn-primary">
                    <a  href="forgotpassword.php">Forgot password</a>
                </form>
            </div>
            <div class="col-md-3">
                <a href="index.php" class="btn btn-primary">Home</a>
            </div>
        </div>
    </div>
</body>
</html>
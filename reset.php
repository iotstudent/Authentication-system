<?php include "lib/header.php" ;?>
<?php session_start() ;?>
<?php
  if(!isset($_GET['token']) && !isset($_SESSION['token'])){
      $_SESSION['error'] = "you are not authorised to view this";
      header("Location: login.php");
  }
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary"> Reset Password</h2>
                <p class="text-center"> Reset Password Associated with your email addres </p>

                <?php
                    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
                        echo "<h6 class='text-success'>" . $_SESSION['message'] . "</h6>";
                        session_destroy();
                    }

                ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="processreset.php" method="post">

                <p>
                    <?php
                    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
                        echo "<h6 class='text-danger'>" . $_SESSION['error'] . "</h6>";
                        session_destroy();
                    }
                    ?>
                </p>
                    
                    <div class="form-group center">
                        <input type="email" placeholder="email" class="form-control" name="email" required
                        value="<?php if (isset($_SESSION['email'])){ echo $_SESSION['email'];}?>">
                    </div>
                    <div class="form-group center">
                        <input type="password" placeholder="password" class="form-control" name="password" required>
                    </div>

                    <input type="submit" name="submit" value="Send Reset code" class="btn btn-primary">
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>
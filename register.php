<?php include "lib/header.php";?>
<?php session_start(); ?>
<?php
if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])){
    header("Location:dashboard.php");
}
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center text-primary"> Register</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="processregister.php" method="post">
                <p>
                    <?php
                       if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
                            echo "<h6 class='text-danger'>".$_SESSION['error']."</h6>";
                             session_destroy();
                       }
                    ?>
                </p>
                    <div class="form-group center">
                        <input type="text" placeholder="first name" class="form-control" name="first_name" required
                        value="<?php if(isset($_SESSION['first_name'])){ echo $_SESSION['first_name'];} ?>">
                    </div>
                    <div class="form-group center">
                        <input type="text" placeholder="last name" class="form-control" name="last_name" required 
                        value="<?php if(isset($_SESSION['last_name'])){ echo $_SESSION['last_name'];} ?>">
                    </div>
                    <div class="form-group center">
                        <input type="password" placeholder="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group center">
                        <input type="email" placeholder="email" class="form-control" name="email" required
                        value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email'];} ?>">
                    </div>
                    <div class="form-group center">
                        <select name="gender">
                            <option value="">Select one</option>
                            <option <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male' ){echo "selected";} ?>>Male</option>
                            <option <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female' ){echo "selected";} ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-group center">
                        <select name="designation">
                            <option value="">Select one</option>
                            <option <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical staff' ){echo "selected";} ?>>Medical staff</option>
                            <option <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient' ){echo "selected";} ?>>Patient</option>
                            <option <?php if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Super admin' ){echo "selected";} ?>>Super admin</option>
                        </select>
                    </div>
                    <div class="form-group center">
                        <input type="department" placeholder="department" class="form-control" name="department" required
                        value="<?php if(isset($_SESSION['department'])){ echo $_SESSION['department'];} ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>
</html>
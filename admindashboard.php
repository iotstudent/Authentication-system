<?php include "lib/header.php"; ?>
<?php session_start(); ?>
<?php include "lib/functions.php"; ?>
<?php
if (!isset($_SESSION['loggedin'])) {
    header("Location:login.php");
}
?>

<div class="container-fluid">
<br><br>
    <div class="row">
    <div class="col-md-2" style="border-right:2px blue solid;">
            <img src="img/cartoon.jpg" alt="" height="100" width="100"  style="border-radius:50%;">
            <br><br>
            <ul style="list-style-type:none;">
                <li><a href="viewpatients.php">View All Patients</a></li>
                 <hr>
                <li><a href="viewstaff.php">View All Staff</a></li>
                <hr>
                <li><a href="reset.php">Reset Password</a></li>
            </ul>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-6">
             <h2 class="text-center text-primary">Admin Dashboard</h2>
             <ul style="list-style-type:none;">
                <li>Welcome mr/mrs<span class="text-primary"> <?php echo $_SESSION['fullname']; ?></span> </li>
                <li>Welcome <span class="text-primary"><?php echo $_SESSION['role']; ?> </span></li>
                <li>Deparment <span class="text-primary"> <?php echo $_SESSION['dept']; ?> </span></li>
                <li>You Registered On <span class="text-primary"><?php echo $_SESSION['reg_date']; ?></span></li>
                <li>you last loggedin on <span class="text-primary"><?php echo $_SESSION['log_date']; ?></span></li>
            </ul>

            <!-- the fields for adding user if admin -->
                <?php
                if ($_SESSION['role'] == 'Super admin') { ?>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form action="processadduser.php" method="post">
                                <h3 class="text-center text-primary">Add User</h3>
                                <?php
                                    success_alert();
                                ?>
                                <p>
                                    <?php
                                        error_alert();
                                    ?>
                                </p>
                                <div class="form-group center">
                                    <input type="text" placeholder="first name" class="form-control" name="first_name" required>
                                </div>
                                <div class="form-group center">
                                    <input type="text" placeholder="last name" class="form-control" name="last_name" required>

                                </div>
                                <div class="form-group center">
                                    <input type="password" placeholder="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group center">
                                    <input type="email" placeholder="email" class="form-control" name="email" required>

                                </div>
                                <div class="form-group center">
                                    <select name="gender">
                                        <option value="">Select one</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="form-group center">
                                    <select name="designation">
                                        <option value="">Select one</option>
                                        <option>Medical staff</option>
                                        <option>Patient</option>
                                        <option>Super admin</option>
                                    </select>
                                </div>
                                <div class="form-group center">
                                    <input type="department" placeholder="department" class="form-control" name="department" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                <?php
                } else {
                    echo "This all you can see on your dashboard";
                }

                ?>


        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2" style="border-left:2px blue solid;">
        <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
</div>
</body>

</html>
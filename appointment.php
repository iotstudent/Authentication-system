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
                <li><a href="paybill.php">Pay bill <span> <i  class="fa fa-money"></i> </span></a></li>
                <hr>
            </ul>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <h2 class="text-center text-primary">Book Appointment</h2>
            <br><hr><br>
                
            
            <form action="processappointment.php" method="post">
                <p>
                    <?php
                       if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
                            echo "<h6 class='text-danger'>".$_SESSION['error']."</h6>";
                             session_destroy();
                       }
                    ?>
                </p>
                    <div class="form-group center">
                        <input type="date"  class="form-control" name="app_date" required>
                    </div>
                    <div class="form-group center">
                        <input type="time" class="form-control" name="app_time" required>
                    </div>
                    <div class="form-group center">
                        <select name="case_nature">
                            <option value="">Nature of appointment</option>
                            <option <?php if(isset($_SESSION['nature']) && $_SESSION['nature'] == 'urgent' ){echo "selected";} ?>>Urgent</option>
                            <option <?php if(isset($_SESSION['nature']) && $_SESSION['nature'] == 'routine' ){echo "selected";} ?>>Routine</option>
                        </select>
                    </div>
                    <div class="form-group center">
                        <textarea name="complaint"  cols="50" rows="5" required>Initial complaint</textarea>
                    </div>
                    <div class="form-group center">
                        <input type="department" placeholder="Department you want to meet" class="form-control" name="booked_department" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Book</button>
                </form>
       
            </div>





        <div class="col-md-1"></div>
        <div class="col-md-2" style="border-left:2px blue solid;">
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>

     
</div>
</body>
</html>
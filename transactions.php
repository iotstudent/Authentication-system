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
            
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-6">
            <h2 class="text-center text-primary">Transactions</h2>
            <table class="table table-striped">
                
                <thead class="thead-dark">
                  <tr>
                    <th>Appointment date</th>
                    <th>Complaint</th>
                    <th>Amount paid</th>
                    <th>Date paid</th>
                  </tr>
            </thead>
            <tbody>
    
    
    <?php
                     
   
    $allAppointments= scandir("db/appointments/");
    $countAllAppointments = count($allAppointments);


    for ($counter = 0; $counter < $countAllAppointments; $counter++) {

        $currentUser = $allAppointments[$counter];

      

            $userString = file_get_contents("db/appointments/" . $currentUser);
            $userObject = json_decode($userString);
            $patient_name = $userObject->full_name;
            $app_date = $userObject->app_date;
            $complaint = $userObject->complaint;
            $Amount_paid=$userObject->Amount_paid;
            $date_paid=$userObject->Date_paid;

            if ($patient_name == $_SESSION['fullname']) { ?>

               
                  <tr>
                    <td scope="col"><?php echo $app_date ;?></td>
                    <td scope="col"><?php echo $complaint ;?></td>
                    <td scope="col"><?php echo $Amount_paid ;?></td>
                    <td scope="col"><?php echo $date_paid ;?></td>
                  </tr>
               
        <?php
                
            }
        }
            
            ?>
         </tbody>
        </table>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2" style="border-left:2px blue solid;">
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>

     
</div>
</body>
</html>
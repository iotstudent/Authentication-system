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
            <h2 class="text-center text-primary">All Payments</h2>
            <table class="table table-striped">
                
                <thead class="thead-dark">
                  <tr>
                    <th>Appointment Id</th>
                    <th>Patient name</th>
                    <th>Appointment date</th>
                    <th>Appointment time</th>
                    <th>Payment Status </th>
                    <th>Amount Paid</th>
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
            $AppointmentId=$userObject->Id;
            $booked_department = $userObject->department_booked;
            $patient_name = $userObject->full_name;
            $app_date = $userObject->app_date;
            $app_time = $userObject->app_time;
            $case_nature = $userObject->case_nature;
            $complaint = $userObject->complaint;
            $payment_status = $userObject->payment_status;
            $Amount_paid=$userObject->Amount_paid;
            $payment_status = $userObject->payment_status;
             ?>

               
                  <tr>
                  <td scope="col"><?php echo $AppointmentId ;?></td>
                    <td scope="col"><?php echo $patient_name ;?></td>
                    <td scope="col"><?php echo $app_date ;?></td>
                    <td scope="col"><?php echo $app_time ;?></td>
                    <td scope="col">
                        
                        <?php 
                           if($payment_status != "paid"){
                               echo "Pending" ;
                           }else{
                              echo  $payment_status;
                           }
                        ?>
                    
                    </td>
                    <td scope="col"><?php echo $Amount_paid ;?></td>
                  </tr>
               
        <?php
                
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
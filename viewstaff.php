<?php include "lib/header.php"; ?>
<?php session_start(); ?>
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
            </ul>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-6">
             <h2 class="text-center text-primary">View All Staff</h2>
             <table class="table table-striped">     
                            <thead class="thead-dark">
                                   <tr>
                                     <th>Staff name</th>
                                     <th>Registeration date</th>
                                     <th>Department</th>         
                                   </tr>
                             </thead>
             <tbody>
              
    <?php
                     
   
                     $allUsers= scandir("db/users/");
                     $countAllUsers = count($allUsers);
                 
                 
                     for ($counter = 0; $counter < $countAllUsers; $counter++) {
                 
                         $currentUser = $allUsers[$counter];
                 
                       
                 
                             $userString = file_get_contents("db/users/" . $currentUser);
                             $userObject = json_decode($userString);
                             $first_name = $userObject->first_name;
                             $last_name = $userObject->last_name;
                             $full_name = $first_name . $last_name;
                             $reg_date = $userObject->reg_date;
                             $designation = $userObject->designation;
                             $dept = $userObject->department;                       
                            
                             if ($designation == "Medical staff") { ?>
                 
                                   <tr>
                                     <td scope="col"><?php echo $full_name ;?></td>
                                     <td scope="col"><?php echo $reg_date ;?></td>
                                     <td scope="col"><?php echo $dept ;?></td>
                                   </tr>
                               
                         <?php
                                 
                             }
                         }
                             
                             ?>

                </tbody>
                 </table>
                         

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2">
        <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
</div>
</body>

</html>
<?php
session_start();

$errorCount = 0;

$app_date = $_POST["app_date"] != "" ? $_POST['app_date'] : $errorCount++;
$app_time = $_POST["app_time"] != "" ? $_POST['app_time'] : $errorCount++;
$case_nature = $_POST["case_nature"] != "" ? $_POST['case_nature'] : $errorCount++;
$complaint = $_POST["complaint"] != "" ? $_POST['complaint'] : $errorCount++;
$booked_department = $_POST["booked_department"] != "" ? $_POST['booked_department'] : $errorCount++;


$full_name = $_SESSION['fullname'] ;


if ($errorCount > 0) {
    $_SESSION['error'] = " you have " . $errorCount . " error in your form";
    header("Location: appointment.php");
} else {

   
    // creating json data object
    $appointmentObject = [
        'full_name' => $full_name,
        'department_booked' => $booked_department,
        'app_date' =>$app_date,
        'app_time'=>$app_time,
        'case_nature'=>$case_nature,
        'complaint'=>$complaint,
    ];





    file_put_contents("db/appointments/" . $full_name. $app_date . ".json", json_encode($appointmentObject));
    $_SESSION['message'] = " Booking successful ";

    header("Location: appointment.php");
}

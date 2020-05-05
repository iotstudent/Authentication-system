<?php
session_start();

$errorCount = 0;

$app_date = $_POST["app_date"] != "" ? $_POST['app_date'] : $errorCount++;
$app_time = $_POST["app_time"] != "" ? $_POST['app_time'] : $errorCount++;
$case_nature = $_POST["case_nature"] != "" ? $_POST['case_nature'] : $errorCount++;
$complaint = $_POST["complaint"] != "" ? $_POST['complaint'] : $errorCount++;
$booked_department = $_POST["booked_department"] != "" ? $_POST['booked_department'] : $errorCount++;
$payment_status = '';

$full_name = $_SESSION['fullname'] ;




if ($errorCount > 0) {
    $_SESSION['error'] = " you have " . $errorCount . " error in your form";
    header("Location: appointment.php");
} else {

    $allAppointments = scandir("db/appointments/");
    $countAllAppointments = count($allAppointments);
    $newAppointmentId = ($countAllAppointments - 1);

    $_SESSION['appointmentId'] = $newAppointmentId;
    // creating json data object
    $appointmentObject = [
        'Id' =>$newAppointmentId,
        'full_name' => $full_name,
        'department_booked' => $booked_department,
        'app_date' =>$app_date,
        'app_time'=>$app_time,
        'case_nature'=>$case_nature,
        'complaint'=>$complaint,
        'payment_status'=>$payment_status,
    ];





    file_put_contents("db/appointments/" . $full_name. $_SESSION['appointmentId'] . ".json", json_encode($appointmentObject));
    $_SESSION['message'] = " Booking successful ";

    header("Location: patientdashboard.php");
}

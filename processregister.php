<?php session_start(); ?>
<?php include "lib/register_functions.php"; ?>
<?php

$errorCount = 0;

$first_name = $_POST["first_name"] != "" ? $_POST['first_name'] : $errorCount++;
$last_name = $_POST["last_name"] != "" ? $_POST['last_name'] : $errorCount++;
$email = $_POST["email"] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST["password"] != "" ? $_POST['password'] : $errorCount++;
$gender = $_POST["gender"] != "" ? $_POST['gender'] : $errorCount++;
$designation = $_POST["designation"] != "" ? $_POST['designation'] : $errorCount++;
$department = $_POST["department"] != "" ? $_POST['department'] : $errorCount++;



$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;


// checking for string length
input_length();
// checking for presence of numbers in the string
check_for_number_in_string();
// checking for lenght or validity of mail
validity_of_mail();


if ($errorCount > 0) {
    $_SESSION['error'] = " you have " . $errorCount . " error in your form";
    header("Location: register.php");
} else {

    // code to auto generate the userid
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);
    $newUserId = ($countAllUsers - 1);

    // creating json data object
    $userObject = [
        'id' => $newUserId,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'gender' => $gender,
        'designation' => $designation,
        'department' => $department,
        'reg_date' =>date("y-m-d"),
    ];



    // check if user exist
    for ($counter = 0; $counter < $countAllUsers; $counter++) {

        $currentUser = $allUsers[$counter];
        if ($currentUser == $email . ".json") {
            $_SESSION['error'] = " Registeration failed, user already exist ";
            header("Location:register.php");
            die();
        }
    }


    file_put_contents("db/users/" . $email . ".json", json_encode($userObject));
    $_SESSION['message'] = " registeration successful you can now log in";

    header("Location: login.php");
}

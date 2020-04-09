<?php

session_start();

$errorCount = 0;


$email = $_POST["email"] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST["password"] != "" ? $_POST['password'] : $errorCount++;



$_SESSION['email'] = $email;




if ($errorCount > 0) {
    $_SESSION['error'] = " you have " . $errorCount . " error in your form";
    header("Location: login.php");
} else {

    // code to auto generate the userid
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);




    // check if user exist
    for ($counter = 0; $counter < $countAllUsers; $counter++) {

        $currentUser = $allUsers[$counter];

        if ($currentUser == $email . ".json") {

            $userString = file_get_contents("db/users/" . $currentUser);
            $userObject = json_decode($userString);
            $passwordFromDB = $userObject->password;
            $passwordFromUser = password_verify($password, $passwordFromDB);
            
            if ($passwordFromDB == $passwordFromUser) {

                $_SESSION['loggedin'] = $userObject->id;
                $_SESSION['fullname'] = $userObject->first_name . " " .$userObject->last_name;
                $_SESSION['role'] = $userObject->designation;
                $_SESSION['dept'] = $userObject->department;
                $_SESSION['reg_date'] = $userObject->reg_date;
                $_SESSION['log_date'] = date("Y-m-d h:i:sa");
                header("Location: dashboard.php");
                die();
            }
        }
    }


   
    $_SESSION['error'] = " invalid email or password";
    header("Location: login.php");
    die();

}

<?php
session_start();

$errorCount = 0;

if(!$_SESSION['loggedin']){
    $token = $_POST["token"] != "" ? $_POST['token'] : $errorCount++;
    $_SESSION['token'] = $token;
}

$email = $_POST["email"] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST["password"] != "" ? $_POST['password'] : $errorCount++;



$_SESSION['email'] = $email;


if ($errorCount > 0) {
    $_SESSION['error'] = " you have " . $errorCount . " error in your form";
    header("Location: reset.php");
} else {

    // code to auto generate the userid
    $allUsersTokens = scandir("db/tokens/");
    $countAllUsersTokens = count($allUsersTokens);




    // check if user exist
    for ($counter = 0; $counter < $countAllUsersTokens; $counter++) {

        $currentTokenFile = $allUsersTokens[$counter];

        if ($currentTokenFile == $email . ".json") {

            $tokenContent = file_get_contents("db/tokens/" . $currentTokenFile);
            $tokenObject = json_decode($tokenContent);
            $tokenFromDB = $tokenObject->token;

            // given token a default value
            if($_SESSION['loggedin']){
                $checkToken = True;
            }else{
                $checkToken = $tokenFromDB == $token;
            }


            if ($checkToken) {


                $allUsers = scandir("db/users/");
                $countAllUsers = count($allUsers);


                // check if user exist
                for ($counter = 0; $counter < $countAllUsers; $counter++) {

                    $currentUser = $allUsers[$counter];

                    if ($currentUser == $email . ".json") {

                        $userString = file_get_contents("db/users/" . $currentUser);
                        $userObject = json_decode($userString);
                        $userObject->password = password_hash($password, PASSWORD_DEFAULT);
                        unlink("db/users/".$currentUser);
                        file_put_contents("db/users/". $email . ".json", json_encode($userObject));
                        $_SESSION["message"] = "Password Reset Successful , you can login";

                        $subject = "Password Reset Link";
                        $message = "A password rest has been initiated from your account
                                       if you did not innitiate thi reset, please ignore this message ,otherwise,
                                       visit: localhost/snh/reset.php?token=".$token;
                        $headers="From: no-reply@snh.org" ."\r\n" . "CC:admin@snh.ng";
                        $try = mail($email,$subject,$message,$header);       
                    
                        header("Location: login.php");
                        die();
                    }
                }
            }
        }
    }



    $_SESSION['error'] = " Password Reset Failed , token/password expired";
    header("Location: login.php");
}

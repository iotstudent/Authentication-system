<?php 

session_start();

$errorCount = 0;


$email = $_POST["email"] != "" ? $_POST['email'] : $errorCount++;
$_SESSION["email"] = $email;


if ($errorCount > 0) {
    $_SESSION['error'] = " you have " . $errorCount . " error in your form";
    header("Location: forgotpassword.php");
} else {

    // code to auto generate the userid
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);


    // check if user exist
    for ($counter = 0; $counter < $countAllUsers; $counter++) {
        $currentUser = $allUsers[$counter];
        if ($currentUser == $email . ".json") {

            // token generation starts

            $token = "";
            $alphabets = ['a','b','c','d','g','h','i','j','A','B','C','D','H','J','I'];
            for($i = 0 ;$i < 20 ;$i++){

                $index = mt_rand(0,count($alphabets)-1);
                $token .= $alphabets[$index];
            }
            // token generation ends
            
            $subject = "Password Reset Link";
            $message = "A password rest has been initiated from your account
                           if you did not innitiate thi reset, please ignore this message ,otherwise,
                           visit: localhost/snh/reset.php?token=".$token;
            $headers="From: no-reply@snh.org" ."\r\n" . "CC:admin@snh.ng";
            $try = mail($email,$subject,$message,$header);       
        
            file_put_contents("db/tokens/" . $email . ".json", json_encode(['token'=>$token]));

            if($try){
                $_SESSION['message'] = "Password reset has been sent to your mail" ;
                header("Location: login.php");
            }else{

                $_SESSION['error'] = "something went wrong with the email transfer" ;
                header("Location: forgotpassword.php");
            }

            die();
        }
    }


    $_SESSION['error'] = " Email not registered with us ERR ";
    header("Location: forgotpassword.php");

}


<?php
session_start();

$errorCount = 0;

$first_name = $_POST["first_name"] != "" ? $_POST['first_name'] : $errorCount++;
$last_name = $_POST["last_name"] != "" ? $_POST['last_name'] : $errorCount++;
$email = $_POST["email"] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST["password"] != "" ? $_POST['password'] : $errorCount++;
$gender = $_POST["gender"] != "" ? $_POST['gender'] : $errorCount++;
$designation = $_POST["designation"] != "" ? $_POST['designation'] : $errorCount++;
$department = $_POST["department"] != "" ? $_POST['department'] : $errorCount++;





// checking for string length
if(strlen($first_name) < 2 || strlen($last_name) < 2){
    $_SESSION['error'] = " first name or last name too short";
    header("Location: dashboard.php");
    die();
}

// checking for presence of numbers in the string
if(preg_match('~[0-9]+~',$first_name) || preg_match('~[0-9]+~',$last_name)){
    $_SESSION['error'] = " first name and last name might have integers";
    header("Location: dashboard.php");
    die();
}

// checking for lenght or validity of mail
if(strlen($email) < 5 || (substr_count($email,'@') != 1) || (substr_count($email,'.') < 1)){
    $_SESSION['error'] = " Something is wrong with your email ";
    header("Location: dashboard.php");
    die();
}






if ($errorCount > 0) {
    $_SESSION['error'] = " you have " . $errorCount . " error in your form";
    header("Location: dashboard.php");
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
            header("Location:dashboard.php");
            die();
        }
    }


    file_put_contents("db/users/" . $email . ".json", json_encode($userObject));
    $_SESSION['message'] = " User created";

    header("Location: dashboard.php");
}

<?php
function input_length()
{
    global $first_name;
    global $last_name;
    if (strlen($first_name) < 2 || strlen($last_name) < 2) {
        $_SESSION['error'] = " first name or last name too short";
        header("Location: register.php");
        die();
    }
}

function check_for_number_in_string()
{
    global $first_name;
    global $last_name;
    if (preg_match('~[0-9]+~', $first_name) || preg_match('~[0-9]+~', $last_name)) {
        $_SESSION['error'] = " first name and last name might have integers";
        header("Location: register.php");
        die();
    }
}


function validity_of_mail()
{

    global $email;
    if (strlen($email) < 5 || (substr_count($email, '@') != 1) || (substr_count($email, '.') < 1)) {
        $_SESSION['error'] = " Something is wrong with your email ";
        header("Location: register.php");
        die();
    }
}

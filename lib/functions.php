<?php
function error_alert()
{
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        echo "<h6 class='text-danger'>" . $_SESSION['error'] . "</h6>";
        session_destroy();
    }
}

function success_alert()
{
    if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
        echo "<h6 class='text-success'>" . $_SESSION['message'] . "</h6>";
        session_destroy();
    }
}

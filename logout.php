<?php

session_start();
unset($_SESSION['showSkills']);

if (isset($_POST['logout']))
{
    unset($_SESSION['loggedIn']);
    unset($_SESSION['username']);
    unset($_SESSION['userID']);
    unset($_SESSION['typeOfUser']);

    session_destroy();
    header("location: index.php");
}

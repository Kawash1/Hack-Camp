<?php

session_start();
unset($_SESSION['showSkills']);
unset($_SESSION['page']);
unset($_SESSION['MatchMode']);
unset($_SESSION['changeStudentDetails']);

if (isset($_SESSION['student']))
{
    unset($_SESSION['student']);
}

if (isset($_SESSION['student']))
{
    unset($_SESSION['student']);
}

if (isset($_POST['logout']))
{
    unset($_SESSION['loggedIn']);
    unset($_SESSION['username']);
    unset($_SESSION['userID']);
    unset($_SESSION['typeOfUser']);

    session_destroy();
    header("location: index.php");
}

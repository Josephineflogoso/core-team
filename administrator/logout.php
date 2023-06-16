<?php

    include('../config/dbconnect.php');
//destroy and redirect to log in page

        session_start();
        session_unset();
        session_destroy();


    header('location:../customer/login.php');

?>
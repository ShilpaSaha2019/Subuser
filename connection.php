<?php
$link = mysqli_connect('localhost','root','','test');
if(mysqli_connect_error())
    {
        die("Database connection failed");
    }
?>
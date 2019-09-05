<?php
$link = new mysqli('localhost','root','','test');
if($link->connect_error)
    {
        die("Database connection failed");
    }
?>
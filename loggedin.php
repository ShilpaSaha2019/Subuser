<?php
session_start();
require 'connection.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Profile</title>
</head>
<body>
    <div class="flex-r welcome-div">
    <h1>Welcome</h1>
    <div class="name-display-div">
    <?php
    $query = "SELECT * FROM `test` WHERE id='{$_SESSION['ID']}'";
    if(mysqli_query($link,$query))
    {
        ?>
        <div>
            <?php
            $result = mysqli_query($link,$query);
            $row = mysqli_fetch_assoc($result);
            echo $row['name'];
            ?>
        </div>
        <?php
    }
    ?>
    </div>
    </div>
</body>
</html>
<?php
require 'connection.php';

if(empty($_SESSION['is_loggedin'])){
    header('location:.');
}



include 'header.php';
$query = "SELECT * FROM `test` WHERE id='{$_SESSION['ID']}'";
if($link->query($query))
{
    $result = $link->query($query);
    $row = $result->fetch_assoc();
}
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
    <div class="flex-r div1">
    <h1>Welcome</h1>
    <div class="display-div1">
    <?php
    echo $row['name'];
    ?>
    </div>
    </div>
    <div class="flex-r div2">
    <h3>Address</h3>
    <div class="display-div2">
    <?php 
        echo $row['address'];
    ?>
    </div>
    </div>
    <div class="flex-r div3">
    <h3>Contact Number</h3>
    <div class="display-div2">
    <?php 
        echo $row['contact'];
    ?>
    </div>
    </div>
    <div class="flex-r div4">
    <h3>Designation</h3>
    <div class="display-div2">
    <?php
        echo $row['designation'];
    ?>
    </div>
    </div>
    <div class="flex-r div5">
    <h3>Highest Degree</h3>
    <div class="display-div2">
    <?php
        echo $row['highestDegree'];
    ?>
    </div>
    </div>
    <div class="flex-r div6">
    <h3>Passout Year</h3>
    <div class="display-div2">
    <?php
        echo $row['passoutYear'];
    ?>
    </div>
    </div>
    <div class="flex-r div7">
    <h3>Certification </h3>
    <div class="display-div2">
    <?php
        echo $row['certification'];
    ?>
    </div>
    </div>
    <div><button onClick="window.location.href='profile.php';">Edit Profile</button></div>
    <div>
    <button onClick="window.location.href='logout.php';">Logout</button>
    </div>
    </div>
</body>
</html>
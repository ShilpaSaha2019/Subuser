<?php
session_start();
include "header.php";
if(isset($_POST['save']))
{
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    require 'connection.php';

    function dump($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
   
    $whitelist = ['name','address','contactNo','designation','passoutYear','certification','highestDegree'];
    $errors = [];
    foreach($whitelist as $val)
    {
        if(!isset($_POST[$val]))
        {
            $errors[]= "{$val} field is missing";
        }
    }
    //dump($errors);

    $requiredFields=['name','address','contactNo'];
    $errorField =[];
    foreach($requiredFields as $key)
    {
        if(!isset($_POST[$key]))
        {
            $errorField[$key] = 1;
        }
    }
     dump($errorField);

    if($_POST['contactNo'] && !preg_match('/^[0-9]{10}+$/', $_POST['contactNo']))
    {
        $errorField['errContact'] = "Contact Number should contain Numeric values";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile Page</title>
    
</head>
<body>
<form action="" method="post">
<div class="flex-c main-div">
    <div class="img-div"><img src="" alt=""></div>
    <div class="form-group" id="">Name<input type="text" class="form-control" id="" name="name">
    <?php
     if(!empty($errorField['name']))
    {
    ?>
    <div class="alert alert-warning" role="alert">
        <?php
        echo "Name should be entered";
        ?>
    </div>
    <?php
    }
    ?>
    </div>
    <div class="form-group" id="">Address<input type="text" class="form-control" id="" name="address">
    <?php
    if(!empty($errorField['address']))
    {
    ?>
    <div class="alert alert-warning" role="alert">
        <?php
        echo "Address should be entered";
        ?>
    </div>
    <?php
    }
    ?>
    </div>
    <div class="form-group" id="">Contact No.<input type="text" class="form-control" id="" name="contactNo">
    <?php
    if(!empty($errorField['contactNo']))
    {
    ?>
    <div class="alert alert-warning" role="alert">
        <?php
        echo "Contact Number should be entered";
        ?>
    </div>
    <?php
    }
    ?>
    <?php
    if(!empty($errorField['errContact']))
    {
    ?>
    <div class="alert alert-warning" role="alert">
        <?php
        echo $errorField['errContact'];
        ?>
    </div>
    <?php
    }
    ?>
    </div>
    <div class="form-group" id="">Designation<input type="text" class="form-control" id="" name="designation"></div>
    <div class="form-group" id="">Highest Degree
        <select class="form-control" name="highestDegree">
            <option value="">--Select Degree--</option>
            <option value="hs">Higher Secondary</option>
            <option value="btech">B.Tech</option>
            <option value="mtech">M.Tech</option>
            <option value="bca">BCA</option>
            <option value="mca">MCA</option>
        </select>
    </div>
    <div class="form-group">Passout Year<input type="date" class="form-control" name="passoutYear"></div>
    <div class="form-group" id="">Certification<textarea class="form-control" rows="3" name="certification"></textarea></div>
    <div class="form-group" id=""><button type="submit" name="save" class="btn btn-success">Save</button></div>
    </div>
    </form>
</body>
</html>
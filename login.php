<?php
session_start();

if(isset($_POST['submit']))
{
require 'connection.php';
$whitelist = ['email','password'];
$errors = [];
foreach($whitelist as $key)
{
    if(!isset($_POST[$key]))
    {
        $errors[] = "{$key} field is missing";
    }
}

$requiredFields = ['email','password'];
$errField = [];
foreach($requiredFields as $val)
{
    if(!($_POST[$val]))
    {
        $errField[$val] = 1;
    }
}
// function dump($arr)
//     {
//         echo '<pre>';
//         print_r($arr);
//         echo '</pre>';
//     }
if(empty($errors) && empty($errField))
{
    $query = "SELECT * FROM `test` WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result)>0)
    {
        $row = mysqli_fetch_array($result);
        $hashedPassword = md5(md5($row['id']).$_POST['password']);
        if($hashedPassword == $row['password'])
        {
            $_SESSION['ID']=$row['id'];
            header("location: profile.php");
        }
        else {
            $errField['errPass'] = 1;
        }
    }
    else {
        $errField['errUser'] = 1;
    }
}

}
?>
<?php include 'header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
<div class="flex-c main-div">
<div class=" form-group" id="">
    <label for="">Email</label>
    <input type="text" name="email" class="form-control" placeholder="abcd@xyz.com">
    <?php
    if(!empty($errField['email']))
    {
        ?>
        <div class="alert alert-danger" role="alert">
        <?php
        echo "Email is required!";
        ?>
        </div>
        <?php
    }
    ?>
</div>
<div class=" form-group" id="">
    <label for="">Password</label>
    <input type="password" name="password" class="form-control" placeholder="*****">
    <!-- <input type="hidden" name="signIn" value="1"> -->
    <?php
    if(!empty($errField['password']))
    {
    ?>
    <div class="alert alert-danger" role="alert">
    <?php
    echo "Password is required!!";
    ?>
    </div>
    <?php
    }
    ?>
     <?php
    if(!empty($errField['errPass']))
    {
    ?>
    <div class="alert alert-danger" role="alert">
    <?php
    echo "That Email/Password combination could not be found!";
    ?>
    </div>
    <?php
    }
    ?>
     <?php
    if(!empty($errField['errUser']))
    {
    ?>
    <div class="alert alert-danger" role="alert">
    <?php
    echo "User not found!";
    ?>
    </div>
    <?php
    }
    ?>
</div>
<div class=" form-group" id="">
    <button type="submit" class="btn btn-success" name="submit">Submit</button>
    <p><a href="register.php">Not registered? Click to Register!</a></p>
</div>
</div>
</body>
</html>
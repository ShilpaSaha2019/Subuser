<?php
if(isset($_POST['submit']))
{
    require 'connection.php';
    // include 'formValidation.php';
    $errors = [];

    //checking submission fields empty errors
    if(!isset($_POST['email']) || !isset($_POST['pass']) || !isset($_POST['conPass']))
    {
        $suberrors = "Missing required fields";
    } 
    else 
    {
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $conPass = $_POST['conPass'];   
        
        //putting POST array elements to ERRORS associative array
        foreach($_POST as $key=>$val)
        {
            $errors[$key] = []; 
        }
            if(!$email)
            {
                $errors['email'][] = "Email can not be empty!";
                
            }
            if($email && !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email))
            {
                $errors['email'][] = "Email type is invalid!";
            }
            if(!$password)
            {
                $errors['pass'][] = "Password can not be empty!";
            }
            if($password && !preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#",$password))
            {
                $errors['pass'][] = "Password should contain at least one upper case, one lower case, one special character, at least 8 characters";
            }
            if(!$conPass)
            {
                $errors['conPass'][] = "Confirm password can not be empty!";
            }
            if($password != $conPass)
            {
                $errors['mismatchErr'][] = "Passwords do not match!";
            }
            else 
            {
                $query = "SELECT id FROM `test` WHERE email='".mysqli_real_escape_string($email)."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if(mysqli_num_rows($result)>0)
                {
                    $errors['already'][] = "This User already exists!! Please register with another account details!!"; 
                }

                else {
                    $query = "INSERT INTO `test`(`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$email)."','".mysqli_real_escape_string($link,$password)."'";
                    if(!mysqli_query($link, $query)
                    {
                        echo "There is a problem in insertion !";
                    }
                    else {
                        $idFetched = mysqli_insert_id($link);
                        $query = "UPDATE `test` SET password = '".md5(md5($idFetched).$_POST['pass'])."' WHERE id=".$idFetched." LIMIT 1";

                        mysqli_query($link, $query);

                    }
                    
                }
            }
    }

    

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <style>
    .flex-c{
        display: flex;
        flex-direction:column;
    }

    .flex-r{
        display:flex;
        flex-direction:row;
    }

    .main-div{
        max-width: 100%;
        margin: 10% 30% 10% 30%;
    }

    #errEmail
    {
    }
    </style>
</head>
<body>
<form action="" method="post">
        <?php 

            if(!empty($suberrors)){
                ?>
                <div class="alert alert-danger" role="alert">
                 <?php echo $suberrors ?>
                </div>
                <?php

            }
        
        ?>
    <div class="flex-c main-div">
        <div class="form-group" id="">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" placeholder="abcd@xyz.com">
            <?php 
            
            if(!empty($errors['email']))
            {
                ?>
                <div class="alert alert-warning" role="alert">
                   <?php
                    foreach($errors['email'] as $msg)
                    {
                        echo $msg.'<br>';
                    }
                   
                   ?>
                
                </div>
                <?php
            }
            ?>
        </div>
        <div class=" form-group" id="">
            <label for="">Password</label>
            <input type="password" name="pass" class="form-control" placeholder="*****">
            <?php
            
            if(!empty($errors['pass']))
            {
                ?>
                <div class="alert alert-warning" role="alert">
                <?php
                    foreach($errors['pass'] as $msg)
                    {
                        echo $msg.'<br>';
                    }
                ?>
                </div>
                <?php
            }
            ?>
            <?php
            
            if(!empty($errors['mismatchErr']))
            {
                ?><div class="alert alert-warning" role="alert">
                <?php 
                foreach($errors['mismatchErr'] as $msg)
                {
                    echo $msg.'<br>';
                }
                ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class=" form-group" id="">
            <label for="">Confirm Password</label>
            <input type="password" name="conPass" class="form-control" placeholder="*****">
            <?php
            
            if(!empty($errors['conPass']))
            {
                ?>
                <div class="alert alert-warning" role="alert">
                <?php 
                    foreach($errors['conPass'] as $msg)
                    {
                        echo $msg.'<br>';
                    }
                ?>
                </div>
                <?php
            }
            ?>
            <?php
        
            if(!empty($errors['mismatchErr']))
            {
                ?><div class="alert alert-warning" role="alert">
                <?php 
                foreach($errors['mismatchErr'] as $msg)
                {
                    echo $msg.'<br>';
                }
                ?>
                </div>
                <?php
            }
            ?>
            <?php
            if(!empty($errors['already']))
            {
                ?>
                <div class="alert alert-warning" role="alert">
                <?php
                foreach($errors['already'] as $msg)
                {
                    echo $msg.'<br>';
                }
                ?>
                </div>
                <?php
                }
                ?>
            <!-- <p class="errReport" id="alreadyErr">This User already exists!! Please register with another account details!!</p> -->
        </div>
        <div class="flex-c" id="">
            <button type="submit" class="btn btn-success" name="submit">Submit</button>
            <a href="login.php">Already registered? Click to login!</a>
        </div>
    </div>
</form>
</body>
</html>
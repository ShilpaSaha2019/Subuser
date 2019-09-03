<?php

function form_validation($email,$password,$conPass){
            
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
        }
?>
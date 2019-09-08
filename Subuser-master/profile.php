<?php
require 'connection.php';
if(empty($_SESSION['is_loggedin']))
{
    header('location:.');
}

$query = "SELECT * FROM `test` WHERE id='{$_SESSION['ID']}'";
if($link->query($query))
{
    $result = $link->query($query);
    $row = $result->fetch_assoc();
}


if(isset($_POST['save']))
{
    function dump($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
    // dump($_POST);
    $whitelist = ['name','address','contactNo','designation','passoutYear','certification','highestDegree'];
    $errors = [];
    foreach($whitelist as $val)
    {
        if(!isset($_POST[$val]))
        {
            $errors[]= "{$val} field is missing";
        }
    }
    // dump($errors);

    $requiredFields = ['name','address','contactNo'];
    $errorField = [];
    foreach($requiredFields as $key)
    {
        if(!($_POST[$key]))
        {
            $errorField[$key] = 1;
        }
    }
    //  dump($errorField);

    if($_POST['contactNo'] && !preg_match('/^[0-9]{10}+$/', $_POST['contactNo']))
    {
        $errorField['errContact'] = "Contact Number should contain Numeric values";
    }
    
    if(empty($errors) && empty($errorField))
    {
        $query = "UPDATE `test` SET name='{$_POST['name']}',address='{$_POST['address']}',contact='{$_POST['contactNo']}',designation='".$_POST['designation']."',highestdegree='".$_POST['highestDegree']."',passoutYear='{$_POST['passoutYear']}',certification='{$_POST['certification']}' WHERE id='".$_SESSION['ID']."' ";
        //$stmt = $link->prepare("INSERT INTO test (name,address,contact,designation,highestDegree,passoutYear,certification) VALUES (?,?,?,?,?,?,?)");
        //$stmt->bind_param("ssissss", $_POST['name'],$_POST['address'],$_POST['contactNo'],$_POST['designation'],$_POST['highestDegree'],$_POST['passoutYear'],$_POST['certification']);
        
        if($link->query($query))
        {
            $errorField['prflUpdate'] = 1;
        }
        else 
        {
            $errorField['errUpdate'] = 1;
        }
    }
    else {
        echo "There is a problem in input fields";
    }
}
?>
<?php include "header.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update your profile</title>
    
</head>
<body>
<form action="" method="post">
<div class="flex-c main-div">
    <div>
    <?php
    if(!empty($errorField['prflUpdate']))
    {
    ?>
        <div class="alert alert-success flex-r" role="alert">
            <?php
            echo "Profile updated successfully";
            ?>
            <div><a href="loggedin.php">Go to Profile</a></div>
        </div>
        <?php
        }
        ?>
    </div>
    <div>
        <?php
        if(!empty($errorField['errUpdate']))
        {
        ?>
        <div class="alert alert-danger" role="alert">
            <?php
            echo "Profile is not updated successfully!"
            ?>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="img-div"><img src="" alt=""></div>
    <div class="form-group" id="">Name<input type="text" class="form-control" id="" name="name" value="<?php echo $row['name']; ?>">
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
    <div class="form-group" id="">Address<input type="text" class="form-control" id="" name="address" value="<?php echo $row['address']; ?>">
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
    <div class="form-group" id="">Contact No.<input type="text" class="form-control" id="" name="contactNo" value="<?php echo $row['contact']; ?>"> 
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
    <div class="form-group" id="">Designation<input type="text" class="form-control" id="" name="designation" value="<?php echo $row['designation']; ?>"></div>
    <div class="form-group" id="">Highest Degree
        <select class="form-control" name="highestDegree" value="<?php echo $row['highestDegree']; ?>" selected>
            <option value="">--Select Degree--</option>
            <option value="btech">
            <?php if($row['highestDegree']=="btech")
            {
                ?> <option selected>B.Tech</option><?php
            } ?>    
            B.Tech</option>
            <option value="hs">Higher Secondary</option>
            <option value="mtech">
            <?php if($row['highestDegree']=="mtech")
            {
                ?> <option selected>M.Tech</option><?php
            } ?>        
            M.Tech</option>
            <option value="bca">BCA</option>
            <option value="mca">MCA</option>
        </select>
    </div>
    <div class="form-group">Passout Year<input type="date" class="form-control" name="passoutYear" value="<?php echo $row['passoutYear']; ?>"></div>
    <div class="form-group" id="">Certification<textarea class="form-control" rows="3" name="certification" value="<?php echo $row['certification']; ?>"></textarea></div>
    <div class="form-group" id=""><button type="submit" name="save" class="btn btn-success">Save</button></div>
    </div>
    </form>
</body>
</html>
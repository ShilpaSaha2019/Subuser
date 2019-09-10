<?php
require 'connection.php';

if(empty($_SESSION['is_loggedin'])){
    header('location:.');
}

include 'header.php';
$style="width:300px; height:380px; margin:5%; margin-right:0; border:2px solid black;";
$style1="width:60px; height:60px; margin:5%; margin-right:0; border:2px solid black;";
    $query = "SELECT * FROM `test` WHERE id='{$_SESSION['ID']}'";
    if($link->query($query))
    {
        $result = $link->query($query);
        $row = $result->fetch_assoc();
    }

$fileList = [];
function dump($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
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
    <div>
    <?php 
    $img= $row['showDp'];
    echo " <img src='images/{$img}' style='{$style}'></img> " ?>
    </div>
    <div id="gallery">
    <?php 
            $dir = "images/";
            if(is_dir($dir))
            { 
            if($dh = opendir($dir))
            {
                while(($file = readdir($dh))!==false)
                {
                    $fileList[]=$file;
                }
            
            } 
            }
            // dump($fileList);
            foreach($fileList as $file)
            {
                echo " <img src='images/{$file}' style='{$style1}' id='clickedImg' onclick='myFunction()'></img> ";
            }
    ?>
    <script type="text/javascript">
    function myFunction(){
        alert ("Image is clicked");
        // <?php 
        // echo "Hello your dp is changed";
        //     $query = "UPDATE `test` SET showDp='{$file}' WHERE id='".$_SESSION['ID']."'";
        //     if($link->query($query))
        //     {
        //         $query = "SELECT * FROM `test` WHERE id='{$_SESSION['ID']}'";
        //             if($link->query($query))
        //             {
        //                 $result = $link->query($query);
        //                 $row = $result->fetch_assoc();
        //             }
        //     }
        //     // return $row['showDp'];
        // ?>
    }
    </script>
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
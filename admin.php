<?php 
    include("./connection.php");
    // ******** check whos person are login user or admin if login is not admin then redired on index page
    session_start();
    
    if($_SESSION == true){
        if($_SESSION["loginUser_roll"] != 1){
            header("location:./index.php");
        }
    }else{
        header("location:./index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admine page</title>
        <link href="../imgUp/img1.jpeg" rel="shortcut icon" type="image/x-icon" />
        
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            h1{
                text-align: center;
                background-color: #e0f0ff;
                padding: 15px;
                font-family: sans-serif;
                color: #006bd6;
            }
        </style>
    </head>
    <body>
        <a href="./logout.php">Logout</a>
        
        <h3>Wealcome:- 
            <?php
                $selectQuerry = "SELECT userName FROM userTbl Where userEmail = '{$_SESSION["loginUser1"]}'";
                $result = mysqli_query($connection, $selectQuerry);
                echo mysqli_fetch_assoc($result)['userName']
            ?>
        </h3>

        <h1>Admine Page</h1>
    </body>
</html>
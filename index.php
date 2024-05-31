<?php 
    include("./connection.php");
    // ******** check whos person are login user or admin if login is admin then redired admin on admin panal
    session_start();
    if($_SESSION == true){
        if($_SESSION["loginUser_roll"] == 1){
            header("location:./admin.php");
        }else{
            $selectQuerry = "SELECT userName FROM userTbl Where userEmail = '{$_SESSION["loginUser1"]}'";
            $result = mysqli_query($connection, $selectQuerry);
            echo "Wealcome:- ".mysqli_fetch_assoc($result)['userName'];
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home page</title>
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
            a{
                text-decoration: none;
                font-weight: bold;
                padding: 10px;
                background-color: #006bd6;
                color: #e0f0ff;
                font-family: sans-serif;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <h1>Home Page</h1>
        <a href="./signup.php">Sing Up</a>
        <?php
            if($_SESSION == true and $_SESSION["loginUser_roll"] == 0){
                echo '<a href="./logout.php">Logout</a>';

            }else{
                echo '<a href="./login.php">Login</a>';
            }
        ?>
        

    </body>
</html>
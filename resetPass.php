<?php
    // ************* include connection file
    include("./connection.php");
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />   
        <title>Reset password</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- *************************************** internal style *********************************** -->
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body{
                background-color: #cce6ff;
                font-family: sans-serif;
                color: #001111;
            }

            form{
                background-color: #f5faff;
                width: 300px;
                margin: 100px auto;
                padding: 10px;
            }
            form h3{
                text-align: center;
                color: #1484ff;
                font-size: 25px;
            }
            form input{
                width: 100%;
                margin-bottom: 14px;
                padding: 8px;
                border: 1.4px solid #1484ff;
            }
            form input:focus{
                outline: 1px solid #1484ff;                
                border-right: 5px solid #1484ff;
            }

            form > a{
                font-size: 14px;
                color: #2e7be9;
                text-decoration: none;
            }
            form #loginBtn{
                background: #1484ff;
                color: #ddd;
                border: none;
                font-size: 15px;
                cursor: pointer;
                font-weight: bold;
                transition: all 0.2s;
            }
            form #loginBtn:hover{
                background: #148433;
            }
            
        </style>
        
    </head>
    <body>
        <!-- ************* Start reset password form ********************** -->
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" id="resetPassForm">
            <h3>Reset Your Password</h3>
            <br/>
            <hr color="#1484ff"><br/>

            <input type="email" name="userEmail" placeholder="Enter email" />
            <input type="password" name="newPass" placeholder="Enter new password" autocomplete="off" />
            <input type="password" name="confPass" placeholder="Enter Confirm password" autocomplete="off" />
            <input type="submit" name="resetBtn" value="Reset Now" id="loginBtn" />
            <a href="./login.php">Login now</a>
            <a href="./signup.php" style="float: right;">New Member:- Signup</a>
        </form><!--**** End of reset password form -->
    </body>
</html>

<?php
    // *************** Start logic of reset password
    if(isset($_POST["resetBtn"])){

        // ****** get input fild data
        $userEmail = addslashes(htmlspecialchars(mysqli_escape_string($connection, $_POST["userEmail"])));
        $newPass = $_POST["newPass"];
        $confPass = $_POST["confPass"];

        // ****** apply some validation 
        if($userEmail != "" and $newPass != "" and $confPass != ""){
            $newPass = addslashes(md5(mysqli_escape_string($connection, $_POST["newPass"])));
            $confPass = addslashes(md5(mysqli_escape_string($connection, $_POST["confPass"])));
            
            // ************* logic to check user is exit or not 
            $selectQuerry = "SELECT userEmail FROM usertbl where userEmail = '$userEmail'";
            $result = mysqli_query($connection, $selectQuerry);

            if(mysqli_num_rows($result) == 1){

                if($newPass == $confPass){
                    $updateQuerry = "UPDATE usertbl set userPass = '{$newPass}' where userEmail = '$userEmail'";
                    $updateRes = mysqli_query($connection, $updateQuerry);
                    echo $updateRes;
                }else{
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Please enter same password",
                            timer:10000,
                        });
                    </script>';
                }
                
            }else{
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "This email id is not Signup !",
                        timer:10000,
                        footer: `<a href="./signup.php" style="text-decoration:none; font-size:20px;">Please click to signup now</a>`
                    });
                </script>';
            }
        }else{
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Please fill the all input box !",
                    timer:5000
                });
            </script>';
        }
        
    }

?>
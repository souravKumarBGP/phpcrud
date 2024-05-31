<?php
    /****************** logic of include connection file *********************** */
    include("./connection.php");

    session_start();
    if($_SESSION == true){
        if($_SESSION['loginUser_roll'] == 1){
            header("location:./admin.php");
        }else{
            header("location:./index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />   
        <title>Login page</title>
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
        <!-- *************** login form ****************************** -->
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" id="loginForm">
            <h3>Login Form</h3>
            <br/>
            <hr color="#1484ff"><br/>

            <input type="email" name="loginEmail" placeholder="Enter email" />
            <input type="password" name="loginPass" placeholder="Enter password" autocomplete="off" />
            <input type="submit" name="loginBtn" value="Login" id="loginBtn" />
            <a href="./resetPass.php">Reset Password</a>
            <a href="./signup.php" style="float: right;">New Member:- Signup</a>
        </form><!--**** End of login form -->

    </body>
    
</html>

<?php 
    // *************** Start logic of login form 
    if(isset($_POST["loginBtn"])){

        $loginEmail = addslashes(htmlspecialchars(mysqli_escape_string($connection, $_POST["loginEmail"])));
        $loginPass = $_POST["loginPass"];


        // ***************** logic to apply validation if validation is success then 
        if($loginEmail != "" and $loginPass != ""){
            $loginPass = addslashes(md5(mysqli_escape_string($connection, $_POST["loginPass"])));
            
            // ************* logic to check user is exit or not 
            $selectQuerry = "SELECT userEmail, userPass, userRoll FROM usertbl where userEmail = '$loginEmail' and userPass = '$loginPass'";
            $result = mysqli_query($connection, $selectQuerry);

            if(mysqli_num_rows($result) == 1){
                
                $data = mysqli_fetch_assoc($result);
                //********** Stored login user in session storage

                session_start();
                $_SESSION["loginUser1"] = $data["userEmail"];
                $_SESSION["loginUser_roll"] = $data["userRoll"];
                header("location:./index.php");

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
        };
    }//***End of login form logic
?>
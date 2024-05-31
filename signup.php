<?php 
    /* ********************* include connecton file ***************** */
    include("./connection.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign up page</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body{
                background: #e0efff;
            }

            form{
                background: #f5faff;
                margin: 100px auto;
                width: 300px;
                min-height: 100px;
                padding: 0 10px 15px;
            }
            form h2{
                text-align: center;
                font-family: sans-serif;
                color: #e0efff;
                background: #1484ff;
                padding: 5px;
                font-size: 21px;
                margin-bottom: 10px;
                margin-left: -10px;
                margin-right: -10px;
            }
            form :is(input, select){
                width: 100%;
                margin-bottom: 13px;
                padding: 7px;
                border-radius: 0;
                border: none;
                outline: 1px solid #1484ff;
            }
            form input:focus{
                border-right: 7px solid #1484ff;
            }
            #signupBtn{
                margin-top: 6px;
                background: #1484ff;
                color: #e0efff;
                font-size: 14.5px;
                cursor: pointer;
            }
            #signupBtn:hover{
                background: #3d99ff;
            }
            form a{
                color: #1484ff;
                font-family: sans-serif;
                text-decoration: none;
                font-size: 14.3px;
                text-align: center;
                display: block;
            }
            form select{
                appearance: none;
                position: relative;
            }
            form .select_arrowBtn{
                width: 12px;
                height: 8px;
                background: #1484ff;
                position: absolute;
                top: 12px;
                right: 7px;
                clip-path: polygon(0 0, 50% 100%, 100% 0);
                pointer-events: none;
            }

        </style>

    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <h2>Singup form</h2>
            <input type="text" name="userName" placeholder="Enter you name" />
            <input type="text" name="userEmail" placeholder="Enter you email id" />
            <input type="text" name="userPass" placeholder="Create you password" autocomplete="off" />
            <label style="position: relative; display:block;" >
                <select name="userRoll">
                    <option value="" disabled>Select Roll</option>
                    <option value="0" selected>User</option>
                    <option value="1">Admin</option>
                </select>
                <div class="select_arrowBtn"></div>
            </label>
            <input type="submit" name="singupBtn" value="Signup Now" id="signupBtn">

            <a href="./login.php">Have you already signup:- Login now</a>
        </form><!--************** End of form tag-->
    
    </body>
</html>

<?php
    /* ********************************************************************************
    Logic to save form data into database when user click signupBtn
    ************************************************************** ****************** */
    if(isset($_POST["singupBtn"])){
        $userName = $_POST["userName"];
        $userEmail = $_POST["userEmail"];
        $userPass =$_POST["userPass"];
        $userRoll = $_POST["userRoll"];

        /************ logic of apply validation on serverside *********************** */
        if($userName != "" and $userEmail != "" and $userPass != "" and $userRoll != ""){

            $userName = addslashes(htmlspecialchars(mysqli_escape_string($connection, $_POST["userName"])));
            $userEmail = addslashes(htmlspecialchars(mysqli_escape_string($connection, $_POST["userEmail"])));;
            $userPass = addslashes(md5(mysqli_escape_string($connection, $_POST["userPass"])));
            $userRoll = addslashes($_POST["userRoll"]);
            
            // *********** logic of check account is already exist if account is not already exit the insert data in database
            $isEmailExit = "SELECT userEmail FROM usertbl WHERE userEmail = '$userEmail'";
            $res = mysqli_query($connection, $isEmailExit);

            if(mysqli_num_rows($res) == 0){
                $insertQuerry = "INSERT INTO userTbl (username, userEmail, userPass, userRoll) values('$userName', '$userEmail', '$userPass', '$userRoll' )";
                $result = mysqli_query($connection, $insertQuerry) or die("Querry dine");

                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Signup success full",
                        timer:2000
                    });
                </script>';
            }else{
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Signup failed !",
                        text: "This email is already registered !",
                        timer:5000
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
    }

?>
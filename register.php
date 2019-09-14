<?php
    include("resources/config.php");
    include("resources/classes/Account.php");
    include("resources/classes/Errors.php");
    $account = new Account ($con);
    include("resources/register-handler.php");
    include("resources/login-handler.php");
    
    function getInputValue($input){
        if ( isset($_POST[$input])){
            echo $input;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script src="js/register.js"></script>
    <title>Register Page</title>
</head>
<body>
    <?php 
        if ( isset($_POST['registerButton'])){
                echo ' <script>
                 $(document).ready(function() {
                  $("#loginForm").hide();
                     $("#registerForm").show();
                    });
                </script>';
        } else{
             echo ' <script>
                $(document).ready(function() {
                     $("#loginForm").show();
                         $("#registerForm").hide();
                 });
                 </script>';
        }
    ?>
   
    
    <div class="background">
     <img class="logo" src="assets/images/logo.png" alt="logo">

    <div class="loginRegContainer">
       
    <!--
    *
    *LOGIN
    *
     -->
    <div class="inputContainer">
    <form id="loginForm" action="register.php" method="POST">
        <h2>Login to your account</h2>
        <?php 
            echo $account->getError(Errors::$loginFailed);
        ?>
        <p><label for="loginUsername">Username</label>
        <input value ="<?php getInputValue('loginUsername') ?>" id="loginUsername" name="loginUsername" placeholder="e.g. mdl160" type="text" required></p>
        <p><label for="loginPassword">Password</label>
        <input value ="<?php getInputValue('loginPassword') ?>" id="loginPassword" name="loginPassword" type="password" placeholder="my password" required></p>

        <button type="submit" name="loginButton">LOG IN</button>

        <div class="hasAccountText">
            <span class="hideLogin">Don't have an account yet? Signup here</span>
        </div>
    </form>

    <!--
    *
    *REGISTER
    *
    -->
       <form id="registerForm" action="register.php" method="POST">
        <h2>Create your free account</h2>
        <p>
        <?php 
            echo $account->getError(Errors::$un);
        ?>
         <?php 
            echo $account->getError(Errors::$un2);
        ?>
  
        <label for="username">Username</label>
        <input value ="<?php getInputValue('username') ?>" id="username" name="username" placeholder="e.g. mdl160" type="text" required>
        </p>

        <p>
        <?php 
            echo $account->getError(Errors::$fn);
        ?>
        <label for="firstName">First name</label>
        <input value ="<?php getInputValue('firstName') ?>" id="firstName" name="firstName" placeholder="e.g. Thomas" type="text" required>
        </p>

        <p>
        <?php 
            echo $account->getError(Errors::$ln);
        ?>
        <label for="lastName">Last name</label>
        <input value ="<?php getInputValue('lastName') ?>" id="lastName" name="lastName" placeholder="e.g. Paolucci" type="text" required>
        </p>

        <p>
        <?php 
            echo $account->getError(Errors::$em1);
        ?>
        <?php 
            echo $account->getError(Errors::$em2);
        ?>
         <?php 
            echo $account->getError(Errors::$em3);
        ?>
        <label for="email">Email</label>
        <input value ="<?php getInputValue('email') ?>" id="email" name="email" placeholder="e.g. @gmail.com" type="email" required>
        </p>

        <p>
        <label for="email2">Confirm email</label>
        <input value ="<?php getInputValue('email2') ?>" id="email2" name="email2" placeholder="e.g. @gmail.com" type="email" required>
        </p>

        <p>
        <?php 
            echo $account->getError(Errors::$pw1);
        ?>
        <?php 
            echo $account->getError(Errors::$pw2);
        ?>
        <?php 
            echo $account->getError(Errors::$pw3);
        ?>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="my password" required>
        </p>
        
        <p>
        <label for="password2">Confirm password</label>
        <input id="password2" name="password2" type="password" placeholder="my password" required>
        </p>
        
        <button type="submit" name="registerButton">SIGN UP</button>

         <div class="hasAccountText">
            <span class="hideRegister">Already have an account? Login here.</span>
        </div>

        </form>
    
        </div>
     <!-- 
    *
    *LOGIN TEXT 
    *
    -->
    <div class="loginText">
        <h1 id="line1">Get greate music, </h1>
        <h1 id="line2">right now</h1>
        <h2>Listen to loads of songs for free.</h2>
        <ul>
            <li>Discover music you'll fall in love with</li>
            <li>Create your own playlists</li>
            <li>Follow artists to keep up to date</li>
        </ul>
    </div>
 
    
    </div>

    </div>
</body>
</html>
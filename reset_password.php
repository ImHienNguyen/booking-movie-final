<?php
    require_once("db.php");
?>
<DOCTYPE html>
<html lang="en">
<head>
    <title>Reset user password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
<?php

    $request_error = '';
    $success ='';
    $email = '';
    $pass = '';
    $pass_confirm = '';

    $display_email = filter_input(INPUT_GET,'email', FILTER_SANITIZE_EMAIL);

    if(isset($_GET['email'])&&isset($_GET['token'])){
        $email = $_GET['email'];
        $token = $_GET['token'];

        if(filter_var($email,FILTER_SANITIZE_EMAIL)===false){
            $error = 'This is an invalid email';

        }else if(strlen($token)!=32){
            $error = 'This reset token is not valid';
        }else{
            
            if (isset($_POST['email']) && isset($_POST['pass']) &&
                isset($_POST['pass-confirm'])) {

                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $pass_confirm = $_POST['pass-confirm'];

                if (empty($email)) {
                    $error = 'Please enter your email';
                }
                else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                    $error = 'This is not a valid email address';
                }
                else if (empty($pass)) {
                    $error = 'Please enter your password';
                }
                else if (strlen($pass) < 6) {
                    $error = 'Password must have at least 6 characters';
                }
                else if ($pass != $pass_confirm) {
                    $error = 'Password does not match';
                }
                else {
                    echo 'Good';
                    $result = change_password($email,$pass);
                    if($result['code']==0){
                        $success = $result['success']. ". <a class='text-primary' href='login.php'>Click</a> here to login";
                    }else{
                        $error = $result['error'];
                    }
                }
            }
            else {
                // echo 'Something went wrong';
            }
        }
    }else{
        $error = 'Your email and token are invalid';
    }
    
    
?>
<div class="container custom-container">
    <h3 class="text-center text-secondary mt-5 mb-3">Reset Password</h3>
    <?php
        if (!empty($request_error)) {
            echo "<div class='alert alert-danger'>$request_error</div>";
        }else{
            ?>
                <form novalidate method="post" action="">
                    <div class="custom-form">
                        <input readonly value="<?=$display_email?>" name="email" id="email" type="text" class="text-info bg-dark text-center" placeholder="Email address">
                    </div>
                    <div class="custom-form">
                        <input  value="<?= $pass?>" name="pass" required type="password" placeholder="Password" id="pass">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="custom-form">
                        <input value="<?= $pass_confirm?>" name="pass-confirm" required type="password" placeholder="Confirm Password" id="pass2">
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>
                    <div class="form-group">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                            if (!empty($success)) {
                                echo "<div class='alert alert-success'>$success</div>";
                            }
                        ?>
                        <button class="btn btn-success px-5">Change password</button>
                    </div>
                </form>
            <?php
        }
    ?>
</div>

</body>
</html>

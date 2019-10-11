<?php

include "../lib/User.php";

include "../lib/PHPMailer/PHPMailerAutoload.php";

    $user = new User();


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {

        $userForgetPass = $user->userForgetPassword($_POST);
    }





?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forget Password</title>

    <!--============ bootstrap-supported-CSS-file ==============-->
    <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
    <!--============ bootstrap-supported-CSS-file ==============-->
</head>

    <body>

        <section class="main">
            <div class="container">
                <div class="card bg-light my-md-4">
                    <div class="card-body pb-0">
                        <div class="col-md-4 offset-md-4">
                            <div class="text-center">
                                <a href="../login.php"><img src="../image/logo.png" alt="LOGO"></a>
                                <h2 class="mb-5">Reset your password</h2>
                            </div>

                            <?php
                                if (isset($userForgetPass)) {
                                    echo $userForgetPass;
                                }
                            ?>

                            <form action="" method="POST" class=" card bg-light p-4">
                                <div class="form-group">
                                    <label for="email"><strong style="font-size: 13px;color: #444444;">Enter your email address and we will send you a link to reset your password.</strong></label>
                                    <input type="email" id="email" name="email" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="re_pass" value="Send password reset email" class="btn btn-success btn-block">
                                </div>
                            </form>
                        <div class="card bg-light my-md-4">
                            <div class="card-body py-3">
                                <span>New to Our Site? <a href="../register.php">Create an account.</a></span>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        <footer>
            <div class="container">
                <div class="card bg-light">
                    <div class="card-header">
                        <h3><a target="_blank" class="text-dark" href="www.ridankabir.com">Website: www.ridankabir.com</a>
                            <a href="https://www.facebook.com/ridankabirr" target="_blank" class="float-right text-dark">Like Us:www.facebook.com/ridankabirr</a>
                        </h3>
                    </div>
                </div>
            </div>
        </footer>
        <!--============ bootstrap-supported-Jquery-file ==============-->
        <script src="../lib/jq/jquery-3.4.1.min.js"></script>
        <script src="../lib/jq/popper.min.js"></script>
        <script src="../lib/jq/bootstrap.min.js"></script>
        <!--============ bootstrap-supported-Jquery-file ==============-->
   
    </body>
</html>

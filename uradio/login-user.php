<?php require_once 'controllerUserData.php';
?>
<!DOCTYPE html>
<html lang = 'en'>
<head>
<meta charset = 'UTF-8'>
<title>Login Form</title>
<link rel = 'stylesheet' href = 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
<link rel = 'stylesheet' href = 'style2.css'>
<!--lottie flow-->
<script src = 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'></script>
</head>
<body>
<div class = 'container'>
    <div class = 'row'>
        <div class = 'col-md-4 offset-md-0 form login-form' style = "background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                            url(images/claus-grunstaudl-dKeB0-M9iiA-unsplash.jpg);background-size:cover;">
        <form action = 'login-user.php' method = 'POST' autocomplete = ''>
        <h2 class = 'text-center text-white'>Login Form</h2>
        <p class = 'text-center text-white'>Login with your email and password.</p>
        <?php
        if ( count( $errors ) > 0 ) {
            ?>
            <div class = 'alert alert-danger text-center'>
            <?php
            foreach ( $errors as $showerror ) {
                echo $showerror;
            }
            ?>
            </div>
            <?php
        }
        ?>
        <div class = 'form-group'>
        <input class = 'form-control' type = 'email' name = 'email' placeholder = 'Email Address' required value = "<?php echo $email ?>">
        </div>
        <div class = 'form-group'>
        <input class = 'form-control' type = 'password' name = 'password' placeholder = 'Password' required>
        </div>
        <div class = 'link forget-pass text-left'><a href = 'forgot-password.php' class = 'text-warning' style = 'text-decoration:underline;'>Forgot password?</a></div>
        <div class = 'form-group'>
        <input class = 'form-control button' type = 'submit' name = 'login' value = 'Login' style = 'background-color:#ffd01d;'>
        </div>
        <div class = 'link login-link text-center text-white'>Not yet a member? <a href = 'signup-user.php' class = 'text-warning' style = 'text-decoration:underline;'>Signup now</a></div>
        </form>
        </div>
    </div>
</div>

</body>
</html>
<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-0 form" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url(images/claus-grunstaudl-dKeB0-M9iiA-unsplash.jpg);background-size:cover;">
            
                <form action="signup-user.php" method="POST" autocomplete="">
                <!-- <div style="margin-top:10vh;">
                    
                    <div class="text-1">
                        <p>Bring Your Music Along<span>Try Unlimited For Free</span></p>
                    </div>
			    </div> -->
                <!-- <img src="images/form-v2.jpg" alt="form"> -->
                <h2 class="text-center text-white">Uradio Register</h2>
                    <p class="text-center text-white">It's quick and easy.</p>
                    <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Full Name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="signup" value="Signup" style="background-color:#ffd01d;">
                    </div>
                    <div class="link login-link text-center text-white">Already a member? <a href="login-user.php" class="text-warning" style="text-decoration:underline;">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
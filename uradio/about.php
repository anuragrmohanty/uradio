<?php require_once 'controllerUserData.php';
?>
<?php
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$password = $_SESSION['password'];
if ( $email != false && $password != false ) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query( $con, $sql );
    if ( $run_Sql ) {
        $fetch_info = mysqli_fetch_assoc( $run_Sql );
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if ( $status == 'verified' ) {
            if ( $code != 0 ) {
                header( 'Location: reset-code.php' );
            }
        } else {
            header( 'Location: user-otp.php' );
        }
    }
} else {
    header( 'Location: login-user.php' );
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Uradio | About Us</title>
    <meta name = 'viewport' content = 'width=device-width, initial-scale=1'>
    <!--lottie flow-->
    <script src = 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js'></script>
    <!--boxicons-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        @import url( 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap' );
        @import url( 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&display=swap');
        body {
            margin:0;
            font-family: 'Roboto', sans-serif;
            background:url( 'images/extra.jpg' ) no-repeat center center fixed;
            background-size:cover;

        }
        * {
            box-sizing: border-box;
        }
        header {
            width:100%;
            background:#131313;
            position:fixed;
            z-index:100;
            -webkit-box-shadow: 0px 10px 13px 0px rgba( 0, 0, 0, 0.9 );
            -moz-box-shadow:    0px 10px 13px 0px rgba( 0, 0, 0, 0.9 );
            box-shadow:         0px 10px 13px 0px rgba( 0, 0, 0, 0.9 );
        }
        .mainheader {
            display:flex;
            width:100%;
            align-items:center;
            justify-content:space-around;

            class = 'main_img'
        }
        .mainheader nav {
            width:500px;
            display:flex;
            justify-content:space-around;
            align-items:center;
            padding-left:5rem;
        }
        .mainheader nav a {
            text-decoration:none;
            text-transform:uppercase;
            color:white;
        }
        .logo, .account {
            cursor:pointer;

        }
        .active {
            border-bottom:.1rem solid white;
            font-weight:bold;
        }
        a:hover {
            border-bottom:.1rem solid white;
            transition:.4s ease;
            font-weight:bold;
        }

        .team-section {
            background-color:rgba( 0, 0, 0, .3 );
            min-height: 100vh;
            padding:70px 15px 30px;
        }

        .container {
            max-width: 1170px;
            margin:auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .team-section .section-title {
            flex-basis: 100%;
            max-width: 100%;
            margin-bottom: 70px;
        }

        .team-section .section-title h1 {
            font-size: 40px;
            text-align: center;
            margin:0;
            color: #ffffff;
            font-weight: 700;
        }

        .team-section .section-title p {
            font-size:16px;
            text-align: center;
            margin:15px 0 0;
            color:#ffffff;
        }
        .team-section .team-items {

            flex-basis: 100%;
            max-width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .team-section .team-items .item {
            flex-basis: calc( 25% - 30px );
            max-width: calc( 25% - 30px );
            transition: all .5s ease;
            margin-bottom: 40px;
        }
        .team-section .team-items .item img {
            display: block;
            width: 100%;
            border-radius: 8px;
        }

        .team-section .team-items .item .inner {
            position: relative;
            z-index: 11;
            padding:0 15px;
        }
        .team-section .team-items .item .inner .info {
            background-color: RGBA( 255, 167, 11, 0.73 );
            text-align: center;
            padding: 20px 15px;
            border-radius:8px;
            transition: all .5s ease;
            margin-top: -40px;
        }
        .team-section .team-items .item:hover  .info {
            transform: translateY( -20px );
        }
        .team-section .team-items .item:hover {
            transform: translateY( -10px );

        }
        .team-section .team-items .item .inner .info h5 {
            margin:0;
            font-size: 18px;
            font-weight: 600;
            color:#ffffff;
        }
        .team-section .team-items .item .inner .info p {
            font-size: 16px;
            font-weight: 400;
            color:#c5c5c5;
            margin:10px 0 0;
        }

        .team-section .team-items .item .inner .info .social-links {
            padding-top: 15px;
        }

        .team-section .team-items .item .inner .info .social-links a {
            display: inline-block;
            height: 32px;
            width: 32px;
            background-color: #ffffff;
            color:#009688;
            border-radius: 50%;
            margin:0 2px;
            text-align: center;
            line-height: 32px;
            font-size:16px;
            transition: all .5s ease;
        }

        .team-section .team-items .item .inner .info .social-links a:hover {
            box-shadow: 0 0 10px #000;
        }

        /*responsive*/
        @media( max-width: 991px ) {
            .team-section .team-items .item {
                flex-basis: calc( 50% - 30px );
                max-width: calc( 50% - 30px );

            }
        }

        @media( max-width: 767px ) {
            .team-section .team-items .item {
                flex-basis: calc( 100% );
                max-width: calc( 100% );

            }
        }
        .animationlottie {
            background-color:rgba( 0, 0, 0, 0.7 );
            z-index:50;
            top:0rem;
            pointer-events:none;
            padding-top:2rem;
            height:100vh;
        }
        .center-animation {
            display:flex;
            justify-content:center;
            pointer-events:none;
        }
        /*scroll bar custom*/
        /* width */
        ::-webkit-scrollbar {
            width: 15px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #888;

        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #131313;

        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;

        }
        .logout{
            display:flex;
            justify-content:space-around;
            align-items:center;
        }
        .left-btn{
            padding-top:.5rem;
        }
        .left-btn>a{
            font-weight:bold;

        }
        .button-logout {
            display: inline-block;
            padding: 0.50rem 1rem;
            border-radius: 10rem;
            color: #fff;
            text-transform: uppercase;
            font-size: 1rem;
            letter-spacing: 0.15rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            z-index: 1;
            text-decoration:none;
            
        }
        .button-logout:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #fe8c00;
            border-radius: 10rem;
            z-index: -2;
        }
        .button-logout:before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: #870000;
            transition: all 0.3s;
            border-radius: 10rem;
            z-index: -1;
        }
        .button-logout:hover {
            color: #fff;
        }
        .button-logout:hover:before {
            width: 100%;
        }
        .account-info{
        position:absolute;
        height:80vh;
        width:23vw;
        background-color:#131313;
        border-radius:1rem;
        top:4rem;
      }
      .account-info>ul{
        padding:0;
      }
      .account-info>ul>li:first-child{
        margin-top:.5rem;
        border-top:none;
        text-transform:none;
        border-bottom:1px solid #9d9d9d;
      }
      .account-info>ul>li:last-child{
        border-bottom:1px solid #9d9d9d;  
      }
      .account-info>ul>li{
        padding:5px;
        color:white;
        list-style:none;
        text-transform:capitalize;
      }
      .account-details{
        display:flex;
        justify-content:space-around;
        align-items:center;
      }
      .acc-left{
        padding:5px;
        border-right:2px solid #9d9d9d;
      }
      .acc-right{
        padding-right:10px;
      }
      .account-content{
        display:flex;
        justify-content:left;
        align-items:center;
      }
      .right-info>a{
        color:white;
        text-decoration:none;
      }
      .left-icon{
        padding:.5rem;
        font-size:20px;
      }
    </style>
</head>
<body>

    <header>
        <div class = 'mainheader'>
            <div class = 'logo'><img src = 'images/youtuberadiologo.png' height = '50px' alt = 'logo'></div>
            <nav>
            <a href = 'index.php'>Home</a>
            <a href = 'explore.php'>Explore</a>
            <a href = '#'>Library</a>
            <a href = 'about.php'class = 'active'>About us</a>
            </nav>
            <div class="account">
                <img id="account-infoimg" src="https://source.unsplash.com/random" width="36px" height="36px" style="border-radius:50%;border:2px solid grey;"alt="account_img">
                <div class="account-info">
                    <ul>
                    <li>
                        <div class="account-details">
                        <div class="acc-left">
                            <img id="account-infoimg" src="https://source.unsplash.com/random" width="36px" height="36px" style="border-radius:50%;border:2px solid grey;"alt="account_img">
                        </div>
                        <div class="acc-right">
                            <?php
                            echo $email."<br/>";
                            echo $name."<br/>";
                            ?>
                        </div>
                        </div>
                    </li>
                    <li class="account-content">
                        <div class="left-icon"><i class='bx bx-cog' style='color:#ffffff'  ></i></div>
                        <div class="right-info"><a href="#">Setting</a></div>
                    </li>
                    <li class="account-content">
                        <div class="left-icon">
                        <i class='bx bx-help-circle'></i>
                        </div>
                        <div class="right-info"><a href="#">Help & Feedback</a></div>
                    </li>
                    <li class="account-content">
                        <div class="left-icon"><i class='bx bxs-user-account'style='color:#ffffff'  ></i></div>
                        <div class="right-info"><a href="#">Switch Account</a></div>
                    </li>
                    </ul>
                </div>
            </div>
            <div class="logout">
                <div class="left-btn">
                    <a href="logout-user.php" class="button-logout">LOGOUT</a>
                </div>
                <div class="right-anime">
                    <lottie-player src="https://assets3.lottiefiles.com/temp/lf20_rkX77P.json" background="transparent"  speed="1" loop  style="width: 40px; height: 40px;z-index:50;" autoplay></lottie-player>
                </div>
            </div>

        </div>
    </header>
    <div class = 'animationlottie'>
        <div class = 'center-animation'>
        <lottie-player src = 'https://assets5.lottiefiles.com/packages/lf20_9xrenieu.json' background = 'transparent'  speed = '1' loop  style = 'width: 400px; height: 400px;z-index:50;' autoplay></lottie-player><br>
        </div>
        <div class = 'center-animation'>
        <lottie-player src = 'https://assets9.lottiefiles.com/packages/lf20_Rq8jJk.json' background = 'transparent'  speed = '1' loop  style = 'width: 50px; height: 50px;z-index:50;' autoplay></lottie-player>
        </div>
    </div>

    <section class = 'team-section'>
        <div class = 'container'>
        <div class = 'row'>
        <div class = 'section-title'>
        <h1>Our Uradio Team</h1>
        <p>This is about us page of Uradio and these are the developers os this awesome musical web app</p>
        </div>
        </div>
        <div class = 'row'>
        <div class = 'team-items'>
        <div class = 'item'>
        <img src = 'playlist1/music/all/poster/face1.jpg' alt = 'team' />
        <div class = 'inner'>
        <div class = 'info'>
        <h5>Anurag</h5>
        <p>Designer</p>
        <div class = 'social-links'>
        <a href = ''><span class = 'fa fa-facebook'></span></a>
        <a href = ''><span class = 'fa fa-twitter'></span></a>
        <a href = ''><span class = 'fa fa-linkedin'></span></a>
        <a href = ''><span class = 'fa fa-youtube'></span></a>
        </div>
        </div>
        </div>
        </div>
        <div class = 'item'>
        <img src = 'playlist1/music/all/poster/face2.jpg' alt = 'team' />
        <div class = 'inner'>
        <div class = 'info'>
        <h5>Aarchana</h5>
        <p>Designer</p>
        <div class = 'social-links'>
        <a href = ''><span class = 'fa fa-facebook'></span></a>
        <a href = ''><span class = 'fa fa-twitter'></span></a>
        <a href = ''><span class = 'fa fa-linkedin'></span></a>
        <a href = ''><span class = 'fa fa-youtube'></span></a>
        </div>
        </div>
        </div>
        </div>
        <div class = 'item'>
        <img src = 'images/anshul.jpg'alt = 'team' />
        <div class = 'inner'>
        <div class = 'info'>
        <h5>Anshul</h5>
        <p>Designer</p>
        <div class = 'social-links'>
        <a href = ''><span class = 'fa fa-facebook'></span></a>
        <a href = ''><span class = 'fa fa-twitter'></span></a>
        <a href = ''><span class = 'fa fa-linkedin'></span></a>
        <a href = ''><span class = 'fa fa-youtube'></span></a>
        </div>
        </div>
        </div>
        </div>
        <div class = 'item'>
        <img src = 'images/bhoomi.jpg' alt = 'team' />
        <div class = 'inner'>
        <div class = 'info'>
        <h5>Bhoomi</h5>
        <p>Designer</p>
        <div class = 'social-links'>
        <a href = ''><span class = 'fa fa-facebook'></span></a>
        <a href = ''><span class = 'fa fa-twitter'></span></a>
        <a href = ''><span class = 'fa fa-linkedin'></span></a>
        <a href = ''><span class = 'fa fa-youtube'></span></a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script>
            /*account info toggle*/
            $(".account-info").hide();
                    $("#account-infoimg").click(function(){
                        $(".account-info").toggle();
                    });
    </script>
</body>
</html>

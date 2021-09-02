<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- APlayer CSS -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.css"/>
    <!--boxicons-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--lottie flow-->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <title>Uradio | Explore</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&display=swap');
        body{
          
          font-family: 'Roboto', sans-serif;
          background:url('images/extra.jpg') no-repeat center center fixed;
          background-size:cover;
        }
        header{
          width:100%;
          background:#131313;
          position:fixed;
          z-index:100;
          -webkit-box-shadow: 0px 10px 13px 0px rgba(0, 0, 0, 0.9);
          -moz-box-shadow:    0px 10px 13px 0px rgba(0, 0, 0, 0.9);
          box-shadow:         0px 10px 13px 0px rgba(0, 0, 0, 0.9);
        }
        .mainheader{
          display:flex;
          width:100%;
          align-items:center;
          justify-content:space-around;class="main_img"
        }
        .mainheader nav{
          width:500px;
          display:flex;
          justify-content:space-around;
          align-items:center;
          padding-left:5rem;
        }
        .mainheader nav a{
          text-decoration:none;
          text-transform:uppercase;
          color:white;
        }
        .logo,.account{
          cursor:pointer;

        }
        .active{
          border-bottom:.1rem solid white;
          font-weight:bold;
        }
        a:hover{
          border-bottom:.1rem solid white;
          transition:.4s ease;
          font-weight:bold;
        }
        .main_img{
          width: 100%;
          min-height: 250px;
        }
        .main{
          padding: 5rem 0;
           
          background-color:rgba(0,0,0,.7);

        }
        .col-md-3{
          margin-bottom: 15rem;
          height:8rem;
          width:8rem;
        }
        .album-poster{
          position: relative;
          display: block;
          border-radius: 7px;
          overflow: hidden;
          box-shadow: 0 15px 35px #3d2173a1;
          transition: all ease 0.4s;
        }
        .album-poster:hover{
          box-shadow: none;
          transform: scale(0.98) translateY(5px);
        }
        h3{
          font-size: 34px;
          margin-bottom: 34px;
          border-bottom: 4px solid #e6e6e6;
          padding-bottom: 15px;
          color:white;
        }
        p{
          font-size: 15px;
          color:white;
        }
        h4{
          font-size: 16px;
          text-transform: uppercase;
          margin-top: 15px;
          font-weight: 700;
          color:white;
        }
      

      /*default is hide music player*/
      #aplayer{
        position: fixed;
        bottom: -100%;
        left: 0;
        width: 100%;
        margin: 0;
        box-shadow: 0 -2px 2px #dadada;
        background-color: #fff;
        transition: all ease 0.5s;
      }
      #aplayer.showPlayer{
        bottom: 0;
      }

      
      /*MUSIC PLAYER CUSTOMIZING STYLE*/
      span{
        color: #000 !important;
        font-size: 16px;
      }
      .aplayer .aplayer-info .aplayer-controller .aplayer-bar-wrap .aplayer-bar .aplayer-loaded{
        background: #e0e0e0;
          height: 4px;
      }
      .aplayer .aplayer-info .aplayer-controller .aplayer-bar-wrap .aplayer-bar .aplayer-played{
        height: 4px;
        background-color: #2196F3 !important;
      }
      .aplayer .aplayer-info .aplayer-controller .aplayer-bar-wrap .aplayer-bar .aplayer-played .aplayer-thumb{
        background-color: #2196F3 !important;
      }

      .aplayer .aplayer-icon{
        width: 20px;
        height: 20px;
      }
      .aplayer .aplayer-info .aplayer-controller .aplayer-time .aplayer-icon path {
          fill: #000;
      }
      .aplayer .aplayer-info .aplayer-music{
        margin-bottom: 5px;
      }

      /*======================list items generes*/
      .row-genres>.genres{
        display:grid;
        gap:1rem;
        grid-template-columns:repeat(6,1fr);
      }
      .genres-list{
        background-color:#131313;
        padding:1rem;
        border-radius:.5rem;
        color:white;
      }
      .genres-list>a{
        color:white;
        text-decoration:none;
      }
      .row-genres1>.genres1{
        display:grid;
        gap:1rem;
        grid-template-columns:repeat(3,1fr);
        margin:5rem 0;
      }
      .genres-list1{
        background-image: linear-gradient(to right, #348F50,#56B4D3);
        padding:1rem;
        border-radius:.5rem;
        color:white;
        font-weight:bold;
        font-size:1.5rem;
      }
      .genres-list1>a{
        color:white;
        text-decoration:none;
      }
      .genres1>.genres-list1:hover{
        transform: scale(0.98) translateY(5px);
      }
      .center-animation{
        background:rgba(0,0,0,0);
        height:60vh;
      }
      .animation-lottie{
        display:flex;
        justify-content:center;
      }
      /*===================custom scroll bar===============================================*/
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
    <div class="mainheader">
        <div class="logo"><img src="images/youtuberadiologo.png" height="50px" alt="logo"></div>
        <nav>
          <a href="index.php">Home</a>
          <a href="explore.php" class="active">Explore</a>
          <a href="#">Library</a>
          <a href="about.php">About us</a>
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

  <div class="main">
    <div class="container">
      <div class="row-genres1">
        <div class="center-animation">
          <div class="animation-lottie">
            <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_9eLZ98.json" background="transparent"  speed="1" loop  style="width: 400px; height: 200px;z-index:50;" autoplay></lottie-player>
          </div>
          <div class="animation-lottie">
            <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_Rq8jJk.json" background="transparent"  speed="1" loop  style="width: 50px; height: 50px;z-index:50;" autoplay></lottie-player>
          </div>
        </div>
        <div class="genres1">
          <div class="genres-list1"><i class='bx bxs-music' style='color:#ffffff'  ></i><a href="#">&nbsp;New Releases</a></div>
          <div class="genres-list1"><i class='bx bx-line-chart-down' style='color:#ffffff'  ></i><a href="#">&nbsp;Charts</a></div>
          <div class="genres-list1"><i class='bx bxs-smile' style='color:#ffffff' ></i><a href="#">&nbsp;Moods & Genres</a></div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3>New Albums & Singles</h3>
        </div>
        <div class="col-md-3">
          <a href="javascript:void();" class="album-poster" data-switch="0">
            <img class="main_img"src="https://images.pexels.com/photos/1763075/pexels-photo-1763075.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Lorem ipsum</h4>
          <p>lorem ipsum - 2010</p>
        </div>
        <div class="col-md-3">
          <a href="#" class="album-poster" data-switch="1">
            <img class="main_img"src="https://images.pexels.com/photos/1370545/pexels-photo-1370545.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Repellat illo</h4>
          <p>Lorem ipsum dolor sit ame - 2020</p>
        </div>
        <div class="col-md-3">
          <a href="#" class="album-poster" data-switch="2">
            <img class="main_img"src="https://images.pexels.com/photos/838696/pexels-photo-838696.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>adipisicing elit</h4>
          <p>Porro distinctio fuga - 2020</p>
        </div>

        <div class="col-md-3">
          <a href="#" class="album-poster" data-switch="3">
            <img class="main_img"src="https://images.pexels.com/photos/1047442/pexels-photo-1047442.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Atque ab</h4>
          <p>Harum nam unde digniss - 2020</p>
        </div>
        <div class="col-md-3">
          <a href="#" class="album-poster" data-switch="4">
            <img class="main_img"src="https://images.pexels.com/photos/1190298/pexels-photo-1190298.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>praesentium fugiat</h4>
          <p>Lorem ipsum dolor - 2020</p>
        </div>
        <div class="col-md-3">
          <a href="#" class="album-poster" data-switch="5">
            <img class="main_img"src="https://images.pexels.com/photos/210922/pexels-photo-210922.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>veniam expedita</h4>
          <p>Porro distinctio fuga - 2020</p>
        </div>
        <div class="col-md-3">
          <a href="#" class="album-poster" data-switch="6">
            <img class="main_img"src="https://images.pexels.com/photos/1763075/pexels-photo-1763075.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Lorem ipsum</h4>
          <p>Lorem ipsum - 2010</p>
        </div>
        <div class="col-md-3">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/1370545/pexels-photo-1370545.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Repellat illo</h4>
          <p>Lorem ipsum dolor sit ame - 2020</p>
        </div>
        
      </div>
      <div class="row">
        <div class="col-md-12">
          <h3>Trending</h3>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/1699161/pexels-photo-1699161.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Lorem ipsum</h4>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/838702/pexels-photo-838702.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Repellat illo</h4>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/894156/pexels-photo-894156.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>adipisicing elit</h4>
        </div>
        
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/2118046/pexels-photo-2118046.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Atque ab</h4>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/1735240/pexels-photo-1735240.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Fugiat Silly</h4>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/2272854/pexels-photo-2272854.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>veniam expedita</h4>
        </div>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div class="row">
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/1699161/pexels-photo-1699161.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Lorem ipsum</h4>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/838702/pexels-photo-838702.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Repellat illo</h4>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/894156/pexels-photo-894156.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>adipisicing elit</h4>
        </div>
        
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/2118046/pexels-photo-2118046.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Atque ab</h4>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/1735240/pexels-photo-1735240.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>Fugiat Silly</h4>
        </div>
        <div class="col-md-2">
          <a href="#" class="album-poster">
            <img class="main_img"src="https://images.pexels.com/photos/2272854/pexels-photo-2272854.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="">
          </a>
          <h4>veniam expedita</h4>
        </div>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div class="row-genres">
        <div class="col-md-12">
          <h3>Moods & Genres</h3>
        </div>
        <div class="genres">
          <div class="genres-list" style="border-left:.5rem solid #8CA6DB;"><a href="playlist1/listtwo.php">Hindi</a></div>
          <div class="genres-list" style="border-left:.5rem solid #870000;"><a href="playlist1/listtwo.php">Jass</a></div>
          <div class="genres-list" style="border-left:.5rem solid #00d2ff;"><a href="playlist1/listtwo.php">Rock</a></div>
          <div class="genres-list" style="border-left:.5rem solid #D3959B;"><a href="playlist1/listtwo.php">Folk</a></div>
          <div class="genres-list" style="border-left:.5rem solid #f2709c;"><a href="playlist1/listtwo.php">Punjabi</a></div>
          <div class="genres-list" style="border-left:.5rem solid #274046;"><a href="playlist1/listtwo.php">English</a></div>
          <div class="genres-list" style="border-left:.5rem solid #50C9C3;"><a href="playlist1/listtwo.php">Dance&Eectronic</a></div>
          <div class="genres-list" style="border-left:.5rem solid #215f00;"><a href="playlist1/listtwo.php">2000s</a></div>
          <div class="genres-list" style="border-left:.5rem solid #ffc500;"><a href="playlist1/listtwo.php">Pop</a></div>
          <div class="genres-list" style="border-left:.5rem solid #FFB88C;"><a href="playlist1/listtwo.php">!980s</a></div>
          <div class="genres-list" style="border-left:.5rem solid #ff5858;"><a href="playlist1/listtwo.php">Metals</a></div>
          <div class="genres-list" style="border-left:.5rem solid #480048;"><a href="playlist1/listtwo.php">1960s</a></div>
          <div class="genres-list" style="border-left:.5rem solid #1CD8D2;"><a href="playlist1/listtwo.php">Workout</a></div>
          <div class="genres-list" style="border-left:.5rem solid #414345;"><a href="playlist1/listtwo.php">!970s</a></div>
          <div class="genres-list" style="border-left:.5rem solid #71B280;"><a href="playlist1/listtwo.php">Feel Good</a></div>
          <div class="genres-list" style="border-left:.5rem solid #FF8008;"><a href="playlist1/listtwo.php">Devotionals</a></div>
          <div class="genres-list" style="border-left:.5rem solid #8E54E9;"><a href="playlist1/listtwo.php"></a>2010s</div>
          <div class="genres-list" style="border-left:.5rem solid #1D976C;"><a href="playlist1/listtwo.php">Seasonal</a></div>
          <div class="genres-list" style="border-left:.5rem solid #AA076B;"><a href="playlist1/listtwo.php">Chill</a></div>
          <div class="genres-list" style="border-left:.5rem solid #E55D87;"><a href="playlist1/listtwo.php">Focus</a></div>
          <div class="genres-list" style="border-left:.5rem solid #FF512F;"><a href="playlist1/listtwo.php">Energy Booster</a></div>
          <div class="genres-list" style="border-left:.5rem solid #348F50;"><a href="playlist1/listtwo.php">Party</a></div>
          <div class="genres-list" style="border-left:.5rem solid #00CDAC;"><a href="playlist1/listtwo.php">Romance</a></div>
          <div class="genres-list" style="border-left:.5rem solid #b31217;"><a href="playlist1/listtwo.php">Sleep</a></div>
        </div>
      </div>
    </div>
  </div>

	<div id="aplayer"></div>

	<!-- Jquery Link -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<!-- Bootstrap Link -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<!-- APlayer Jquery link -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.js"></script>	

	<script>


		// NOW I CLICK album-poster TO GET CURRENT SONG ID
		$(".album-poster").on('click', function(e){
			var dataSwitchId = $(this).attr('data-switch');
			//console.log(dataSwitchId);

			// and now i use aplayer switch function see
			ap.list.switch(dataSwitchId); //this is static id but i use dynamic 

			// aplayer play function
			// when i click any song to play
			ap.play();

			// click to slideUp player see
			$("#aplayer").addClass('showPlayer');
		});

		const ap = new APlayer({
		    container: document.getElementById('aplayer'),
		    listFolded: true,
		    audio: [
		    {
		        name: 'Invisible Beauty',
		        artist: 'Artist Name',
		        url: 'source/invisible_beauty.mp3',
		        cover: 'https://images.pexels.com/photos/1699161/pexels-photo-1699161.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500'
		    },
			{
		        name: 'Just Stay',  // SONG NAME
		        artist: 'Artist Name', //ARTIST NAME
		        url: 'source/just_stay.mp3', // PATH NAME AND SONG URL
		        cover: 'https://images.pexels.com/photos/838702/pexels-photo-838702.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500' // COVER IMAGE
		    },
			{
				name: 'Liquid Time',
				artist: 'Artist Name',
				url: 'source/liquid_time.mp3',
				cover: 'https://images.pexels.com/photos/838696/pexels-photo-838696.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
			},
			{
				name: 'Silky Smooth',
				artist: 'Artist Name',
				url: 'source/silky_smooth.mp3',
				cover: 'https://images.pexels.com/photos/1370545/pexels-photo-1370545.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
			},


		    ]
		});
    /*account info toggle*/
    $(".account-info").hide();
        $("#account-infoimg").click(function(){
            $(".account-info").toggle();
        });
	</script>

	</body>
</html>
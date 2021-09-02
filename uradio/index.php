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

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- APlayer CSS -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aplayer/1.10.1/APlayer.min.css"/>
    <!--lottie flow-->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <!--animate css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <title>Uradio | Home</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&display=swap');
        body{
          
          font-family: 'Roboto', sans-serif;
          background:url('images/extra.jpg') no-repeat center center fixed;
          background-size:cover; 
        }
        /*==================================loader==================================*/
        #loader { 
            border: 7px solid #f3f3f3; 
            border-radius: 50%; 
            border-top: 7px solid #FF8008; 
            width: 70px; 
            height: 70px; 
            animation: spin 1s linear infinite; 
            z-index:1000;
        } 
          
        @keyframes spin { 
            100% { 
                transform: rotate(360deg); 
            } 
        } 
          
        .loader-center { 
            position: absolute; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            margin: auto; 
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
          justify-content:space-around;
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
      .animationlottie{
        background-color:rgba(0,0,0,0.7);
        z-index:50;
        top:2rem;
        pointer-events:none;
        padding-top:5rem;
        height:100vh;
      }
      .center-animation{
        display:flex;
        justify-content:center;
        pointer-events:none;
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
      .para{
        padding-top:7rem;
      }
      .para>h1{
        color:white;
        font-weight:bold;
      }
      .para>p{
        padding-left:8rem;
        font-weight:bold;
        font-size:1rem;
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
      /*text animation*/
      .line-1{
          position: relative;
          top: 15%;  
          width: 24em;
          margin: 0 auto;
          border-right: 2px solid rgba(255,255,255,.75);
          font-size: 2rem;
          text-align: center;
          white-space: nowrap;
          overflow: hidden;
          transform: translateY(-50%);    
      }

      /* Animation */
      .anim-typewriter{ animation: typewriter 4s steps(44) 1s 1 normal both,
                  blinkTextCursor 500ms steps(44) normal;
      }
      @keyframes typewriter{
        from{width: 0;}
        to{width: 20em;}
      }
      @keyframes blinkTextCursor{
        from{border-right-color: rgba(255,255,255,.75);}
        to{border-right-color: transparent;}
      }
      .paraanime{
        animation: fade 10s;
        animation-iteration-count:10;
      }
      @keyframes fade{
        from{
          opacity:0;
        }
        to{
          opacity:1;
        }
      }

    </style>
 	</head>
	<body>
  <div id="loader" class="loader-center"></div>
  <header>
    <div class="mainheader">
        <div class="logo"><img src="images/youtuberadiologo.png" height="50px" alt="logo"></div>
        <nav>
          <a class="nav_a active"href="index.php">Home</a>
          <a class="nav_a"href="explore.php">Explore</a>
          <a class="nav_a"href="#">Library</a>
          <a class="nav_a"href="about.php">About us</a>
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
  <div class="animationlottie">
    <div class="center-animation">
      <lottie-player src="https://assets8.lottiefiles.com/private_files/lf30_k2RVBb.json" background="transparent"  speed="2.2" loop  style="width: 400px; height: 400px;z-index:50;" autoplay></lottie-player>
      <div class="para">
        <h1 class="line-1 anim-typewriter">Welcome to Uradio A Music Web App.</h1> <br>
        <br>
        <p class="paraanime">Enjoy Free songs and albums with unlimited downloads!</p>
      </div><br>
    </div>
    <div class="center-animation">
      <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_Rq8jJk.json" background="transparent"  speed="1" loop  style="width: 50px; height: 50px;z-index:50;" autoplay></lottie-player>
    </div>
  </div>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>New Releasess</h3>
          </div>
          <div class="col-md-3">
            <a href="javascript:void();" class="album-poster" data-switch="0">
              <img class="main_img"src="playlist1/music/all/poster/doori.jpg" alt="">
            </a>
            <h4>Doori</h4>
            <p>lorem ipsum - 2010</p>
          </div>
          <div class="col-md-3">
            <a href="#" class="album-poster" data-switch="1">
              <img class="main_img"src="playlist1/music/all/poster/gharmorepardesiya.jpg" alt="">
            </a>
            <h4>Ghar More Pardesiyan</h4>
            <p>Lorem ipsum dolor sit ame - 2020</p>
          </div>
          <div class="col-md-3">
            <a href="#" class="album-poster" data-switch="2">
              <img class="main_img"src="playlist1/music/all/poster/khamosiyan.jpg" alt="">
            </a>
            <h4>Khamosiyan</h4>
            <p>Porro distinctio fuga - 2020</p>
          </div>

          <div class="col-md-3">
            <a href="#" class="album-poster" data-switch="3">
              <img class="main_img"src="playlist1/music/all/poster/kr.jpg" alt="">
            </a>
            <h4>Kyu Rabba</h4>
            <p>Harum nam unde digniss - 2020</p>
          </div>
          <div class="col-md-3">
            <a href="#" class="album-poster" data-switch="4">
              <img class="main_img"src="playlist1/music/all/poster/leja.jpg" alt="">
            </a>
            <h4>Leja Re</h4>
            <p>Lorem ipsum dolor - 2020</p>
          </div>
          <div class="col-md-3">
            <a href="#" class="album-poster" data-switch="5">
              <img class="main_img"src="playlist1/music/all/poster/qaafirana.jpg" alt="">
            </a>
            <h4>Qaafirana</h4>
            <p>Porro distinctio fuga - 2020</p>
          </div>
          <div class="col-md-3">
            <a href="#" class="album-poster" data-switch="6">
              <img class="main_img"src="playlist1/music/all/poster/tujhekesepata.jpg" alt="">
            </a>
            <h4>Tujhe Kese Pata Na Chala</h4>
            <p>Lorem ipsum - 2010</p>
          </div>
          <div class="col-md-3">
            <a href="#" class="album-poster">
              <img class="main_img"src="playlist1/music/all/poster/yahabibi.jpg" alt="">
            </a>
            <h4>Ya Habibi</h4>
            <p>Lorem ipsum dolor sit ame - 2020</p>
          </div>
          
        </div>


        <div class="row">
          <div class="col-md-12">
            <h3>coming soon</h3>
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
		        name: 'Doori',
		        artist: 'Ranveer Singh',
		        url: 'playlist1/music/all/doori.mp3',
		        cover: 'playlist1/music/all/poster/doori.jpg'
		    },
			{
		        name: 'Ghar More Pardesiya',  // SONG NAME
		        artist: 'Shreya Ghoshal, Vaishali Mhade...', //ARTIST NAME
		        url: 'playlist1/music/all/Ghar More Pardesiy.mp3', // PATH NAME AND SONG URL
		        cover: 'playlist1/music/all/poster/gharmorepardesiya.jpg' // COVER IMAGE
		    },
			{
				name: 'Khamosiyan',
				artist: 'Arijit Singh',
				url: "playlist1/music/all/Khamoshiyan (From 'Khamoshiyan').mp3",
				cover: 'playlist1/music/all/poster/khamosiyan.jpg',
			},
			{
				name: 'Kyu Rabba',
				artist: 'Aarman Malik',
				url: 'playlist1/music/all/Kyun Rabba.mp3',
				cover: 'playlist1/music/all/poster/kr.jpg',
			},
			{
				name: 'Leja Re',
				artist: 'Dhvani Bhanushali',
				url: 'playlist1/music/all/Leja Re.mp3',
				cover: 'playlist1/music/all/poster/leja.jpg',
			},
			{
				name: 'Qaafirana',
				artist: 'Arijit Singh',
				url: 'playlist1/music/all/Qaafirana.mp3',
				cover: 'playlist1/music/all/poster/qaafirana.jpg',
			},
			{
				name: 'Tujhe Kese pata na Chala',
				artist: 'Artist Name',
				url: 'playlist1/music/all/Tujhe Kaise Pata Na Chala.mp3',
				cover: 'playlist1/music/all/poster/tujhekesepata.jpg',
			},


		    ]
		});

    //==================loading screen==========================================//
    document.onreadystatechange = function() { 
            if (document.readyState !== "complete") { 
                document.querySelector( 
                  "body").style.visibility = "hidden"; 
                document.querySelector( 
                  "#loader").style.visibility = "visible"; 
            } else { 
                document.querySelector( 
                  "#loader").style.display = "none"; 
                document.querySelector( 
                  "body").style.visibility = "visible"; 
            } 
        }; 

        /*account info toggle*/
        $(".account-info").hide();
        $("#account-infoimg").click(function(){
            $(".account-info").toggle();
        });

        /*text animation*/

    
	</script>

	</body>
</html>
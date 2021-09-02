<!DOCTYPE html>
<html lang="en">

<head>
  <title>Simple Music Player</title>
  <!-- Load FontAwesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

  <!-- Load the custom CSS style file -->
  <style>

    body {
      background-color: lightgreen;

      /* Smoothly transition the background color */
      transition: background-color .5s;
      overflow-y: hidden;
    }


    /* Using flex with the column direction to 
    align items in a vertical direction */
    .player {
      height: 95vh;
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;
      background-color: white;
      border-radius: 3rem;
      margin: 0rem 27rem;
      box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2), 0 6px 20px 0px rgba(0, 0, 0, 0.50);
      padding-bottom:1rem;
    }

    .details {
      display: flex;
      align-items: center;
      flex-direction: column;
      justify-content: center;

    }

    img {
      width: 250px;
      height: 250px;
    }

    .track-art {
      margin: 25px;
      height: 180px;
      width: 180px;
      background-image: URL("https://source.unsplash.com/Qrspubmx6kE/640x360");
      background-size: cover;
      background-position: center;
      border-radius: 50%;
      box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2), 0 6px 20px 0px rgba(0, 0, 0, 0.50);
    }
    /* Changing the font sizes to suitable ones */
    .now-playing {
      font-size: 1rem;
      font-weight: bold;
    }

    .track-name {
      font-size: 2rem;
      font-weight: bold;
    }

    .track-artist {
      font-size: 1.5rem;
    }

    /* Using flex with the row direction to 
    align items in a horizontal direction */
    .buttons {
      display: flex;
      flex-direction: row;
      align-items: center;
    }

    .playpause-track,
    .prev-track,
    .next-track {
      padding: 25px;
      opacity: 0.8;

      /* Smoothly transition the opacity */
      transition: opacity .2s;
    }

    /* Change the opacity when mouse is hovered */
    .playpause-track:hover,
    .prev-track:hover,
    .next-track:hover {
      opacity: 1.0;
    }

    /* Define the slider width so that it scales properly */
    .slider_container {
      width: 75%;
      max-width: 400px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Modify the appearance of the slider */
    .seek_slider,
    .volume_slider {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      height: 5px;
      background: black;
      opacity: 0.7;
      -webkit-transition: .2s;
      transition: opacity .2s;
    }

    /* Modify the appearance of the slider thumb */
    .seek_slider::-webkit-slider-thumb,
    .volume_slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      width: 15px;
      height: 15px;
      background: black;
      cursor: pointer;
      border-radius: 50%;
    }

    /* Change the opacity when mouse is hovered */
    .seek_slider:hover,
    .volume_slider:hover {
      opacity: 1.0;
    }

    .seek_slider {
      width: 60%;
    }

    .volume_slider {
      width: 30%;
    }

    .current-time,
    .total-duration {
      padding: 10px;
    }

    i.fa-volume-down,
    i.fa-volume-up {
      padding: 10px;
    }

    /* Change the mouse cursor to a pointer 
    when hovered over */
    i.fa-play-circle,
    i.fa-pause-circle,
    i.fa-step-forward,
    i.fa-step-backward {
      cursor: pointer;
    }

    
  </style>

</head>

<body>
  <div class="player">
    <!-- Define the section for displaying details -->
    <div class="details">
      <div class="now-playing">PLAYING x OF y</div>
      <div  id="rotatediv" class="track-art"></div>
      <div class="track-name">Track Name</div>
      <div class="track-artist">Track Artist</div>
    </div>

    <!-- Define the section for displaying track buttons -->
    <div class="buttons">
      <div class="prev-track" onclick="prevTrack()">
        <i class="fa fa-step-backward fa-2x"></i>
      </div>
      <div id="btnrotate" class="playpause-track" onclick="playpauseTrack()">
        <i class="fa fa-play-circle fa-5x"></i>
      </div>
      <div class="next-track" onclick="nextTrack()">
        <i class="fa fa-step-forward fa-2x"></i>
      </div>
    </div>

    <!-- Define the section for displaying the seek slider-->
    <div class="slider_container">
      <div class="current-time">00:00</div>
      <input type="range" min="1" max="100" value="0" class="seek_slider" onchange="seekTo()">
      <div class="total-duration">00:00</div>
    </div>

    <!-- Define the section for displaying the volume slider-->
    <div class="slider_container">
      <i class="fa fa-volume-down"></i>
      <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">
      <i class="fa fa-volume-up"></i>
    </div>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
  <!-- Load the main script for the player -->
  <script>
    // Select all the elements in the HTML page 
    // and assign them to a variable 
    let now_playing = document.querySelector(".now-playing");
    let track_art = document.querySelector(".track-art");
    let track_name = document.querySelector(".track-name");
    let track_artist = document.querySelector(".track-artist");

    let playpause_btn = document.querySelector(".playpause-track");
    let next_btn = document.querySelector(".next-track");
    let prev_btn = document.querySelector(".prev-track");

    let seek_slider = document.querySelector(".seek_slider");
    let volume_slider = document.querySelector(".volume_slider");
    let curr_time = document.querySelector(".current-time");
    let total_duration = document.querySelector(".total-duration");

    // Specify globally used values 
    let track_index = 0;
    let isPlaying = false;
    let updateTimer;

    // Create the audio element for the player 
    let curr_track = document.createElement('audio');

    // Define the list of tracks that have to be played 
    let track_list = [
      {
        name: "Doori",
        artist: "Broke For Free",
        image: "music/all/poster/doori.jpg",
        path: "music/all/Doori.mp3"
      },
      {
        name: "Ghar More Pardesiya",
        artist: "Tours",
        image: "music/all/poster/gharmorepardesiya.jpg",
        path: "music/all/Ghar More Pardesiy.mp3"
      },
      {
        name: "Khamoshiyan",
        artist: "Chad Crouch",
        image: "music/all/poster/khamosiyan.jpg",
        path: "music/all/Khamoshiyan (From 'Khamoshiyan').mp3",
      },
      {
        name: "Kyun Rabba",
        artist: "Broke For Free",
        image: "music/all/poster/kr.jpg",
        path: "music/all/Kyun Rabba.mp3"
      },
      {
        name: "Leja Re",
        artist: "Tours",
        image: "music/all/poster/leja.jpg",
        path: "music/all/Leja Re.mp3"
      },
      {
        name: "Qaafirana",
        artist: "Chad Crouch",
        image: "music/all/poster/qaafirana.jpg",
        path: "music/all/Qaafirana.mp3",
      },
      {
        name: "Tujhe kese pata na chala",
        artist: "Chad Crouch",
        image: "music/all/poster/tujhekesepata.jpg",
        path: "music/all/Tujhe Kaise Pata Na Chala.mp3",
      },
    ];

    //step 2: loading tracks
    //loading tracks
    function loadTrack(track_index) {
      // Clear the previous seek timer 
      clearInterval(updateTimer);
      resetValues();

      // Load a new track 
      curr_track.src = track_list[track_index].path;
      curr_track.load();

      // Update details of the track 
      track_art.style.backgroundImage =
        "url(" + track_list[track_index].image + ")";
      track_name.textContent = track_list[track_index].name;
      track_artist.textContent = track_list[track_index].artist;
      now_playing.textContent =
        "PLAYING " + (track_index + 1) + " OF " + track_list.length;

      // Set an interval of 1000 milliseconds 
      // for updating the seek slider 
      updateTimer = setInterval(seekUpdate, 1000);

      // Move to the next track if the current finishes playing 
      // using the 'ended' event 
      curr_track.addEventListener("ended", nextTrack);

      // Apply a random background color 
      random_bg_color();
    }

    function random_bg_color() {
      // Get a random number between 64 to 256 
      // (for getting lighter colors) 
      let red = Math.floor(Math.random() * 256) + 64;
      let green = Math.floor(Math.random() * 256) + 64;
      let blue = Math.floor(Math.random() * 256) + 64;
      let red1 = Math.floor(Math.random() * 256) + 70;
      let green1 = Math.floor(Math.random() * 256) + 70;
      let blue1 = Math.floor(Math.random() * 256) + 70;

      // Construct a color withe the given values 
      let bgColor = "linear-gradient(180deg,rgb(" + red + ", " + green + ", " + blue + "),rgb(" + red1 + ", " + green1 + ", " + blue1 + "))";

      // Set the background to the new color 
      document.body.style.background = bgColor;
      setTimeout(random_bg_color,3000);
    }

    // Functiom to reset all values to their default 
    function resetValues() {
      curr_time.textContent = "00:00";
      total_duration.textContent = "00:00";
      seek_slider.value = 0;
    }


    //steps 3 confugiration the player buttons
    function playpauseTrack() {
      // Switch between playing and pausing 
      // depending on the current state 
      if (!isPlaying) playTrack();
      else pauseTrack();
    }

    function playTrack() {
      // Play the loaded track 
      curr_track.play();
      isPlaying = true;
      // Replace icon with the pause icon 
      playpause_btn.innerHTML = '<i class="fa fa-pause-circle fa-5x"></i>';
    }

    function pauseTrack() {
      // Pause the loaded track 
      curr_track.pause();
      isPlaying = false;

      // Replace icon with the play icon 
      playpause_btn.innerHTML = '<i class="fa fa-play-circle fa-5x"></i>';;
    }

    function nextTrack() {
      // Go back to the first track if the 
      // current one is the last in the track list 
      if (track_index < track_list.length - 1)
        track_index += 1;
      else track_index = 0;

      // Load and play the new track 
      loadTrack(track_index);
      playTrack();
    }

    function prevTrack() {
      // Go back to the last track if the 
      // current one is the first in the track list 
      if (track_index > 0)
        track_index -= 1;
      else track_index = track_list.length;

      // Load and play the new track 
      loadTrack(track_index);
      playTrack();
    }

    //step to confugiration of slider portion
    //seek slider
    function seekTo() {
      // Calculate the seek position by the 
      // percentage of the seek slider 
      // and get the relative duration to the track 
      seekto = curr_track.duration * (seek_slider.value / 100);

      // Set the current track position to the calculated seek position 
      curr_track.currentTime = seekto;
    }

    function setVolume() {
      // Set the volume according to the 
      // percentage of the volume slider set 
      curr_track.volume = volume_slider.value / 100;
    }

    function seekUpdate() {
      let seekPosition = 0;

      // Check if the current track duration is a legible number 
      if (!isNaN(curr_track.duration)) {
        seekPosition = curr_track.currentTime * (100 / curr_track.duration);
        seek_slider.value = seekPosition;

        // Calculate the time left and the total duration 
        let currentMinutes = Math.floor(curr_track.currentTime / 60);
        let currentSeconds = Math.floor(curr_track.currentTime - currentMinutes * 60);
        let durationMinutes = Math.floor(curr_track.duration / 60);
        let durationSeconds = Math.floor(curr_track.duration - durationMinutes * 60);

        // Add a zero to the single digit time values 
        if (currentSeconds < 10) { currentSeconds = "0" + currentSeconds; }
        if (durationSeconds < 10) { durationSeconds = "0" + durationSeconds; }
        if (currentMinutes < 10) { currentMinutes = "0" + currentMinutes; }
        if (durationMinutes < 10) { durationMinutes = "0" + durationMinutes; }

        // Display the updated duration 
        curr_time.textContent = currentMinutes + ":" + currentSeconds;
        total_duration.textContent = durationMinutes + ":" + durationSeconds;
      }
    }
    //step 5:start the player//
    // Load the first track in the tracklist 
    loadTrack(track_index);

  </script>
</body>

</html>
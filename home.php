<?php
    session_start();
    
    if(isset($_SESSION['timeout'])) { // jika timeout telah di set

    	$timeout = 1800; // 
        
        $duration = time() - (int)$_SESSION['timeout']; //set durasi dari selisih waktu sekarang dan waktu timeout berjalan 

        if($duration > $timeout) { // apakah durasi lebih dari 1800 detik
            
            session_start(); // bersihkan session
            session_unset();
            session_destroy();
        }
    }

    //set durasi dari waktu sekarang
    $_SESSION['timeout'] = time();


	if(isset($_SESSION['user'])){ // cek jika tidak ada session user dari login
	}
	else {
		header('Location: login.php');
	}

	if(isset($_SESSION['pic'])) $profpic = $_SESSION['pic']; 
		else $profpic = "media/default_profile.jpg";
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $_SESSION['namalengkap']; ?> - News Feed</title>
		<meta charset="UTF-8">
		<meta name="description" content="SahabatSosial home page">
		<meta name="keywords" content="HTML,CSS,social, media">
		<meta name="author" content="Aldi Burhanhamali">
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>


		<link rel="shortcut icon" href="media/logo-orange.png"> <!--membuat icon -->
		<link rel="stylesheet" href="css/style.css" >
		<link rel="alternate stylesheet" href="css/style-black.css" title="playblack">
		<link rel="alternate stylesheet" href="css/style-blue.css" title="exoblue">
		<link rel="alternate stylesheet" href="css/style-green.css" title="ptserifgreen">
		<link rel="alternate stylesheet" href="css/style-red.css" title="ubuntured">

	</head>
	<body id="scrollbody" class="container homepage" onload="getFullname('home') ; countdown(1800)">
		
		<div class="header" id="header">
			
	   	   	<img src="media/logo.png" alt="Logo" width="75" >
	   	   	<p class="absolutepos" style="font-size: 300% ; color: white ; " > Sahabat Sosial </p>	
	   	</div>

		<div class="headermain" id="headermain">
			
	   	   	<img src="media/logo.png" alt="Logo" width="55" >
	   	   	<p id="greet" class="absolutepos" style="font-size: 200% ; color: white ; " > Sahabat Sosial </p>
   	   	   	
		</div>

		<div class="content relativepos">
			<nav class="menubar" id="menubar">
				
					<a href="home.php" class="menulink">Home</a>
				
					<a href="profile.php" class="menulink">Profile</a>
				
				
					<a href="friend.php" class="menulink">Friends</a>
				
				
					<a href="#0" class="menulink">Notifications</a>

					<a href="messages.php" class="menulink">Messages</a>
				
				
					<a href="logout.php" class="logoutlink" onclick="logOut()" >Log Out</a>
				
			</nav>
			<div class="homeprofpic borderlight absolutepos">
				<div style="width: 70px; height: 70px; overflow: hidden; margin: 6px;">
					<img src="<?php echo $profpic; ?>" alt="profile pic" />
				</div>
				
				<p class="absolutepos fullnames"><?php echo $_SESSION['namalengkap']; ?><p>
			</div>

			<nav class="sidenav borderlight">
				<ul>
					<li><a href="http://facebook.com" class="linkto">facebook</a></li>
					<li><a href="http://twitter.com" class="linkto">twitter</a></li>
					<li><a href="http://plus.google.com" class="linkto">google plus</a></li>
				</ul>

				<label id="session" >Session time : </label>  <!-- fungsi menampilkan timeout session di buat pada resize.js-->

			<!--untuk memilih tema-->
				<div class="theme font14">
					<br>
					<b>Theme :</b>
					<br>
					<i>Font-Color</i>
					<br>
					<ul> 
						<li><a href="#" class="linkto" id="default" onclick="setActiveStyleSheet('default'); return false;">Default</a></li>
						<li><a href="#" class="linkto" id="black" onclick="setActiveStyleSheet('playblack');return false">Play-Black</a></li>
						<li><a href="#" class="linkto" id="blue" onclick="setActiveStyleSheet('exoblue');return false">Exo-Blue</a></li>
						<li><a href="#" class="linkto" id="green" onclick="setActiveStyleSheet('ptserifgreen');return false">PT Serif-Green</a></li>
						<li><a href="#" class="linkto" id="red" onclick="setActiveStyleSheet('ubuntured');return false">Ubuntu-Red</a></li>
					</ul>
				</div>
			</nav>

			<div class="newsfeed font14 borderlight relativepos">
				<div class="createpost relativepos">
					<b>Post Something Interesting!</b>
					<form method="post">
						<textarea class="absolutepos" placeholder="Post Here!"></textarea>
						<input type="button" value="Post" id="postbtn" class="postbtn absolutepos" onclick="submitPost()" />
					</form>
				</div>

				<div class="timeline">
					
				</div>
				<!--<button class="post relativepos loadmore" style="font-family: Lato; min-height: 30px; max-width: 170px ;color: #505050; padding: 10px" onclick="loadMorePost()">Load More Post</button>-->
			</div>
			<div class="push"></div>
		</div>

		<footer class="footermain relativepos" >
			<div class="footerinfo">
				
				<div class="leftfoot">
					date
				</div>
				<div class="rightfoot">
					 <div class="contact">
					 	<img src="media/conicon.png" alt="contact">
					 	<p>+62 838 1234 5678</p>
					 </div>
					 <div class="mail">
					 	<img src="media/mailicon.png" alt="email">
					 	<p>contact@sahabatsosial.id</p>
					 </div>
				</div>
			</div>

			<div class="bottomfoot">
   	   	   		<div style="text-align: center;">
   	   	   	    	@2016 Sahabat Sosial. All Rights Reserved.
   	   	   		</div>
   	   		</div>
		</footer> 
		<script src="js/resize.js"></script>
		<script src="js/tugas2.js"></script>
		<script src="js/tugas3.js"></script>
	</body>
</html>
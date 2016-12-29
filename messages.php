<?php
	session_start();
	
    if(isset($_SESSION['timeout'])) { // jika timeout telah di set
        
        $duration = time() - (int)$_SESSION['timeout']; //set durasi dari selisih waktu sekarang dan waktu timeout berjalan 

        if($duration > 1800) { // apakah durasi lebih dari 1800 detik
            
            session_start(); // bersihkan session
            session_unset();
            session_destroy();
        }
    }
     
    //set durasi dari waktu sekarang
    $_SESSION['timeout'] = time();

	if(isset($_SESSION['user'])){
		
	}
	else {
		header('Location: login.php');
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $_SESSION['namalengkap']; ?>- Direct Messages</title>
		<meta charset="UTF-8">
		<meta name="description" content="SahabatSosial message page">
		<meta name="keywords" content="HTML,CSS,social, media">
		<meta name="author" content="Aldi Burhanhamali">
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

		<link rel="shortcut icon" href="media/logo-orange.png"> <!--membuat icon -->
		<link rel="stylesheet" href="css/style.css" title="default">
		<link rel="alternate stylesheet" href="css/style-black.css" title="play-black">
		<link rel="alternate stylesheet" href="css/style-blue.css" title="exo-blue">
		<link rel="alternate stylesheet" href="css/style-green.css" title="ptserif-green">
		<link rel="alternate stylesheet" href="css/style-red.css" title="ubuntu-red">

	</head>
	<body class="container homepage" onload="getFullname()">

		<div class="header">
			
	   	   	<img src="media/logo.png" alt="Logo" width="75" >
	   	   	<p class="absolutepos" style="font-size: 300% ; color: white ; " > Sahabat Sosial </p>	
	   	</div>

		<div class="headermain">
			
	   	   	<img src="media/logo.png" alt="Logo" width="55" >
	   	   	<p id="greet" class="absolutepos" style="font-size: 200% ; color: white ; " > Sahabat Sosial </p>
   	   	   	
		</div>

		<div class="content relativepos">
			<nav class="menubar">
				
					<a href="home.php" class="menulink">Home</a>
				
					<a href="profile.php" class="menulink">Profile</a>
				
				
					<a href="friend.php" class="menulink">Friends</a>
				
				
					<a href="#0" class="menulink">Notifications</a>

					<a href="messages.php" class="menulink">Messages</a>
				
				
					<a href="logout.php" class="logoutlink" onclick="logOut()" >Log Out</a>
				
			</nav>
			
			<div class="messagebody font14">
				<div class="messagelist borderlight relativepos">
					<div class="sender borderlight" id="teman1">
					<div class="thumbnaildiv">
						<img class="thumbsender" src="media/default_profile.jpg" alt="profile pic" /></div>
						<h4 class="sendername">
							Teman Pengguna 1
						</h4>
					</div>
					<div class="sender borderlight" id="teman2">
					<div class="thumbnaildiv">
						<img class="thumbsender" src="media/default_profile.jpg" alt="profile pic" /></div>
						<h4 class="sendername">
							Teman Pengguna 2
						</h4>
					</div>
					<div class="sender borderlight" id="teman3">
					<div class="thumbnaildiv">
						<img class="thumbsender" src="media/default_profile.jpg" alt="profile pic" /></div>
						<h4 class="sendername">
							Teman Pengguna 3
						</h4>
					</div>
					
				</div>
				<div class="messagethread absolutepos">
					<div class="postmessage">
					<form>
						<textarea class="absolutepos" placeholder="Write Here!"></textarea>
						<input type="button" value="Send" class="sendbtn " />
					</form>
					</div>

					<div class="messages">
						<div class="message leftpos">
							<p>hi!</p>
						</div>

						<div class="message rightpos">
							<p>hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! </p>
						</div>

						<div class="message leftpos">
							<p>hi!</p>
						</div>

						<div class="message rightpos">
							<p>hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! </p>
						</div>

						<div class="message leftpos">
							<p>hi!</p>
						</div>

						<div class="message rightpos">
							<p>hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! </p>
						</div>

						<div class="message leftpos">
							<p>hi!</p>
						</div>

						<div class="message rightpos">
							<p>hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! </p>
						</div>

						<div class="message leftpos">
							<p>hi!</p>
						</div>

						<div class="message rightpos">
							<p>hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! </p>
						</div>

						<div class="message leftpos">
							<p>hi!</p>
						</div>

						<div class="message rightpos">
							<p>hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! hello! </p>
						</div>
					</div>

				</div>
				<div class="messagethread absolutepos">
					<div class="postmessage">
					<form>
						<textarea class="absolutepos" placeholder="Write Here!"></textarea>
						<input type="button" value="Send" class="sendbtn " />
					</form>
					</div>

					<div class="messages">
						<div class="message leftpos">
							<p>hi!</p>
						</div>
						
						<div class="message rightpos">
							<p>hello! </p>
						</div>
					</div>
					
				</div>

				<div class="messagethread absolutepos">
					<div class="postmessage">
					<form>
						<textarea class="absolutepos" placeholder="Write Here!"></textarea>
						<input type="button" value="Send" class="sendbtn " />
					</form>
					</div>
					<div class="messages">
						<div class="message leftpos">
							<p>test!</p>
						</div>
						
						<div class="message rightpos">
							<p>hmm.. </p>
						</div>
					</div>

				</div>

			</div>
			
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
	</body>
</html>
<?php
	session_start();
	if(isset($_SESSION["user"])){
		header('Location: home.php');
	}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Sahabat Sosial</title>
		<meta charset="UTF-8">
		<meta name="description" content="SahabatSosial login page">
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
	<body class="container loginpage" onload="">
		<div class="header">
			
	   	   	<img src="media/logo.png" alt="Logo" width="75" >
	   	   	<p class="absolutepos" style="font-size: 300% ; color: white ; " > Sahabat Sosial </p>	
	   	</div>

		<div class="content relativepos">
				<div class="loginform relativepos">
					<br>
					<h1>Want to Connect?</h1>
					<br>
					<h2>Login</h2>

					<!--membuat form login-->
					<form name="login" id="login" method="post" onsubmit="return false"> 
						<input type="text" name="username" placeholder="username" required /><br/>
						<input type="password" name="password" placeholder="password" required /> <!--menyembunyikan text tipe password-->
						
						<input type="checkbox" name="remember" value=true /><label style="color: white"> Remember Me?</label><br>
						<br>
						<input type="submit" class="login" value="log in" onclick="checkConnection()"/>
						<a href="register.php" class="signup" onclick="">sign up</a>
					</form>
					<br>
					<p id="notvalid"></p>
				</div>
				<div class="push"></div>
		</div>

		<!--membuat dan memngisi footer -->
		<div class="footer relativepos" >
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
					 	<img src="media/mailicon.png" alt="mail">
					 	<p>contact@sahabatsosial.id</p>
					 </div>
				</div>
			</div>

			<div class="bottomfoot">
   	   	   		<div style="text-align: center;">
   	   	   	    	@2016 Sahabat Sosial. All Rights Reserved.
   	   	   		</div>
   	   		</div>
		</div>
		<script src="js/resize.js"></script>
		<script src="js/tugas2.js"></script>
		<script src="js/tugas3.js"></script>
	</body>
</html>
<?php
	session_start();
	
	include('php/connect.php');

	global $connect;

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

	$_SESSION["follow"] = $_SESSION['view'] = $style = "";

	$id = $_SESSION['id'];
	$usr = $_SESSION['user'];
	if(isset($_GET['usr'])){
		if(!($_GET['usr'] == $_SESSION['user'])){ 
			$usr = $_GET['usr'];

			$_SESSION['view'] = $usr;

			$style = ' style = "display:none"';
		}
		else $_GET['usr'] =""; // jika get user sama dengan session user
	}

	$konten = kontenProfile($connect,$id, $usr,1);

	$followed = kontenProfile($connect,$id, $usr,0);

	if($row = $konten->fetch_assoc()){
		$fullname = $row["fullname"];

		if(isset($row["job"])) $job = '<td>Job</td><td>'.$row["job"].'</td>';

		if(isset($row["education"])) $edu = '<td>Education</td><td>'.$row["education"].'</td>';

		$born = '<td>Birthday</td><td>'.$row["birthday"].'</td>';

		$gender = '<td>Gender</td><td>'.$row["sex"].'</td>';

		if(isset($row["city"])) $kota = '<td>City</td><td>'.$row["city"].'</td>';

		if(isset($row["country"])) $country = '<td>Country</td><td>'.$row["country"].'</td>';

		if(isset($row["company"])) $company = '<li><b>Company</b> &nbsp; '.$row["company"].'</li>';

		if(isset($row["phone"])) $phone = '<li><b>Phone</b> &nbsp; '.$row["phone"].'</li>';

		$email = '<li><b>e-mail</b> &nbsp; '.$row["email"].'</li>';

		if(isset($row["hobby"])) $hobby = '<li><b>Hobby</b> &nbsp; '.$row["hobby"].'</li>';

		if(isset($row["profpict"])) $profpic = $row["profpict"]; 
		else $profpic = "media/default_profile.jpg";

		if(isset($row["about"])) $about = $row["about"];

	}

	if($usr == $_SESSION['user']){

		$link = "php/editprofile.php";
		$value = "Edit Profile";
		$click = " ";
		//echo $_SESSION["follow"];
	}
	else if($followed === 0){
		$link = "#0";
		$value = "Follow";
		$click = "follow($id,'".$_GET['usr']."','follow')";

	}
	else if($followed == 1){
		$link = "#0";
		$value = "Unfollow";
		$click = "follow($id,'".$_GET['usr']."','unfollow')";
		
	}


?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $fullname; ?> - Your Amazing Profile</title>
		<meta charset="UTF-8">
		<meta name="description" content="SahabatSosial profile page">
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
	<body id="scrollbody" class="container profilepage" onload="getFullname('profile'); countdown(1800);">
		
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

			<nav class="sidenav borderlight">
				<ul>
					<li><a href="http://facebook.com" class="linkto">facebook</a></li>
					<li><a href="http://twitter.com" class="linkto">twitter</a></li>
					<li><a href="http://plus.google.com" class="linkto">google plus</a></li>
				</ul>

				<label id="session" >Session time : </label> <!-- fungsi menampilkan timeout session di buat pada resize.js-->

				<div class="theme font14">
					<br>
					<b>Theme :</b>
					<br>
					<i>Font-Color</i>
					<br>
					<ul> <!--memanggil fungsi mengganti tema-->
						<li><a href="#" class="linkto" id="default" onclick="setActiveStyleSheet('default'); return false;">Default</a></li>
						<li><a href="#" class="linkto" id="black" onclick="setActiveStyleSheet('playblack');return false">Play-Black</a></li>
						<li><a href="#" class="linkto" id="blue" onclick="setActiveStyleSheet('exoblue');return false">Exo-Blue</a></li>
						<li><a href="#" class="linkto" id="green" onclick="setActiveStyleSheet('ptserifgreen');return false">PT Serif-Green</a></li>
						<li><a href="#" class="linkto" id="red" onclick="setActiveStyleSheet('ubuntured');return false">Ubuntu-Red</a></li>
					</ul>
				</div>
			</nav>

			<div class="newsfeed font14 borderlight relativepos">

				<!--mengisi profile-->
				<div class="outsidebox borderlight relativepos">
					<div class="insidebox font14 borderlight">
						<div class="absolutepos" style="width: 250px; height: 250px; overflow: hidden; margin: 25px">
							<img class="" src="<?php echo $profpic; ?>" alt="Profile Photos"/>
						</div>

						<h1 class="absolutepos" ><?php 

						if(isset($fullname)){
							echo $fullname;
						}

						?></h1>

						<table class="tabprofile absolutepos"> <!-- membuat table untuk profil-->
							<tr>
								<?php echo $gender; ?>
							</tr>
							<tr>
								<?php

									if(isset($job)){
										echo $job;
									}

								?>
							</tr>
							<tr>
								<?php

									if(isset($edu)){
										echo $edu;
									}

								?>
							</tr>
							<tr>
								<?php echo $born; ?>
							</tr>
							<tr>
								<?php

									if(isset($kota)){
										echo $kota;
									}

								?>
							</tr>
							<tr>
								<?php

									if(isset($country)){
										echo $country;
									}

								?>
							</tr>
						</table>
						<ul class="profcontact absolutepos">
						 	<?php

								if(isset($company)){
									echo $company;
								}

							?>

						    <li><b>Contact :</b>
							    <ul >
							    	<?php

										if(isset($phone)){
											echo $phone;
										}

										echo $email;

									?>
							    </ul>
						    </li>
						    <?php

								if(isset($hobby)){
									echo $hobby;
								}

							?>
						</ul> 
					</div>
					<a href="<?php echo $link ?>" class="edit absolutepos" onclick="<?php echo $click ?>"><?php echo $value ?></a>
					
					<?php 
						if(isset($about)) echo '<a href="#0" class="aboutshw absolutepos">About me...</a>';
					?> 
					
				</div>

				<div class="aboutprofile relativepos">
					<p>	
						<?php 
							echo $about;
						?> 
					</p>
				</div>

				<div class="createpost relativepos" <?php echo $style; ?>>
					<b>Post Something Interesting!</b>
					<form method="post">
						<textarea class="absolutepos" placeholder="Post Here!"></textarea>
						<input type="button" value="Post" id="postbtn" class="postbtn absolutepos" onclick="submitPost()" />
					</form>
				</div>
				<div class="timeline relativepos">
					
				</div>
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
		</div>
		<script src="js/resize.js"></script>
		<script src="js/tugas2.js"></script>
		<script src="js/tugas3.js"></script>
	</body>
</html>
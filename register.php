<?php

	include("php/connect.php");

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

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

		<link rel="shortcut icon" href="media/logo-orange.png"> <!--membuat icon -->
		<link rel="stylesheet" href="css/style.css" title="default">
		<link rel="alternate stylesheet" href="css/style-black.css" title="play-black">
		<link rel="alternate stylesheet" href="css/style-blue.css" title="exo-blue">
		<link rel="alternate stylesheet" href="css/style-green.css" title="ptserif-green">
		<link rel="alternate stylesheet" href="css/style-red.css" title="ubuntu-red">
		<script>
            $(function() {
                $(".datepicker").datepicker({
                // Consistent format with the HTML5 picker
                    dateFormat : 'yy-mm-dd',
                    autoSize: true
                    });
            });
        </script>
		

	</head>
	<body class="container loginpage" onload="">
		<div class="header">
			
	   	   	<img src="media/logo.png" alt="Logo" width="75" >
	   	   	<p class="absolutepos" style="font-size: 300% ; color: white ; " > Sahabat Sosial </p>	
	   	</div>

		<div class="content relativepos">
			<div class="newsfeed font14 relativepos">
				<div class="relativepos" style="left: 50%; transform: translate(-50%,8%); background-color: #d9d9d9; width : 600px; min-height: 350px; padding: 20px 35px 20px 20px;">
					<form method="post" action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> id="regform">
						<b>Username : </b> <label class="red regusername"></label>
						<input type="text" name="newusername" placeholder="Username (Max 25 Character)" class="relativepos inputedit newusername" value="" required /><br><br>
						<b>Email : </b> <label class="red regmail"></label>
						<input type="email" name="newmail" placeholder="Emali" class="relativepos inputedit newmail" value="" required/><br><br>
						<b>Password : </b> <label class="red alertpass"></label>
						<input type="password" name="newpass" placeholder="Password (6 - 35 Character)" class="relativepos inputedit regpassword" value="" required/><br><br>
						<b>Nama : </b> <label class="red"></label>
						<input type="text" name="namalengkap" placeholder="Full Name (Max 25 Character)" class="relativepos inputedit namalengkap" value="" required/><br><br>
						<b>Birthday : </b> <label class="red"></label>
						<input type="text" name="tanggallahir" placeholder="0000-00-00 (year-month-day)" class="relativepos inputedit datepicker" value="" required /><br><br>
						<b>Gender : </b> <label class="red"></label><br>
						&nbsp &nbsp<input type="radio" name="gender" value="male" checked> Male<br>
  						&nbsp &nbsp<input type="radio" name="gender" value="female"> Female<br><br><br>


  						<input type="submit" value="Register" class="postbtn absolutepos registerbtn" onclick="" />

					</form>

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


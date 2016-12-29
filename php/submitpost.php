<?php
	
	include("connect.php");
	global $connect;
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//$namaL = $_SESSION['namalengkap'];
		$konten = $_POST['kontenPost'];

		if(!$connect){
			echo "Cannot connect to Data Base!";
			die("Connection failed: " . mysqli_connect_error());
		}

		// insert data ke database
		mysqli_query($connect,"INSERT INTO post (id, content) VALUES ('".$_SESSION['id']."' ,'".$konten."');");

		// ambil postid terbaru dari (yang paling tinggi id nya)
		$qresult = mysqli_query($connect,"SELECT MAX(postid) FROM post");

		// kembalikan ke javascript function submitPost() pada tugas3.js
		if($row = $qresult->fetch_assoc()){ 
			echo $row['MAX(postid)']; //dijadikan sebagai id pada html dalam fungsi posting() pada resize.js
		}
	}

?>
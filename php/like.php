<?php

	include("connect.php");
	global $connect;
	
	// menyimpan like pada database
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$lKonten = $_POST['likes']; // ambil id dari konten yang di like

		mysqli_query($connect,"UPDATE post SET liked = (liked +1) WHERE postid = '".$lKonten."'"); // update database liked + 1

		$queryresult = mysqli_query($connect,"SELECT liked FROM post WHERE postid = '".$lKonten."'"); // ambil data yang dilike

		if($row = $queryresult->fetch_assoc()){
			echo $row['liked']; // kirimkan ke database
		}

		// hal yang hampir sama di lakukan pada post dislike
	}

?>
<?php
	include("connect.php");
	global $connect;
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$lKonten = $_POST['dislikes']; // ambil id dari konten yang di like
		
		mysqli_query($connect,"UPDATE post SET disliked = (disliked +1) WHERE postid = '".$lKonten."'");
		$queryresult = mysqli_query($connect,"SELECT disliked FROM post WHERE postid = '".$lKonten."'");

		if($row = $queryresult->fetch_assoc()){
			echo $row['disliked'];
		}

	}

?>
<?php
	
	include("connect.php");
	global $connect;
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$id = $_POST['id'];
		$type = $_POST['type'];

		if($type == "following"){
			$select = "SELECT profile.fullname, profile.profpict, user.username FROM profile LEFT JOIN user ON profile.id = user.id RIGHT JOIN friend ON profile.id = friend.id_following WHERE friend.id_followers = '".$id."'";
		}
		elseif ($type == "follower") {
			$select = "SELECT profile.fullname, profile.profpict, user.username FROM profile LEFT JOIN user ON profile.id = user.id RIGHT JOIN friend ON profile.id = friend.id_followers WHERE friend.id_following = '".$id."'";
		}
		elseif ($type == "all") {
			$select = "SELECT profile.fullname, profile.profpict, user.username FROM profile LEFT JOIN user ON profile.id = user.id";
		}

		
		$res = mysqli_query($connect,$select);

		while ($row=$res->fetch_assoc()) {
			if(isset($row['profpict'])) $profpict = $row['profpict'];
			else $profpict = 'media/default_profile.jpg';

			$user = $row['username'];

			$fullname = $row['fullname'];

			echo '<div class ="usershow relativepos" >';
			echo 	'<div class="thumbnaildiv" >';
			echo 	'<img class="thumbpic" src="'.$profpict.'" alt="profile pic"/></div>';
			echo	' <h4 class ="fullnames"><a href="profile.php?usr='.$user.'">  '.$fullname.'</a></h4><text style="color:#909090;font-size:12px;margin-left:10px"> ';
			echo '</div>';

		}
	}

?>
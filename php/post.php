<?php

	include("connect.php");
	global $connect;

	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST"){ 

		$id = $_SESSION['id'];

		if(isset($_SESSION['view'])){

			if(!$_SESSION['view'] == ""){

				$selectid = "SELECT id FROM user WHERE username = '".$_SESSION['view']."'";
				
				$resultid = mysqli_query($connect,$selectid);

				$id = mysqli_fetch_object($resultid)->id;

			}
		}

		$page = $_POST['page']; // ambil page

		$like = " like"; 
		$dislike = " dislike";

		// jika menampilkan dari profile
		if($page == "profile"){

			// ambil data post yang hanya di buat oleh id tersebut
			$postresult = mysqli_query($connect,'SELECT post.*, profile.fullname, profile.profpict, user.username FROM post post LEFT JOIN profile ON post.id = profile.id LEFT JOIN user ON post.id = user.id WHERE user.id = "'.$id.'" ORDER BY dateposted DESC'); // semua diurutkan dari tanggal terbaru

		} else {

			// ambil semua data post
			$postresult = mysqli_query($connect,'SELECT post.*, profile.fullname, profile.profpict, user.username FROM post LEFT JOIN profile ON post.id = profile.id LEFT JOIN user ON post.id = user.id RIGHT JOIN friend ON post.id = friend.id_following WHERE id_followers = "'.$id.'" OR user.id = "'.$id.'" ORDER BY post.dateposted DESC');
		}

		// buat loop untuk menampilkan semua post
		while($row = $postresult->fetch_assoc()){

			if($row['liked']==0) $row['liked']="" ;
			if($row['disliked']==0) $row['disliked'] = "";

			$i=$row['postid'];

			$user = $row['username'];

			$fullname = $row['fullname'];

			if(isset($row['profpict'])) $profpict = $row['profpict'];
			else $profpict = 'media/default_profile.jpg';
			
			//kirimkan ke ajax
			echo '<div class="post relativepos textpost"><script>showHide('.$i.')</script>';
			echo '<div class="thumbnaildiv" >';
			echo 	'<img class="thumbpic" src="'.$profpict.'" alt="profile pic"/></div>';
			echo	'<h4 class ="fullnames"><a href="profile.php?usr='.$user.'">'.$fullname.'</a></h4><text style="color:#909090;font-size:12px;margin-left:10px"> ';
			echo 	$row['dateposted'] .'</text><br>'; // memanggil tanggal
			echo 	'<p id="post'.$i.'">'. $row['content'] .'</p>';
			echo	'<div class="interact">';
			echo		'<a href="#0" class="like" id="l'. $i .'" onclick="like('.$i.')"> '.$row['liked'].''. $like .' </a>';
			echo		'<a href="#0" class="dislike" id="dl'. $i .'" onclick="dislike('.$i.')">'.$row['disliked'].''. $dislike .'</a>';
			echo		'<a href="#0" class="comment"> comment </a>';
			echo	'</div>';
			echo '</div>';
		}
	}
	
?>
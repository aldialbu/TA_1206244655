<?php 

	$connect = mysqli_connect('localhost','aldi.burhan','mysqlppw','ppw4655');

	if(!$connect){
		echo "Connection failed";
		die("Connection failed: " . mysqli_connect_error());
	}

	if(isset($_POST['inputval'])){

		if($_POST['type']=="username"){
			$inu = $_POST['inputval'];
			$queryresult = mysqli_query($connect,'SELECT id FROM user WHERE username = "'.$inu.'"');
			$count = mysqli_num_rows($queryresult);
			if($count > 0){
				echo "Username Already in use";
			}

		}
		elseif($_POST['type']=="email"){
			$inu = $_POST['inputval'];
			$queryresult = mysqli_query($connect,'SELECT id FROM user WHERE email = "'.$inu.'"');
			$count = mysqli_num_rows($queryresult);
			if($count > 0){
				echo "Email Already in use";
			}
		}
	}

	if(isset($_POST["usernamereg"])){
		register($connect);
	}

	if(isset($_POST['follower'])){
		follow($connect);
	}

	function register($connect){

		$result = mysqli_query($connect,"INSERT INTO user (email ,username,password) VALUES ('".$_POST["email"]."','".$_POST["usernamereg"]."','".$_POST["password"]."');");
		mysqli_query($connect," INSERT INTO profile (fullname, birthday,sex) VALUES ('".$_POST["fullname"]."','".$_POST["birthdate"]."','".$_POST["gender"]."');");

		echo print_r($result,true);

	}

	function inputprofile($connect,$nama, $email, $about, $born, $negara, $job, $edu, $kota, $phone, $company, $hobby){

		session_start();
		$id = $_SESSION["id"];

		$updt = "UPDATE profile SET fullname = '".$nama."', about = '".$about."', birthday = '".$born."', country = '".$negara."', job = '".$job."', education = '".$edu."', city = '".$kota."', phone = '".$phone."', company = '".$company."', hobby = '".$hobby."' WHERE profile.id = '".$id."'";

		mysqli_query($connect,$updt);

		$updt = "UPDATE user SET email ='".$email."'";

		mysqli_query($connect,$updt);

	}

	$followed;

	function kontenProfile($connect, $id, $user,$type){

		$select = "SELECT profile.*,user.email FROM profile INNER JOIN user ON profile.id = user.id WHERE user.username = '".$user."'";

		$result = mysqli_query($connect,$select);

		if($type > 0) return $result;
		else if($type == 0){

			$id2 = mysqli_fetch_object($result)->id;

			$friend = "SELECT * FROM friend WHERE id_followers = '".$id."' AND id_following = '".$id2."' ";

			$row = mysqli_query($connect,$friend);

			$count = mysqli_num_rows($row);

		
			if($count==0){
				return 0;
			}
			elseif($count==1){
				return 1;
			}
		}
	}

	function follow($connect){

		$selectid = "SELECT id FROM user WHERE username = '".$_POST['following']."'";
				
		$resultid = mysqli_query($connect,$selectid);

		$id2 = mysqli_fetch_object($resultid)->id;

		if($_POST['command']=="follow"){
			$query = "INSERT INTO friend (id_following,id_followers) VALUES ('".$id2."','".$_POST['follower']."')";
		}
		elseif($_POST['command']=="unfollow"){
			$query = "DELETE FROM friend WHERE id_following = '".$id2."'AND id_followers = '".$_POST['follower']."'";
		}

		$result = mysqli_query($connect,$query);

		echo print_r($result,true);
	}

?>
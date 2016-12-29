<?php // fungsi otentikasi

	include("connect.php");
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		// ambil input dari form login
		$inu = $_POST['username'];
		$inp = $_POST['password'];

		global $connect;

		// ambil USERNAME dan PASSWORD yang sama pada input form
		$queryresult = mysqli_query($connect,'SELECT id FROM user WHERE username = "'.$inu.'" AND password = "'.$inp.'"');

		$count = mysqli_num_rows($queryresult); // ambil jumlah row
		$valID = mysqli_fetch_object($queryresult);

		if($count == 0){ // jika salah atau tidak ada username 
			echo "Wrong Username or Password, <br> Please Try Again!";
		}elseif ($count == 1) {
			$select = "SELECT fullname FROM profile WHERE id = '".$valID->id."'";

			$selectres = mysqli_query($connect,$select);

			$name = mysqli_fetch_object($selectres)->fullname;

			$selectpic = "SELECT profpict FROM profile WHERE id = '".$valID->id."'";

			$resultpic = mysqli_query($connect,$selectpic);

			$_SESSION['pic'] = mysqli_fetch_object($resultpic)->profpict;
			$_SESSION['user'] = $inu; // jika username dan passward benar
			$_SESSION['id'] = $valID->id;
			$_SESSION['namalengkap'] = $name;

			echo json_encode(array($name,$inu));

		}

	}
?>
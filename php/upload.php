<?php

	session_start();
	$_SESSION['message']="";

	include("connect.php");
	global $connect;

	$query = "SELECT username FROM user WHERE id = '".$_SESSION["id"]."'";
	$selectresult = mysqli_query($connect,$query);

	if($row = $selectresult->fetch_assoc()){
		$usrname = $row["username"];
	}

	$target_dir = "../media/uploaded/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        $uploadOk = 0;
	    }
	}

	$newfile_name = $target_dir.$usrname.".jpg";

	$uploadedpic = "media/uploaded/".$usrname.".jpg";

	$update = "UPDATE profile SET profpict = '".$uploadedpic."' WHERE profile.id = '".$_SESSION["id"]."'";


	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    $_SESSION['message'] = "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {// upload dan ganti nama file
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$newfile_name)) {
	        $_SESSION['message'] = "The file has been uploaded.";

	        mysqli_query($connect,$update);
	        
	    } else {
	        $_SESSION['message'] = "Sorry, there was an error uploading your file.";
	        
	    }
	}

	header('Location: editprofile.php');
	
?> 
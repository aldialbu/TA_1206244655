<?php
	session_start();

    include("connect.php");

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

    $namalengkap = $emailbaru = $aboutme = $tanggallahir = $negara = $job = "";
    $edu = $kota = $phone = $company = $hobby = "";

	if(isset($_SESSION['user'])){ // mengcek session jika ada maka akan mengisi variabel yang dipakai pada input
		if (isset($_POST['namalengkap'])){
            $namalengkap = $_POST['namalengkap'];
        }

        if (isset($_POST['emailbaru'])){
            $emailbaru = $_POST['emailbaru'];
        }

        if (isset($_POST['aboutme'])){
            $aboutme = $_POST['aboutme'];
        }

        if (isset($_POST['tanggallahir'])){
            $tanggallahir = $_POST['tanggallahir'];
        }

        if (isset($_POST['negara'])){
            $negara = $_POST['negara'];
        }

        if (isset($_POST['job'])){
            $job = $_POST['job'];
        }

        if (isset($_POST['edu'])){
            $edu = $_POST['edu'];
        }

        if (isset($_POST['kota'])){
            $kota = $_POST['kota'];
        }

        if (isset($_POST['phone'])){
            $phone = $_POST['phone'];
        }

        if (isset($_POST['company'])){
            $company = $_POST['company'];
        }

        if (isset($_POST['hobby'])){
            $hobby = $_POST['hobby'];
        }
	}
	else {
		header('Location: login.php');
	}

    if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
        if (!($_POST['namalengkap'] == "")&& 
        	!($_POST['emailbaru'] == "")&& 
        	!($_POST['aboutme'] == "")&& 
        	!($_POST['tanggallahir'] == "")&& 
        	!($_POST['negara'] == "")&& 
            !($_POST['job'] == "")&&
            !($_POST['kota'] == "")&&
            !($_POST['phone'] == "")&& 
            !($_POST['company'] == "")&& 
            !($_POST['hobby'] == "")&& 
            !($_POST['edu'] == "")){
        	
            /*$_SESSION['namalengkap']  = $_POST['namalengkap'];
            $_SESSION['emailbaru']    = $_POST['emailbaru'];
            $_SESSION['aboutme']      = $_POST['aboutme'];
            $_SESSION['tanggallahir'] = $_POST['tanggallahir'];
            $_SESSION['negara']       = $_POST['negara'];
            $_SESSION['job']          = $_POST['job'];
            $_SESSION['edu']          = $_POST['edu'];
            $_SESSION['kota']         = $_POST['kota'];
            $_SESSION['phone']        = $_POST['phone'];
            $_SESSION['company']      = $_POST['company'];
            $_SESSION['hobby']        = $_POST['hobby'];*/

            inputprofile($connect, $namalengkap, $emailbaru, $aboutme, $tanggallahir, $negara, $job, $edu, $kota, $phone, $company, $hobby);

            header('Location: ../profile.php'); // redirect ke halaman profile jika form tidak kosong dan menyimpannya di session
        }
    }
                
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_SESSION['namalengkap']; ?>- Edit Your Profile</title>
        <meta charset="UTF-8">
        <meta name="description" content="SahabatSosial edit profile page">
        <meta name="keywords" content="HTML,CSS,social, ../media">
        <meta name="author" content="Aldi Burhanhamali">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

        <link rel="shortcut icon" href="../media/logo-orange.png"> <!--membuat icon -->
        <link rel="stylesheet" href="../css/style.css" >
        <link rel="alternate stylesheet" href="../css/style-black.css" title="playblack">
        <link rel="alternate stylesheet" href="../css/style-blue.css" title="exoblue">
        <link rel="alternate stylesheet" href="../css/style-green.css" title="ptserifgreen">
        <link rel="alternate stylesheet" href="../css/style-red.css" title="ubuntured">
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
    
    <body id="scrollbody" class="container profilepage">
        
        <div class="header" id="header">
            
            <img src="../media/logo.png" alt="Logo" width="75" >
            <p class="absolutepos" style="font-size: 300% ; color: white ; " > Sahabat Sosial </p>  
        </div>

        <div class="headermain" id="headermain">
            
            <img src="../media/logo.png" alt="Logo" width="55" >
            <p id="greet" class="absolutepos" style="font-size: 200% ; color: white ; " > Sahabat Sosial </p>
            
        </div>
        <div class="content relativepos">
            <nav class="menubar" id="menubar">
                
                    <a href="../home.php" class="menulink">Home</a>
                
                    <a href="../profile.php" class="menulink">Profile</a>
                
                
                    <a href="#0" class="menulink">Friends</a>
                
                
                    <a href="#0" class="menulink">Notifications</a>

                    <a href="../messages.php" class="menulink">Messages</a>

                    <a href="../logout.php" class="logoutlink" onclick="logOut()" >Log Out</a>
                
            </nav>
            
            <div class="newsfeed font14 borderlight relativepos">
               <div class="relativepos" style="left: 50%; transform: translate(-50%,8%); background-color: #d9d9d9; width : 600px; min-height: 350px; padding: 20px 35px 20px 20px;">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <b>Upload Profile Picture : </b> <label class="red"></label>
                        <br>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="postbtn ">
                        <input type="submit" value="Upload Image" name="submit" class="postbtn">
                        <label class="red">
                        <?php
                            if (isset($_SESSION["message"])) {
                                echo $_SESSION["message"];
                                $_SESSION["message"]="";
                            }

                        ?>
                        </label>
                    </form><br>

                   <form method="post" action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> >

                        <b>Nama : </b> <label class="red">
                        <?php 
                            if(isset($_POST['namalengkap'])){ //menampilkan pasan error
                                if(empty($_POST['namalengkap'])){
                                    echo "input Name is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="text" name="namalengkap" placeholder="Full Name" class="relativepos inputedit" value="<?php echo $namalengkap; ?>" /><br><br>

                        <b>Email : </b> <label class="red regmail">
                        <?php 
                            if(isset($_POST['emailbaru'])){
                                if(empty($_POST['emailbaru'])){
                                    echo "input Email is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="email" name="emailbaru" placeholder="E-mail" class="relativepos inputedit newmail" value="<?php echo $emailbaru; ?>"/><br><br>

                        <b>Phone : </b> <label class="red">
                        <?php 
                            if(isset($_POST['phone'])){
                                if(empty($_POST['phone'])){
                                    echo "input Phone is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="tel" name="phone" placeholder="Phone Number" class="relativepos inputedit" value="<?php echo $phone; ?>"/><br><br>

                        <b>Bio : </b> <label class="red">
                        <?php 
                            if(isset($_POST['aboutme'])){
                                if(empty($_POST['aboutme'])){
                                    echo "input Bio is Required";
                                }
                            }
                        ?></label><br>
                        <textarea name="aboutme" placeholder="Write your Bio!" class="relativepos inputedit" ><?php echo $aboutme; ?></textarea><br><br>

                        <b>Birthday  : </b> <label class="red">
                        <?php 
                            if(isset($_POST['tanggallahir'])){
                                if(empty($_POST['tanggallahir'])){
                                    echo "input Birthday is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="text" name="tanggallahir" placeholder="0000-00-00 (year-month-day)" class="relativepos inputedit datepicker" value="<?php echo $tanggallahir; ?>"/><br><br>

                        <b>City : </b> <label class="red">
                        <?php 
                            if(isset($_POST['kota'])){
                                if(empty($_POST['kota'])){
                                    echo "input Location is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="text" name="kota" placeholder="Country Location" class="relativepos inputedit" value="<?php echo $kota; ?>" /><br><br>

                        <b>Country : </b> <label class="red">
                        <?php 
                            if(isset($_POST['negara'])){
                                if(empty($_POST['negara'])){
                                    echo "input Location is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="text" name="negara" placeholder="Country Location" class="relativepos inputedit" value="<?php echo $negara; ?>" /><br><br>

                        <b>Job : </b> <label class="red">
                        <?php 
                            if(isset($_POST['job'])){
                                if(empty($_POST['job'])){
                                    echo "input Job is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="text" name="job" placeholder="Everything you do to get Money" class="relativepos inputedit" value="<?php echo $job; ?>" /><br><br>

                        <b>Education : </b> <label class="red">
                        <?php 
                            if(isset($_POST['edu'])){
                                if(empty($_POST['edu'])){
                                    echo "input Education is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="text" name="edu" placeholder="School Name" class="relativepos inputedit" value="<?php echo $edu; ?>" /><br><br>
                        
                        <b>Institution : </b> <label class="red">
                        <?php 
                            if(isset($_POST['company'])){
                                if(empty($_POST['company'])){
                                    echo "This field is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="text" name="company" placeholder="Company Name" class="relativepos inputedit" value="<?php echo $company; ?>" /><br><br>

                        <b>Hobby : </b> <label class="red">
                        <?php 
                            if(isset($_POST['company'])){
                                if(empty($_POST['company'])){
                                    echo "This field is Required";
                                }
                            }
                        ?></label> <br>
                        <input type="text" name="hobby" placeholder="Hobby" class="relativepos inputedit" value="<?php echo $hobby; ?>" /><br><br>
                        
                        <input type="submit" value="Save" class="postbtn absolutepos"  />
                       
                   </form>
               </div>
            <div class="push"></div>
        </div>

        <footer class="footermain relativepos" >
            <div class="footerinfo">
                
                <div class="leftfoot">
                    date
                </div>
                <div class="rightfoot">
                     <div class="contact">
                        <img src="../media/conicon.png" alt="contact">
                        <p>+62 838 1234 5678</p>
                     </div>
                     <div class="mail">
                        <img src="../media/mailicon.png" alt="email">
                        <p>contact@sahabatsosial.id</p>
                     </div>
                </div>
            </div>

            <div class="bottomfoot">
                <div style="text-align: center;">
                    @2016 Sahabat Sosial. All Rights Reserved.
                </div>
            </div>
        </footer> 
        <script src="../js/resize.js"></script>
        <script src="../js/tugas2.js"></script>
        <script src="../js/tugas3.js"></script>
    </body>
</html>
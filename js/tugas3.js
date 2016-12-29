//Tugas 3

// 1 Ajax untuk memanggil file php (otentikasi)

function checkConnection() {
	var errormsg = "Wrong Username or Password, <br> Please Try Again!";
	var errorcon = "Cannot connect to Data Base!";
	var usrname = document.forms["login"]["username"].value; //mendapatkan isi dari input username
	var psswrd = document.forms["login"]["password"].value; //mendapatkan isi dari input password
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest

	var data = new FormData();

	data.append('username', usrname);
	data.append('password', psswrd);

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
		
			xmlDoc = xhttp.responseText; // variabel respon

			xmlDoc = JSON.parse(xmlDoc);

			//alert(xmlDoc[0]+" "+xmlDoc[1])

			if (xmlDoc == errormsg || (xmlDoc == errorcon) ){
				document.getElementById("notvalid").innerHTML= xmlDoc;// "Wrong username or Password! <br> Please Try Again";	
			}
			else{
				//document.getElementById("notvalid").innerHTML = xmlDoc;
				localStorage.savedFullName = xmlDoc[0];
				localStorage.username = xmlDoc[1];
				window.location.href = "home.php";
			}
		}
	};

	//xhttp.open("GET", "checkUser.php?u="+usrname+"&p="+psswrd, true); 
	xhttp.open("POST", "php/checkUser.php", true); 
	xhttp.send(data); // kirimkan data ke php
}

// 2 menampilkan json dengan php
// dilakukan pada file tugas2.js dengan mengubah beberapa fungsi terutama fungsi 
// loadPostJSON() dan getFullname()

// 3 menyimpan input submit pada JSON

function submitPost(){

	var valuePost = $(".createpost textarea").val();

	if (!(valuePost=="")){

		var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest

		var dataPost = new FormData(); // membuat objek form untuk mengirimkan data ke php

		dataPost.append('kontenPost',valuePost);

		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			
				doc = xhttp.responseText; // variabel respon 
				posting(doc);// panggil function postng pada resize.js
				
			}
		};

		xhttp.open("POST", "php/submitpost.php",true); 
		xhttp.send(dataPost); // kirimkan data ke php

	}
	//return false;
}

//---------------------------------------------------------------------

// menyimpan like dan dislike

function like(indx){
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest

	var like = new FormData(); // membuat objek form untuk mengirimkan data ke php

	like.append('likes',indx);

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			var doc = xhttp.responseText; // variabel respon 

			$('#l'+indx).text(doc +" like"); // update nilai like
		}
	};

	xhttp.open("POST", "php/like.php",true); 
	xhttp.send(like); // kirimkan dara ke php
}

function dislike(indx){
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest

	var dislike = new FormData();

	dislike.append('dislikes',indx);

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			
			var doc = xhttp.responseText; // variabel respon 

			$('#dl'+indx).text(doc +" dislike(s)");
				
		}
	};

	xhttp.open("POST", "php/dislike.php",true); 
	xhttp.send(dislike);
}

//-------------------------------------------------------------------------------------
// Tugas Akhir

//register 

$('.newusername').keyup(function (){
	if ($.trim(this.value).length > 0) checkavail("username", this.value);
});

$('.newmail').keyup(function (){
	if ($.trim(this.value).length > 0) checkavail("email", this.value);
});

$('.regpassword').keyup(function (){
	if ($.trim(this.value).length < 6) $(".alertpass").text("Password too short");
	else $(".alertpass").text("");
});

var value = true;

function checkavail(type,value){
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest

	var inputval = new FormData();

	inputval.append('inputval',value);
	inputval.append('type',type);

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			
			var doc = xhttp.responseText; // variabel respon

			if(type == "username"){
				$(".regusername").text(doc);
				if (!doc==""){
					$("#regform").attr("onsubmit","return false");
					$(".registerbtn").attr("onclick","");
					value = false;
				}
				else {
					$("#regform").attr("onsubmit","return false");
					$(".registerbtn").attr("onclick","register()");
					value = true;
				}
			}
			else if(type == "email"){
				$(".regmail").text(doc);
				if (!doc==""){
					$("#regform").attr("onsubmit","return false");
					$(".registerbtn").attr("onclick","");
				}
				else {
					if(value==true){
						$("#regform").attr("onsubmit","return false");
						$(".registerbtn").attr("onclick","register()");
					}
				}	
			}
		}
	};

	xhttp.open("POST", "php/connect.php",true); 
	xhttp.send(inputval);
}

function register(){
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest

	var inputreg = new FormData();

	inputreg.append("usernamereg",$(".newusername").val());
	inputreg.append("email",$(".newmail").val());
	inputreg.append("password",$(".regpassword").val());
	inputreg.append("fullname",$(".namalengkap").val());
	inputreg.append("birthdate",$(".datepicker").val());
	inputreg.append("gender",$('input[name=gender]:checked').val());


	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			
			var doc = xhttp.responseText; // variabel respon 
			alert("submited");
			if(doc == 1) window.location.href = "login.php" ;
		}
	};

	xhttp.open("POST", "php/connect.php",true); 
	xhttp.send(inputreg);
}

function follow(follower,following,type){
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest

	var inputreg = new FormData();

	inputreg.append("command",type);
	inputreg.append("follower",follower);
	inputreg.append("following",following);


	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			
			var doc = xhttp.responseText; // variabel respon 

			if(doc==1){
				if(type == "follow"){
					$('.edit').text("Unfollow");
					$('.edit').attr("onclick","follow("+follower+",'"+following+"','unfollow')");
				}
				else if(type == "unfollow"){
					$('.edit').text("Follow");
					$('.edit').attr("onclick","follow("+follower+",'"+following+"','follow')");
				}
			}
		}
	};

	xhttp.open("POST", "php/connect.php",true); 
	xhttp.send(inputreg);
}

$(".friendlink").eq(0).addClass("linkfocus");

$(".friendlink").click(function(){
	$(".friendlink").removeClass("linkfocus");
	$(this).toggleClass("linkfocus");
});

function friendlist(id,type){
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest

	var inputreg = new FormData();

	inputreg.append("type",type);
	inputreg.append("id",id);

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			
			var doc = xhttp.responseText; // variabel respon

			$("#friendlist").hide().html(doc).fadeIn("slow");
		}
	};

	xhttp.open("POST", "php/friendlist.php",true); 
	xhttp.send(inputreg);
}

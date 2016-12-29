
// Latihan 4
//AJAX

var usrname;
var psswrd;
var fullnm='';
var valueTF=false;

function getUserPass(){

	usrname = document.forms["login"]["username"].value; //mendapatkan isi dari inout username
	psswrd = document.forms["login"]["password"].value; //mendapatkan isi dari inout username
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest
	xhttp.onreadystatechange = function() { 
		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			
			var xmlDoc = xhttp.responseXML; // variabel respon xml
			var getUser = xmlDoc.getElementsByTagName("user"); // mengambil tag user pada xml
			
			for (var i = 0; i <getUser.length; i++) { // untuk setiap isi tag user

				// jika isi tag indeks ke i dari username dan password sama dengan input 
				if (getUser[i].getElementsByTagName("username")[0].childNodes[0].nodeValue == usrname &&
			    getUser[i].getElementsByTagName("password")[0].childNodes[0].nodeValue == psswrd) {
			    	//ambil fullname pada xml
			    	fullnm = getUser[i].getElementsByTagName("fullname")[0].childNodes[0].nodeValue;
			    	
			    	//maka ubah nilai return jadi true
			    	valueTF = true;

			    	// dan direct ke link home
			    	window.location.href = "home.php?user="+fullnm;
			    	
			    	break; // selesaikan loop
				}
				else if (i>=getUser.length-1){ // jika keadaan awal tidak terpenuhi maka akan mengekek jika iterasi lebih atau sama dengan panjang array user
					// berarti username dan password tidak dietemukan

					//munculkan pesan
					document.getElementById("notvalid").innerHTML= "Wrong username or Password! <br> Please Try Again";	
				}
			}
		}
	};

	xhttp.open("GET", "users.xml", true); 
	xhttp.send();

	return valueTF; // return nilai false akan menghentikan submit
}

function getFullname(){ // fungsi ini di muat saat halaman home dibuka dengan menggunakan event onload
	var parameter = window.location.search; // mengambil isi dari search (?) pada url/uri
	var indexPar = parameter.lastIndexOf('='); // jika ada tanda samadengan (=) maka ambil indeks terakhir (=) muncul
	var fullname = parameter.substring(indexPar+1); // hilangkan string yang diambil sebelum dan indeks (=)
	var fullname = decodeURI(fullname); // mendecode string yang diambil agar 20% hilang

	//berikan salam pada halaman home di class headermain dengan nama yang didapat dari cek xml
	document.getElementById("greet").innerHTML= " Hello " + fullname +"! Welcome to " + document.getElementById("greet").innerHTML;	

	// mengubah semua nama menjadi nama yang di dapat dari xml
	var namaleng = document.getElementsByClassName("fullnames");
	for (var i = 0; i < namaleng.length; i++) {
		namaleng[i].innerHTML = fullname;
	}
}
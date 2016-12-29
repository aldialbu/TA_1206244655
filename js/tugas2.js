// Tugas 2

var usrname;
var psswrd;
var fullnm='';
var emailUser='';
var valueTF=false;

var sFullName;
var sEmail;
var sUserName;


//1.a. Fungsi login: validasi username dan password yang dimasukkan user dengan yang ada
// di file XML. Jika proses login gagal, tampilkan pesan kegagalannya.
// b. Jika proses login berhasil, halaman akan di‐redirect ke halaman Home lalu tampilkan
// nama lengkap dan email user tersebut di setiap halaman.

function getUserPass(){

	usrname = document.forms["login"]["username"].value; //mendapatkan isi dari input username
	psswrd = document.forms["login"]["password"].value; //mendapatkan isi dari input password
	localStorage.rememberChk = document.getElementsByName("remember")[0].checked; // simpan boolean pada local storage (value bolean akan bertopa string jika di simpan pada localstorage)
	
	var xhttp = new XMLHttpRequest(); //memulai XMLHttpRequest
	xhttp.onreadystatechange = function() { 		

		if (xhttp.readyState == 4 && xhttp.status == 200) { //meminta ready state atau status jika terhubung maka lakukan:
			
			var xmlDoc = xhttp.responseXML; // variabel respon xml
			var getUser = xmlDoc.getElementsByTagName("user"); // mengambil tag user pada xml
			
			loopcek:
			for (var i = 0; i <getUser.length; i++) { // untuk setiap isi tag user

				// jika isi tag indeks ke i dari username dan password sama dengan input 
				if (getUser[i].getElementsByTagName("username")[0].childNodes[0].nodeValue == usrname && getUser[i].getElementsByTagName("password")[0].childNodes[0].nodeValue == psswrd) {
			    	//ambil fullname pada xml
			    	fullnm = getUser[i].getElementsByTagName("fullname")[0].childNodes[0].nodeValue;
			    	emailUser= getUser[i].getElementsByTagName("mail")[0].childNodes[0].nodeValue;
			    	if(localStorage.rememberChk=="true"){ // jika value checkbox true maka disimpan pada localstorage
				    	localStorage.savedFullName = fullnm;
				    	localStorage.savedUserName = usrname;
				    	localStorage.savedEmail = emailUser;
				    }
				    else{ // jika tidak dicentang maka simpan d sessionstorage
				    	sessionStorage.savedFullName = fullnm;
				    	sessionStorage.savedUserName = usrname;
				    	sessionStorage.savedEmail = emailUser;
				    }

				    //document.getElementById('login').setAttribute('method','post');
			    	//maka ubah nilai return jadi true
			    	valueTF = true;

			    	//document.getElementById('login').setAttribute('action','home.php');

			    	// dan direct ke link home
			    	//window.location.href = "home.php?user="+localStorage.savedUserName+'&checked='+localStorage.rememberChk ;
			    	
			    	break loopcek; // selesaikan loop
				}
				else if (i>=getUser.length-1){ // jika keadaan awal tidak terpenuhi maka akan mengekek jika iterasi lebih atau sama dengan panjang array user
					// berarti username dan password tidak dietemukan

					//munculkan pesan
					//document.getElementById("notvalid").innerHTML= "Wrong username or Password! <br> Please Try Again";	
				}
			}
		}
	};

	xhttp.open("GET", "userdata.xml", true); 
	xhttp.send();

	return valueTF; // return nilai false akan menghentikan submit
}

//1.c. Fungsi logout: menghapus informasi nama lengkap dan email/username dari halaman web dan
// me‐redirect ke halaman login.
// d. implementasikan subfungsi tambahan :
//  - untuk menyimpan informasi login
//  - 

var arrJSON;
var incrmn=0;
var arJLength;

function getFullname(page){ // fungsi ini di muat saat halaman home dibuka dengan menggunakan event onload

	/*if(localStorage.rememberChk=="true"){ //mengecek nilai checkbox
		sFullName = localStorage.savedFullName;
		sEmail = localStorage.savedEmail;
		sUserName = localStorage.savedUserName;
	}
	else{
		sFullName = sessionStorage.savedFullName;
		sEmail = sessionStorage.savedEmail;
		sUserName = sessionStorage.savedUserName;
	}

	if((sUserName == undefined)){ //jika username tidak ada (belum login) maka akan menampilkan pesan dan rediect ke halaman login
		alert("You're not Logged In!");
		window.location.href = "login.php?";
	}
	else   {

		//berikan salam pada halaman yang me-load fungsi ini di class headermain dengan nama yang didapat dari cek xml
		//document.getElementById("greet").innerHTML= " Hello " + sFullName+"! Welcome to " + document.getElementById("greet").innerHTML +", email : " + sEmail ;	

		// mengubah semua nama menjadi nama yang di dapat dari xml
		//var namaleng = document.getElementsByClassName("fullnames");
		for (var i = 0; i < namaleng.length; i++) {
			namaleng[i].innerHTML = sFullName;
		}
	}

	if(localStorage.json){ //jika sudah pernah menympan json pada localstorage maka jalankan fungsi loadJSON (posting konten yang telah tersimpan di local storage)
		loadJSON(incrmn,page); //variabel page untuk melihat apakah fungsi dipanggil halaman tertentu 
	}
	else{*/
		loadPostJSON(page); //jika belum ada local storage yang menyimpan konten dari JSON
	//}
}

function logOut(){ // fungsi logout menghapus semua localstorage gan session storage
	localStorage.removeItem("json");
	localStorage.removeItem("rememberChk");
	if(localStorage.rememberChk=="true"){
		localStorage.removeItem("savedFullName");
		localStorage.removeItem("savedUserName");
		localStorage.removeItem("savedEmail");
		
	}
	else{
		sessionStorage.removeItem("savedFullName");
		sessionStorage.removeItem("savedUserName");
		sessionStorage.removeItem("savedEmail");
	}
}

function pernahLogin(){ //di panggil halaman login, jika pernah login dan belum pernah logout maka akan langsung redirect ke home

	/*if(localStorage.rememberChk=="true"){
		sUserName = localStorage.savedUserName;
	}
	else{
		sUserName = sessionStorage.savedUserName;
	}

	if(sUserName != undefined){
		window.location.href = "home.php?"+sUserName;
	} */
}


//2 Mengambil konten Friends’ posts dari file JSON.

function loadPostJSON(page){  // kode ajax untuk menerima respon state dan status 
	var xhttp = new XMLHttpRequest();

	var data = new FormData();

	data.append('page', page);

    xhttp.onreadystatechange = function(){
    	if(xhttp.readyState == 4 && xhttp.status == 200){
       		if(typeof(Storage) !== "undefined"){
       			
                localStorage.json = xhttp.responseText; // menyimpan response text dari JSON
                $(localStorage.json).hide().appendTo(".timeline").fadeIn("slow"); // memuat pada profile

            }else {
                alert("Local Storage not supported");
            }
        }
    }
    xhttp.open("POST","php/post.php", true);
    xhttp.send(data);
}

function loadJSON(i,page){ // fungsi menampilkan isi JSON
	arrJSON = JSON.parse(localStorage.json); // mengibah isi localstorage.json ke bentuk objek
	arJLength = arrJSON.length-1;

	if (page == "profile"){  // jika di load dari profile page maka isi objek JSON di ambil seluruhnya langsung
		for ( var l = arrJSON.length-1;  l >= 0; l--) {
			createPostJSON(arrJSON[l].fullname, arrJSON[l].posttime, arrJSON[l].content, Number(arrJSON[l].likes), Number(arrJSON[l].dislikes),l,"profile");
		}
	}
	else { //load jika di panggil dari home 

		for (i ; i <=arrJSON.length; i++) {
			incrmn = i;

			if (incrmn > arJLength){ // menghilangkan tombol load more jika isi konten telah dimuat semua
				$(".loadmore").hide();
			}
			else if(i==0 || i%3 != 0){ // mengambil konten setiap 3 post
				createPostJSON(arrJSON[arJLength - i].fullname, arrJSON[arJLength - i].posttime, arrJSON[arJLength - i].content, Number(arrJSON[arJLength-i].likes), Number(arrJSON[arJLength-i].dislikes),arJLength-i,"home");
			}
			else { // break loop jika telah mengambil isi konten json setiap 3 kali
				break;
			}
		}
	}
}

function loadMorePost(){ //dipanggil jika button load more pada home ditekan
	createPostJSON(arrJSON[arJLength-incrmn].fullname, arrJSON[arJLength-incrmn].posttime, arrJSON[arJLength-incrmn].content, Number(arrJSON[arJLength-incrmn].likes), Number(arrJSON[arJLength-incrmn].dislikes),arJLength-incrmn,"home");
	loadJSON(incrmn+1);
}

function createPostJSON(namaLengkap, waktuPost, isiPost, likedPost, dislikedPost,j,page){ //menampilkan isi JSON yang diambil pada HTML

	jmlLike[j] = likedPost;
	jmlDisl[j] = dislikedPost; 

	if(jmlLike[j]==0) likedPost="";
	if(jmlDisl[j]==0) dislikedPost="";

	var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour:'numeric',minute:'numeric'}; //format tanggal 

	var htmlPost = (''+ //membuat html
		'<div class="post relativepos textpost">'+
			'<img class="thumbpic" src="default_profile.jpg" alt="profile pic"/>'+
			'<h4 class ="fullnames">'+namaLengkap+'</h4><text style="color:#909090;font-size:12px;margin-left:10px"> '+
			new Date(waktuPost).toLocaleString('en-US',options)+'</text><br>'+ // memanggil tanggal
			'<p id="post'+j+'">'+ isiPost +'</p>'+
			'<div class="interact">'+
				'<a href="#0" class="like" id="l'+ j +'"> '+likedPost+' like </a>'+
				'<a href="#0" class="dislike" id="dl'+ j +'" >'+dislikedPost+' dislike </a>'+
				'<a href="#0" class="comment"> comment </a>'+
			'</div>'+
		'</div>'+
	'');

	if (page == "home") { 
		$(htmlPost).hide().appendTo(".timeline").fadeIn("slow"); //memuat pada home
	}
	else {
		$(htmlPost).hide().appendTo(".timeline").fadeIn("slow"); // memuat pada profile
	}

	$("#l"+j).click(function(){ //jalankan fungsi like bertambah jika di klik dengan menggunakan id dari variabel j
		jmlLike[j] += 1 ;
		$(this).text(jmlLike[j]  + " like" );
		simpanLike(jmlLike[j],j);
	});

	$("#dl"+j).click(function(){
		jmlDisl[j]  += 1 ;
		$(this).text(jmlDisl[j] + " dislike" );
		simpanDislike(jmlDisl[j],j);
	});

	$("#post"+j).find(".shwhide").click(function(){ //fungsi show hide gambar jika ada kelas .shwhide pada post konten

		classImage = $("#post"+j).find(".imgpost"); //memilih elemen gambar yang ingin  diperbesar

		classImage.toggle(function(){ 
			myFunction(classImage); // jalankan fungsi myFunction pada resize.js
		});
	});

}

//3 Mengimplementasikan fitur post dan menyimpan kontennya dalam Webstorage

function simpanPost(nama,isipesan,tanggal,suka,taksuka){ //menambah isi array object arrJSON, dipanggil di fungsi post di resize.js

    var tambahisiPost = new Object(); // membuat objek baru dan mengisi variabel di dalamnya
    tambahisiPost.fullname = nama;
    tambahisiPost.posttime = tanggal;
    tambahisiPost.content = isipesan;
    tambahisiPost.likes = suka;
    tambahisiPost.dislikes = taksuka;

    arrJSON[arrJSON.length] = tambahisiPost; //menambahkan objek pada array object arrJSON
    localStorage.json = JSON.stringify(arrJSON); //kembalikan  ke bentuk string dan simpan ke localstorage
}

function simpanLike(suka,indx){ //meyiman banyak like pada localstorage
	arrJSON[indx].likes = suka; //ubah isi objek arrJSON dengan jumlah like
	localStorage.json = JSON.stringify(arrJSON); 
}

function simpanDislike(taksuka,indx){  //meyiman banyak dislike pada localstorage
	arrJSON[indx].dislikes = taksuka; 
	localStorage.json = JSON.stringify(arrJSON); 
}

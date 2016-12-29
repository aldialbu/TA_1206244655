$(document).ready(function(){

	$(".aboutshw").click(function(){ //showhide about pada profile
		$(".aboutprofile").toggle("slow");
	});

	//fungsi di bawah digunakan pada halaman message 
	//untuk memilih menampilkan pesan dari user tertentu 

	$(".messagethread").eq(0).show(); //memunculkan pesan paling "baru"
	$(".sender").eq(0).addClass("senderfocus"); //fokus style pada pengirim

	var a = 0; //menyimpan index sebelumnya untuk dibandingkan

	$(".sender").click(function(){
		$(".sender").removeClass("senderfocus");
		$(this).toggleClass("senderfocus");

		var indSender = $(".sender").index(this); //memilih index user yang di klik
		var threadClass = $(".messagethread").eq(indSender); //memilih pesan dari user untuk ditampilkan

		//memunculkan pesan dari user tertentu

		if (indSender!==a) { // jika index sebelumnya tidak sama maka lakukan instruksi di bawah
			$(".messagethread").hide("slow");  
			threadClass.toggle(function(){
				threadClass.show("slow");
			});
			a=indSender; // menyimpan lagi nilai index dengan yang baru
		}	
	});

});

	function myFunction(indx){			// fungsi yang mengembalikan style image seperti semula
		indx.animate({height :"240px"});// membuat animasi transisi agar ukuran mengecil
		indx.css({

			"z-index":"0",
			"top": "0",
			"left": "0",
			"transform": "translate(0,0)",
			"margin-bottom":"0",
			"margin-right":"0"
		});
	}

	var zoom = 1; 
	var indexImage;
	var classImage;

	/*$(".shwhide").click(function(){ // fungsi sudah tidak terpakai

		indexImage = $(".shwhide").index(this); //mengambil index dari class yang di klik

		classImage = $(".imgpost").eq(indexImage); // menggunakan index untuk menentukan class lain 

		classImage.toggle(function(){
			myFunction(classImage);
		});
	});*/

	$(".imgpost").click(function(){

		indexImage = $(".imgpost").index(this);
		classImage = $(".imgpost").eq(indexImage);

		// membuat fungsi toggle pada class imgpost dengan 
		if(zoom==1){ // membuat kondisi apabila nilai zoom = 1 maka akan menjalankan pembesaran image
			classImage.animate({height :"400px"}); // membuat animasi transisi agar ukuran membesar
			classImage.css({
				"z-index":"0", // meletakkan image -1 terhadap sumbu z (hadapan pengguna) agar tombol bisa ditekan
				"top": "50%",
				"left": "50%",
				"transform": "translate(-50%,-50%)",
				"margin-bottom":"-50%",
				"margin-right":"-50%",
				"position":"relative"
			});
			zoom = 0; //nilai zoom = 0
		} 
		else {
			myFunction(classImage); // fungsi yang mengembalikan style image seperti semula
			zoom = 1; //mengembailkan nilai zoom
		}
	});

window.onscroll = function() {scrollheader()}; // memberikan efek saatevent scroll

function scrollheader(){
	if (document.body.scrollTop > 110 || document.documentElement.scrollTop > 110) { // jika discroll 110 px ke bawah maka lakukan event di bawah
        $("#headermain").css("top","-85px"); 
		$("#header").css("top","-85px");
		//$("#scrollbody").css("margin-top","-80px");
		$("#menubar").css("top","-85px");
    } else {
        $("#headermain").css("top","0px"); 
		$("#header").css("top","0px");
		//$("#scrollbody").css("margin-top","0px");
		$("#menubar").css("top","0px");
    }	
}

var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'} // format tampilan tanggal
var todaydate = new Date();      
document.getElementsByClassName("leftfoot")[0].innerHTML = todaydate.toLocaleString("en-US",options); // tampilkan tanggal pada footer

//TUGAS 1 Javascript/JQuery

	//1) membuat tombol like jika ditekan akan menghitung jumlah like

	var jmlLike = []; // membentuk array untuk menympan jumlah like dati post yang berbeda
	var jmlDisl = [];
	var i;

	for ( i = 0; i < $(".like").length; i++) { //array akan sepanjang jumlah class like
		jmlLike[i] = 0; //mengisi semua nilai array dengan 0
		jmlDisl[i] = 0;
	}

	// fungsi di bawah sudah tidak terpakai
	function clickedLike(){
		$(".like").click(function(){ //jalankan fungsi like bertambah jika di klik
			var indLike = $(".like").index(this); //menyimpan index untuk memilih like yang mana yang akan di tambah
			jmlLike[indLike] += 1 ;
			$(this).text(jmlLike[indLike]  + " like" );
		});
	}

	function clickedDLike(){	
		$(".dislike").click(function(){
			var indDL = $(".dislike").index(this);
			jmlDisl[indDL]  += 1 ;
			$(this).text(jmlDisl[indDL] + " dislike" );
		});
	}

	clickedLike(); //memanggil like function
	clickedDLike();

	//2) membuat postingan pada home dan profile

	var j;

	function posting(j){
		//j = JSON.parse(localStorage.json).length;
		//j = localStorage.json.split('class="post').length - 1;
		
		var date = new Date(); // buat objek tanggal
		var indLike, indDL;
		var valuePost = $(".createpost textarea").val(); // mendapatkan isi text area
		var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour:'numeric',minute:'numeric'};
		if(valuePost != ''){ //jika tidak kosong maka tambahkan html d bawah
			
			var htmlPost = (''+
				'<div class="post relativepos textpost"><script>showHide('+j+')</script>'+
					'<div class="thumbnaildiv" >'+
						'<img class="thumbpic" src="media/default_profile.jpg" alt="profile pic" />'+
					'</div><h4 class = "fullname"><a href="profile.php?usr='+localStorage.username+'">'+localStorage.savedFullName+'</a></h4><text style="color:#909090;font-size:12px;margin-left:10px"> '+
					date.toLocaleString('en-US',options)+'</text><br>'+
					'<p>'+ valuePost +'</p>'+
					'<div class="interact">'+
						'<a href="#0" class="like" id="l'+ j +'" onclick="like('+j+')"> like </a>'+
						'<a href="#0" class="dislike" id="dl'+ j +'" onclick="dislike('+j+')" > dislike </a>'+
						'<a href="#0" class="comment"> comment </a>'+
					'</div>'+
				'</div>'+
			'');

			$(htmlPost).hide().prependTo(".timeline").fadeIn("slow"); // lakukan posting
			$(".createpost textarea").val(""); //mengosongkan kembali textarea

			/* sudah tidak terpakai semenjak Tugas 3
			jmlLike.unshift(0);
			jmlDisl.unshift(0);

			//jika mengulang fungsi like di atas maka akan terjadi fungsi ganda
			// hal ini menyebabkan fungsi dipanggil bergabda sehingga increment yang dilakukan juga ganda
			// maka diperlukan fungsi yang mirip tetapi berbeda cara mendapatnkan elemennya

			$("#l"+j).click(function(){ //jalankan fungsi like bertambah jika di klik
				indLike = $(".like").index(this); //menyimpan index untuk memilih like yang mana yang akan di tambah
				jmlLike[indLike] += 1 ;
				$(this).text(jmlLike[indLike]  + " like" );
				simpanLike(jmlLike[indLike],j-1);
				//alert(jmlLike[indLike]);
			});

			$("#dl"+j).click(function(){
				indDL = $(".dislike").index(this);
				jmlDisl[indDL]  += 1 ;
				$(this).text(jmlDisl[indDL] + " dislike" );
				simpanDislike(jmlDisl[indDL],j-1);

			});

			j++; // increment digunakan sebagai variabel id 
			simpanPost(localStorage.savedFullName,valuePost,date,0,0); // memanggil fungsi pada tugas2.js untuk menyimpan post
			*/
		}
	}

	$("#postbtn").click(function(){ 
		//posting();
	});

	//3) membalas pesan

	$(".sendbtn").click(function(){

		var indMessage = $(".sendbtn").index(this); //mengambil index button send yang di klik (simulasi user yang berbeda)
		var classMsgs = $(".messages").eq(indMessage); // memilih kelas yang akan diisi oleh pesan untuk orang yang berbeda

		var valMessage = $(".postmessage textarea").eq(indMessage).val(); // mengambil isi textarea
		if(valMessage != ''){ //jika tidak kosong maka tambahkan html d bawah
			var htmlMes = (''+ 
				'<div class="message rightpos">'+
					'<p>'+valMessage+'</p>'+
				'</div>'
			);
			$(htmlMes).hide().prependTo(classMsgs).fadeIn("slow"); // menampilkan pesan
			$(".postmessage textarea").eq(indMessage).val(""); //mengosongkan kembali textarea
		}
	});


	//4)) ganti tema warna

	//setelah mendefinisikan stlye alternatif pada html home dan profile
	function setActiveStyleSheet(title) {
		var i, a, main;
		// mengambil setiap elemen link
		for(i=0; (a = document.getElementsByTagName("link")[i]); i++) {
			// jika terdapat atribut rel dari elemen yang berisi string style
			// dan punya atribut title maka 
			if(a.getAttribute("rel").indexOf("style") != -1 && a.getAttribute("title")) {
				a.disabled = true; // elemen akan disable
				//jika atribut elemen link sama dengan title css maka disable untuk 
				// stylesheet tersebut adalah false
				if(a.getAttribute("title") == title) a.disabled = false;
	    	}
		}
	}

//--------------------------------------------------------------------------------

// fungsi countdown

function countdown(detik){
	var secduration = detik;
	var intervalTime = setInterval(function () {
    	minutes = parseInt(secduration / 60, 10); //membuat menit
        seconds = parseInt(secduration % 60, 10); // membuat detik

        minutes = minutes < 10 ? "0" + minutes : minutes; // menambahkan nol jika dibawah 10 menit atau 10 detik
        seconds = seconds < 10 ? "0" + seconds : seconds;

        $('#session').text("Session time : "+minutes + ":" + seconds); // update pada id session

        if (--secduration < 0) {
            clearInterval(intervalTime); //hentikan interval
            logOut();
        }
    }, 1000); //1000 milisecond, setiap 1 detik update time
}

//fungsi showhide yang baru

function showHide(id){
	$("#post"+id).find(".shwhide").click(function(){ //fungsi show hide gambar jika ada kelas .shwhide pada post konten

		var callImage = $("#post"+id).find(".imgpost"); //memilih elemen gambar yang ingin  diperbesar
		callImage.toggle(function(){
			myFunction(callImage); // jalankan fungsi myFunction pada resize.js
		});
	});
}
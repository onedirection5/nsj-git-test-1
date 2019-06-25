<?php //tag pembuka php
include "koneksi2.php"; //include: menghubungkan setiap halaman ke server utama.

?>
<html> <?php--tag pembuka html--?>
	<head><title>Arsip Berita</title> <?php--head merupakan wadah penampung semua element-- ?>
	<link rel="stylesheet" href="style.css"> <?php-- link rel: untuk mengarahkan ke halaman tertentu. href: untuk mengarahkan ke halaman tertentu--?>
	<script language="javascript"> <?php--script language: bahasa yg digunakan untuk script coding--?>
		function konfirmasi() { <?php-->function: untuk memanggil secara berulang2 nilai pada setiap variabel--?>
			if (confirm ("Apakah Anda yakin menghapus berita ini ?")) { <?php--jika:konfirmasi/memastikan--?>
			return true; //mengembalikan nilai benar
			} else { //atau
			return false; //mengembalikan nilai salah
			} //kurung kurawal tutup
		} //kurung kurawal tutup
	</script> <?php--script penutup--?>
	</head> <?php--head penutup--?>
	<body> <?php--tag/element yg mencakup semua tag--?>
		<a href="index_berita2.php">Halaman Depan</a> | <?php--a href: mengarahkan ke halaman tertentu--?>
		<a href="arsip_berita2.php">Arsip Berita</a> | <?php--a href: mengarahkan ke halaman tertentu--?>
		<a href="input_berita2.php">Input Berita</a> <?php--a href: mengarahkan ke halaman tertentu--?>
		<br><br> <?php--tag untuk spasi/baris baru--?>
		<h2>Arsip Berita</h2> <?php--h2: ukuran huruf/display--?>
		<ol> <?php--element/tag order list yg terstruktur dan urut--?>
		<?php //tag pembuka php
		$query = "SELECT A.id_berita, B.nm_kategori, A.judul,
					A.pengirim, A.tanggal
			   FROM berita A, kategori B WHERE A.id_kategori=B.id_kategori ORDER BY A.id_berita DESC LIMIT 0,5"; //SELECT untuk memanggil nilai dari variabel, FROM tempat tabel yg menampung variabel, WHERE: kondisi yg berhubungan dengan variabel, ORDER: berdasarkan, DESC LIMIT 0,5: diurutkan dari yg besar ke kecil.
			   
//		SELECT A.id_berita, B.nm_kategori, A.judul, A.pengirim, A.tanggal
//		FROM berita A, kategori B 
//		WHERE A.id_kategori=B.id_kategori 
//		ORDER BY A.id_berita DESC LIMIT 0,5	   
		
			   
//		SELECT A.id_berita, B.nm_kategori, A.judul, A.pengirim, A.tanggal
//		FROM berita A
//		LEFT JOIN berita B
//		ON A.id_kategori=B.id_kategori
//		GROUP BY nm_kategori
//		ORDER BY A.id_berita DESC LIMIT 0,5
			    
			   
		$sql = mysqli_query ($conn, $query); //mysqli_query untuk memberi perintah query kepada Mysqli Server (seperti SELECT, DELETE, INSERT, UPDATE)
		while ($hasil = mysqli_fetch_array ($sql, MYSQLI_ASSOC)) { //WHILE adalah proses pengulangan nilai yg belum diketahui jumlahnya. mysqli_fetch_array untuk menampilkan data hasil dari fungsi mysqli _query dengan perintah SELECT.
			$id_berita = $hasil['id_berita']; //$hasil untuk mencetak nilai dari variabel
			$kategori = stripslashes ($hasil['nm_kategori']); //stripslashes untuk untuk menghilangkan backslashes (\) dalam string.
			$judul = stripslashes ($hasil['judul']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil mencetak nilai dari variabel.
			$pengirim = stripslashes ($hasil['pengirim']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil mencetak nilai dari variabel.
			$tanggal = stripslashes ($hasil['tanggal']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil mencetak nilai dari variabel.
			//
			//tampilkan arsip berita
			echo "<li><a
href='berita_lengkap2.php?id=$id_berita'>$judul</a><br>"; //maka, tag <li> untuk menyusun daftar dengan simbol alfabeth/nomor.
			echo "<small>Berita dikirimkan oleh <b>$pengirim</b>
				pada tanggal <b>$tanggal</b> dalam kategori
<b>$kategori</b><br>"; //<small>:untuk tulisan yg lebih kecil atau fine print. <b>:menunjukkan bold, artinya tulisan yang diapit oleh <b> menjadi tebal/tegas.
			echo "<b>Action : </b><a
href='edit_berita2.php?id=$id_berita'>Edit</a> | "; //<b> menunjukkan bold, tulisan diapit <b> dan menjadi tebal. a href: mengarahkan ke halaman tertentu. <a>: untuk mendefinisikan sebuah sebuah hyperlink.
			echo "<a href='delete_berita2.php?id=$id_berita'
onClik='return tanya()'>Delete</a>"; //a href: untuk mengarahkan ke halaman tertentu. onClik untuk 
			echo "</small></li><br><br>"; //tag penutup </small>: untuk tulisan yg lebih kecil atau fine print. </li> untuk menyusun daftar dengan simbol alfabeth/nomor. <br><br>: untuk spasi atau garis bsru.
		} //kurung kurawal penutup dan tag php penutup.
		?> 
		</ol> <?php-- element/tag order list untuk yg terstruktur dan urut--?>
	 </body> <?php-- tag penutup body--?>
</html> <?php-- tag penutup html--?>
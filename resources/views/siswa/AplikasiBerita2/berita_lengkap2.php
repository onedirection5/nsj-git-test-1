<?php //tag pembuka php
include "koneksi2.php"; //include untuk koneksi ke server utama

if (isset($_GET['id'])) { //jika isset (isset untuk memeriksa apakah variabel sudah di set atsu belum.
	$id_berita = $_GET ['id']; //$_GET digunakan untuk menampung data nilai variabel.
} else { //atau
	echo "<br/>"; //tag <br/> untuk membuat garis baru pada script.
	die ("Error.No Id Selected!"); //die: untuk menghentikan perintah script selanjutnya, sehingga eksekusi terhenti disini jika tidak ada id yang dipilih.
} //kurung kurawal penutup dan tag php penutup.
?>

<html> <?php--tag pembuka html--?>
	<h2>Berita Lengkap</h2> <?php--h2: untuk ukuran huruf--?>
	<link rel= "stylesheet" href= "style.css"> <?php--link rel: untuk mengarahkan ke halaman tertentu. href: untuk mengarahkan ke halaman tertentu --?>
	</head> <?php--head penutup--?>
	<body> 	<?php--tag/element yg mencakup semua tag--?>
	<a href="index_berita2.php">Halaman Depan</a> | <?php--a href: untuk mengarahkan ke halaman tertentu--?>
	<a href="arsip_berita2.php">Arsip Berita</a> | <?php--a href: untuk mengarahkan ke halaman tertentu--?>
	<a href="input_berita2.php">Input Berita</a> <?php--a href: untuk mengarahkan ke halaman tertentu--?>
	<br><br> <?php--tag untuk membuat baris baru--?>
	<h2>Berita Lengkap</h2> <?php--h2 tag untuk ukuran huruf--?>
	<?php //tag pembuka php
	$query = "SELECT A.id_berita, B.nm_kategori, A.judul,
A.isi, A.pengirim, A.tanggal
			FROM berita A, kategori B WHERE
A.id_kategori=B.id_kategori && A.id_berita='$id_berita'"; //$query untuk memanggil nilai dari tabel dengan perintah SELECT, FROM, WHERE.
	$sql = mysqli_query ($conn, $query); //mysqli_query untuk memberikan perintah query ke MySQL server. $conn: koneksi ke server pusat. $query: memuat nilai2 dari variabel.
	$hasil = mysqli_fetch_array ($sql, MYSQLI_ASSOC); //mysqli_fetch _array menangkap data dari hasil perintah query dan membentuk array assosiatif dan numerik. Mysqli_assoc: digunakan untuk menghasilkan array dari tabel dalam bentuk assosiatif (tidak mengggunakan nomor element/index tapi dengan string).
	$id_berita = $hasil['id_berita']; //$hasil: menghasilkan nilai dari dalam variabel 
	$kategori = stripslashes ($hasil['nm_kategori']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil untuk menghasilkan nilai dari dalam variabel 
	$judul = stripslashes ($hasil['judul']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil untuk menghasilkan nilai dari dalam variabel 
	$isi = stripslashes ($hasil ['isi']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil untuk menghasilkan nilai dari dalam variabel
	$pengirim = stripslashes ($hasil['pengirim']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil untuk menghasilkan nilai dari dalam variabel
	$tanggal = stripslashes ($hasil['tanggal']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil untuk menghasilkan nilai dari dalam variabel
// //
// //menampilkan berita
	echo "<font size=5 color='blue'>$judul</font><br>"; // echo untuk memanggil/mencetak nilai. <font size>:ukuran huruf. color:warna huruf. <br>:untuk baris baru.
	echo "<small>Berita dikirimkan oleh <b>$pengirim</b>
	pada tanggal <b>$tanggal</b> dalam kategori
<b>$kategori</b></small>"; //small: untuk tulisan yg lebih kecil/fine print. <b>:tulisan cetak tebal/bold
	echo "<p>$isi</p>"; //<p>:untuk menunjukkan sebuah paragraph.
	?> <?php--tag penutup php--?>
	</body> <?php-- tag body penutup --?>
</html> <?php-- tag html penutup--?>
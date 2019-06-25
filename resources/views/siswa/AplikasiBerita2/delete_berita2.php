<?php
include "koneksi2.php"; //incude: menghubungkan setiap halaman ke server utama.

if (isset($_GET['id'])) { //isset adalah function untuk menyatakan apakah variabel sudah di set atau belum, jika sudah maka akan bernilai true & sebaliknya akan bernilai false jika belum di set. $_GET untuk menampung data nilai variabel.
	$id_berita = $_GET['id']; //$_GET digunakan untuk menampung data nilai variabel
} else { //atau
	die ("Error. No Id Selected! "); //die: untuk menghentikan perintah script selanjutnya, sehingga eksekusi terhenti di sini jika tidak ada Id yg dipilih.
} //kurung kurawal penutup dan tag php penutup
?>
<html> <?php--tag pembuka html--?>
	<head><title>Hapus Berita</title> <?php--head merupakan wadah/penampung semua ekement, title untuk judul--?>
	<link rel="stylesheet" href="style.css"> <?php-- link rel: untuk mengarahkan ke halaman tertentu. href: untuk mengarahkan ke halaman tertentu --?>
	</head> <?php--head penutup-- ?>
	<body> <?php--tag atau element yg mencakup semua tag--?>
		<a href= "index_berita2.php">Halaman Depan</a> | <?php--a href: mengarahkan ke halaman tertentu-- ?>
		<a href= "arsip_berita2.php">Arsip Berita</a> | <?php--a href: mengarahkan ke halaman tertentu-- ?>
		<a href= "input_berita2.php">Input Bertia</a> <?php--a href: mengarahkan ke halaman tertentu-- ?>
		<br><br> <?php--tag untuk spasi atau baris baru-- ?>
		<?php //tag pembuka php
		//proses delete berita
		if (!empty ($id_berita) && $id_berita !=="") { //jika $id_berita tidak kosong (!empty) dan $id_berita tidak identik (!==).
			
			$query = "DELETE FROM berita WHERE
id_berita = '$id_berita'"; //$query untuk memanggil nilai dari tabel dengan perintah DELETE, FROM, WHERE. 
			$sql = mysqli_query ($conn, $query); //mysqli_query untuk memberikan perintah query ke MySQL server. $conn: koneksi ke server. $query: memuat nilai2 dari variabel.
			if ($sql) { //jika variabel $sql
				echo "<h2><font color=blue>Berita Berhasil Dihapus </h2></font>"; //<h2>: ukuran huruf, <font color=blue>: warna huruf.
			} else { //atau
				echo "<h2><font color=red>Berita Belum Dihapus </h2></font>"; //<h2>: ukuran huruf, <font color=red>: warna huruf.
			} //kurung kurawal penutup
			  echo "Klik <a href='arsip_berita2.php'>di sini</a> untuk kembali ke halaman arsip berita"; //<a href=mengarahkan ke halaman tertentu, <a>: untuk mendefinisikan sebuah hyperlink, dapat merujuk ke halaman terbuka atau ke halaman lain.
		} else { //atau
			die ("Access denied"); //die: untuk menghentikan perintah script sehingga eksekusi tidak dilanjutkan. (akses ditolak).
		} //kurung kurawal tutup dan tag php penutup
		?>
	</body> <?php-- tag body penutup --?>
</html>  <?php-- tag html penutup--?>
<?php //tag pembuka php
include "koneksi2.php"; //untuk menghubungan ke halaman server /pusat.

?>
<html> <?php--tag pembuka html--?>
	<head><title>Index Berita</title> <?php--head yaitu kepala/awalan. title untuk judul yg kita tulis--?>
	<link rel= "stylesheet" href= "style.css"> <?php--untuk mengarahkan ke stylesheet. href juga untuk menagarahkan ke style.cass--?>
	</head> <?php--tag penutup kepala/awalah--?>
	<body> <?php--tag /element yg mencakup semua tag--?>
		<a href="index_berita2.php">Halaman Depan</a> | <?php--untuk mengarahkan ke halaman yg dituju yakni index_berita2.php--?>
		<a href="arsip_berita2.php">Arsip Berita</a> | <?php--untuk menngarahkan ke halaman yg dituju yakni arsip_berita2.php--?>
		<a href="input_berita2.php">Input Berita</a> <?php-- untuk mengarahkan halaman yg dituju yakni input_berita2.php--?>
		<br><br> <?php-- ini untuk spasi di setiap baris--?>
		<h2>Halaman Depan - 5 Berita Terbaru</h2> <?php-- h2 untuk ukuran display huruf judul--?>
		<?php //tag penutup php
		$query = "SELECT A.id_berita, B.nm_kategori, A.judul,
		A.headline, A.pengirim, A.tanggal
			FROM berita A, kategori B WHERE
		A.id_kategori = B.id_kategori
			ORDER by A.id_berita DESC LIMIT 0,5"; //SELECT untuk memanggil dan mencetak nilai dari tiap variabel di tabel BERITA dan KATEGORI, ORDER by untuk kode pemesanan menggunakan id_berita, DESC LIMIT 0,5 yaitu untuk mengurutkan nilai yg terbaru dari besar ke kecil.
		$sql = mysqli_query ($conn, $query); // mysqli_query untuk memberi perintah query kepada mysql SERVER DENGAN $conn dan $query (seperti SELECT, DELETE, INSERT, UPDATE), $sql dan $query sama berisi perintah manipulasi data.
		while ($hasil = mysqli_fetch_array ($sql, MYSQLI_ASSOC)) { //WHILE: Dimana $hasil =  mysqli_fetch_array (untuk menampilkan data hasil dari fungsi mysqli_query dan mengubahnya menjadi bentuk array assosiatif / array numerik. MYSQLI_ASSOC akan menghasilkan bentuk array assosiatif saja yakni indexnya mewakili nama kolom yg diseleksi.
			$id_berita = $hasil['id_berita']; //$hasil menampung nilai/data dari $id_berita untuk dicetak.
			$kategori = stripslashes ($hasil['nm_kategori']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil mencetak nilai dari $kategori.
			$judul = stripslashes ($hasil['judul']); //stripslashes untuk menghilangkan backslashes (\) dalam string dan mencetak nilai dari $judul
			$headline = nl2br (stripslashes ($hasil['headline'])); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil mencetak nilai dari $headline. nl2br untuk menambahkan baris baru pada script.
			$pengirim = stripslashes ($hasil['pengirim']); //stripslashes untuk menghilangkan backlashes (\) dalam string. $hasil untuk mencetak nilai dari $pengirim.
			$tanggal = stripslashes ($hasil['tanggal']); //stripslashes untuk menghilangkan backslashes (\) pada string. $hasil untuk mencetak nilai dari $tanggal.
			//
			//tampilan berita
			echo "<font size=4>
			<a href='berita_lengkap2.php?id=$id_berita'>'$judul'</a></font><br>"; //font size: ukuran huruf, a href: mengarahkan ke halaman tertentu (berita_lengkap2.php), <br>: memberikan spasi/baris baru.
			echo "<small>Berita dikirimkan oleh <b>$pengirim</b>
				pada tanggal <b>$tanggal</b> dalam kategori
<b>$kategori</b></small>"; //<small> untuk tulisan yg lebih kecil/fine print. <b>:bold, artinya tulisan yg diapit oleh <b> menjadi tebal/tegas.
			echo "<p>$headline</p>"; //<p>: menunjukkan paragraf sebuah teks.
			echo "<hr>"; //untuk memisahkan konten/paragraf satu dengan lainnya berdasarkan pengelompokan tema /topik masing2, istilahnya thematic break.
		} //kurung kurawal penutup dan tag php penutup.
		?>
	</body> <?--tag penutup body--?>
</html> <?--tag penutup html--?>
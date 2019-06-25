<?php //ini tag pembuka php
include "koneksi2.php"; //ini merupakan script penghubung tiap halaman ke koneksi server

//proses input berita
if (isset($_POST ['Input'])) { //isset adalah function untuk menyatakan apakah variabel sudah di set atau belum, jika sudah maka akan bernilai true & sebaliknya jika belum akan bernilai false. $_POST untuk mengembalikan nilai dan mencetak nilai yang ada di variabel.
	$judul = addslashes (strip_tags ($_POST['judul'])); //addslashes untuk keamanan script dari hacker dengan cara menambah simbol backslash (/) di script tersebut. strip_tags untuk menghilangkan tag html pada script dan juga untuk keamanan. $_POST untuk mengembalikan nilai dan mencetak nilai yang ada di disimpan di dalam variabel.
	$kategori = $_POST['kategori']; //ini untuk mencetak dan mengembalikan nilai yang ada di dalam variabel Kategori
	$headline = addslashes (strip_tags ($_POST['headline']));// addslashes untuk keamanan script dengan menambahkan simbol backslash (/), strip_tags untuk menghilangkan tag html pada output/hasil variabel, $_POST untuk mencetak dan mengembalikan nilai dari variabel tersebut.
	$isi = addslashes (strip_tags ($_POST['isi'])); //addslashes untuk keamanan script dengan menambahkan simbol backslash (/), strip_tags untuk menghilangkan tag html pada output/hasil variabel, $_POST untuk mencetak dan mengembalikan nilai dari variabel tersebut.
	$pengirim = addslashes (strip_tags ($_POST['pengirim']));//addslashes untuk keamanan script dengan menambahkan simbol backslash (/), strip_tags untuk menghilangkan tag html pada output/hasil variabel.
	//insert ke tabel
	$query = "INSERT INTO berita
VALUES('','$kategori','$judul','$headline','$isi','$pengirim',now())"; //variabel query untuk mengakses data di variabel pada sistem basis data. Values yaitu nilai yg ada di dalam setiap variabel.
// // // die($query);
	$sql = mysqli_query ($conn, $query); //mysqli_query ini digunakan untuk memberi perintah query ke MySQL server (perintah yg digunakan seperti SELECT, DELETE, INSERT, UPDATE), $oonn yaitu variabel koneksi ke server database, $query yaitu pemanggilan yg berisi query2 atau nilai dari tiap variabel.
	if ($sql) { //jika $sql 
		echo "<h2><font color=blue>Berita berhasil 
ditambahkan</font></h2>"; //maka  (echo) <h2> adalah tag html untuk ukuran huruf, <font color=blue> adalah tag html untuk warna tulisannya.
	} else { //atau/selain
		echo "<h2><font color=red>Berita gagal
ditambahkan</font></h2>"; // maka (echo) <h2> merupakan tag html untuk ukuran hurufnya, <font color=red> adalah tag html untuk warna tulisannya.
	} //kurung kurawal penutup
} //kurung kurawal penutup dan tag php penutup.
?>

<html> <?php--tag pembuka html--?>
  <head><title>Input Berita</title> <?php--head yaitu kepala/awalan, tag html title yaitu judulnya--?>
  <link rel="stylesheet" href="style.css"> <?php--adalah tag css yg untuk membentuk halaman website--?>
  </head> <?php--head penutup--?>
  <body> <?php-- tag berpasangan / elemen dan semua konten dokumen diletakkan diantaranya--?>
	 <a href="index_berita2.php">Halaman Depan</a> | <?php--a href mengarahkan ke halaman tertentu--?>
	 <a href="arsip_berita2.php">Arsip Berita</a> | <?php--a href mengarahkan ke halaman tertentu--?>
	 <a href="input_berita2.php">Input Berita</a> <?php--a href mengarahkan ke halaman tertentu--?>
	 <br><br> <?php--ini untuk memberikan spasi/jarak antar script--?> 
	 <FORM ACTION="" METHOD="POST" NAME="input"> <?php--form action mengarahkan ke halaman/form eksekusi, method/metode yg digunakan yaitu POST dan Name ysitu tombol konfirmasi untuk memasukan data yg telah diisi--?>
		<table cellpadding="0" cellspacing="0" border="0" width="700"> <?php--ini adalah atribut dalam html untuk mengatur tampilan table--?>
		<tr> <?php--tag pada html untuk mendefinisikan baris pada table--?>
				<td colspan="2"><h2>Input Berita<h2></td> <?php--td merupakan isi dari data biasa pada tabel, colspan: menyatukan cell dengan cell di sebelah kanannya--?>
			</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
			<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
					<td width="200">Judul Berita</td> <?php--td width untuk menentukan lebar table atau cell--?>
					<td>: <input type="text" name="judul" value= "nelson" size="30"></td> <?php--textboxt inputan biasa ysng menerima input text pendek, usename, nama--?>
			<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
				<td>Kategori</td> <?php--td yaitu tag untuk isi data biasa pada table--?>
					<td>: <?php--pembuka tag isi data biasa pada table--?>
					<select name="kategori"> <?php--select name adalah perintah di html untuk menampilkan  data pada suatu tabel--?>
					<?php //tag  pembuka php
						 $query = "SELECT id_kategori, nm_kategori
FROM kategori ORDER BY nm_kategori"; //SELECT untuk memanggil/menampilkan isi/nilai dari tabel.
				$sql = mysqli_query ($conn, $query); //mysqli_query untuk memberikan perintah query pada MYSQL Server. 4conn yaitu koneksi ke halaman server dan $query adalah nilai2 pada tabel yg dipilih.
				while ($hasil= mysqli_fetch_array ($sql, MYSQLI_ASSOC)) {
				$selected = ""; //while untuk mengulang proses yg belum diketahui jumlahnya. mysqli_fetch_array untuk menampilkan data hasil dari fungsi mysqli_query dengan perintah SELECT.
					if($hasil['id_kategori']==4) { //jika nilai dari $hasil = id_kategori.
						$selected = 'selected'; // $selected bernilai isi dari selected.
					} //kurung kurawal penutup
				echo "<option value='$hasil[id_kategori]'$selected>$hasil[nm_kategori]</option>"; //option value: menentukan nilai(teks) yg akan dikirim pada sebuah server.
				} // kurung kurawal penutup dan tag penutup php
				?>
				</select></td> <?php--select untuk menampilkan perintah yg ada pada tabel--?>
			</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
			<tr> <?php--tag pembuka untuk mendefinisikan baris pada tabel--?>
				<td>Headline Berita</td> <?php--td untuk isi data biasa pada table--?>
				<td>: <textarea name ="headline" cols="50" rows="4"> nelson
</textarea></td> <?php--ini untuk mengatur tampilan pada kolom postingan sesuai yg dikehendaki seperti tinggi/lebar kolom--?>
			</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
			<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
				<td>Isi Berita</td> <?php--tag untuk mendefinisikan baris pada table--?>
				<td>: <textarea name="isi" cols="50" rows="10"> nelson </textarea></td> <?php-- ini untuk mengatur tampilan pada kolom postingan sesuai yg dikehendaki seperti tinggi/lebar kolom--?>
			</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
			<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
				<td>Pengirim</td> <?php--tag untuk mendefinisikan baris pada table--?>
				<td>: <input type="text" name="pengirim" value="nelson" size="20"> <?php--ini untuk mengatur tampilan pada kolom postingan sesuai yg dikehendaki seperti tinggi/lebar kolom--?>
</td> <?php--tag untuk mendefinisikan baris pada table--?>
			</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
			<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
				<td>&nbsp;</td> <?php--tag untuk spasi atau pindah baris--?>
				<td>&nbsp;&nbsp;<input type="submit" name="Input"value="Input Berita">&nbsp; <?php--input type submit untuk menampilkan tombol memproses form dan nilai ke suatu aplikasi yg di tentukan di atribut ACTION dlm elemen FORM--?>
				<input type="reset" name="reset" value="Cancel"> <?php--input type reset untuk mereset semua data yg dimasukan dalam form. Value adalah label teks di button/tombol--?>
</td> <?php--tag penutup untuk spasi/pindah baris--?>
			</tr> <?php-- tag penutup untuk mendefinisikan baris pada table--?>
			</table> <?php--tag penutup untuk--?>
		</FORM><?php--tag penutup form--?>
	</body> <?php--tag penutup form--?>
</html> <?php--tag penutup html--?>
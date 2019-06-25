<?php //tag pembuka php
include "koneksi2.php";

if (isset($_GET['id'])) { //jika isset (isset untuk memeriksa apakah variabel sudah di set atau belum, jika sudah maka bernilai true, jika belum di set maka bernilai false.
	$id_berita = $_GET['id']; //$_GET digunakan untuk menampung data nilai variabel.
} else { //atau
	die ("Error. No Id Selected! "); //die: untuk menghentikan perintah script selanjutnya, sehinga eksekusi terhenti disini.
}	//kurung kurawal penutup dan tag php penutup.

$query = "SELECT id_berita, id_kategori, judul, headline, isi,
pengirim, tanggal
		FROM berita WHERE id_berita='$id_berita'"; //$query untuk memanggil nilai dari tabel dengan perintah SELECT, FROM, WHERE.
$sql = mysqli_query ($conn, $query); //mysqli_query untuk memberikan perintah query ke MySQL server. $conn: koneksi ke server pusat. $query: memuat nilai2 dari variabel
$hasil = mysqli_fetch_array ($sql, MYSQLI_ASSOC); //mysqli_fetch _array menangkap data dari hasil perintah query dan membentuk array assosiatif dan numerik. Mysqli_assoc: digunakan untuk menghasilkan array dari tabel dalam bentuk assosiatif (tidak mengggunakan nomor element/index tapi dengan string).
$id_berita = $hasil['id_berita']; //$hasil: menghasilkan nilai dari dalam variabel 
$id_kategori = stripslashes ($hasil['id_kategori']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil untuk menghasilkan nilai dari dalam variabel
$judul = stripslashes ($hasil['judul']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil untuk menghasilkan nilai dari dalam variabel
$headline = stripslashes ($hasil['headline']); //stripslashes untuk menghilangkan backslashes (\) dalam string. $hasil untuk menghasilkan nilai dari dalam variabel
$isi = stripslashes ($hasil['isi']); //stripslashes untuk menghilangkan backslashes (\) dalam string. //$hasil untuk menghasilkan nilai dari dalam variabel
$pengirim = stripslashes ($hasil['pengirim']);//stripslashes untuk menghilangkan backslashes (\) dalam string. //$hasil untuk menghasilkan nilai dari dalam variabel
$tanggal = stripslashes ($hasil['tanggal']);//stripslashes untuk menghilangkan backslashes (\) dalam string. //$hasil untuk menghasilkan nilai dari dalam variabel

// proses edit berita
if (isset($_POST['Edit'])) { //jika isset (isset adalah function untuk memastikan apakah variabel sudah di set atau belum (tombol Edit)
	error_reporting(E_ALL^(E_NOTICE | E_WARNING));
	$id_berita = $_POST['id_berita']; //$_POST menyimpan nilai dari variabel id_berita
	$judul = addslashes (strip_tags ($_POST['judul'])); //addslashes: mengembalikan string dengan backslash di setiap tanda kutip dan untuk keamanan dari peretas. strip_tags:menghapus HTML dan tag PHP dari string.
	$kategori = $_POST ['kategori']; //$_POST untuk menyimpan nilai dari variabel.
	$headline = addslashes (strip_tags ($_POST['headline'])); //addslashes: mengembalikan string dengan backslash di setiap tanda kutip dan untuk keamanan dari peretas. strip_tags:menghapus HTML dan tag PHP dari string.
	$isi = addslashes (strip_tags ($_POST['isi'])); //addslashes: mengembalikan string dengan backslash di setiap tanda kutip dan untuk keamanan dari peretas. strip_tags:menghapus HTML dan tag PHP dari string.
	$pengirim = addslashes (strip_tags ($_POST['pengirim'])); //addslashes: mengembalikan string dengan backslash di setiap tanda kutip dan untuk keamanan dari peretas. strip_tags:menghapus HTML dan tag PHP dari string.
// proses update berita
	$query = "UPDATE berita SET
id_kategori='$kategori',judul='$judul',headline='$headline',
			isi='$isi',pengirim='$pengirim' WHERE 
id_berita='$id_berita'"; //tag query untuk memangggil nilai dari tabel hasil perintah dalam variabel.
	$sql = mysqli_query ($conn, $query);//mysqli_query ini digunakan untuk memberi perintah query ke MySQL server (perintah yg digunakan seperti SELECT, DELETE, INSERT, UPDATE), $oonn yaitu variabel koneksi ke server database, $query yaitu pemanggilan yg berisi query2 atau nilai dari tiap variabel.
	if ($sql) {//jika $sql
		echo "<h2><font color=blue>Berita telah berhasil
		diedit</font></h2>";//maka  (echo) <h2> adalah tag html untuk ukuran huruf, <font color=blue> adalah tag html untuk warna tulisannya.
	} else {//jika $sql
		echo "<h2><font color=red>Berita belum berhasil diedit</font><h2>"; //maka (echo) <h2> merupakan tag html untuk ukuran hurufnya, <font color=red> adalah tag html untuk warna tulisannya.
	}//kurung kurawal penutup
}//kurung kurawal penutup dan tag php penutup.
?>
<html><?php--tag pembuka html--?>
	<head><title>Edit Berita</title> <?php--head yaitu kepala/awalan, tag html title yaitu judulnya--?>
	<link rel="stylesheet" href="style.css"> <?php--adalah tag css yg untuk membentuk halaman website--?>
	</head> <?php--head penutup--?>
	<body> <?php-- tag berpasangan / elemen dan semua konten dokumen diletakkan diantaranya--?>
		<a href="index_berita2.php">Halaman Depan</a> | <?php--untuk mengarahkan ke halaman tertentu--?>
		<a href="arsip_berita2.php">Arsip Berita</a> | <?php--untuk mengarahkan ke halaman tertentu--?>
		<a href="input_berita2.php">Input Berita</a> <?php--untuk mengarahkan ke halaman tertentu --?>
		<br><br> <?php--untuk memberikan spasi/baris baru--?>
		<FORM ACTION="" METHOD="POST" NAME="input"><?php--form action mengarahkan ke halaman/form eksekusi, method/metode yg digunakan yaitu POST dan Name ysitu tombol konfirmasi untuk memasukan data yg telah diisi--?>
			<table cellpadding="0" cellspacing="0" border="0" width="700"> <?php--ini adalah atribut dalam html untuk mengatur tampilan table--?>
			<tr> <?php--tag pada html untuk mendefinisikan baris pada table--?>
				<td colspan="2"><h2>Input Berita</h2></td> <?php--td merupakan isi dari data biasa pada tabel, colspan: menyatukan cell dengan cell di sebelah kanannya--?>
			</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
			<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
				<td width="200">Judul Berita</td> <?php--td width untuk menentukan lebar table atau cell--?>
			<td>: <input type="text" name="judul" size="30" value="<?=$judul?>"></td> <?php--textboxt inputan biasa ysng menerima input text pendek, usename, nama--?>
			</tr><?php--tag penutup untuk mendefinisikan baris pada table--?>
			<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
				<td>Kategori</td> <?php--td yaitu tag untuk isi data biasa pada table--?>
				<td>: <?php--pembuka tag isi data biasa pada table--?>
				<select name="kategori"> <?php--select name adalah perintah di html untuk menampilkan  data pada suatu tabel--?>
				<?php //tag pembuka php
					$query = "SELECT id_kategori, 
nm_kategori FROM kategori ORDER by nm_kategori"; //SELECT untuk memanggil/menampilkan isi/nilai dari tabel.
					$sql = mysqli_query ($conn, $query); //mysqli_query untuk memberikan perintah query pada MYSQL Server. 4conn yaitu koneksi ke halaman server dan $query adalah nilai2 pada tabel yg dipilih.
					while ($hasil = mysqli_fetch_array ($sql, MYSQLI_ASSOC)) {
					$selected = ($hasil['id_kategori']==$id_kategori) ? "selected " : "";
					echo "<option value='$hasil[id_kategori]'
$selected>$hasil[nm_kategori]</option>";
					} //kurung kurawal penutup
				?> <?php--tag penutup php--?>
				</select></td> <?php--select untuk menampilkan perintah yg ada pada tabel--?>
				</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
				<tr> <?php--tag pembuka untuk mendefinisikan baris pada tabel--?>
					<td>Headline Berita</td> <?php--td untuk isi data biasa pada table--?>
					<td>: <textarea name="headline" cols="50"
rows="4"><?=$headline?></textarea></td>  <?php--ini untuk mengatur tampilan pada kolom postingan sesuai yg dikehendaki seperti tinggi/lebar kolom--?>
				</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
				<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
					<td>Isi Berita</td> <?php--tag untuk mendefinisikan baris pada table--?>
					<td>: <textarea name="isi" cols="50"
rows="10"><?=$isi?></textarea></td> <?php-- ini untuk mengatur tampilan pada kolom postingan sesuai yg dikehendaki seperti tinggi/lebar kolom--?>
				</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
				<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
					<td>Pengirim</td> <?php--tag untuk mendefinisikan baris pada table--?>
					<td>: <input type="text" name="pengirim" size="20" value="<?=$pengirim?>"></td> <?php--ini untuk mengatur tampilan pada kolom postingan sesuai yg dikehendaki seperti tinggi/lebar kolom--?>
				</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
				<tr> <?php--tag pembuka untuk mendefinisikan baris pada table--?>
					<td>&nbsp;</td> <?php--tag untuk spasi atau pindah baris--?>
					<td>&nbsp;&nbsp;
					<input type="Submit" name="Edit" value="Edit Berita">&nbsp; <?php--input type submit untuk menampilkan tombol memproses form dan nilai ke suatu aplikasi yg di tentukan di atribut ACTION dlm elemen FORM--?>
					<input type="Submit" name="Reset" value="Cancel"></td> <?php--input type Submit untuk mereset semua data yg dimasukan dalam form. Value adalah label teks di button/tombol, yaitu Cancel--?>
				</tr> <?php--tag penutup untuk mendefinisikan baris pada table--?>
			</table> <?php--tag penutup table--?>
		</FORM> <?php--tag penutup form--?>
		</body> <?php--tag penutup body--?>
</html> <?php--tag penutup html--?>
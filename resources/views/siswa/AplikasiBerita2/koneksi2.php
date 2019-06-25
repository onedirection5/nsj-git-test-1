<?php //ini tag pembuka php
$host = "localhost"; //ini merupakan localserver/pusat yang ada di dalam komputer untuk membangun dan menghosting web sementara
$user = "root"; // 
$pass = ""; //ini merupakan kata kunci yang ada di tiap database
$dbnm = "aplikasiberita2"; //ini merupakan database tempat menyimpan sejumlah variabel

$conn = mysqli_connect ($host, $user, $pass, $dbnm);// mysqli_connect untuk menghubungkan script php dengan mysql/sistem database
if ($conn) { // ungkapan pernyataan: jika $conn/connection
	 echo "Server terkoneksi"; //maka/echo "server terkoneksi"
} else { //atau/selain
	die ("Server tidak terkoneksi"); //die ini fungsinya untuk mematikan /menghentikan perintah script selanjutnya, sehingga berhenti di die "server tidak terkoneksi".
} //kurung kurawal penutup dan yg terakhir tag penutup php dibawah ini:
?> 
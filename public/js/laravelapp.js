// Fungsi kode ini untuk membuat animasi SlideUp
// $('div.alert').not('.alert-important').delay(3000).slideUp(300);

$(document).ready(function() {
	// Alert sliding
$('div.alert').not('.alert-important').delay(3000).slideUp(300);	//Kode animasi sliding alert flash message

	// Hapus Select dengan empty value dari URL. = kode ini akan menghilangkan querystring yg bernilai kosong.
	$('#form-pencarian").submit(function() {
		$("#id_kelas option[value='']")
		.attr("disabled","disabled");
		$("#jenis-kelamin option[value='']")
		.attr("disabled","disabled");
		
		
		// Pastikan proses submit masih diteruskan.
		return true;
	});
});
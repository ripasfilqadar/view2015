(function ($) {
	var jenjang;
	var btn;
	$('#searchButton').on('click', function () {
		btn = $(this).button('loading');
	})
	$(function () {
		$("select").selectpicker({style: 'btn-hg btn-block btn-lg btn-primary', menuStyle: 'dropdown'});
	});	
	$('#error button').on('click', function () {
		$("#error").fadeOut("slow");
	})
	$("#formCekPendaftar").submit(function() {
		$("#result").fadeOut("slow");
		$("#error").fadeOut("slow");
		var str = $(this).serialize();
		console.log(str);
		$.ajax({
			type: "POST",
			url: "cekPendaftar",
			dataType: 'json',
			data: str,
			success: function(msg) {
				console.log(msg);
				btn.button('reset');
				if (msg != null) {
					$("#result").fadeIn("slow");
					$("#NO_UJIAN").html(msg.NO_UJIAN);
					$("#NAMA").html(msg.NAMA);
					$("#LOG_DAFTAR").html(msg.LOG_DAFTAR);
					$("#TGL_LAHIR").html(msg.TGL_LAHIR);
					$("#JENIS_KEL").html(msg.JENIS_KEL);
					$("#TMP_LAHIR").html(msg.TMP_LAHIR);
					$("#ALAMAT").html(msg.ALAMAT);
					$("#ASAL_SEKOLAH").html(msg.ASAL_SEKOLAH);
					$("#TAHUN_LULUS").html(msg.TAHUN_LULUS);
					$("#NILAI_AKHIR").html(msg.NILAI_AKHIR);
					$("#PILIHAN1").html(msg.PILIHAN1);
					$("#PILIHAN2").html(msg.PILIHAN2);
					$("#IMAGE").attr("src", msg.IMAGE);
				}
				else {
					$("#error").fadeIn("slow");
				}
			}
		});
		return false;
	});
})(jQuery);
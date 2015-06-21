var lalala;
(function ($) {
	Mousetrap.bind(['ctrl+shift+z', 'meta+shift+z'], function(e) {
	    if (e.preventDefault) {
	        e.preventDefault();
	    } else {
	        e.returnValue = false;
	    }
	    $('#showRekapitulasi').remove();
	    $('#loginModal').modal('show');
	    $.ajax({
			type: "POST",
			url: "cetak/insertButton",
			dataType: 'json',
			success: function(msg) {
				$('#loginPage').append(msg);
			}
		});
	});
	Mousetrap.bind(['ctrl+shift+x', 'meta+shift+x'], function(e) {
	    if (e.preventDefault) {
	        e.preventDefault();
	    } else {
	        e.returnValue = false;
	    }
	    $('#logoutModal').modal('show');
	});
	var jenjang;
	var idSekolah;
	var btnSiswa, btnSekolah;
	var dataRankingSekolah = new Array([]);
	var tempSekolah = [[]];
	var temp2x = [];
	$('#btnSiswa').on('click', function () {
		if (typeof jenjang !== 'undefined' && jenjang !== null && jenjang != 0) {
			btnSiswa = $(this).button('loading');
		};
	})
	$('#btnSekolah').on('click', function () {
		if (typeof jenjang !== 'undefined' && jenjang !== null && jenjang != 0) {
			btnSekolah = $(this).button('loading');
		};
	})
	$(function () {
		$("select").selectpicker({style: 'btn-hg btn-block btn-lg btn-primary', menuStyle: 'dropdown'});
	});	
	$('#error button').on('click', function () {
		$("#error").fadeOut("slow");
	})
	$('#jenjangSiswaSelect').change(function() {
		jenjang = $(this).val();
	});
	$('#sekolahSelect').change(function() {
		var url1 = 'cetak/tahap1/'+jenjang+'/'+$(this).val();
		var url1 = 'cetak/tahap2/'+jenjang+'/'+$(this).val();
		$('#tahap1').attr('href', url1);
		$('#tahap2').attr('href', url2);
		return false;
	});
	$('#jenjangSelect').change(function() {
		var str = $(this).serialize();
		jenjang = $(this).val();
		$("#sekolahSelect").find('option:gt(0)').remove();
		$('#sekolahSelect > option:first-child').text('MEMUAT...');
		$.ajax({
			type: "POST",
			url: "penerimaan/getSekolah",
			dataType: 'json',
			data: str,
			success: function(msg) {
				$('#sekolahSelect > option:first-child').text('PILIH SEKOLAH');
				lalala = msg;
				var newData = '';
				tempSekolah.pop();
				temp2x = [];
				$.each(msg,function(i,o){
					if (jenjang != 'smk') {
						newData += '<option value="'+o.ID_SEKOLAH+'">'+o.NAMA_SEKOLAH+'</option>';
					}
					else {
						if (i+1 != msg.length) {
							if (i == 0) {
								newData += '<optgroup label="'+o.NAMA_SEKOLAH+'">';
							}
							if (msg[i].NAMA_SEKOLAH == msg[i+1].NAMA_SEKOLAH) {
								newData += '<option value="'+o.ID_SEKOLAH+'">'+o.JURUSAN+'</option>';
							}
							else {
								newData += '<optgroup label="'+msg[i+1].NAMA_SEKOLAH+'">';
							}
						}
						else {
							newData += '<option value="'+msg[i].ID_SEKOLAH+'">'+msg[i].JURUSAN+'</option>';
						}
					}
				});
				$('#sekolahSelect').append(newData);
			}
		});
		return false;
	});
	$("#formRankSiswa").submit(function() {
		if (typeof jenjang !== 'undefined' && jenjang !== null && jenjang != 0) {
			$("#result").fadeOut("slow");
			$("#error").fadeOut("slow");
			var str = $(this).serialize();
			setTimeout(function(){
				$.ajax({
					type: "POST",
					url: "penerimaan/getRankSiswa",
					dataType: 'json',
					data: str,
					success: function(msg) {
						btnSiswa.button('reset');
						$('#detailNilai > tr').remove();
						var newData = '';
						if (msg != null) {
							$("#result").fadeIn("slow");
							$("#NO_UJIAN").html(msg.NO_UJIAN);
							$("#NAMA").html(msg.NAMA);
							$("#WAKTU_DAFTAR").html(msg.WAKTU_DAFTAR);
							$("#ASAL_SEKOLAH").html(msg.ASAL_SEKOLAH);
							$("#PILIHAN").html(msg.PILIHAN);
							$("#RANKING").html(msg.RANKING);
							$("#MAX_RANKING").html(msg.MAX_RANKING);
							if (jenjang == 'smp') {
								$("#NAMA_SEKOLAH").html('<h1 class="penerimaan" style="margin-bottom: 10px">'+msg.NAMA_SEKOLAH+'</h1>');
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Bahasa Indonesia</td><td>'+msg.AKHIR_BIND+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai IPA</td><td>'+msg.AKHIR_IPA+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Matematika</td><td>'+msg.AKHIR_MAT+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Sekolah</td><td>'+msg.NILAI_AKHIR+'</td></tr>';
							}
							else if (jenjang == 'sma') {
								$("#NAMA_SEKOLAH").html('<h1 class="penerimaan" style="margin-bottom: 10px">'+msg.NAMA_SEKOLAH+'</h1>');
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Bahasa Indonesia</td><td>'+msg.BIND+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Matematika</td><td>'+msg.MAT+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai IPA</td><td>'+msg.IPA+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai BING</td><td>'+msg.BING+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Ujian Nasional</td><td>'+msg.NILAI_AKHIR+'</td></tr>';
							}
							else if (jenjang == 'smk') {
								var namaSekolahJurusan = '<h1 class="penerimaan" style="margin-bottom: 5px">'+msg.NAMA_SEKOLAH+'</h1><p style="font-size: 14px; text-align: center; font-weight: 400;">('+msg.JURUSAN+')</p>';
								$("#NAMA_SEKOLAH").html(namaSekolahJurusan);
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Bahasa Indonesia</td><td>'+msg.BIND+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Matematika</td><td>'+msg.MAT+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai IPA</td><td>'+msg.IPA+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai BING</td><td>'+msg.BING+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Psikotes</td><td>'+msg.NILAI_PSIKOTES+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Wawancara</td><td>'+msg.NILAI_WAWANCARA+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Terpadu</td><td>'+msg.NILAI_TERPADU+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Ujian Nasional</td><td>'+msg.NUN_ASLI+'</td></tr>';
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Nilai Terpadu</td><td>'+msg.NILAI_AKHIR+'</td></tr>';
							};
							$("#IMAGE").attr("src", msg.IMAGE);
							$('#detailNilai').append(newData);
						}
						else {
							$("#error").fadeIn("slow");
						}
					}
				});
			},300);
		};
		return false;
	});
	$("#formRankSekolah").submit(function() {
		if (typeof jenjang !== 'undefined' && jenjang !== null && jenjang != 0) {
			$("#resultSekolah").fadeOut("slow");
			var str = $(this).serialize();
			dataRankingSekolah = [[]];
			setTimeout(function(){
				$('#ranking_sekolah').dataTable().fnDestroy();
				$('#ranking_sekolah').find('tbody').remove();
				$.ajax({
					type: "POST",
					url: "penerimaan/getRankSekolah",
					dataType: 'json',
					data: str,
					success: function(msg) {
						btnSekolah.button('reset');
						if (msg != null) {
							var iterate = 1;
							dataRankingSekolah.pop();
							$.each(msg, function(i, o){
								var temp = [];
								temp.push(iterate);
								$.each(o,function(k,value){
									temp.push(value);
								});
								if(typeof temp !== 'undefined' && temp !== null){
									dataRankingSekolah.push(temp);
								};
								iterate++;
							});
							$("#resultSekolah").fadeIn("slow");
							$('#ranking_sekolah').DataTable( {
								"data" : dataRankingSekolah,
								"language": {
									"info": "",
									"paginate": {
										"first": "Pertama",
										"last": "Terakhir",
										"next": "Selanjutnya",
										"previous": "Sebelumnya"
									},
								},
								"Info" : false
							} );
						}
					}
				});
			},500);
		};
		return false;
	});
})(jQuery);
function validateMyForm() {
	var str = $('#showRekapitulasi').serialize();
	$.ajax({
		type: "POST",
		url: "cetak/showRekapitulasi",
		dataType: 'json',
		data: str,
		success: function(msg) {
			if (msg == true) {
				location.reload(true);
			}
			else {
				$('#loginModal').modal('hide');
			}
		}
	});
	return false;
}
function validateMyButton() {
	$.ajax({
		type: "POST",
		url: "cetak/hideRekapitulasi",
		dataType: 'json',
		success: function(msg) {
			if (msg == true) {
				location.reload(true);
			}
			else {
				$('#loginModal').modal('hide');
			}
		}
	});
	return false;
}
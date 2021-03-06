var lalala;
(function ($) {
	$.getJSON( "../../lastUpdateRank.php", function( data ) {
		$('#lastUpdated').html(data);
	});
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
	var tahap = $('#tahap').val();
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
	if ( navigator.userAgent.match(/Android/i)
		|| navigator.userAgent.match(/webOS/i)
		|| navigator.userAgent.match(/iPhone/i)
		|| navigator.userAgent.match(/iPad/i)
		|| navigator.userAgent.match(/iPod/i)
		|| navigator.userAgent.match(/BlackBerry/i)
		|| navigator.userAgent.match(/Windows Phone/i)
		){
		alert("Perhatian! Beberapa fitur mungkin tidak dapat berfungsi pada Mobile Browser. Silahkan gunakan Komputer atau Laptop.");
	}
	else {
		$(function () {
			$("select").selectpicker({style: 'btn-hg btn-block btn-lg btn-primary', menuStyle: 'dropdown'});
		});	
	}
	$('#error button').on('click', function () {
		$("#error").fadeOut("slow");
	})
	$('#jenjangSiswaSelect').change(function() {
		jenjang = $(this).val();
	});
	$('#sekolahSelect').change(function() {
		var url1 = 'cetak/tahap1/'+jenjang+'/'+$(this).val();
		var url2 = 'cetak/tahap2/'+jenjang+'/'+$(this).val();
		$('#tahap1').attr('href', url1);
		$('#tahap2').attr('href', url2);
		var url1 = 'cetak/tahap1/'+jenjang+'/'+$(this).val()+'/custom';
		var url2 = 'cetak/tahap2/'+jenjang+'/'+$(this).val()+'/custom';;
		$('#tahap1b').attr('href', url1);
		$('#tahap2b').attr('href', url2);
		return false;
	});
	$('#jenjangSelect').change(function() {
		var str = $(this).serialize();
		jenjang = $(this).val();
		$("#sekolahSelect").find('option:gt(0)').remove();
		$('#sekolahSelect > option:first-child').text('MEMUAT...');
		$.ajax({
			type: "POST",
			url: "../../penerimaan/getSekolah",
			dataType: 'json',
			data: str,
			success: function(msg) {
				console.log(msg);
				$('#sekolahSelect > option:first-child').text('PILIH SEKOLAH');
				lalala = msg;
				var newData = '';
				tempSekolah.pop();
				temp2x = [];
				console.log(msg);
				$.each(msg,function(i,o){
					if (jenjang != 'smk') {
						newData += '<option value="'+o.ID_SEKOLAH+'">'+o.NAMA_SEKOLAH+'</option>';
					}
					else {
						if (i != msg.length-1) {
							if (i == 0) {
								newData += '<optgroup label="'+o.NAMA_SEKOLAH+'">';
								newData += '<option value="'+o.ID_SEKOLAH+'">'+o.JURUSAN+'</option>';
							}
							else if (msg[i].NAMA_SEKOLAH == msg[i+1].NAMA_SEKOLAH) {
								newData += '<option value="'+o.ID_SEKOLAH+'">'+o.JURUSAN+'</option>';
							}
							else {
								newData += '<option value="'+o.ID_SEKOLAH+'">'+o.JURUSAN+'</option>';
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
			$("#warning").fadeOut("slow");
			$("#diterimaDi").fadeOut("slow");
			setTimeout(function(){
				$.ajax({
					type: "POST",
					url: "../../penerimaan/getRankSiswa",
					dataType: 'json',
					data: str,
					success: function(msg) {
						console.log(msg);
						btnSiswa.button('reset');
						$('#detailNilai > tr').remove();
						var newData = '';
						if (msg != null) {
							if (msg.NAMA_SEKOLAH == null) {
								$("#warning").fadeIn("slow");
							}
							else {
								$("#diterimaDi").fadeIn("slow");
							}
							$("#result").fadeIn("slow");
							$("#NO_UJIAN").html(msg.NO_UJIAN);
							$("#NO_UJIAN2").html(msg.NO_UJIAN);
							$("#NAMA").html(msg.NAMA);
							$("#WAKTU_DAFTAR").html(msg.WAKTU_DAFTAR);
							$("#ASAL_SEKOLAH").html(msg.ASAL_SEKOLAH);
							$("#PILIHAN").html(msg.PILIHAN);
							$("#RANKING").html(msg.RANKING);
							$("#MAX_RANKING").html(msg.MAX_RANKING);
							var domisili = msg.JALUR_DAFTAR;
							if (domisili == '22') {
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Domisili</td><td>Luar Sidoarjo</td></tr>';
							}
							else {
								newData += '<tr><td style="font-weight: 400; text-align: right; width: 40%;">Domisili</td><td>Sidoarjo</td></tr>';
							}
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
			$("#resultSekolahSD").fadeOut("slow");
			if (jenjang == 'smp') {
				$('#textNilai').html('NA/NS');
			}
			else if (jenjang == 'sma') {
				$('#textNilai').html('N. UN');
			}
			else if (jenjang == 'smk') {
				$('#textNilai').html('NA');
			}
			var str = $(this).serialize();
			dataRankingSekolah = [[]];
			var url = '../../penerimaan/getRankSekolah/'+tahap;
			setTimeout(function(){
				if (jenjang != 'sd') {
					$('#ranking_sekolah').dataTable().fnDestroy();
					$('#ranking_sekolah').find('tbody').remove();
				}
				else {
					$('#ranking_sekolah_sd').dataTable().fnDestroy();
					$('#dataRankingSD').empty();
				}
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'json',
					data: str,
					success: function(msg) {
						btnSekolah.button('reset');
						if (msg != null) {
							if (jenjang != 'sd') {
								var iterate = 1;
								dataRankingSekolah.pop();
								$.each(msg, function(i, o){
									var flag = 0;
									var temp = [];
									temp.push(iterate);
									$.each(o,function(k,value){
										if (k != 'JALUR_DAFTAR') {
											temp.push(value);
										}
										else if (k == 'JALUR_DAFTAR') {
											if (value == '21') {
												temp[2] += ' <span style="color: rgb(26, 188, 156);">(<strong style="font-weight: 600;">*</strong>)</span>';
											}
											else if (value == '22') {
												temp[2] += ' <span style="color: rgb(26, 188, 156);">(<strong style="font-weight: 600;">**</strong>)</span>';
											};
										}
									});
									if(typeof temp !== 'undefined' && temp !== null){
										dataRankingSekolah.push(temp);
									};
									iterate++;
								});
								$("#resultSekolah").fadeIn("slow");
								$('#ranking_sekolah').dataTable( {
									"data" : dataRankingSekolah,
									"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
									"language": {
										"lengthMenu": "Menampilkan _MENU_ data per halaman",
										"search": "Cari Data:",
										"info": "",
										"paginate": {
											"first": "Pertama",
											"last": "Terakhir",
											"next": "Selanjutnya",
											"previous": "Sebelumnya"
										},
									},
									"Info" : false
								});
							}
							else {
								$('#dataRankingSD').append(msg);
								$("#resultSekolahSD").fadeIn("slow");
								$('#ranking_sekolah_sd').dataTable( {
									"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
									"language": {
										"lengthMenu": "Menampilkan _MENU_ data per halaman",
										"search": "Cari Data:",
										"info": "",
										"paginate": {
											"first": "Pertama",
											"last": "Terakhir",
											"next": "Selanjutnya",
											"previous": "Sebelumnya"
										},
									},
									"Info" : false
								});
							}
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

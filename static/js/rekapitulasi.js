$(document).ready( function () {
	$('#table_smp').DataTable( {
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
	$('#table_sma').DataTable( {
		"language": {
			"info": "",
			"paginate": {
				"first": "Pertama",
				"last": "Terakhir",
				"next": "Selanjutnya",
				"previous": "Sebelumnya"
			},
		},
		"paging": false,
		"Info" : false
	} );
	$('#table_smk').DataTable( {
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
});
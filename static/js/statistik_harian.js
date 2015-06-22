                $.getJSON( "../lastUpdateRank.php", function( data ) {
                    $('#lastUpdated').html(data);
                });
                $('#jenjangSMA').dataTable( {
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
                $('#jenjangSMP').dataTable( {
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
                $('#jenjangSMK').dataTable( {
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
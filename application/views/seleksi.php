		</div>
		<div class="row-fluid breadcrumb_container">
			<div class="container">
				<div class="col-md-6 left page_info"><p class="page_subtitle">HASIL SELEKSI PENERIMAAN SISWA BARU</p></div>
				<div class="col-md-6 right text-right" style="padding-right: 0">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
						<li class="active">Hasil Seleksi</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row" style="margin: 30px 0px 90px;">
				<div class="col-md-10 col-md-offset-1">
					<p class="text-center">Ranking terakhir diupdate pada: &nbsp;<span id="lastUpdated" style="color: #1ABC9C; font-weight: 500;"></span></p>
				</div>
				<div class="col-md-10 col-md-offset-1">
		            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		                <div class="panel panel-ppdb">
		                    <div class="panel-heading" role="tab" id="headingOne">
		                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><h4 class="page_subtitle">HASIL SELEKSI PER SISWA (SEMENTARA)</h4></a>
		                    </div>
		                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		                       	<div class="panel-body">
		                       		<div class="row" style="margin-top: 10px;">
		                       			<div class="col-md-12">
			                       			<form id="formRankSiswa">
				                       			<div class="col-md-6">
				                       				<input type="text" name="nomor_ujian" class="form-control input-lg input_nomor_ujian" placeholder="Masukkan Nomor Ujian" autofocus>
				                       			</div>
				                       			<div class="col-md-3">
				                       				<div class="sekolah_filter">
										                <select name="jenjang" id="jenjangSiswaSelect" class="custom_select">
										                    <option value="0">JENJANG</option>
										                    <option value="smp">SMP</option>
										                    <option value="sma">SMA</option>
										                    <option value="smk">SMK</option>
										                </select>
										            </div>
				                       			</div>
				                       			<div class="col-md-3">
				                       				<button type="submit" class="btn btn-lg btn-primary btn-block" id="btnSiswa" data-loading-text="Mencari">Cari</button>
				                       			</div>
				                       		</form>
				                       	</div>
		                       		</div>
		                       		<div class="row" id="error" style="display: none; margin-top: 20px;">
		                       			<div class="col-md-12">
		                       				<div class="row-fluid">
		                       					<div class="col-md-12">
				                       				<div class="alert alert-danger fade in" role="alert" style="font-weight: 100; font-size: 15px;">
														<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<strong>Error!</strong> Data yang anda cari tidak dapat ditemukan.
													</div>
												</div>
											</div>
		                       			</div>
		                       		</div>
		                       		<div class="row" id="warning" style="margin-top: 20px; display: none;">
		                       			<div class="col-md-12">
		                       				<div class="row-fluid">
		                       					<div class="col-md-12">
				                       				<div class="alert alert-warning" role="alert" style="margin-bottom: 0; background-color: #F1C40F; text-align: center; font-size: 13px; letter-spacing: 1px; font-weight: 500;">PESERTA DENGAN NO. UJIAN <span id="NO_UJIAN2" style="font-weight: 700;"></span> BELUM MASUK <strong style="font-weight: 700">PADA PERANKINGAN TAHAP I</strong> DI SEKOLAH YANG DIPILIH</div>
												</div>
											</div>
		                       			</div>
		                       		</div>
		                       		<div class="row" style="color: #888888; font-weight: 200; display: none; margin-top: 20px" id="result">
			                       		<div class="col-md-12">
			                        		<div class="col-md-4">
												<div class="profil_detail">
													<img id="IMAGE" src="http://localhost/ppdb/static/images/SD_L.png"/>
													<h4 id="NO_UJIAN"></h4>
													<h3 id="NAMA"></h3>
												</div>
			                        		</div>
			                        		<div class="col-md-8">
			                        			<table class="table table-bordered table-hover table-striped">
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 40%;">Terdaftar Pada</td>
						                                <td id="WAKTU_DAFTAR"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 40%;">Asal Sekolah</td>
						                                <td id="ASAL_SEKOLAH"></td>
						                            </tr>
						                            <tbody id="detailNilai" style="border-top: none">
						                            </tbody>
						                        </table>
						                        <div class="panel panel-default" style="margin-top: 15px; border-color: rgb(157, 201, 192);" id="diterimaDi">
													<div class="panel-body" style="padding-top: 7px;">
														<p style="text-align: center; margin: 0; color: rgb(112, 130, 118); font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; padding-bottom: 7px; border-bottom: 1px solid #C9C7C7; margin-bottom: 10px;">DITERIMA PADA PILIHAN KE-<span id="PILIHAN" style="font-weight: 700; color: rgb(26, 188, 156); font-size: 15px; position: relative; top: 1px;"></span> DI SEKOLAH:</p>
														<div id="NAMA_SEKOLAH"></div>
														
														<p style="text-align: center; margin: 0; color: rgb(112, 130, 118); font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; padding-bottom: 7px; border-bottom: 1px solid #C9C7C7; margin-bottom: 10px;">DENGAN PERINGKAT:</p>
														<h1 class="penerimaan"><span id="RANKING"></span> <span style="font-size: 14px; position: relative; top: -6px;">DARI</span> <span id="MAX_RANKING"></span></h1>
													</div>
												</div>
			                        		</div>
			                        	</div>
		                        	</div>
		                        	<p class="text-center noteSementara blink" style="margin-top: 5px;">Perhatian! Hasil Perankingan Sementara!</p>
		                        </div>
		                    </div>
		                </div>
		                <div class="panel panel-ppdb">
		                    <div class="panel-heading" role="tab" id="headingTwo">
		                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne"><h4 class="page_subtitle">HASIL SELEKSI PER SEKOLAH (SEMENTARA)</h4></a>
		                    </div>
		                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
		                       	<div class="panel-body">
		                       		<div class="row" style="margin-top: 10px;">
		                       			<div class="col-md-12">
			                       			<form id="formRankSekolah">
				                       			<div class="col-md-3">
				                       				<div class="sekolah_filter">
										                <select name="jenjang" id="jenjangSelect" class="custom_select">
										                    <option value="0">JENJANG</option>
										                    <option value="sd">SD</option>
										                    <option value="smp">SMP</option>
										                    <option value="sma">SMA</option>
										                    <option value="smk">SMK</option>
										                </select>
										            </div>
				                       			</div>
				                       			<div class="col-md-6">
				                       				<div class="sekolah_filter">
										                <select name="sekolah" id="sekolahSelect" class="custom_select">
										                    <option value="0">SEKOLAH</option>
										                </select>
										            </div>
				                       			</div>
				                       			<div class="col-md-3">
				                       				<?php echo $rankSekolahButton; ?>
				                       			</div>
				                       		</form>
				                       	</div>
		                       		</div>
		                       		<div class="row" style="color: #888888; font-weight: 200; margin-top: 10px; display: none" id="resultSekolah">
			                       		<div class="row-fluid">
			                       			<div class="col-md-12">
				                       			<div class="col-md-12">
				                        			<table class="table table-bordered table-hover table-striped rankSekolah" id="ranking_sekolah" width="100%">
							                            <thead style="background-color: #dde4e6; font-weight: 700; text-align: center;">
							                            	<tr>
							                            		<td class="col-md-1">No</td>
							                            		<td class="col-md-2">No. UJIAN</td>
							                            		<td class="col-md-4">NAMA LENGKAP</td>
							                            		<td class="col-md-4">ASAL SEKOLAH</td>
							                            		<td class="col-md-1"><span id="textNilai">NA</span></td>
							                            	</tr>
							                            </thead>
							                        </table>
							                    </div>
							                    <div class="col-md-12">
						                            <h3 style="  font-size: 13px; margin-top: 0; margin-bottom: 4px;">KETERANGAN:</h3>
						                            <p style="  margin: 0; font-size: 13px; line-height: 1.4;">*)  Rekom domisili Sidoarjo<br>**) Rekom domisili luar Sidoarjo</p>
						                        </div>
				                        	</div>
			                        	</div>
			                        	<div class="row-fluid">
			                       			<div class="col-md-12">
					                       		<div class="col-md-12">
				                        			<p class="text-center noteSementara blink">Perhatian! Hasil Perankingan Sementara!</p>
				                        		</div>
				                        	</div>
				                        </div>
		                        	</div>
		                        	<div class="row" style="color: #888888; font-weight: 200; margin-top: 10px; display: none" id="resultSekolahSD">
			                       		<div class="row-fluid">
			                       			<div class="col-md-12">
			                       				<div class="col-md-12">
				                        			<table class="table table-bordered table-hover table-striped rankSekolah" id="ranking_sekolah_sd" width="100%">
							                            <thead style="background-color: #dde4e6; font-weight: 700; text-align: center;">
							                            	<tr>
							                            		<td>NO</td>
							                            		<td>NAMA LENGKAP</td>
							                            		<td>KELURAHAN</td>
							                            		<td>TANGGAL LAHIR</td>
							                            		<td>USIA</td>
							                            		<td>JARAK (M)</td>
							                            		<td>WAKTU DAFTAR</td>
							                            	</tr>
							                            </thead>
							                            <tbody id="dataRankingSD"></tbody>
							                        </table>
							                    </div>
				                        	</div>
			                        	</div>
			                        	<div class="row-fluid">
			                       			<div class="col-md-12">
					                       		<div class="col-md-12">
				                        			<p class="text-center noteSementara blink">Perhatian! Hasil Perankingan Sementara!</p>
				                        		</div>
				                        	</div>
				                        </div>
		                        	</div>
		                       	</div>
		                    </div>
						</div>
		            </div>
            	</div>
            </div>
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="loginModal" id="loginModal">
				<div class="modal-dialog modal-sm" style="  top: 50%; position: fixed; margin: -102.5px -150px; left: 50%;">
					<div class="modal-content">
						<div id="loginPage">
						</div>
					</div>
				</div>
			</div>
			<?php echo $logoutModal; ?>

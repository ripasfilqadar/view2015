		</div>
		<div class="row-fluid breadcrumb_container">
			<div class="container">
				<div class="col-md-6 left page_info"><p class="page_subtitle">CEK STATUS PENDAFTARAN SISWA</p></div>
				<div class="col-md-6 right text-right" style="padding-right: 0">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
						<li><a href="#">Informasi</a></li>
						<li class="active">Status Pendaftaran</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row" style="margin: 40px 0px 90px;">
				<div class="col-md-8 col-md-offset-2">
		            <div class="panel-group">
		                <div class="panel panel-ppdb">
		                    <div class="panel-heading">
		                        <h4 class="page_subtitle">MASUKKAN DATA PENDAFTAR</h4>
		                    </div>
		                    <div class="panel">
		                       	<div class="panel-body">
		                       		<div class="row" style="margin-top: 10px;">
		                       			<div class="col-md-12">
			                       			<form id="formCekPendaftar">
				                       			<div class="col-md-6">
				                       				<input type="text" name="nomor_ujian" class="form-control input-lg input_nomor_ujian" placeholder="Masukkan Nomor Ujian" autofocus>
				                       			</div>
				                       			<div class="col-md-3">
				                       				<div class="sekolah_filter">
										                <select name="jenjang">
										                    <option value="0">JENJANG</option>
										                    <option value="smp">SMP</option>
										                    <option value="sma">SMA</option>
										                    <option value="smk">SMK</option>
										                </select>
										            </div>
				                       			</div>
				                       			<div class="col-md-3">
				                       				<button type="submit" class="btn btn-lg btn-primary btn-block" id="searchButton" data-loading-text="Mencari">Cari</button>
				                       			</div>
				                       		</form>
				                       	</div>
		                       		</div>
		                       		<div class="row" id="error" style="display: none;">
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
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Terdaftar Pada</td>
						                                <td id="LOG_DAFTAR"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Tanggal Lahir</td>
						                                <td id="TGL_LAHIR"></td>
						                            </tr>
									     			<tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Jenis Kelamin</td>
						                                <td id="JENIS_KEL"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Tempat Lahir</td>
						                                <td id="TMP_LAHIR"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Alamat</td>
						                                <td id="ALAMAT"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Asal Sekolah</td>
						                                <td id="ASAL_SEKOLAH"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Tahun Lulus</td>
						                                <td id="TAHUN_LULUS"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Nilai Akhir</td>
						                                <td id="NILAI_AKHIR"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Pilihan-1</td>
						                                <td id="PILIHAN1"></td>
						                            </tr>
						                            <tr>
						                                <td style="font-weight: 400; text-align: right; width: 30%;">Pilihan-2</td>
						                                <td id="PILIHAN2"></td>
						                            </tr>
						                        </table>
			                        		</div>
			                        	</div>
		                        	</div>
		                        </div>
		                    </div>
		                </div>
		            </div>
            	</div>
            </div>
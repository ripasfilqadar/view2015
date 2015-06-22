		</div>
		<div class="row-fluid breadcrumb_container">
			<div class="container">
				<div class="col-md-6 left page_info"><p class="page_subtitle">REKAPITULASI PENDAFTARAN SEKOLAH HARI KE-<?php $str = strtotime(date("M d Y ")) - (strtotime("Jun 19 2015")); if(date("d") <= 24 and date("n") <= 6 and date("Y") <= 2015) { echo floor($str/3600/24); } else { echo "5"; } ?></p></div>
				<div class="col-md-6 right text-right" style="padding-right: 0">
					<ol class="breadcrumb">
						<li><a href="<?php echo base_url(); ?>">Beranda</a></li>
                        <li><a href="#">Informasi</a></li>
						<li class="active">Statistik Harian</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p class="text-center blink">Ranking terakhir diupdate pada: &nbsp;<span id="lastUpdated" style="color: #1ABC9C; font-weight: 500;"></span></p>
                </div>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-ppdb">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><h4 class="page_subtitle">JENJANG SMP</h4></a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                       	<div class="panel-body">
                            <table class="table table-bordered table-hover table-striped" id="jenjangSMP">
                                <thead style="background-color: #dde4e6; font-weight: 700; text-align: center;">
                                    <tr>
                                        <td>Lembaga</td>
                                        <td>NA Tertinggi</td>
                                        <td>NA Terendah</td>
                                        <td>Pendaftar</td>
                                        <td>Kuota</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($smp as $sekolah) { ?>
                                        <tr>
                                            <td><?php echo $sekolah["NAMA_SEKOLAH"]; ?></td>
                                            <td><?php echo $sekolah["MAX"]; ?></td>
                                            <td><?php echo $sekolah["MIN"]; ?></td>
                                            <td><?php echo $sekolah["PENDAFTAR"]; ?></td>
                                            <td><?php echo $sekolah["PAGUPSB"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-ppdb">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><h4 class="page_subtitle">JENJANG SMA</h4></a>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <table class="table table-bordered table-hover" id="jenjangSMA">
                                <thead style="background-color: #dde4e6; font-weight: 700; text-align: center;">
                                    <tr>
                                        <td>Lembaga</td>
                                        <td>NA Tertinggi</td>
                                        <td>NA Terendah</td>
                                        <td>Pendaftar</td>
                                        <td>Kuota</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sma as $sekolah) { ?>
                                        <tr>
                                            <td><?php echo $sekolah["NAMA_SEKOLAH"]; ?></td>
                                            <td><?php echo $sekolah["MAX"]; ?></td>
                                            <td><?php echo $sekolah["MIN"]; ?></td>
                                            <td><?php echo $sekolah["PENDAFTAR"]; ?></td>
                                            <td><?php echo $sekolah["PAGUPSB"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-ppdb">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree"><h4 class="page_subtitle">JENJANG SMK</h4></a>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-striped" id="jenjangSMK">
                                <thead style="background-color: #dde4e6; font-weight: 700; text-align: center;">
                                    <tr>
                                        <td>Lembaga</td>
                                        <td>Jurusan</td>
                                        <td>NA Tertinggi</td>
                                        <td>NA Terendah</td>
                                        <td>Pendaftar</td>
                                        <td>Kuota</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($smk as $sekolah) { ?>
                                        <tr>
                                            <td><?php echo $sekolah["NAMA_SEKOLAH"]; ?></td>
                                            <td><?php echo $sekolah["JURUSAN"]; ?></td>
                                            <td><?php echo $sekolah["MAX"]; ?></td>
                                            <td><?php echo $sekolah["MIN"]; ?></td>
                                            <td><?php echo $sekolah["PENDAFTAR"]; ?></td>
                                            <td><?php echo $sekolah["PAGUPSB"]; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
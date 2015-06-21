<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cetak extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct() {
		parent::__construct();
		$this->load->library('Layout');
		$this->load->library('session');
		$this->load->library('cezpdf');
	}

	public function index() {
		$data['title'] = "Hasil Seleksi";
		$style1 = base_url()."static/css/breadcrumb.css";
		$style2 = base_url()."static/css/datatable.css";
		$style3 = base_url()."static/css/custom_select.css";
		$data['styles'] = array($style1,$style2,$style3);
		$scriptSelect = base_url()."static/js/bootstrap-select.js";
		$scriptSelect2 = base_url()."static/js/hasil_seleksi.js";
		$scriptDatatable = base_url()."static/js/jquery.dataTables.min.js";
		$scriptDatatable2 = base_url()."static/js/dataTables.bootstrap.js";
		$data['footer_scripts'] = array($scriptDatatable,$scriptDatatable2,$scriptSelect,$scriptSelect2);
		$this->layout->render('seleksi', $data);
	}

	function insertButton() {
		$loginForm = '<form id="showRekapitulasi" onsubmit="return validateMyForm();">
								<div class="modal-body" style="padding: 15px 0px 0px;">
									<div class="container-fluid" style="padding: 0;">
										<div class="col-md-12">
											<div class="form-group">
												<input type="text" class="form-control" name="username" placeholder="Username">
											</div>
											<div class="form-group">
												<input type="password" class="form-control" name="password" placeholder="Password">
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-lg btn-primary btn-block">Masuk</button>
								</div>
							</form>';
		if (date('j') >= 20 && date('n') == 6 && date('Y') == 2015) {
			echo json_encode($loginForm);
		}
		else {
			echo json_encode(NULL);
		}
	}

	function showRekapitulasi() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if ($username == "ZzZzZzZzZzZz" and $password == "CetakSekarang4ja!") {
			$this->session->set_userdata('isLoggedIn', TRUE);
			echo json_encode(TRUE);
		}
		else {
			echo json_encode(FALSE);
		}
	}

	function hideRekapitulasi() {
		$this->session->sess_destroy();
		echo json_encode(TRUE);
	}

	public function tahap1($jenjang,$id_sekolah,$footer="normal") {
		if ($this->session->userdata('isLoggedIn')) {
			$this->load->model('ranking');
			$this->load->model('sekolah');
			function HeaderFooter(&$dpdf,$nama_sekolah,$jurusan) {
				$dpdf->addJpegFromFile("static/images/sidoarjo.jpg",32,762,60);
				$text = "<b>DAFTAR CALON SISWA YANG DITERIMA TAHAP I</b>";
				$jurus = "PROGRAM KEAHLIAN ".strtoupper($jurusan);
				$school = "DI ".strtoupper($nama_sekolah);
				$tahun = "<b>TAHUN PELAJARAN 2015/2016</b>";
				$all = $dpdf->openObject();
				$dpdf->saveState();
				$dpdf->setStrokeColor(0,0,0,1);
				$dpdf->ezSetY(820);
				$dpdf->ezText($text,15,array('justification'=>'center'));
				$dpdf->ezText($school,15,array('justification'=>'center'));
				if(!empty($jurusan)) {
					$dpdf->ezText($jurus,14,array('justification'=>'center'));
					$dpdf->ezText($tahun,15,array('justification'=>'center'));
					$dpdf->ezSetY(800);
				}
				else {
					$dpdf->ezText($tahun,15,array('justification'=>'center'));
					$dpdf->ezSetY(820);
				}
				$dpdf->restoreState();
				$dpdf->closeObject();
				$dpdf->addObject($all,'all');
			}
			$pdfku = new Cezpdf("A4", 'portrait'); //595.28,841.29
			$pdfku->addInfo('Title','Hasil Rekapitulasi');
			$pdfku->addInfo('Author','PPDB HELPER');
			$pdfku->addInfo('Application','PPDB Online Kabupaten Sidoarjo');
			if ($footer == "normal") {
				$pdfku->ezSetCmMargins("3.5","3","3","3");
			}
			else {
				$pdfku->ezSetCmMargins("3.5","7","3","3");
			}
			$nama_sekolah= $this->sekolah->getSekolahById($id_sekolah)['NAMA_SEKOLAH'];
			if($jenjang == "smk") {
				$jurusan = $this->sekolah->getSekolahById($id_sekolah)['JURUSAN'];
			}
			else {
				$jurusan = 0;
			}
			HeaderFooter($pdfku, $nama_sekolah, $jurusan);
			$pdfku->ezStartPageNumbers(146,35,9,'','Halaman {PAGENUM} dari {TOTALPAGENUM} Halaman',1);
			$pdfku->ezSetY(760);
			$pdfku->ezSetDy(-20);
			$data= $this->ranking->cetakData($jenjang,$id_sekolah);
			if ($jenjang == "smp") {
				$namakolom = "NILAI SEKOLAH";
			}
			elseif ($jenjang == "sma") {
				$namakolom = "NILAI UJIAN NASIONAL";
			}
			else {
				$namakolom = "NILAI TERPADU";
			}
			$cols_db = array (
				'NO_URUT'=>'NO.',
				'NO_UJIAN'=>'NO. UJIAN',
				'NAMA'=>' NAMA',
				'ASAL_SEKOLAH'=>'ASAL SEKOLAH',
				'NILAI_AKHIR' => $namakolom,
				'PILIHAN' => 'PIL',
				'JENIS_KEL' => 'JK'
			);
			$option_db= array (
				'showHeadings'=>1,'shaded'=>0,'xPos'=>'center','xOrientation'=>'center','fontSize' => 10,
				'cols'=>array (
					'NO_URUT'=>array (
						'justification'=>'center',
						'width'=>'30'
					),
					'NO_UJIAN'=>array (
						'justification'=>'center',
						'width'=>'70'
					),
					'NAMA'=>array (
						'justification'=>'justify',
						'width'=>'180'
					),
					'ASAL_SEKOLAH'=>array (
						'justification'=>'justify',
						'width'=>'130'
					),
					'NILAI_AKHIR'=>array (
						'justification'=>'center',
					)
					,
					'PILIHAN'=>array (
						'justification'=>'center',
					)
					,
					'JENIS_KEL'=>array (
						'justification'=>'center',
					)
				)
			);
			$pdfku->ezTable( $data, $cols_db, '', $option_db);
			$pdfku->addText(390,($pdfku->y)-40,10,"SIDOARJO, 29 JUNI 2015");
			$pdfku->addText(390,($pdfku->y)-53,10,"KEPALA DINAS PENDIDIKAN");
			$pdfku->addText(390,($pdfku->y)-66,10,"KABUPATEN SIDOARJO");
			$pdfku->addText(390,($pdfku->y)-145,10,"<b>Drs. MUSTAIN, M.Pd.I</b>");
			$pdfku->addText(390,($pdfku->y)-157,10,"Pembina Tingkat I");
			$pdfku->addText(390,($pdfku->y)-170,10,"NIP. 19650311 199103 1 006");
			$pdfku->ezStream();
		}
		else {
			redirect(base_url());
		}
	}

	public function tahap2($jenjang,$id_sekolah,$footer = "normal") {
		if ($this->session->userdata('isLoggedIn')) {
			$this->load->model('ranking');
			$this->load->model('sekolah');
			function HeaderFooter(&$dpdf,$nama_sekolah,$jurusan) {
				$dpdf->addJpegFromFile("static/images/sidoarjo.jpg",32,762,60);
				$text = "<b>DAFTAR CALON SISWA YANG DITERIMA TAHAP II</b>";
				$jurus = "PROGRAM KEAHLIAN ".strtoupper($jurusan);
				$school = "DI ".strtoupper($nama_sekolah);
				$tahun = "<b>TAHUN PELAJARAN 2015/2016</b>";
				$all = $dpdf->openObject();
				$dpdf->saveState();
				$dpdf->setStrokeColor(0,0,0,1);
				$dpdf->ezSetY(820);
				$dpdf->ezText($text,15,array('justification'=>'center'));
				$dpdf->ezText($school,15,array('justification'=>'center'));
				if(!empty($jurusan)) {
					$dpdf->ezText($jurus,14,array('justification'=>'center'));
					$dpdf->ezText($tahun,15,array('justification'=>'center'));
					$dpdf->ezSetY(800);
				}
				else {
					$dpdf->ezText($tahun,15,array('justification'=>'center'));
					$dpdf->ezSetY(820);
				}
				$dpdf->restoreState();
				$dpdf->closeObject();
				$dpdf->addObject($all,'all');
			}
			$pdfku = new Cezpdf("A4", 'portrait'); //595.28,841.29
			$pdfku->addInfo('Title','Hasil Rekapitulasi');
			$pdfku->addInfo('Author','PPDB HELPER');
			$pdfku->addInfo('Application','PPDB Online Kabupaten Sidoarjo');
			if ($footer == "normal") {
				$pdfku->ezSetCmMargins("3.5","3","3","3");
			}
			else {
				$pdfku->ezSetCmMargins("3.5","7","3","3");
			}
			$nama_sekolah= $this->sekolah->getSekolahById($id_sekolah)['NAMA_SEKOLAH'];
			if($jenjang == "smk") {
				$jurusan = $this->sekolah->getSekolahById($id_sekolah)['JURUSAN'];
			}
			else {
				$jurusan = 0;
			}
			HeaderFooter($pdfku, $nama_sekolah, $jurusan);
			$pdfku->ezStartPageNumbers(146,35,9,'','Halaman {PAGENUM} dari {TOTALPAGENUM} Halaman',1);
			$pdfku->ezSetY(760);
			$pdfku->ezSetDy(-20);
			$data= $this->ranking->cetakData($jenjang,$id_sekolah);
			if ($jenjang == "smp") {
				$namakolom = "NILAI SEKOLAH";
			}
			elseif ($jenjang == "sma") {
				$namakolom = "NILAI UJIAN NASIONAL";
			}
			else {
				$namakolom = "NILAI TERPADU";
			}
			$cols_db = array (
				'NO_URUT'=>'NO.',
				'NO_UJIAN'=>'NO. UJIAN',
				'NAMA'=>' NAMA',
				'ASAL_SEKOLAH'=>'ASAL SEKOLAH',
				'NILAI_AKHIR' => $namakolom,
				'PILIHAN' => 'PIL',
				'JENIS_KEL' => 'JK'
			);
			$option_db= array (
				'showHeadings'=>1,'shaded'=>0,'xPos'=>'center','xOrientation'=>'center','fontSize' => 10,
				'cols'=>array (
					'NO_URUT'=>array (
						'justification'=>'center',
						'width'=>'30'
					),
					'NO_UJIAN'=>array (
						'justification'=>'center',
						'width'=>'70'
					),
					'NAMA'=>array (
						'justification'=>'justify',
						'width'=>'180'
					),
					'ASAL_SEKOLAH'=>array (
						'justification'=>'justify',
						'width'=>'130'
					),
					'NILAI_AKHIR'=>array (
						'justification'=>'center',
					)
					,
					'PILIHAN'=>array (
						'justification'=>'center',
					)
					,
					'JENIS_KEL'=>array (
						'justification'=>'center',
					)
				)
			);
			$pdfku->ezTable( $data, $cols_db, '', $option_db);
			$pdfku->addText(390,($pdfku->y)-40,10,"SIDOARJO, 2 JULI 2015");
			$pdfku->addText(390,($pdfku->y)-53,10,"KEPALA DINAS PENDIDIKAN");
			$pdfku->addText(390,($pdfku->y)-66,10,"KABUPATEN SIDOARJO");
			$pdfku->addText(390,($pdfku->y)-145,10,"<b>Drs. MUSTAIN, M.Pd.I</b>");
			$pdfku->addText(390,($pdfku->y)-157,10,"Pembina Tingkat I");
			$pdfku->addText(390,($pdfku->y)-170,10,"NIP. 19650311 199103 1 006");
			$pdfku->ezStream();
		}
		else {
			redirect(base_url());
		}
	}
}
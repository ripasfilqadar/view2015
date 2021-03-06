<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('Layout');
	}

	public function index() {
		$this->tahap(2);
	}

	public function tahap($tahap=2) {
		$this->load->library('session');
		$data['title'] = "Hasil Seleksi Tahap ".$tahap;
		$style1 = base_url()."static/css/breadcrumb.css";
		$style2 = base_url()."static/css/datatable.css";
		$style3 = base_url()."static/css/custom_select.css";
		$data['styles'] = array($style1,$style2,$style3);
		$scriptSelect = base_url()."static/js/bootstrap-select.js";
		$scriptSelect2 = base_url()."static/js/hasil_seleksi.js";
		$scriptDatatable = base_url()."static/js/jquery.dataTables.min.js";
		$scriptDatatable2 = base_url()."static/js/dataTables.bootstrap.js";
		$scriptMousetrap = base_url()."static/js/mousetrap.min.js";
		$data['footer_scripts'] = array($scriptDatatable,$scriptDatatable2,$scriptSelect,$scriptMousetrap,$scriptSelect2);
		if ($this->session->userdata('isLoggedIn')) {
			$rankSekolahButton = '<div class="btn-group dropup btn-block">
				                       					<button type="submit" class="btn btn-lg btn-primary" id="btnSekolah" data-loading-text="Mencari" style="width: 80%">Tampilkan</button>
				                       					<button type="button" class="btn btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 20%">
				                       						<span class="caret" style="border-bottom: 0; border-top: 4px solid;"></span>
				                       						<span class="sr-only">Toggle Dropdown</span>
				                       					</button>
				                       					<ul class="dropdown-menu" style="margin-bottom: -117px; width: 100%;">
				                       						<li class="text-center" style="font-size: 15px;"><a id="tahap1" href="#" target = "_blank">Cetak Tahap 1</a></li>
															<li class="text-center" style="font-size: 15px;"><a id="tahap2"  href="#" target = "_blank">Cetak Tahap 2</a></li>
															<li class="text-center" style="font-size: 15px;"><a id="tahap1b" href="#" target = "_blank">Cetak Tahap 1 (Custom)</a></li>
															<li class="text-center" style="font-size: 15px;"><a id="tahap2b"  href="#" target = "_blank">Cetak Tahap 2 (Custom)</a></li>
				                       					</ul>
				                       				</div>';
			$logoutModal = '<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="logoutModal" id="logoutModal">
				<div class="modal-dialog modal-sm" style="  top: 50%; position: fixed; margin: -102.5px -150px; left: 50%;">
					<div class="modal-content">
						<div class="modal-body" style="padding: 15px 0px 0px;">
							<div class="container-fluid" style="padding: 0;">
								<div class="col-md-12">
									<p class="text-center" style="font-size: 16px;">Anda yakin ingin keluar?</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="col-md-6"><button type="button" class="btn btn-sm btn-primary btn-block" onclick="return validateMyButton();">Ya</button></div>
							<div class="col-md-6"><button type="button" class="btn btn-sm btn-default btn-block" data-dismiss="modal" >Tidak</button></div>
						</div>
					</div>
				</div>
			</div>';
		}
		else {
			$rankSekolahButton = '<button type="submit" class="btn btn-lg btn-block btn-primary" id="btnSekolah" data-loading-text="Mencari">Tampilkan</button>';
			$logoutModal = '';
		}
		$data['rankSekolahButton'] = $rankSekolahButton;
		$data['logoutModal'] = $logoutModal;
		$data['tahap'] = $tahap;
		$this->layout->render('seleksi', $data);
	}

	function getSekolah() {
		$this->load->model('sekolah');
		$jenjang = strtoupper($this->input->post('jenjang'));
		if (empty($jenjang)) {
			$result = NULL;
		}
		else {
			$result = $this->sekolah->getSekolah($jenjang);
		};
		echo json_encode($result);
	}

	function getRankSekolah($tahap=2) {
		$this->load->model('ranking');
		$jenjang = strtolower($this->input->post('jenjang'));
		$sekolah = $this->input->post('sekolah');
		if (empty($sekolah)) {
			$result = NULL;
		}
		elseif ($jenjang == "sd") {
			$string = file_get_contents('http://180.250.248.75/sd_diterima.php?id_sekolah='.$sekolah);
			$result = substr(strstr($string, '<tr class="odd">'), 0, strpos(strstr($string, '<tr class="odd">'), "</tbody>"));
		}
		else {
			$result = $this->ranking->getRankSekolah($jenjang,$sekolah,$tahap);
		};
		echo json_encode($result);
	}

	function getRankSiswa($tahap=2) {
		$this->load->model('ranking');
		$nomor_ujian = $this->input->post('nomor_ujian');
		$jenjang = strtolower($this->input->post('jenjang'));
		if (empty($jenjang)) {
			$result = NULL;
		}
		else {
			$result = $this->ranking->getRankSiswa($nomor_ujian,$jenjang,$tahap);
		};
		if ($result != NULL) {
			$result['IMAGE'] = base_url()."static/images/".strtoupper($jenjang)."_".strtoupper(substr($result['JENIS_KEL'],0,1)).".png";
		}
		echo json_encode($result);
	}

	function tes() {
		$str = strtotime(date("M d Y ")) - (strtotime("Jun 19 2015"));
		echo floor($str/3600/24);
	}
}

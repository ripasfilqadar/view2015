<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informasi extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('Layout');
	}

	public function index() {
		redirect('beranda');
	}

	public function jadwal_pelaksanaan() {
		$data['title'] = "Jadwal Pelaksanaan";
		$style1 = base_url()."static/css/breadcrumb.css";
		$style2 = base_url()."static/css/datatable.css";
		$data['styles'] = array($style1,$style2);
		$this->layout->render('informasi/jadwal_pelaksanaan', $data);
	}

	public function status_pendaftaran() {
		$data['title'] = "Status Pendaftaran";
		$style1 = base_url()."static/css/breadcrumb.css";
		$style2 = base_url()."static/css/datatable.css";
		$style3 = base_url()."static/css/custom_select.css";
		$data['styles'] = array($style1,$style2,$style3);
		$scriptSelect = base_url()."static/js/bootstrap-select.js";
		$scriptSelect2 = base_url()."static/js/status_pendaftaran.js";
		$data['footer_scripts'] = array($scriptSelect,$scriptSelect2);
		$this->layout->render('informasi/status_pendaftaran', $data);
	}

	public function rekap_harian() {
		$this->load->model('sekolah');
		$data['title'] = "Statistik Harian";
		$style1 = base_url()."static/css/breadcrumb.css";
		$style2 = base_url()."static/css/datatable.css";
		$scriptDatatable = base_url()."static/js/jquery.dataTables.min.js";
		$scriptDatatable2 = base_url()."static/js/dataTables.bootstrap.js";
		$data['styles'] = array($style1,$style2);
		$data['smp'] = $this->sekolah->rekap_harian('smp');
		$data['sma'] = $this->sekolah->rekap_harian('sma');
		$data['smk'] = $this->sekolah->rekap_harian('smk');
		$statistik_harian = base_url()."static/js/statistik_harian.js";
		$data['footer_scripts'] = array($scriptDatatable, $scriptDatatable2, $statistik_harian);
		$this->layout->render('informasi/rekap_harian', $data);
	}

	function cekPendaftar() {
		$this->load->model('pendaftar');
		$nomor_ujian = $this->input->post('nomor_ujian');
		$jenjang = $this->input->post('jenjang');
		if (empty($jenjang)) {
			$result = NULL;
		}
		else {
			$result = $this->pendaftar->getDetail($nomor_ujian,$jenjang);
		};
		if ($result != NULL) {
			$result['IMAGE'] = base_url()."static/images/".strtoupper($jenjang)."_".strtoupper(substr($result['JENIS_KEL'],0,1)).".png";
		}
		echo json_encode($result);
	}
}
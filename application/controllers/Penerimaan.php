<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penerimaan extends CI_Controller {

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

	function getRankSekolah() {
		$this->load->model('ranking');
		$jenjang = $this->input->post('jenjang');
		$sekolah = $this->input->post('sekolah');
		if (empty($sekolah)) {
			$result = NULL;
		}
		else {
			$result = $this->ranking->getRankSekolah($jenjang,$sekolah);
		};
		echo json_encode($result);
	}

	function getRankSiswa() {
		$this->load->model('ranking');
		$nomor_ujian = $this->input->post('nomor_ujian');
		$jenjang = strtolower($this->input->post('jenjang'));
		if (empty($jenjang)) {
			$result = NULL;
		}
		else {
			$result = $this->ranking->getRankSiswa($nomor_ujian,$jenjang);
		};
		if ($result != NULL) {
			$result['IMAGE'] = base_url()."static/images/".strtoupper($jenjang)."_".strtoupper(substr($result['JENIS_KEL'],0,1)).".png";
		}
		echo json_encode($result);
	}
}
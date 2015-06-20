<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informasi extends CI_Controller {

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
			$result['IMAGE'] = base_url()."static/images/".strtoupper($jenjang).".png";
		}
		echo json_encode($result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

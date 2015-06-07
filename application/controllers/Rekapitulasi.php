<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller {

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
		$this->tahun(2014);
	}

	function tahun($tahun=2014) {
		$data['title'] = "Hasil Rekapitulasi";
		$data['tahun'] = $tahun;
		$scriptRekapitulasi = base_url()."static/js/rekapitulasi.js";
		$data['footer_scripts'] = array('https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js','https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js',"$scriptRekapitulasi");
		$this->layout->render("rekapitulasi/$tahun", $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

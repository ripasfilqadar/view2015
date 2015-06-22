<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller {

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
		$style1 = base_url()."static/css/breadcrumb.css";
		$style2 = base_url()."static/css/datatable.css";
		$data['styles'] = array($style1,$style2);
		$scriptRekapitulasi = base_url()."static/js/rekapitulasi.js";
		$data['footer_scripts'] = array('https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js','https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js',"$scriptRekapitulasi");
		$this->layout->render("rekapitulasi/$tahun", $data);
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah extends CI_Controller {

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

	public function index()
	{
		redirect('beranda');
	}

	public function smp() {
		$data['title'] = "Daftar Sekolah SMP Sidoarjo";
		$style1 = base_url()."static/css/breadcrumb.css";
		$data['styles'] = array($style1);
		$this->layout->render('sekolah/smp', $data);
	}

	public function sma() {
		$data['title'] = "Daftar Sekolah SMA Sidoarjo";
		$style1 = base_url()."static/css/breadcrumb.css";
		$data['styles'] = array($style1);
		$this->layout->render('sekolah/sma', $data);
	}

	public function smk() {
		$data['title'] = "Daftar Sekolah SMK Sidoarjo";
		$style1 = base_url()."static/css/breadcrumb.css";
		$data['styles'] = array($style1);
		$this->layout->render('sekolah/smk', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
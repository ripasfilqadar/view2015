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
		$this->layout->render('informasi/jadwal_pelaksanaan', $data);
	}

	public function status_pendaftaran() {
		$data['title'] = "Status Pendaftaran";
		$this->layout->render('informasi/status_pendaftaran', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('Layout');
	}

	public function index()
	{
		$data['title'] = "Halaman Utama";
		$style1 = base_url()."static/css/main_menu.css";
		$data['styles'] = array($style1);
		$this->layout->render('beranda', $data);
	}
}

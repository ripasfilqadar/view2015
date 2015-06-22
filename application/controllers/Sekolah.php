<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah extends CI_Controller {

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
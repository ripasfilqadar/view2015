<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sekolah extends CI_Model {

	public function __construct(){
		parent:: __construct();
		$this->load->database('default');
	}

	function getSekolah($jenjang) {
		$table = "pagu_sekolah";
		$this->db->select("ID_SEKOLAH, NAMA_SEKOLAH, JURUSAN");
		$this->db->from($table);
		$this->db->where('NAMA_SEKOLAH like "%'.$jenjang.'%"');
		$this->db->order_by("ID_SEKOLAH");
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->result_array();
		}
		else {
			return NULL;
		}
	}
}
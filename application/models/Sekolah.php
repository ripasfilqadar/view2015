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

	function getSekolahById($id_sekolah) {
		$table = "pagu_sekolah";
		$this->db->select("ID_SEKOLAH, NAMA_SEKOLAH, JURUSAN");
		$this->db->from($table);
		$this->db->where("ID_SEKOLAH",$id_sekolah);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->row_array();
		}
		else {
			return NULL;
		}
	}

	function rekap_harian($jenjang) {
		$table = "terima_".$jenjang."_2";
		$this->db->select("t.NAMA_SEKOLAH, t.JURUSAN, min(j.NILAI_AKHIR) as MIN, max(j.NILAI_AKHIR) as MAX, count(j.NILAI_AKHIR) as PENDAFTAR");
		$this->db->from("pagu_sekolah t");
		$this->db->join($table." j","j.DITERIMA = t.ID_SEKOLAH", "left");
		$this->db->where("t.NAMA_SEKOLAH like '%$jenjang%'");
		$this->db->group_by("t.NAMA_SEKOLAH, t.JURUSAN");
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->result_array();
		}
		else {
			return NULL;
		}
	}
}
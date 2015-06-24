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
		$tablePendaftar = "pendaftar_".$jenjang;
		$query = "select 
				t.NAMA_SEKOLAH,
				t.JURUSAN,
				l.MIN,
				l.MAX,
				t.PAGUPSB, 
				t.JML_TIDAK_NAIK, 
				t.JML_PRESTASI, 
				t.PAGUAWAL, 
				count(j.NILAI_AKHIR) as PENDAFTAR
			from pagu_sekolah t
			left join $tablePendaftar j on j.PILIH1 = t.ID_SEKOLAH or j.PILIH2 = t.ID_SEKOLAH
			left join (select max(NILAI_AKHIR) as MAX, min(NILAI_AKHIR) as MIN, DITERIMA from $table group by DITERIMA) l on l.DITERIMA = t.ID_SEKOLAH
			where t.NAMA_SEKOLAH like '%$jenjang%'
			group by t.NAMA_SEKOLAH, t.JURUSAN";
		$result = $this->db->query($query);
		if ($result->num_rows() > 0) {
			return $result->result_array();
		}
		else {
			return NULL;
		}
	}
}
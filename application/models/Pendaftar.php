<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftar extends CI_Model {

	public function __construct(){
		parent:: __construct();
		$this->load->database('default');
	}

	function getDetail($no_ujian,$jenjang) {
		$table = "pendaftar_".$jenjang;
		$this->db->select("t1.NO_UJIAN, t1.TAHUN_LULUS, t1.NAMA, IF(t1.JENIS_KEL = 'L','LAKI-LAKI','PEREMPUAN') AS JENIS_KEL, t1.TMP_LAHIR, t1.TGL_LAHIR, t1.ALAMAT, t1.ASAL_SEKOLAH, t2.NAMA_SEKOLAH as PILIHAN1, t3.NAMA_SEKOLAH as PILIHAN2, t1.NILAI_AKHIR, t1.LOG_DAFTAR");
		$this->db->from("$table t1");
		$this->db->join("pagu_sekolah t2", "t1.PILIH1=TRIM(LEADING '0' FROM `t2`.`ID_SEKOLAH`)","left");
		$this->db->join("pagu_sekolah t3", "t1.PILIH2=TRIM(LEADING '0' FROM `t3`.`ID_SEKOLAH`)","left");
		$this->db->where("t1.NO_UJIAN", $no_ujian);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->row_array();
		}
		else {
			return $this->db->last_query();
		}
	}
}

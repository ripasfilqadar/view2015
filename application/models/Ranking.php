<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking extends CI_Model {

	public function __construct(){
		parent:: __construct();
		$this->load->database('default');
	}

	function getRankSekolah($jenjang,$sekolah) {
		$table = "terima_".$jenjang."_2";
		$this->db->select("NO_UJIAN, NAMA, ASAL_SEKOLAH, NILAI_AKHIR, JALUR_DAFTAR");
		$this->db->from($table);
		$this->db->where('DITERIMA',$sekolah);
		$this->db->order_by('NO_URUT','DESC');
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->result_array();
		}
		else {
			return NULL;
		}
	}

	function getRankSiswa($nomor_ujian,$jenjang) {
		$table = "terima_".$jenjang."_2";
		$tablePendaftar = "pendaftar_".$jenjang;
		if ($jenjang == "smp") {
			$query = "
				select
					t.NO_UJIAN,
					t.NAMA, 
					t.ASAL_SEKOLAH, 
					t.WAKTU_DAFTAR, 
					t.AKHIR_BIND, 
					t.AKHIR_MAT, 
					t.AKHIR_IPA, 
					t.NILAI_AKHIR, 
					t.PILIHAN, 
					p.NAMA_SEKOLAH, 
					t.NO_URUT AS RANKING, 
					dt.maximum AS MAX_RANKING,
					t.JALUR_DAFTAR,
					IF(skl.JENIS_KEL = 'L','LAKI-LAKI','PEREMPUAN') AS JENIS_KEL
				from 
					$table t, 
					pagu_sekolah p, 
					(
						select 
							diterima, 
							max(no_urut) as maximum 
						from $table 
						group by diterima
					) dt,
					$tablePendaftar skl
				where t.DITERIMA = p.ID_SEKOLAH 
					and dt.diterima=t.diterima 
					and t.NO_UJIAN = '$nomor_ujian' 
					and skl.NO_UJIAN = t.NO_UJIAN
				order by t.diterima asc, t.NO_URUT";
		}
		elseif ($jenjang == "sma") {
			$query = "
				select
					t.NO_UJIAN,
					t.NAMA, 
					t.ASAL_SEKOLAH, 
					t.WAKTU_DAFTAR, 
					t.BIND, 
					t.MAT, 
					t.IPA, 
					t.BING, 
					t.NILAI_AKHIR, 
					t.PILIHAN, 
					p.NAMA_SEKOLAH, 
					t.NO_URUT AS RANKING, 
					dt.maximum AS MAX_RANKING,
					t.JALUR_DAFTAR,
					IF(skl.JENIS_KEL = 'L','LAKI-LAKI','PEREMPUAN') AS JENIS_KEL
				from 
					$table t, 
					pagu_sekolah p, 
					(
						select 
							diterima, 
							max(no_urut) as maximum 
						from $table 
						group by diterima
					) dt,
					$tablePendaftar skl
				where t.DITERIMA = p.ID_SEKOLAH 
					and dt.diterima=t.diterima 
					and t.NO_UJIAN = '$nomor_ujian' 
					and skl.NO_UJIAN = t.NO_UJIAN
				order by t.diterima asc, t.NO_URUT";
		}
		elseif ($jenjang == "smk") {
			$query = "
				select
					t.NO_UJIAN,
					t.NAMA, 
					t.ASAL_SEKOLAH, 
					t.WAKTU_DAFTAR, 
					t.BIND, 
					t.MAT, 
					t.IPA, 
					t.BING, 
					t.NUN_ASLI, 
					t.NILAI_PSIKOTES, 
					t.NILAI_WAWANCARA, 
					t.NILAI_TERPADU, 
					t.NILAI_AKHIR, 
					t.PILIHAN, 
					p.NAMA_SEKOLAH, 
					p.JURUSAN, 
					t.NO_URUT AS RANKING, 
					dt.maximum AS MAX_RANKING,
					t.JALUR_DAFTAR,
					IF(skl.JENIS_KEL = 'L','LAKI-LAKI','PEREMPUAN') AS JENIS_KEL
				from 
					$table t, 
					pagu_sekolah p, 
					(
						select 
							diterima, 
							max(no_urut) as maximum 
						from $table 
						group by diterima
					) dt,
					$tablePendaftar skl
				where t.DITERIMA = p.ID_SEKOLAH 
					and dt.diterima=t.diterima 
					and t.NO_UJIAN = '$nomor_ujian' 
					and skl.NO_UJIAN = t.NO_UJIAN
				order by t.diterima asc, t.NO_URUT";
		}
		$result = $this->db->query($query);
		if ($result->num_rows() > 0) {
			return $result->row_array();
		}
		else {
			return NULL;
		}
	}

	public function cetakData($jenjang,$ID_SEKOLAH){
		$tabel = "terima_".$jenjang."_2 ta";
		$join = "pendaftar_".$jenjang." j";
		$this->db->select("ta.NO_URUT, ta.NO_UJIAN, ta.NAMA, ta.ASAL_SEKOLAH, ta.PILIHAN, ta.NILAI_AKHIR, j.JENIS_KEL");
		$this->db->from($tabel);
		$this->db->join($join, 'ta.NO_UJIAN = j.NO_UJIAN');
		$this->db->where("DITERIMA",$ID_SEKOLAH);
		$this->db->order_by("NO_URUT", "ASC");
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return $result->result_array();
		}
		else {
			return null;
		}
	}
}
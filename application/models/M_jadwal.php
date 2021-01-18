<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jadwal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list_materi_id_jadwal($id_jadwal)
    {
        $sql = "SELECT tb_detail_jadwal.id, tb_detail_jadwal.id_pengajar, tb_detail_jadwal.id_materi, tb_detail_jadwal.hari, tb_detail_jadwal.jam, tb_detail_jadwal.durasi, tb_account.nama_lengkap, tb_account.no_telp, tb_materi.nama FROM tb_detail_jadwal , tb_materi , tb_account WHERE tb_detail_jadwal.id_jadwal = $id_jadwal AND tb_detail_jadwal.id_pengajar = tb_account.id AND tb_detail_jadwal.id_materi = tb_materi.id ORDER BY tb_detail_jadwal.hari ASC, tb_detail_jadwal.jam ASC";
        $query = $this->db->query($sql);
        return $query;
    }

}

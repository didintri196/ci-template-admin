<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_list_detail_transaksi($id_transaksi)
    {
        $sql = "SELECT tb_detail_transaksi.id_transaksi, tb_detail_transaksi.id_paket, tb_detail_transaksi.harga, tb_detail_transaksi.dp, tb_paket.judul, tb_paket.deskripsi, tb_paket.periode, tb_paket.durasi, tb_paket.asrama, tb_paket.jadwal, tb_paket.id_asrama, tb_paket.id_kategori, tb_paket.id_jadwal, tb_paket.`status`, tb_kategori.nama nama_kategori, tb_detail_transaksi.id FROM tb_detail_transaksi , tb_paket , tb_kategori WHERE tb_detail_transaksi.id_transaksi='$id_transaksi' AND tb_detail_transaksi.id_paket = tb_paket.id AND tb_paket.id_kategori = tb_kategori.id";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_list_trx_expired($time)
    {
        $sql = "SELECT * FROM `tb_transaksi` WHERE status='pending' AND tgl_kadaluwarsa < $time";
        $query = $this->db->query($sql);
        return $query;
    }

    public function set_list_trx_expired($time)
    {
        $sql = "UPDATE `tb_transaksi` SET `status` = 'expired' WHERE status='pending' AND tgl_kadaluwarsa < $time";
        $query = $this->db->query($sql);
        return $query;
    }
    
}

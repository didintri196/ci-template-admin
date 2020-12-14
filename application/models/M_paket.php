<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_paket extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_list_paket_all()
    {
        $sql = "SELECT tb_asrama.nama nama_asrama, tb_paket.id, tb_paket.judul, tb_paket.deskripsi deskripsi_paket, tb_paket.harga, tb_paket.dp, tb_paket.periode, tb_paket.durasi, tb_paket.asrama, tb_paket.jadwal, tb_paket.id_asrama, tb_paket.id_kategori, tb_paket.id_jadwal, tb_paket.`status` paket_status, tb_kategori.nama nama_kategori, tb_kategori.deskripsi, tb_kategori.materi, tb_kategori.`status`, tb_jadwal.judul judul_jadwal FROM tb_paket , tb_asrama , tb_kategori , tb_jadwal WHERE tb_paket.id_asrama = tb_asrama.id AND tb_paket.id_kategori = tb_kategori.id AND tb_paket.id_jadwal = tb_jadwal.id ORDER BY tb_paket.judul DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_list_paket_kategori($idkategori)
    {
        $sql = "SELECT tb_asrama.nama nama_asrama, tb_paket.id, tb_paket.judul, tb_paket.deskripsi deskripsi_paket, tb_paket.harga, tb_paket.dp, tb_paket.periode, tb_paket.durasi, tb_paket.asrama, tb_paket.jadwal, tb_paket.id_asrama, tb_paket.id_kategori, tb_paket.id_jadwal, tb_paket.`status` paket_status, tb_kategori.nama nama_kategori, tb_kategori.deskripsi, tb_kategori.materi, tb_kategori.`status`, tb_jadwal.judul judul_jadwal FROM tb_paket , tb_asrama , tb_kategori , tb_jadwal WHERE tb_paket.id_kategori='$idkategori' AND tb_paket.id_asrama = tb_asrama.id AND tb_paket.id_kategori = tb_kategori.id AND tb_paket.id_jadwal = tb_jadwal.id ORDER BY tb_paket.judul DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_list_paket_kategori_active($idkategori)
    {
        $sql = "SELECT tb_asrama.nama nama_asrama, tb_paket.id, tb_paket.judul, tb_paket.deskripsi deskripsi_paket, tb_paket.harga, tb_paket.dp, tb_paket.periode, tb_paket.durasi, tb_paket.asrama, tb_paket.jadwal, tb_paket.id_asrama, tb_paket.id_kategori, tb_paket.id_jadwal, tb_paket.`status` paket_status, tb_kategori.nama nama_kategori, tb_kategori.deskripsi, tb_kategori.materi, tb_kategori.`status`, tb_jadwal.judul judul_jadwal FROM tb_paket , tb_asrama , tb_kategori , tb_jadwal WHERE tb_paket.status='TRUE' AND tb_paket.id_kategori='$idkategori' AND tb_paket.id_asrama = tb_asrama.id AND tb_paket.id_kategori = tb_kategori.id AND tb_paket.id_jadwal = tb_jadwal.id ORDER BY tb_paket.judul DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_list_paket_id($id)
    {
        $sql = "SELECT tb_asrama.nama nama_asrama, tb_paket.id, tb_paket.judul, tb_paket.deskripsi deskripsi_paket, tb_paket.harga, tb_paket.dp, tb_paket.periode, tb_paket.durasi, tb_paket.asrama, tb_paket.jadwal, tb_paket.id_asrama, tb_paket.id_kategori, tb_paket.id_jadwal, tb_paket.`status` paket_status, tb_kategori.nama nama_kategori, tb_kategori.deskripsi, tb_kategori.materi, tb_kategori.`status`, tb_jadwal.judul judul_jadwal FROM tb_paket , tb_asrama , tb_kategori , tb_jadwal WHERE tb_paket.id='$id' AND tb_paket.id_asrama = tb_asrama.id AND tb_paket.id_kategori = tb_kategori.id AND tb_paket.id_jadwal = tb_jadwal.id ORDER BY tb_paket.judul DESC";
        $query = $this->db->query($sql);
        return $query;
    }
    
}

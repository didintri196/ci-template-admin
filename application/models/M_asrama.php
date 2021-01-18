<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_asrama extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_faslitas_id($idasrama)
    {
        $sql = "SELECT * FROM tb_fasilitas_asrama WHERE id_asrama='$idasrama'";
        $query = $this->db->query($sql);
        return $query;
    }
}

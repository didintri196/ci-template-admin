<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_coupon extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_kode($code)
    {
        $sql = "SELECT * FROM tb_coupon WHERE code='$code'";
        $query = $this->db->query($sql);
        return $query;
    }

}

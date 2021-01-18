<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_notif extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function create($tipe,$reff_id,$value,$receive_contact)
    {
        $data['tipe']=$tipe;
        $data['reff_id']=$reff_id;
        $data['value']=$value;
        $data['status']="queue";
        $data['receive_contact']=$receive_contact;
        return $this->db->insert('tb_notif', $data);
    }

}

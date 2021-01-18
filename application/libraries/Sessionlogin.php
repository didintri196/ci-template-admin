<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sessionlogin
{

    // SET SUPER GLOBAL
    var $CI = NULL;

    /**
     * Class constructor
     *
     * @return   void
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /*
     * cek username dan password pada table users, jika ada set session berdasar data user dari
     * table users.
     * @param string username dari input form
     * @param string password dari input form
     */
    public function login($id)
    {
        $this->CI->session->set_userdata('id', $id);
    }

    /**
     * Cek session login, jika tidak ada, set notifikasi dalam flashdata, lalu dialihkan ke halaman
     * login
     */
    public function cek_login()
    {

        //cek session username
        if ($this->CI->session->userdata('id') == '') {

            //set notifikasi
            $this->CI->session->set_flashdata('alert', 'warning|<b>Mohon Maaf</b> Anda belum melakukan login.');

            //alihkan ke halaman login
            redirect(base_url('account/login'));
        }
    }

    public function cek_login_akses($akses)
    {

        //cek session id
        if ($this->CI->session->userdata('id') == '') {

            //set notifikasi
            $this->CI->session->set_flashdata('alert', 'warning|<b>Mohon Maaf</b> Anda belum melakukan login.');

            //alihkan ke halaman login
            redirect(base_url('account/login'));
        } else {
            $datauser = $this->get_session();
            if ($datauser['status'] == "ok") {
                if ($akses != $datauser['akses']) {
                    //set notifikasi
                    $this->CI->session->set_flashdata('alert', 'warning|<b>Mohon Maaf</b> Anda tidak mempunyai akses ke halaman ini.');

                    //alihkan ke halaman login
                    redirect(base_url('account/dashboard'));
                }
            }else{
                redirect(base_url('account/logout'));
            }
        }
    }

    public function get_session()
    {
        $id = $this->CI->session->userdata('id');
        // echo $id;
        $row  = $this->CI->db->query('SELECT * FROM tb_account where id = "' . $id . '"');
        if ($row->num_rows() > 0) {
            $user     = $row->row();
            $session["status"] = "ok";
            $session["id"] = $user->id;
            $session["akses"] = $user->akses;
            $session["url_pic"] = $user->link_photo;
            $session["nama_lengkap"] = $user->nama_lengkap;
        } else {
            $session["status"] = "no_found";
        }

        return $session;
    }



    /**
     * Hapus session, lalu set notifikasi kemudian di alihkan
     * ke halaman login
     */
    public function logout()
    {
        $this->CI->session->unset_userdata('id');
        $this->CI->session->set_flashdata('alert', 'success|<b>Berhasil</b> melakukan logout.');
        redirect(base_url('account/login'));
    }
}

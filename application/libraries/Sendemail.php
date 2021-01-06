<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sendemail
{
    protected $_ci;

    function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->model('App');
        $this->_ci->load->model('M_transaksi');
    }

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */
    public function config()
    {
        // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.britaincourse.id',
            'smtp_user' => 'no-reply@britaincourse.id',  // Email gmail
            'smtp_pass'   => 'segopecel12',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        return $config;
    }

    public function konfirmasi_akun($id_user)
    {

        // Data email
        $where_user['id'] = $id_user;
        $data['data'] = $this->_ci->App->get_where('tb_account', $where_user)->row();

        // Load library email dan konfigurasinya
        $this->_ci->load->library('email', $this->config());

        // Email dan nama pengirim
        $this->_ci->email->from('no-reply@britaincourse.id', 'Britain Course');

        // Email penerima
        $this->_ci->email->to($data['data']->email); // Ganti dengan email tujuan

        // Subject email
        $this->_ci->email->subject('Konfirmasi akun ' . $data['data']->email . ' yang telah mendaftar Britain Course');

        // Isi email
        $html = $this->_ci->load->view('email/konfirmasi', $data, true);
        $this->_ci->email->message($html);

        // Tampilkan pesan sukses atau error
        if ($this->_ci->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    }

    public function invoice($id_transaksi)
    {

        // Data email
        $where_trx['id'] = $id_transaksi;
        $data['data_trx'] = $this->_ci->App->get_where('tb_transaksi', $where_trx)->row();
        $data['data_list_trx'] = $this->_ci->M_transaksi->get_list_detail_transaksi($id_transaksi);
        $where_user['id'] = $data['data_trx']->id_user;
        $data['data_user'] = $this->_ci->App->get_where('tb_account', $where_user)->row();

        // Load library email dan konfigurasinya
        $this->_ci->load->library('email', $this->config());

        // Email dan nama pengirim
        $this->_ci->email->from('no-reply@britaincourse.id', 'Britain Course');

        // Email penerima
        $this->_ci->email->to($data['data_user']->email); // Ganti dengan email tujuan

        // Subject email
        $this->_ci->email->subject('Invoice transaksi #' . $data['data_trx']->code_trx . ', Segera lakukan pembayaran');

        // Isi email
        $html = $this->_ci->load->view('email/invoice', $data, true);
        $this->_ci->email->message($html);
        // echo $html;
        // Tampilkan pesan sukses atau error
        if ($this->_ci->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
            echo $this->_ci->email->print_debugger();
        }
    }

    public function pembayaran_dp($id_transaksi)
    {

        // Data email
        $where_trx['id'] = $id_transaksi;
        $data['data_trx'] = $this->_ci->App->get_where('tb_transaksi', $where_trx)->row();
        $data['data_list_trx'] = $this->_ci->M_transaksi->get_list_detail_transaksi($id_transaksi);
        $where_user['id'] = $data['data_trx']->id_user;
        $data['data_user'] = $this->_ci->App->get_where('tb_account', $where_user)->row();

        // Load library email dan konfigurasinya
        $this->_ci->load->library('email', $this->config());

        // Email dan nama pengirim
        $this->_ci->email->from('no-reply@britaincourse.id', 'Britain Course');

        // Email penerima
        $this->_ci->email->to($data['data_user']->email); // Ganti dengan email tujuan

        // Subject email
        $this->_ci->email->subject('Pembayaran DP transaksi #' . $data['data_trx']->code_trx . ' sudah kami terima');

        // Isi email
        $html = $this->_ci->load->view('email/pembayaran_dp', $data, true);
        $this->_ci->email->message($html);
        // echo $html;
        // Tampilkan pesan sukses atau error
        if ($this->_ci->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
            echo $this->_ci->email->print_debugger();
        }
    }

    public function pembayaran_lunas($id_transaksi)
    {

        // Data email
        $where_trx['id'] = $id_transaksi;
        $data['data_trx'] = $this->_ci->App->get_where('tb_transaksi', $where_trx)->row();
        $data['data_list_trx'] = $this->_ci->M_transaksi->get_list_detail_transaksi($id_transaksi);
        $where_user['id'] = $data['data_trx']->id_user;
        $data['data_user'] = $this->_ci->App->get_where('tb_account', $where_user)->row();

        // Load library email dan konfigurasinya
        $this->_ci->load->library('email', $this->config());

        // Email dan nama pengirim
        $this->_ci->email->from('no-reply@britaincourse.id', 'Britain Course');

        // Email penerima
        $this->_ci->email->to($data['data_user']->email); // Ganti dengan email tujuan

        // Subject email
        $this->_ci->email->subject('Pembayaran transaksi #' . $data['data_trx']->code_trx . ' sudah kami terima');

        // Isi email
        $html = $this->_ci->load->view('email/pembayaran_lunas', $data, true);
        $this->_ci->email->message($html);
        // echo $html;
        // Tampilkan pesan sukses atau error
        if ($this->_ci->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
            echo $this->_ci->email->print_debugger();
        }
    }

    public function pembayaran_expired($id_transaksi)
    {

        // Data email
        $where_trx['id'] = $id_transaksi;
        $data['data_trx'] = $this->_ci->App->get_where('tb_transaksi', $where_trx)->row();
        $data['data_list_trx'] = $this->_ci->M_transaksi->get_list_detail_transaksi($id_transaksi);
        $where_user['id'] = $data['data_trx']->id_user;
        $data['data_user'] = $this->_ci->App->get_where('tb_account', $where_user)->row();

        // Load library email dan konfigurasinya
        $this->_ci->load->library('email', $this->config());

        // Email dan nama pengirim
        $this->_ci->email->from('no-reply@britaincourse.id', 'Britain Course');

        // Email penerima
        $this->_ci->email->to($data['data_user']->email); // Ganti dengan email tujuan

        // Subject email
        $this->_ci->email->subject('Pembayaran transaksi #' . $data['data_trx']->code_trx . ' telah kadaluarsa');

        // Isi email
        $html = $this->_ci->load->view('email/pembayaran_expired', $data, true);
        $this->_ci->email->message($html);
        // echo $html;
        // Tampilkan pesan sukses atau error
        if ($this->_ci->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
            echo $this->_ci->email->print_debugger();
        }
    }

    public function pembayaran_batal($id_transaksi)
    {

        // Data email
        $where_trx['id'] = $id_transaksi;
        $data['data_trx'] = $this->_ci->App->get_where('tb_transaksi', $where_trx)->row();
        $data['data_list_trx'] = $this->_ci->M_transaksi->get_list_detail_transaksi($id_transaksi);
        $where_user['id'] = $data['data_trx']->id_user;
        $data['data_user'] = $this->_ci->App->get_where('tb_account', $where_user)->row();

        // Load library email dan konfigurasinya
        $this->_ci->load->library('email', $this->config());

        // Email dan nama pengirim
        $this->_ci->email->from('no-reply@britaincourse.id', 'Britain Course');

        // Email penerima
        $this->_ci->email->to($data['data_user']->email); // Ganti dengan email tujuan

        // Subject email
        $this->_ci->email->subject('Pembayaran transaksi #' . $data['data_trx']->code_trx . ' telah dibatalkan');

        // Isi email
        $html = $this->_ci->load->view('email/pembayaran_batal', $data, true);
        $this->_ci->email->message($html);
        // echo $html;
        // Tampilkan pesan sukses atau error
        if ($this->_ci->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
            echo $this->_ci->email->print_debugger();
        }
    }
}

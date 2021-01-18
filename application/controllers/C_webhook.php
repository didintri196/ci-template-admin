<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_webhook extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('App');
		$this->load->model('M_notif');
	}

	function status_va(){
		$stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
		$request = json_decode($stream_clean);
	}

	function pay_va(){
		$stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
		$request = json_decode($stream_clean);
		$where['id'] = $request->external_id;
		$data['status'] = 'payed';
		$update = $this->App->update('tb_transaksi', $data, $where);
		if ($update) {
			//GET TRX
			$transaksi = $this->App->get_where('tb_transaksi', $where)->row();
			//GET USER
			$where_user['id'] = $transaksi->id_user;
			$user = $this->App->get_where('tb_account', $where_user)->row();
			//SEND NOTIF
			$this->M_notif->create("email_transaksi",$transaksi->id,"payed",$user->email);
		}
	}

	function pay_retail(){
		$stream_clean = $this->security->xss_clean($this->input->raw_input_stream);
		$request = json_decode($stream_clean);
		$where['id'] = $request->external_id;
		$data['status'] = 'payed';
		$update = $this->App->update('tb_transaksi', $data, $where);
		if ($update) {
			//GET TRX
			$transaksi = $this->App->get_where('tb_transaksi', $where)->row();
			//GET USER
			$where_user['id'] = $transaksi->id_user;
			$user = $this->App->get_where('tb_account', $where_user)->row();
			//SEND NOTIF
			$this->M_notif->create("email_transaksi",$transaksi->id,"payed",$user->email);
		}
	}
}

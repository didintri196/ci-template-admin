<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_coupon extends CI_Controller
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
		$this->load->model('M_coupon');
	}

	public function api_getcodewherecode($code)
	{
		$get = $this->M_coupon->get_kode($code)->row();
		echo json_encode($get);
	}

	public function index()
	{
		$iduser = "1";
		$view['_title'] = "Data coupon &mdash; Britain Kampung Inggris";
		$where['id_user'] = $iduser;
		$view['listdata'] = $this->App->get_all_orderby('tb_coupon', "id", "DESC");
		$this->template->display_theme('pages/V_coupon', $view);
	}

	public function ack_add()
	{
		$data['code'] = $this->input->post('code');
		$data['quota'] = $this->input->post('quota');
		$data['start'] = $this->input->post('start');
		$data['end'] = $this->input->post('end');
		$data['tipe'] = $this->input->post('tipe');
		$data['value'] = $this->input->post('value');
		$data['deskripsi'] = $this->input->post('deskripsi');
		$data['status'] = $this->input->post('status');
		$insert = $this->App->insert('tb_coupon', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat data coupon.');
			redirect(base_url('/account/coupon'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat data coupon.');
			redirect(base_url('/account/coupon'));
		}
	}

	public function ack_view($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_coupon', $where);
		echo json_encode($data->row());
	}

	public function ack_update()
	{
		$where['id'] = $this->input->post('id');
		$data['code'] = $this->input->post('code');
		$data['quota'] = $this->input->post('quota');
		$data['start'] = $this->input->post('start');
		$data['end'] = $this->input->post('end');
		$data['tipe'] = $this->input->post('tipe');
		$data['value'] = $this->input->post('value');
		$data['deskripsi'] = $this->input->post('deskripsi');
		$data['status'] = $this->input->post('status');
		$update = $this->App->update('tb_coupon', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data coupon.');
			redirect(base_url('/account/coupon'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data coupon.');
			redirect(base_url('/account/coupon'));
		}
	}

	public function ack_delete()
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_coupon', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus data coupon.');
			redirect(base_url('/account/coupon'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus data coupon.');
			redirect(base_url('/account/coupon'));
		}
	}

}

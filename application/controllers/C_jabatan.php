<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_jabatan extends CI_Controller
{

	/**
	 * Developer : Didin Tri Anggoro
	 * Github	 : https://github.com/didintri196
	 * Email	 : didintri196@gmail.com
	 * Create At : 04-04-2021
	 */
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('App');
	}

	public function index()
	{
		$iduser = "1";
		$view['_title'] = "Data Jabatan &mdash; E-izin Kejari Kota Kediri";
		$where['id_user'] = $iduser;
		$view['listdata'] = $this->App->get_all_orderby('jabatan', "id", "DESC");
		$this->template->display_theme('pages/V_jabatan', $view);
	}

	public function ack_add()
	{
		$data['id'] = $this->App->GenerateId('jabatan', 'K');
		$data['nama'] = $this->input->post('nama');
		$insert = $this->App->insert('jabatan', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat data jabatan.');
			redirect(base_url('/admin/jabatan'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat data jabatan.');
			redirect(base_url('/admin/jabatan'));
		}
	}

	public function ack_view($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('jabatan', $where);
		echo json_encode($data->row());
	}

	public function ack_update()
	{
		$where['id'] = $this->input->post('id');
		$data['nama'] = $this->input->post('nama');
		$update = $this->App->update('jabatan', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data jabatan.');
			redirect(base_url('/admin/jabatan'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data jabatan.');
			redirect(base_url('/admin/jabatan'));
		}
	}

	public function ack_delete()
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('jabatan', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus data jabatan.');
			redirect(base_url('/admin/jabatan'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus data jabatan.');
			redirect(base_url('/admin/jabatan'));
		}
	}
}

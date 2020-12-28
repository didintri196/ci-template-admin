<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_materi extends CI_Controller
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
	}

	public function index()
	{
		$iduser = "1";
		$view['_title'] = "Data materi &mdash; Britain Kampung Inggris";
		$where['id_user'] = $iduser;
		$view['listdata'] = $this->App->get_all_orderby('tb_materi', "id", "DESC");
		$this->template->display_theme('pages/V_materi', $view);
	}

	public function ack_add()
	{
		$data['nama'] = $this->input->post('nama');
		$insert = $this->App->insert('tb_materi', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat data materi.');
			redirect(base_url('/account/materi'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat data materi.');
			redirect(base_url('/account/materi'));
		}
	}

	public function ack_view($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_materi', $where);
		echo json_encode($data->row());
	}

	public function ack_update()
	{
		$where['id'] = $this->input->post('id');
		$data['nama'] = $this->input->post('nama');
		$update = $this->App->update('tb_materi', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data materi.');
			redirect(base_url('/account/materi'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data materi.');
			redirect(base_url('/account/materi'));
		}
	}

	public function ack_delete()
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_materi', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus data materi.');
			redirect(base_url('/account/materi'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus data materi.');
			redirect(base_url('/account/materi'));
		}
	}
}

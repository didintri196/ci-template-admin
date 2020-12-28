<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_asrama extends CI_Controller
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
		$view['_title'] = "Data asrama &mdash; Britain Kampung Inggris";
		$view['listdata'] = $this->App->get_all_orderby('tb_asrama', "id", "DESC");
		$this->template->display_theme('pages/V_asrama', $view);
	}

	public function ack_add()
	{
		$data['nama'] = $this->input->post('nama');
		$insert = $this->App->insert('tb_asrama', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat data asrama.');
			redirect(base_url('/account/asrama'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat data asrama.');
			redirect(base_url('/account/asrama'));
		}
	}

	public function ack_view($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_asrama', $where);
		echo json_encode($data->row());
	}

	public function ack_update()
	{
		$where['id'] = $this->input->post('id');
		$data['nama'] = $this->input->post('nama');
		$update = $this->App->update('tb_asrama', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data asrama.');
			redirect(base_url('/account/asrama'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data asrama.');
			redirect(base_url('/account/asrama'));
		}
	}

	public function ack_delete()
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_asrama', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus data asrama.');
			redirect(base_url('/account/asrama'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus data asrama.');
			redirect(base_url('/account/asrama'));
		}
	}

	public function fasilitas($id_asrama)
	{
		$iduser = "1";
		$view['_title'] = "Fasilitas asrama &mdash; Britain Kampung Inggris";
		$where['id_asrama'] = $id_asrama;
		$view['listdata'] = $this->App->get_where_orderby('tb_fasilitas_asrama', $where, "id", "ASC");
		$where2['id'] = $id_asrama;
		$view['data_asrama'] = $this->App->get_where('tb_asrama', $where2)->row();
		$this->template->display_theme('pages/V_asrama_fasilitas', $view);
	}

	public function ack_add_detail($id_asrama)
	{
		$data['id_asrama'] = $id_asrama;
		$data['fasilitas'] = $this->input->post('fasilitas');
		$insert = $this->App->insert('tb_fasilitas_asrama', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat fasilitas asrama.');
			redirect(base_url('/account/asrama/'. $id_asrama.'/fasilitas'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat fasilitas asrama.');
			redirect(base_url('/account/asrama/'. $id_asrama.'/fasilitas'));
		}
	}

	public function ack_view_detail($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_fasilitas_asrama', $where);
		echo json_encode($data->row());
	}

	public function ack_update_detail($id_asrama)
	{
		$where['id'] = $this->input->post('id');
		$data['fasilitas'] = $this->input->post('fasilitas');
		$update = $this->App->update('tb_fasilitas_asrama', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah fasilitas asrama.');
			redirect(base_url('/account/asrama/'. $id_asrama.'/fasilitas'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah fasilitas asrama.');
			redirect(base_url('/account/asrama/'. $id_asrama.'/fasilitas'));
		}
	}

	public function ack_delete_detail($id_asrama)
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_fasilitas_asrama', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus fasilitas asrama.');
			redirect(base_url('/account/asrama/'. $id_asrama.'/fasilitas'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus fasilitas asrama.');
			redirect(base_url('/account/asrama/'. $id_asrama.'/fasilitas'));
		}
	}
}

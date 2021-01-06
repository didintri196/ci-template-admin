<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_jadwal extends CI_Controller
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
		$this->sessionlogin->cek_login();
		$this->load->model('App');
		$this->load->model('M_jadwal');
	}

	public function index()
	{
		$iduser = "1";
		$view['_title'] = "Data jadwal &mdash; Britain Kampung Inggris";
		$view['listdata'] = $this->App->get_all_orderby('tb_jadwal', "id", "DESC");
		$this->template->display_theme('pages/V_jadwal', $view);
	}

	public function ack_add()
	{
		$data['judul'] = $this->input->post('judul');
		$insert = $this->App->insert('tb_jadwal', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat data jadwal.');
			redirect(base_url('/account/jadwal'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat data jadwal.');
			redirect(base_url('/account/jadwal'));
		}
	}

	public function ack_view($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_jadwal', $where);
		echo json_encode($data->row());
	}

	public function ack_update()
	{
		$where['id'] = $this->input->post('id');
		$data['judul'] = $this->input->post('judul');
		$update = $this->App->update('tb_jadwal', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data jadwal.');
			redirect(base_url('/account/jadwal'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data jadwal.');
			redirect(base_url('/account/jadwal'));
		}
	}

	public function ack_delete()
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_jadwal', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus data jadwal.');
			redirect(base_url('/account/jadwal'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus data jadwal.');
			redirect(base_url('/account/jadwal'));
		}
	}

	public function materi($id_jadwal)
	{
		$iduser = "1";
		$view['_title'] = "detail jadwal &mdash; Britain Kampung Inggris";
		$view['listdata'] = $this->M_jadwal->get_list_materi_id_jadwal($id_jadwal);
		$where2['id'] = $id_jadwal;
		$view['data_jadwal'] = $this->App->get_where('tb_jadwal', $where2)->row();
		$view['data_materi'] = $this->App->get_all('tb_materi');
		$where3['akses'] = "pengajar";
		$view['data_pengajar'] = $this->App->get_where('tb_account', $where3);
		$view['id_jadwal'] = $id_jadwal;
		$this->template->display_theme('pages/V_jadwal_detail', $view);
	}

	public function ack_add_detail($id_jadwal)
	{
		$data['id_jadwal'] = $id_jadwal;
		$data['id_materi'] = $this->input->post('id_materi');
		$data['id_pengajar'] = $this->input->post('id_pengajar');
		$data['hari'] = $this->input->post('hari');
		$data['jam'] = $this->input->post('jam');
		$data['durasi'] = $this->input->post('durasi');
		$insert = $this->App->insert('tb_detail_jadwal', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat materi jadwal.');
			redirect(base_url('/account/jadwal/'. $id_jadwal.'/materi'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat materi jadwal.');
			redirect(base_url('/account/jadwal/'. $id_jadwal.'/materi'));
		}
	}

	public function ack_view_detail($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_detail_jadwal', $where);
		echo json_encode($data->row());
	}

	public function ack_update_detail($id_jadwal)
	{
		$where['id'] = $this->input->post('id');
		$data['id_jadwal'] = $id_jadwal;
		$data['id_materi'] = $this->input->post('id_materi');
		$data['id_pengajar'] = $this->input->post('id_pengajar');
		$data['hari'] = $this->input->post('hari');
		$data['jam'] = $this->input->post('jam');
		$data['durasi'] = $this->input->post('durasi');
		$update = $this->App->update('tb_detail_jadwal', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah materi jadwal.');
			redirect(base_url('/account/jadwal/'. $id_jadwal.'/materi'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah materi jadwal.');
			redirect(base_url('/account/jadwal/'. $id_jadwal.'/materi'));
		}
	}

	public function ack_delete_detail($id_jadwal)
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_detail_jadwal', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus materi jadwal.');
			redirect(base_url('/account/jadwal/'. $id_jadwal.'/materi'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus materi jadwal.');
			redirect(base_url('/account/jadwal/'. $id_jadwal.'/materi'));
		}
	}
}

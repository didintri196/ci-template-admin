<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_user extends CI_Controller
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
		$view['_title'] = "Data user &mdash; Britain Kampung Inggris";
		$where['id_user'] = $iduser;
		$view['listdata'] = $this->App->get_all_orderby('tb_account', "id", "DESC");
		$this->template->display_theme('pages/V_user', $view);
	}

	public function ack_add()
	{
		$file_upload = $this->uploader->image('profile');
		if ($file_upload["status"] == "success") {
			$data['nama_lengkap'] = $this->input->post('nama_lengkap');
			$data['email'] = $this->input->post('email');
			$data['no_telp'] = $this->input->post('no_telp');
			$data['alamat'] = $this->input->post('alamat');
			$data['password'] = md5($this->input->post('password'));
			$data['link_photo'] = $file_upload["data"]["file_name"];
			// print_r($file_upload);
			$data['create_at'] = date("Y-m-d H:i:s");
			$data['akses'] = $this->input->post('akses');
			$data['status'] = $this->input->post('status');
			$insert = $this->App->insert('tb_account', $data);
			if ($insert) {
				$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat data user.');
				redirect(base_url('/account/user'));
			} else {
				$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat data user.');
				redirect(base_url('/account/user'));
			}
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal Upload</b> '.$file_upload["error"]);
			redirect(base_url('/account/user'));
		}
	}

	public function ack_view($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_account', $where);
		echo json_encode($data->row());
	}

	public function ack_update()
	{
		$where['id'] = $this->input->post('id');
		$file_upload = $this->uploader->image('profile');
		if ($file_upload["status"] == "success") {
			$data['nama_lengkap'] = $this->input->post('nama_lengkap');
			$data['email'] = $this->input->post('email');
			$data['no_telp'] = $this->input->post('no_telp');
			$data['alamat'] = $this->input->post('alamat');
			$data['link_photo'] = $file_upload["data"]["file_name"];
			// print_r($file_upload);
			$data['create_at'] = date("Y-m-d H:i:s");
			$data['akses'] = $this->input->post('akses');
			$data['status'] = $this->input->post('status');
			$update = $this->App->update('tb_account', $data,$where);
			if ($update) {
				$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data user.');
				redirect(base_url('/account/user'));
			} else {
				$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data user.');
				redirect(base_url('/account/user'));
			}
		} else {
			$data['nama_lengkap'] = $this->input->post('nama_lengkap');
			$data['email'] = $this->input->post('email');
			$data['no_telp'] = $this->input->post('no_telp');
			$data['alamat'] = $this->input->post('alamat');
			$data['create_at'] = date("Y-m-d H:i:s");
			$data['akses'] = $this->input->post('akses');
			$data['status'] = $this->input->post('status');
			$update = $this->App->update('tb_account', $data,$where);
			if ($update) {
				$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data user.');
				redirect(base_url('/account/user'));
			} else {
				$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data user.');
				redirect(base_url('/account/user'));
			}
		}
	}

	public function ack_delete()
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_account', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus data user.');
			redirect(base_url('/account/user'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus data user.');
			redirect(base_url('/account/user'));
		}
	}
}

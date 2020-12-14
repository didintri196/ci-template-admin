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
		$view['_title'] = "Data User - MinSys";
		$view['listdata'] = $this->App->get_all('tb_user');
		$this->template->display_theme('pages/V_user', $view);
	}

	public function add()
	{
		$config['host'] = "vpn2.labkom.my.id";
		$config['user'] = "admin";
		$config['pass'] = "segopecel12";
		$config['port'] = "31227";

		$data['id'] = $this->App->GenerateId("tb_paket", "P");
		$data['nama_paket'] = $this->input->post("nama_paket");
		$download = $this->input->post("download");
		$upload = $this->input->post("upload");
		$data['rate_limit'] = $upload . "/" . $download;
		$data['harga'] = $this->input->post("harga");
		$data['deskripsi'] = $this->input->post("deskripsi");
		$insert_db = $this->App->insert('tb_paket', $data);
		if ($insert_db) {
			$this->session->set_flashdata('alert', 'selesai|success|<b>Database</b>  Berhasil Menambahkan Paket <b>' . $data['nama_paket'] . '</b>.');
			$create_profile_mikrotik = $this->mikrotikapi->ppp_profile_create($config, $data['id'], $data['nama_paket'], $data['rate_limit'], $data['harga']);
			if ($create_profile_mikrotik) {
				$this->session->set_flashdata('alert2', 'selesai|success|<b>Mikrotik</b>  Berhasil Menambahkan Paket <b>' . $data['nama_paket'] . '</b>.');
			}
		} else {
			$this->session->set_flashdata('alert', 'selesai|warning|<b>Mohon Maaf</b> Gagal Menambahkan Paket.');
		}
		redirect(base_url('paket'));
	}
}

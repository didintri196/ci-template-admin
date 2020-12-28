<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_account extends CI_Controller
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

	public function profile()
	{
		$view['_title'] = "Profile Account &mdash; Britain Kampung Inggris";
		$iduser = "1";
		$where_account['id'] = $iduser;
		$row_account = $this->App->get_where("tb_account", $where_account);
		$data_account = $row_account->row();
		$view['data_account'] = $data_account;
		$this->template->display_theme('pages/V_profile', $view);
	}

}

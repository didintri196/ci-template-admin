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

	public function login()
	{
		$view['_title'] = "Masuk Akun &mdash; Britain Kampung Inggris";
		if ($this->input->post()) {
			$this->login_ack();
		}else{
			$this->template->display_ui('pages_ui/V_login', $view);
		}
	}

	public function register()
	{
		$view['_title'] = "Daftar Akun &mdash; Britain Kampung Inggris";
		$this->template->display_ui('pages_ui/V_register', $view);
	}

	public function profile()
	{
		$this->sessionlogin->cek_login();
		$session = $this->sessionlogin->get_session();
		$view['_title'] = "Profile Account &mdash; Britain Kampung Inggris";
		$iduser = $session['id'];
		$where_account['id'] = $iduser;
		$row_account = $this->App->get_where("tb_account", $where_account);
		$data_account = $row_account->row();
		$view['data_account'] = $data_account;
		$this->template->display_theme('pages/V_profile', $view);
	}

	public function verif($code)
	{
		$id = $code[0];
		$password = substr($code, 1);
		// echo $id."<br>"; 
		// echo $password; 
		$where_account['id'] = $id;
		$where_account['password'] = $password;
		$where_account['status'] = 'regis';
		if ($this->App->get_where("tb_account", $where_account)->num_rows() > 0) {
			$data['status'] = 'valid';
			$update = $this->App->update("tb_account", $data, $where_account);
			if ($update) {
				$this->session->set_flashdata('alert', 'success|<b>Berhasil Konfirmasi Akun,</b> Silahkan login dashboard.');
				redirect(base_url("account/login"));
			} else {
				$this->session->set_flashdata('alert', 'danger|<b>Gagal Konfirmasi Akun,</b> Silahkan hubungi admin.');
				redirect(base_url("account/login"));
			}
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal Konfirmasi Akun,</b> Silahkan hubungi admin.');
			redirect(base_url("account/login"));
		}
	}

	public function login_ack()
	{
		if ($this->input->post()) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			if ($email != "" || $password != "") {
				$where_cek['email']=$email;
				$where_cek['password']=md5($password);
				$cek = $this->App->get_where('tb_account', $where_cek);
				if ($cek->num_rows() > 0) {
					$data_user=$cek->row();
					// echo $data_user->id;
					$this->sessionlogin->login($data_user->id);
					redirect(base_url('account/dashboard'));
				} else {
					$this->session->set_flashdata('alert', 'warning|<b>Mohon Maaf</b> Username atau password anda salah.');
					redirect(base_url('account/login'));
				}
			}
		} else {
			echo "404 NOT FOUND";
		}
	}

	public function test(){
		echo json_encode($this->sessionlogin->get_session());
	}

	public function logout()
	{
		$this->sessionlogin->logout();
	}

}

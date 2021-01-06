<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends CI_Controller {

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
	public function index()
	{                             
		$this->load->library('user_agent');
		$view['_title']="Selamat Datang &mdash; Britain Kampung Inggris";
		$this->template->display_ui('pages_ui/V_home',$view);
	}
	// public function redirect(){
	// 	redirect(base_url('account/dashboard'));
	// }

	function test_email(){
		// $this->sendemail->konfirmasi_akun(6);//OK
		// $this->sendemail->invoice('T0000005');//OK
		// $this->sendemail->pembayaran_dp('T0000005');//OK
		// $this->sendemail->pembayaran_lunas('T0000004');//OK
		// $this->sendemail->pembayaran_expired('T0000004');//OK
		$this->sendemail->pembayaran_lunas('T0000004');//OK
	}
}

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

}

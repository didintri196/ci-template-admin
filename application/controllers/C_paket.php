<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_paket extends CI_Controller
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
		$this->load->model('M_paket');
		$this->load->model('M_asrama');
	}

	public function register()
	{
		$view['_title'] = "Daftar Paket &mdash; Britain Kampung Inggris";
		$view['listdatakategori'] = $this->App->get_all('tb_kategori');
		$view['listperiode'] = $this->generateperiode();
		$this->template->display_theme('pages/V_daftar_paket', $view);
	}

	function generateperiode(){
		$d=date("d");
		$periode=array();
		if($d<=10){
			array_push($periode, "10".date("-m-Y"));
		}else if($d>=25){
			$nxtm = strtotime("next month");
			$nextmonth=date("-m-Y", $nxtm);
			array_push($periode, "10".$nextmonth, "25".$nextmonth);
		}else{
			$nxtm = strtotime("next month");
			$nextmonth=date("-m-Y", $nxtm);
			array_push($periode, "25".date("-m-Y"), "10".$nextmonth);
		}
		return $periode;
		// echo json_encode($periode);
	}

	public function api_getpaketwherecat($idkategori)
	{
		$newdata=array();
		$listdata = $this->M_paket->get_list_paket_kategori_active($idkategori);
		$i=0;
		foreach($listdata->result_array() as $rowdata){
		$list_fasilitas_asrama = $this->M_asrama->get_faslitas_id($rowdata['id_asrama']);
			$rowdata['fasilitas_asrama']=$list_fasilitas_asrama->result();
			$newdata[$i]=$rowdata;
		$i++;}
		echo json_encode($newdata);
	}

	public function api_getpaketwhereid($id)
	{
		$listdata = $this->M_paket->get_list_paket_id($id);
		foreach($listdata->result_array() as $rowdata){
		$list_fasilitas_asrama = $this->M_asrama->get_faslitas_id($rowdata['id_asrama']);
			$rowdata['fasilitas_asrama']=$list_fasilitas_asrama->result();
			$newdata=$rowdata;
		}
		echo json_encode($newdata);
	}

	public function index()
	{
		$iduser = "1";
		$view['_title'] = "Data Paket &mdash; Britain Kampung Inggris";
		$where['id_user'] = $iduser;
		$view['listdata'] = $this->M_paket->get_list_paket_all();
		$this->template->display_theme('pages/V_paket', $view);
	}

	public function ack_add()
	{
		$data['id'] = $this->App->GenerateId('tb_kategori', 'K');
		$data['nama'] = $this->input->post('nama');
		$data['deskripsi'] = $this->input->post('deskripsi');
		$data['materi'] = $this->input->post('materi');
		$data['status'] = $this->input->post('status');
		$insert = $this->App->insert('tb_kategori', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat data kategori.');
			redirect(base_url('/account/kategori'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat data kategori.');
			redirect(base_url('/account/kategori'));
		}
	}

	public function ack_view($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_kategori', $where);
		echo json_encode($data->row());
	}

	public function ack_update()
	{
		$where['id'] = $this->input->post('id');
		$data['nama'] = $this->input->post('nama');
		$data['deskripsi'] = $this->input->post('deskripsi');
		$data['materi'] = $this->input->post('materi');
		$data['status'] = $this->input->post('status');
		$update = $this->App->update('tb_kategori', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data kategori.');
			redirect(base_url('/account/kategori'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data kategori.');
			redirect(base_url('/account/kategori'));
		}
	}

	public function ack_delete()
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_kategori', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus data kategori.');
			redirect(base_url('/account/kategori'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus data kategori.');
			redirect(base_url('/account/kategori'));
		}
	}
}

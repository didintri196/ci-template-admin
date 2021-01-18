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
			array_push($periode, "25".date("-m-Y"));
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

	public function api_getpaketwherecat($idkategori,$periode)
	{
		$periode=explode("-",$periode);
		$periode=$periode[0];
		// echo $periode;
		$newdata=array();
		$listdata = $this->M_paket->get_list_paket_kategori_active_periode_spec($idkategori,$periode);
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
		$view['listasrama'] = $this->App->get_all_orderby("tb_asrama", "id", "DESC");
		$view['listjadwal'] = $this->App->get_all_orderby('tb_jadwal', "id", "DESC");
		$view['listkategori'] = $this->App->get_all_orderby('tb_kategori', "id", "DESC");
		$view['listdata'] = $this->M_paket->get_list_paket_all();
		$this->template->display_theme('pages/V_paket', $view);
	}

	public function ack_add()
	{
		$data['id'] = $this->App->GenerateId('tb_paket', 'P');
		$data['judul'] = $this->input->post('judul');
		$data['id_kategori'] = $this->input->post('id_kategori');
		$data['deskripsi'] = $this->input->post('deskripsi');
		$data['harga'] = $this->input->post('harga');
		$data['dp'] = $this->input->post('dp');
		$data['periode'] = $this->input->post('periode');
		$data['durasi'] = $this->input->post('durasi');
		$data['asrama'] = $this->input->post('asrama');
		$data['id_asrama'] = $this->input->post('id_asrama');
		$data['jadwal'] = $this->input->post('jadwal');
		$data['id_jadwal'] = $this->input->post('id_jadwal');
		$data['status'] = $this->input->post('status');
		$insert = $this->App->insert('tb_paket', $data);
		if ($insert) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil membuat data paket.');
			redirect(base_url('/account/paket'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal membuat data paket.');
			redirect(base_url('/account/paket'));
		}
	}

	public function ack_view($id)
	{
		$where['id'] = $id;
		$data = $this->App->get_where('tb_paket', $where);
		echo json_encode($data->row());
	}

	public function ack_update()
	{
		$where['id'] = $this->input->post('id');
		$data['judul'] = $this->input->post('judul');
		$data['id_kategori'] = $this->input->post('id_kategori');
		$data['deskripsi'] = $this->input->post('deskripsi');
		$data['harga'] = $this->input->post('harga');
		$data['dp'] = $this->input->post('dp');
		$data['periode'] = $this->input->post('periode');
		$data['durasi'] = $this->input->post('durasi');
		$data['asrama'] = $this->input->post('asrama');
		$data['id_asrama'] = $this->input->post('id_asrama');
		$data['jadwal'] = $this->input->post('jadwal');
		$data['id_jadwal'] = $this->input->post('id_jadwal');
		$data['status'] = $this->input->post('status');
		$update = $this->App->update('tb_paket', $data, $where);
		if ($update) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil mengubah data paket.');
			redirect(base_url('/account/paket'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal mengubah data paket.');
			redirect(base_url('/account/paket'));
		}
	}

	public function ack_delete()
	{
		$where['id'] = $this->input->post('id');
		$delete = $this->App->delete('tb_kategori', $where);
		if ($delete) {
			$this->session->set_flashdata('alert', 'success|<b>Success</b> Berhasil hapus data kategori.');
			redirect(base_url('/account/paket'));
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b> Gagal hapus data kategori.');
			redirect(base_url('/account/paket'));
		}
	}
}

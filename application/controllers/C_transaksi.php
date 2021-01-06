<?php
defined('BASEPATH') or exit('No direct script access allowed');
class C_transaksi extends CI_Controller
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
		$this->load->model('M_paket');
		$this->load->model('M_coupon');
		$this->load->model('M_transaksi');
		$this->load->model('M_notif');
		// $this->load->model('xenditlib');
	}

	public function index()
	{
		$session = $this->sessionlogin->get_session();
		$iduser = $session['id'];
		$view['_title'] = "List Transaksi &mdash; Britain Kampung Inggris";
		$where['id_user'] = $iduser;
		$view['listdata'] = $this->App->get_where_orderby('tb_transaksi', $where, "id", "DESC");
		if($session['akses']=="user"){
			$this->template->display_theme('pages/V_transaksi_user', $view);
		}else{
			$this->template->display_theme('pages/V_transaksi_admin', $view);
		}
		// $this->xenditlib->get_ballance();
	}
	public function checkout($param)
	{
		if ($this->input->post()) {
			$this->ack_checkout();
		} else {
			$param = urldecode($param);
			$param = base64_decode($param);
			$pecah = explode("|", $param);
			$id = $pecah[0];
			$view['periode'] = $pecah[1];
			// echo $periode;
			$get_data_paket = $this->M_paket->get_list_paket_id($id)->row();
			$view['datapaket'] = $get_data_paket;
			$view['status_pay'] = $this->input->get("pay");
			$view['_title'] = "Checkout Paket &mdash; Britain Kampung Inggris";
			$view['listdata'] = $this->App->get_all('tb_paket');
			$where_metode['status'] = "true";
			$view['listmetode'] = $this->App->get_where("tb_metode_pembayaran", $where_metode);
			$this->template->display_theme('pages/V_checkout', $view);
		}
	}

	function GenerateCode($n)
	{
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';

		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}

		return $randomString;
	}

	public function ack_checkout()
	{
		$session = $this->sessionlogin->get_session();
		$iduser = $session['id'];
		$where_account['id'] = $iduser;
		$row_account = $this->App->get_where("tb_account", $where_account);
		$data_account = $row_account->row();
		$nama = $data_account->nama_lengkap;
		if ($this->input->post()) {
			$where['id_user'] = $iduser;
			$where['status'] = "pending";
			$id = $this->input->post('id');
			$get_data_paket = $this->M_paket->get_list_paket_id($id)->row();
			$PromoCode = $this->input->post('PromoCode');
			$status_pay = $this->input->post('status_pay');
			$periode = $this->input->post('periode');
			$paymentmethod = $this->input->post('paymentmethod');
			$url = base64_encode($id . "|" . $periode);

			$cek_trx = $this->App->total_rows_where('tb_transaksi', $where);
			if ($cek_trx == 0) {
				//hitung detail transaksi
				$total_harga = 0;
				$total_dp = 0;
				$id_asrama = "";
				// foreach($list_id_paket as $row_id_paket){
				$total_harga = $get_data_paket->harga;
				$total_dp = $get_data_paket->dp;
				$id_asrama = $get_data_paket->id_asrama;
				// }

				//insert transaksi
				if ($status_pay == "dp") {
					$transaksi['subtotal'] = $total_dp;
				} else {
					$transaksi['subtotal'] = $total_harga;
					$status_pay = "full";
				}
				//hitung potongan voucher
				$potongan = 0;
				$coupon = "";
				$coupon_status = "ok";
				if ($PromoCode != "") {
					$cekkupon = $this->M_coupon->get_kode($PromoCode)->row();
					if ($cekkupon->status == "active") {
						if ($cekkupon->tipe == "PERCENT") {
							$potongan = $total_harga * $cekkupon->value / 100;
						} elseif ($cekkupon->tipe == "NOMINAL") {
							$potongan = $cekkupon->value;
						}

						$coupon = $PromoCode;
					} else {
						$coupon_status = "error";
					}
				}
				if ($coupon_status == "ok") {
					$transaksi['potongan'] = $potongan;
					$transaksi['pembayaran_tipe'] = $status_pay;
					$kurangan = 0;
					if ($status_pay == "dp") {
						$total_bayar = $total_dp;
						$kurangan = $total_harga - $potongan - $total_dp;
					} else {
						$total_bayar = $total_harga - $potongan;
					}
					$transaksi['total_bayar'] = $total_bayar;
					$transaksi['kurangan'] = $kurangan;
					$transaksi['total_trx'] = $total_harga - $potongan;
					$transaksi['code_metode'] = $paymentmethod;
					//GET XENDIT
					$transaksi['trx_metode'] = "-";
					$transaksi['id_user'] = $iduser;
					$transaksi['periode'] = $periode;
					$currentDate =  time(); // get current date
					$tanggal_buat = $currentDate;
					$tanggal_kadaluwarsa = strtotime('+6 hours', $currentDate);;
					$transaksi['tgl_buat'] = $tanggal_buat;
					$transaksi['tgl_kadaluwarsa'] = $tanggal_kadaluwarsa;
					$transaksi['status'] = "pending";
					$transaksi['coupon'] = $coupon;
					$transaksi['id_asrama'] = $id_asrama;
					$transaksi['sertifikat'] = "";
					$code_trx = $this->GenerateCode(6);
					$transaksi['code_trx'] = $code_trx;
					$id_transaksi = $this->App->GenerateId('tb_transaksi', "T");
					$transaksi['id'] = $id_transaksi;

					$insert = $this->App->insert("tb_transaksi", $transaksi);
					if ($insert) {
						//insert detail transaksi
						// foreach($list_id_paket as $row_id_paket){
						$detail_transaksi['id_transaksi'] = $id_transaksi;
						$detail_transaksi['id_paket'] = $id;
						$detail_transaksi['harga'] = $get_data_paket->harga;
						$detail_transaksi['dp'] = $get_data_paket->dp;
						$this->App->insert("tb_detail_transaksi", $detail_transaksi);
						$tipe_metode = "";
						$bankcode = "";
						$where_metode['code'] = $paymentmethod;
						$row_metode = $this->App->get_where("tb_metode_pembayaran", $where_metode);
						if ($row_metode->num_rows() > 0) {
							$data_metode = $row_metode->row();
							$tipe_metode = $data_metode->tipe;
							$bankcode = $data_metode->code_api;
						} else {
							$where_metode['code'] = "bri_otomatis";
							$row_metode = $this->App->get_where("tb_metode_pembayaran", $where_metode);
							$data_metode = $row_metode->row();
							$tipe_metode = $data_metode->tipe;
							$bankcode = $data_metode->code_api;
						}
						// echo $bankcode;
						$code_metode = "-";
						// //TRIPAY
						// $email = "didintri196@gmail.com";
						// $phone = "085895567978";
						// $paket = $get_data_paket->nama_kategori." - ".$get_data_paket->judul;
						// $response_tripay = $this->tripay->virtualaccount_create($id_transaksi, $bankcode, $nama, $email, $phone, $paket, $periode, $total_bayar);
						// $code_metode = $response_tripay['pay_code'];
						// XENDIT
						$expired_xendit = gmdate('Y-m-d\TH:i:s\Z', $tanggal_kadaluwarsa);
						if ($tipe_metode == "RETAIL") {
							$response_xendit = $this->xenditlib->retail_create($id_transaksi, $bankcode, $nama, $total_bayar, $expired_xendit);
							$code_metode = $response_xendit['payment_code'];
						} else if ($tipe_metode == "QR") {
							$response_xendit = $this->xenditlib->qr_create($id_transaksi, $total_bayar);
							$code_metode = $response_xendit['qr_string'];
						} else {
							$response_xendit = $this->xenditlib->virtualaccount_create($id_transaksi, $bankcode, $nama, $total_bayar, $expired_xendit);
							$code_metode = $response_xendit['account_number'];
						}
						$where_trx['id'] = $id_transaksi;
						$data_trx['trx_metode'] = $code_metode;
						$this->App->update('tb_transaksi', $data_trx, $where_trx);

						//SEND NOTIF
						$this->M_notif->create("email_transaksi", $id_transaksi, "invoice", $data_account->email);
						// echo json_encode($transaksi);

						redirect(base_url('/account/transaksi/payout/' . $code_trx));
						// }
					} else {
						$this->session->set_flashdata('alert', 'danger|<b>Gagal Membuat Transaksi</b> Terjadi kesalahan sistem <b>Hubungi Admin</b>.');
						redirect(base_url('/account/register-paket/checkout/' . urlencode($url)));
					}
				} else {
					$this->session->set_flashdata('alert', 'danger|<b>Gagal Membuat Transaksi</b> Coupon sudah tidak bisa digunakan.');
					redirect(base_url('/account/register-paket/checkout/' . urlencode($url)));
				}
			} else {
				$this->session->set_flashdata('alert', 'danger|<b>Gagal Membuat Transaksi</b> Masih ada transaksi yang belum diselesaikan.');
				redirect(base_url('/account/register-paket/checkout/' . urlencode($url)));
			}
		} else {
			// echo "Hello Bro ^_^";
			redirect(base_url('/account'));
		}
	}

	public function cek_trx()
	{
		$time_now = time();
		$data = $this->M_transaksi->get_list_trx_expired($time_now);
		$expired = $this->M_transaksi->set_list_trx_expired($time_now);
		// echo json_encode($data);
		echo "TIME : " . $time_now . "<br>";
		echo "EXPIRED : <br>";
		foreach ($data->result() as $row_data) {
			echo "[ ID : " . $row_data->id . "] [ DATE : " . date("Y-m-d H:i:s", $row_data->tgl_kadaluwarsa) . " ] -> EXPIRED <br>";
			//GET USER
			$where_user['id'] = $row_data->id_user;
			$user = $this->App->get_where('tb_account', $where_user)->row();
			//SEND NOTIF
			$this->M_notif->create("email_transaksi", $row_data->id, "expired", $user->email);
		}
	}
	public function payout($code)
	{
		$view['_title'] = "Pembayaran Transaksi &mdash; Britain Kampung Inggris";
		$where['code_trx'] = $code;
		$view['listdata'] = $this->App->get_where('tb_transaksi', $where)->row();
		$where_asrama['id'] = $view['listdata']->id_asrama;
		$view['dataasrama'] = $this->App->get_where('tb_asrama', $where_asrama)->row();
		$view['listdatatrx'] = $this->M_transaksi->get_list_detail_transaksi($view['listdata']->id);
		$view['nama'] = "DIDIN TRI ANGGORO";
		if ($view['listdata']->code_metode == "bri_otomatis") {
			$code_metode = "BRI";
		} else if ($view['listdata']->code_metode == "bni_otomatis") {
			$code_metode = "BNI";
		} else if ($view['listdata']->code_metode == "mandiri_otomatis") {
			$code_metode = "MANDIRI";
		} else if ($view['listdata']->code_metode == "permata_otomatis") {
			$code_metode = "PERMATA";
		} else if ($view['listdata']->code_metode == "qris_otomatis") {
			$code_metode = "QR";
		} else if ($view['listdata']->code_metode == "alfamart_otomatis") {
			$code_metode = "ALFAMART";
		} else if ($view['listdata']->code_metode == "lain_otomatis") {
			$code_metode = "BNI2";
		}

		$view['tutorial'] = $this->load->view('tutorial/' . $code_metode, $view, true);
		$this->template->display_theme('pages/V_payout', $view);
	}

	public function cancel($code)
	{
		$session = $this->sessionlogin->get_session();
		$iduser = $session['id'];
		$code_decode = base64_decode($code);
		$where['code_trx'] = $code_decode;
		$where['status'] = 'pending';
		$where['id_user'] = $iduser;
		$data['status'] = 'cancel';
		$cek = $this->App->get_where('tb_transaksi', $where);
		if ($cek->num_rows() > 0) {
			$update = $this->App->update('tb_transaksi', $data, $where);
			if ($update) {
				//GET TRX
				unset($where['status']);
				$transaksi = $this->App->get_where('tb_transaksi', $where)->row();
				//GET USER
				$where_user['id'] = $transaksi->id_user;
				$user = $this->App->get_where('tb_account', $where_user)->row();
				//SEND NOTIF
				$this->M_notif->create("email_transaksi", $transaksi->id, "cancel", $user->email);

				$this->session->set_flashdata('alert', 'success|<b>Berhasil</b>  Berhasil Membatalkan Transaksi <b>' . $code_decode . '</b>.');
				redirect(base_url('/account/transaksi/payout/' . $code_decode));
			} else {
				$this->session->set_flashdata('alert', 'danger|<b>Gagal</b>  Gagal Membatalkan Transaksi <b>' . $code_decode . '</b>.');
				redirect(base_url('/account/transaksi/payout/' . $code_decode));
			}
		} else {
			$this->session->set_flashdata('alert', 'danger|<b>Gagal</b>  Gagal Membatalkan Transaksi, Transaksi tidak ditemukan.');
			redirect(base_url('/account/transaksi'));
		}
	}
	public function test()
	{
		$response_xendit = $this->xenditlib->retail_test();
		var_dump($response_xendit);
	}
}

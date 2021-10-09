<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
	Public function __construct() {
		parent::__construct();
		$this->load->model('model_chat');
		$this->load->model('model_users');
		$this->load->model('model_siswa');
	}

	public function index() {
		$data['pageTitle'] = 'Bimbingan Konseling';
		$data['status'] = $this->model_chat->get_stats()->result();
		$data['chat']   = $this->model_chat->isi_chat()->result();
	    $data['pageContent'] = $this->load->view('bimbingan/chat', $data, TRUE);

	    // Jalankan view template/layout
	    $this->load->view('template/layout', $data);
	}

	public function kirim() {
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
		$pesan = array(
					'pengirim' => $this->session->userdata('username'),
					'tgl_bimbingan' => $date,
					'isi_bimbingan' => $this->input->post('pesan')
				 );
		 
		$this->db->insert('bimbingan', $pesan);
		redirect (base_url('chat'));
	}

	public function point() {
		date_default_timezone_set('Asia/Jakarta');
		$date = date('Y-m-d H:i:s');
        $data = array(
					'nis' => $this->session->userdata('username'),
					'tgl_poin_reward' => $date
				 ); 
        $this->db->insert('poin_reward', $data);
		redirect (base_url('Poin'));  
	}

	public function chat() {
		if ($this->session->userdata('level') == FALSE) {
			$this->session->set_flashdata('login', '<div class="alert alert-warning alert-dismissable">
														<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
														<i class="fa fa-exclamation-circle">&nbsp;</i> <strong>Anda Harus Login!</strong>
													</div>');
			redirect(base_url());
		} else {
			$data['status'] = $this->model_chat->get_stats()->result();
			$data['chat']   = $this->model_chat->isi_chat()->result();
			$this->load->view('header');
			$this->load->view('chat', $data);
			$this->load->view('footer');
		}
	}

	public function reset($id)
  	{
 
    $query = $this->model_chat->reset();

    // refresh page
    redirect('chat', 'refresh');
  }

	// public function open() { return $this->model_chat->main(array('status'=>TRUE)); }

	// public function maintenance() { return $this->model_chat->main(array('status'=>FALSE)); }

	// public function pending() {
	// 	if ($this->session->userdata('sesi') == FALSE) {
	// 		$this->session->set_flashdata('login', '<div class="alert alert-warning alert-dismissable">
	// 													<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	// 													<i class="fa fa-exclamation-circle">&nbsp;</i> <strong>Anda Harus Login!</strong>
	// 												</div>');
	// 		redirect(base_url());
	// 	} else {
	// 		$data['orang'] = $this->regis->orang();
	// 		$data['status'] = $this->model_chat->get_stats()->result();
	// 		$this->load->view('header');
	// 		$this->load->view('pending', $data);
	// 		$this->load->view('footer');
	// 	}
	// }

}


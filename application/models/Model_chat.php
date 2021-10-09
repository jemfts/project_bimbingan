<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_chat extends CI_Model {

	public function __construct() { $this->load->database(); }

	public function isi_chat(){ return $this->db->select('*')->order_by('tgl_bimbingan','ASC')->get('bimbingan'); }

	public function main($status) {
		$this->db->update('detail_bimbingan', $status);
		redirect(base_url('bimbingan/chat'));
	}

	public function get_stats() { return $this->db->get('detail_bimbingan'); }

	public function getpoint(){
		return $this->db->insert('poin_reward');
	}

}

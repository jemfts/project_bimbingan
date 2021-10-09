<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BimbinganList extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
    
    // Load model users
    $this->load->model('model_bimbingan');
  }

	public function index()
	{	
		$data['pageTitle'] = 'PoinBimbingan';
		$data['reward'] = $this->model_bimbingan->get()->result();
	   	$data['pageContent'] = $this->load->view('bimbingan/bimbinganList', $data, TRUE);

	    // Jalankan view template/layout
	    $this->load->view('template/layout', $data);
	}

}
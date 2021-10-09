<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends CI_Controller {


	public function index()
	{	
		$data['pageTitle'] = 'Bimbingan Konseling';
	   	$data['pageContent'] = $this->load->view('bimbingan/bimbingan', $data, TRUE);

	    // Jalankan view template/layout
	    $this->load->view('template/layout', $data);
	}

}
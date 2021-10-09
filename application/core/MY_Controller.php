<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
  public function cekLogin()
  {
    // Jika belum ada session username maka 
    // redirect ke halaman auth/login
    if (!$this->session->userdata('username')) {
      redirect('auth/login');
    }
  }
  
  public function getUserData()
  {
    // Ambil semua data session
    $userData = $this->session->userdata();

    // Return userdata
    return $userData;
  }

  public function isAdmin()
  {
    // Mengambil data session
    $userData = $this->getUserData();

    // Jika level user bukan administrator
    // maka redirect ke halaman 404
    if ($userData['level'] !== 'bk') show_404();
  }

  public function view($main_containt, $data = null) {
        $this->load->view('template/header');
        $this->load->view($main_containt, $data);
        $this->load->view('template/footer');
    }

}
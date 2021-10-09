<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->cekLogin();

    $this->load->model('model_siswa');
    $this->load->model('model_pelanggaran');
    $this->load->model('chart_model');
  }

  public function index()
  {
    $pelanggaran = $this->db->query("SELECT p.nis, sum(poin_pelanggaran) poin_pelanggaran, nama_lengkap FROM pelanggaran p JOIN siswa s on p.nis=s.nis WHERE poin_pelanggaran = ( SELECT max(poin_pelanggaran) FROM pelanggaran)GROUP BY nis")->row();

     $poin_reward = $this->db->query("SELECT pr.nis, sum(jml_poin_reward) AS jml_poin_reward, nama_lengkap
                                      FROM poin_reward pr JOIN siswa s on pr.nis=s.nis
                                      GROUP BY pr.nis HAVING SUM(jml_poin_reward) = 
                                      (SELECT MAX(jml_poin_reward)
                                          FROM (
                                            SELECT SUM(jml_poin_reward) AS jml_poin_reward
                                            FROM poin_reward
                                            GROUP BY nis
                                            ) a
                                      )")->row();

    // $poin_reward = $this->db->query("SELECT pr.nis, sum(jml_poin_reward) jml_poin_reward, nama_lengkap FROM poin_reward pr JOIN siswa s on pr.nis=s.nis WHERE jml_poin_reward = ( SELECT max(jml_poin_reward) FROM poin_reward)GROUP BY nis")->row();

    $siswa = $this->db->query("SELECT * FROM siswa")->num_rows();

    $chart = $this->chart_model->get_data()->result();

    $data['pelanggaran'] = $pelanggaran;
    $data['poin_reward'] = $poin_reward;
    $data['siswa'] = $siswa;
    $data['chart'] = json_encode($chart);
    $nama = $this->session->userdata('nama');
    $data['pageTitle'] = 'Dashboard';
    $data['dashboard'] = $this->session->userdata('nama');
    $data['pageContent'] = $this->load->view('dashboard/content', $data, TRUE);
    
    $this->load->view('template/layout', $data);


  }
}

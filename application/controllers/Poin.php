<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Poin extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah siswa sudah login
    $this->cekLogin();

    // Cek apakah siswa login 
    // sebagai administrator
    // $this->isAdmin();

    // Load model siswa
    $this->load->model('model_poin');
     $this->load->model('model_pelanggaran');
  }

  public function index()
  {
    // Data untuk page index
    $data['pageTitle'] = 'Poin Reward';
    if ($this->session->userdata('level') == 'siswa') {
        $data['poin'] = $this->model_poin->get()->result(); }
    else {
        $data['poin'] = $this->model_poin->get_admin()->result();
    }
    $data['pageContent'] = $this->load->view('poin/poinList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function leaderboard()
  {
    // Data untuk page index
    $data['pageTitle'] = 'Leaderboard';
    $data['poin'] = $this->model_poin->get_admin()->result();
    $data['pageContent'] = $this->load->view('poin/leaderboard', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function add()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('jml_poin_reward', 'Jumlah Poin Reward', 'required');
      $this->form_validation->set_rules('tgl_poin_reward', 'Tanggal Poin Reward', 'required');
      $this->form_validation->set_rules('keterangan', 'Keterangan');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'jml_poin_reward' => $this->input->post('jml_poin_reward'),
          'tgl_poin_reward' => date_format(date_create($this->input->post('tgl_poin_reward')), 'Y-m-d'),
          'keterangan' => $this->input->post('keterangan')

        );

        // Jalankan function insert pada model_siswa
        $query = $this->model_poin->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan data poin');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan data poin');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('poin/add', 'refresh');
      } 
    }
    
    // Data untuk page siswa/add
    $data['pageTitle'] = 'Tambah Data Poin';
    $data['pageContent'] = $this->load->view('poin/poinAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function edit($id = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('tgl_poin_reward', 'Tanggal Poin Reward', 'required');
      $this->form_validation->set_rules('keterangan', 'Keterangan');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'tgl_poin_reward' =>date_format(date_create($this->input->post('tgl_poin_reward')), 'Y-m-d'),
          'keterangan' => $this->input->post('keterangan')
        );

        // Jalankan function insert pada model_siswa
        $query = $this->model_poin->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui data poin');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui data poin');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('poin/edit/'.$id, 'refresh');
      } 
    }
    
    // Ambil data siswa dari database
    $poin = $this->model_poin->get_where(array('nis' => $id))->row();

    // $poin->tgl_poin_reward = date_format(date_create($poin->tgl_poin_reward), 'd-m-Y');

    // Jika data siswa tidak ada maka show 404
    if (!$poin) show_404();

    // Data untuk page siswa/add
    $data['pageTitle'] = 'Edit Data Poin';
    $data['poin'] = $poin;
    $data['pageContent'] = $this->load->view('poin/poinEdit', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function delete($id)
  {
    // Ambil data siswa dari database
    $poin = $this->model_poin->get_where(array('nis' => $id))->row();

    // Jika data siswa tidak ada maka show 404
    if (!$poin) show_404();

    // Jalankan function delete pada model_siswa
    $query = $this->model_poin->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus data poin');
    else $message = array('status' => true, 'message' => 'Gagal menghapus  data poin');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('poin', 'refresh');
  }
  public function cetak()
  {
    $pdf = new FPDF('l','mm','A5');
      // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial','B',16);
    // mencetak string
    $pdf->Cell(190,7,'SMA 1 BARUNAWATI',0,1,'C');
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,7,'DAFTAR SISWA ',0,1,'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,6,'No',1,0);
    $pdf->Cell(35,6,'NIS',1,0);
    $pdf->Cell(25,6,'Poin Reward',1,0);
    $pdf->Cell(35,6,'Tgl Poin Reward',1,0);
    $pdf->Cell(85,6,'Keterangan',1,1);
    $pdf->SetFont('Arial','',10);
    $poin = $this->db->get('poin_reward')->result();
    $no = 0; foreach ($poin as $row){
        $pdf->Cell(10,6,++$no,1,0);
        $pdf->Cell(35,6,$row->nis,1,0);
        $pdf->Cell(25,6,$row->jml_poin_reward,1,0);
        $pdf->Cell(35,6,$row->tgl_poin_reward,1,0);
        $pdf->Cell(85,6,$row->keterangan,1,1);
    }
    $pdf->Output();
  }

   public function tukarpoin(){

       // $poin_pelanggaran="SELECT poin_pelanggaran from pelanggaran where nis='".$this->session->username."'";

       $query = $this->model_poin->tukar();

        // cek jika query berhasil
        $sisa = $this->model_poin->sisa();
            
        if ($query && $sisa) $message = array('status' => true, 'message' => 'Berhasil menukarkan poin');
        else $message = array('status' => true, 'message' => 'Gagal menukarkan poin');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('poin', 'refresh');
    }

  public function search(){

          // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('jml_poin_reward', 'Jumlah Poin Reward', 'required');
      $this->form_validation->set_rules('tgl_poin_reward', 'Tanggal Poin Reward', 'required');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'jml_poin_reward' => $this->input->post('jml_poin_reward'),
          'tgl_poin_reward' => $this->input->post('tgl_poin_reward'),
          'keterangan' => $this->input->post('keterangan')
        );

        // Jalankan function insert pada model_siswa
        $query = $this->model_poin->get_by_keyword($keyword);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Data ditemukan');
        else $message = array('status' => true, 'message' => 'Data tidak ditemukan di database');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('poin/search', 'refresh');
      } 
    }

   
    
    // Data untuk page siswa/add
    $keyword = $this->input->post('keyword');
    $data['pageTitle'] = 'Cari Data Poin';
    $data['poin']=$this->model_poin->get_by_keyword($keyword);
    $data['pageContent'] = $this->load->view('poin/poinList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);

    }
}
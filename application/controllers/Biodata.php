<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Biodata extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah biodata sudah login
    $this->cekLogin();

    // Cek apakah biodata login 
    // sebagai administrator
    // $this->isAdmin();

    // Load model biodata
    $this->load->model('model_biodata');
  }

  public function index()
  {
    // Data untuk page index
    $data['pageTitle'] = 'biodata';
    $data['biodata'] = $this->model_biodata->get()->result();
    $data['pageContent'] = $this->load->view('biodata/siswaList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function add()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('kelas', 'Kelas', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
      $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
      $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
      $this->form_validation->set_rules('agama', 'Agama', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
      $this->form_validation->set_rules('nama_wali_murid', 'Nama Wali Murid', 'required');
      $this->form_validation->set_rules('email_wali_murid', 'Email Wali Murid', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'nama_lengkap' => $this->input->post('nama_lengkap'),
          'kelas' => $this->input->post('kelas'),
          'alamat' => $this->input->post('alamat'),
          'tempat_lahir' => $this->input->post('tempat_lahir'),
          'tgl_lahir' => $this->input->post('tgl_lahir'),
          'jenis_kelamin' => $this->input->post('jenis_kelamin'),
          'agama' => $this->input->post('agama'),
          'email' => $this->input->post('email'),
          'no_hp' => $this->input->post('no_hp'),
          'nama_wali_murid' => $this->input->post('nama_wali_murid'),
          'email_wali_murid' => $this->input->post('email_wali_murid')
        );

        // Jalankan function insert pada model_biodata
        $query = $this->model_biodata->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan data biodata');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan data biodata');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('biodata/add', 'refresh');
      } 
    }
    
    // Data untuk page biodata/add
    $data['pageTitle'] = 'Tambah Data biodata';
    $data['pageContent'] = $this->load->view('biodata/siswaAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function edit($id = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('kelas', 'Kelas', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
      $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
      $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
      $this->form_validation->set_rules('agama', 'Agama', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
      $this->form_validation->set_rules('nama_wali_murid', 'Nama Wali Murid', 'required');
      $this->form_validation->set_rules('email_wali_murid', 'Email Wali Murid', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'nama_lengkap' => $this->input->post('nama_lengkap'),
          'kelas' => $this->input->post('kelas'),
          'alamat' => $this->input->post('alamat'),
          'tempat_lahir' => $this->input->post('tempat_lahir'),
          'tgl_lahir' => $this->input->post('tgl_lahir'),
          'jenis_kelamin' => $this->input->post('jenis_kelamin'),
          'agama' => $this->input->post('agama'),
          'email' => $this->input->post('email'),
          'no_hp' => $this->input->post('no_hp'),
          'nama_wali_murid' => $this->input->post('nama_wali_murid'),
          'email_wali_murid' => $this->input->post('email_wali_murid')

        );

        // Jalankan function insert pada model_biodata
        $query = $this->model_biodata->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui data biodata');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui data biodata');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('biodata/edit/'.$id, 'refresh');
      } 
    }
    
    // Ambil data biodata dari database
    $biodata = $this->model_biodata->get_where(array('nis' => $id))->row();

    // Jika data biodata tidak ada maka show 404
    if (!$biodata) show_404();

    // Data untuk page biodata/add
    $data['pageTitle'] = 'Edit Data biodata';
    $data['biodata'] = $biodata;
    $data['pageContent'] = $this->load->view('biodata/siswaEdit', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function delete($id)
  {
    // Ambil data biodata dari database
    $biodata = $this->model_biodata->get_where(array('nis' => $id))->row();

    // Jika data biodata tidak ada maka show 404
    if (!$biodata) show_404();

    // Jalankan function delete pada model_biodata
    $query = $this->model_biodata->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus data biodata');
    else $message = array('status' => true, 'message' => 'Gagal menghapus  data biodata');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('biodata', 'refresh');
  }

public function detail($id = null)
  {
    // Ambil data biodata dari database
    $biodata = $this->model_biodata->get_where(array('nis' => $id))->row();
    
    // Jika data biodata tidak ada maka show 404
    if (!$biodata) show_404();
 
    // Data untuk page biodata/detail
    $data['pageTitle'] = 'Detail Data biodata';
    $data['biodata'] = $biodata;
    $data['pageContent'] = $this->load->view('biodata/siswaDetail', $data, TRUE);
 
    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
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
    $pdf->Cell(190,7,'DAFTAR biodata ',0,1,'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,6,'No',1,0);
    $pdf->Cell(20,6,'NIS',1,0);
    $pdf->Cell(85,6,'Nama Lengkap',1,0);
    $pdf->Cell(25,6,'Tanggal Lahir',1,1);
    $pdf->SetFont('Arial','',10);
    $biodata = $this->db->get('biodata')->result();
    $no = 0; foreach ($biodata as $row){
        $pdf->Cell(10,6,++$no,1,0);
        $pdf->Cell(20,6,$row->nis,1,0);
        $pdf->Cell(85,6,$row->nama_lengkap,1,0);
        $pdf->Cell(25,6,$row->tgl_lahir,1,1);
    }
    $pdf->Output();
  }

  public function search(){

          // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('kelas', 'Kelas', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
      $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
      $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
      $this->form_validation->set_rules('agama', 'Agama', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
      $this->form_validation->set_rules('nama_wali_murid', 'Nama Wali Murid', 'required');
      $this->form_validation->set_rules('email_wali_murid', 'Email Wali Murid', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'nama_lengkap' => $this->input->post('nama_lengkap'),
          'kelas' => $this->input->post('kelas'),
          'alamat' => $this->input->post('alamat'),
          'tempat_lahir' => $this->input->post('tempat_lahir'),
          'tgl_lahir' => $this->input->post('tgl_lahir'),
          'jenis_kelamin' => $this->input->post('jenis_kelamin'),
          'agama' => $this->input->post('agama'),
          'email' => $this->input->post('email'),
          'no_hp' => $this->input->post('no_hp'),
          'nama_wali_murid' => $this->input->post('nama_wali_murid'),
          'email_wali_murid' => $this->input->post('email_wali_murid')

        );

        // Jalankan function insert pada model_biodata
        $query = $this->model_biodata->get_by_keyword($keyword);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Data ditemukan');
        else $message = array('status' => true, 'message' => 'Data tidak ditemukan di database');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('biodata/search', 'refresh');
      } 
    }
    
    // Data untuk page biodata/add
    $keyword = $this->input->post('keyword');
    $data['pageTitle'] = 'Cari Data biodata';
    $data['biodata']=$this->model_biodata->get_by_keyword($keyword);
    $data['pageContent'] = $this->load->view('biodata/siswaList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);

    }
}
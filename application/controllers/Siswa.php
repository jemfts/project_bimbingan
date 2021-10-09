<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah siswa sudah login
    $this->cekLogin();

    // Cek apakah siswa login 
    // sebagai administrator
    $this->isAdmin();

    // Load model siswa
    $this->load->model('model_siswa');
  }

  public function index()
  {
    $this->load->library('pagination');
 
    // Pengaturan pagination
    $config['base_url'] = base_url('siswa/index/');
    $config['total_rows'] = $this->model_siswa->get()->num_rows();
    $config['per_page'] = 10;
    $config['offset'] = $this->uri->segment(3);
 
    // Styling pagination
    $config['first_link'] = false;
    $config['last_link'] = false;
 
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
 
    $config['num_tag_open'] = '<li class="waves-effect">';
    $config['num_tag_close'] = '</li>';
 
    $config['prev_tag_open'] = '<li class="waves-effect">';
    $config['prev_tag_close'] = '</li>';
 
    $config['next_tag_open'] = '<li class="waves-effect">';
    $config['next_tag_close'] = '</li>';
 
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
 
    $this->pagination->initialize($config);

    // Data untuk page index
    $data['pageTitle'] = 'Siswa';
    $data['siswa'] = $this->model_siswa->get_offset($config['per_page'], $config['offset'])->result();
    $data['pageContent'] = $this->load->view('siswa/siswaList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function tambahData()
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
      // $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
      $this->form_validation->set_rules('nama_wali_murid', 'Nama Wali Murid', 'required');
      // $this->form_validation->set_rules('email_wali_murid', 'Email Wali Murid', 'required');
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

        // Jalankan function insert pada model_siswa
        $query = $this->model_siswa->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan data siswa');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan data siswa');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('siswa/tambahData', 'refresh');
      } 
    }
    
    // Data untuk page siswa/add
    $data['pageTitle'] = 'Tambah Data Siswa';
    $data['pageContent'] = $this->load->view('siswa/siswaAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function editData($id = null)
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
      // $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
      $this->form_validation->set_rules('nama_wali_murid', 'Nama Wali Murid', 'required');
      // $this->form_validation->set_rules('email_wali_murid', 'Email Wali Murid', 'required');
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

        // Jalankan function insert pada model_siswa
        $query = $this->model_siswa->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui data siswa');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui data siswa');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('siswa/editData/'.$id, 'refresh');
      } 
    }
    
    // Ambil data siswa dari database
    $siswa = $this->model_siswa->get_where(array('nis' => $id))->row();

    // Jika data siswa tidak ada maka show 404
    if (!$siswa) show_404();

    // Data untuk page siswa/add
    $data['pageTitle'] = 'Edit Data Siswa';
    $data['siswa'] = $siswa;
    $data['pageContent'] = $this->load->view('siswa/siswaEdit', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function hapusData($id)
  {
    // Ambil data siswa dari database
    $siswa = $this->model_siswa->get_where(array('nis' => $id))->row();

    // Jika data siswa tidak ada maka show 404
    if (!$siswa) show_404();

    // Jalankan function delete pada model_siswa
    $query = $this->model_siswa->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus data siswa');
    else $message = array('status' => true, 'message' => 'Gagal menghapus  data siswa');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('siswa', 'refresh');
  }

public function detail($id = null)
  {
    // Ambil data siswa dari database
    $siswa = $this->model_siswa->get_where(array('nis' => $id))->row();
    
    // Jika data siswa tidak ada maka show 404
    if (!$siswa) show_404();
 
    // Data untuk page siswa/detail
    $data['pageTitle'] = 'Detail Data Siswa';
    $data['siswa'] = $siswa;
    $data['pageContent'] = $this->load->view('siswa/siswaDetail', $data, TRUE);
 
    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }
 

  public function cetak()
  {
    $pdf = new FPDF('l','mm','Letter');
      // membuat halaman baru
    $pdf->AddPage();
    // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial','B',16);
    // mencetak string
    $pdf->Cell(270,7,'SMA 1 BARUNAWATI',0,1,'C');
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(270,7,'DAFTAR SISWA ',0,1,'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',6);
    $pdf->Cell(5,6,'No',1,0);
    $pdf->Cell(8,6,'NIS',1,0);
    $pdf->Cell(45,6,'Nama Lengkap',1,0);
    $pdf->Cell(10,6,'Kelas',1,0);
    $pdf->Cell(55,6,'Alamat',1,0);
    $pdf->Cell(15,6,'Tempat Lahir',1,0);
    $pdf->Cell(13,6,'Tgl Lahir',1,0);
    $pdf->Cell(5,6,'JK',1,0);
    $pdf->Cell(10,6,'Agama',1,0);
    $pdf->Cell(25,6,'Email',1,0);
    $pdf->Cell(17,6,'No.HP',1,0);
    $pdf->Cell(25,6,'Nama Wali Murid',1,0);
    $pdf->Cell(25,6,'Email Wali Murid',1,1);

    $pdf->SetFont('Arial','',6);
    $siswa = $this->db->get('siswa')->result();
    $no = 0; foreach ($siswa as $row){
        $pdf->Cell(5,6,++$no,1,0);
        $pdf->Cell(8,6,$row->nis,1,0);
        $pdf->Cell(45,6,$row->nama_lengkap,1,0);
        $pdf->Cell(10,6,$row->kelas,1,0);
        $pdf->Cell(55,6,$row->alamat,1,0);
        $pdf->Cell(15,6,$row->tempat_lahir,1,0);
        $pdf->Cell(13,6,$row->tgl_lahir,1,0);
        $pdf->Cell(5,6,$row->jenis_kelamin,1,0);
        $pdf->Cell(10,6,$row->agama,1,0);
        $pdf->Cell(25,6,$row->email,1,0);
        $pdf->Cell(17,6,$row->no_hp,1,0);
        $pdf->Cell(25,6,$row->nama_wali_murid,1,0);        
        $pdf->Cell(25,6,$row->email_wali_murid,1,1);
    }
    $pdf->Output();
  }

  public function excel() {

    $data = array( 'title' => 'Data Siswa',
    'siswa' => $this->model_siswa->get());
    $title = 'Siswa';
    $data['siswa'] = $this->model_siswa->get()->result();
    $data['pageContent'] = $this->load->view('siswa/siswaList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
   }

  public function export_excel(){
    $data = array( 'title' => 'Data Siswa',
    'siswa' => $this->model_siswa->get());
    $title = 'Siswa';
    $data['pageTitle'] = 'Siswa';
    $data['siswa'] = $this->model_siswa->get()->result();
    $this->load->view('siswa/siswaExcel', $data);
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
      // $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required');
      $this->form_validation->set_rules('nama_wali_murid', 'Nama Wali Murid', 'required');
      // $this->form_validation->set_rules('email_wali_murid', 'Email Wali Murid', 'required');
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

        // Jalankan function insert pada model_siswa
        $query = $this->model_siswa->get_by_keyword($keyword);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Data ditemukan');
        else $message = array('status' => true, 'message' => 'Data tidak ditemukan di database');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('siswa/search', 'refresh');
      } 
    }
    
    // Data untuk page siswa/add
    $keyword = $this->input->post('keyword');
    $data['pageTitle'] = 'Cari Data Siswa';
    $data['siswa']=$this->model_siswa->get_by_keyword($keyword);
    $data['pageContent'] = $this->load->view('siswa/siswaList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);

    }
}
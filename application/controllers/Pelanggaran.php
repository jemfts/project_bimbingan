<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah siswa sudah login
    $this->cekLogin();

    // Cek apakah siswa login 
    // sebagai administrator
    // $this->isAdmin();

    // Load model siswa
    $this->load->model('model_pelanggaran');
  }

  public function index()
  {
    // Data untuk page index
    $data['pageTitle'] = 'Pelanggaran';
    if ($this->session->userdata('level') == 'siswa') {
        $data['pelanggaran'] = $this->model_pelanggaran->get()->result(); }
    else {
        $data['pelanggaran'] = $this->model_pelanggaran->get_admin()->result();
    };
    $data['pageContent'] = $this->load->view('pelanggaran/pelanggaranList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function tambahData()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('pelanggaran', 'Pelanggaran', 'required');
      $this->form_validation->set_rules('tipe_pelanggaran', 'Tipe Pelanggaran', 'required');
      $this->form_validation->set_rules('tgl_pelanggaran', 'Tanggal Pelanggaran', 'required');
      $this->form_validation->set_rules('poin_pelanggaran', 'Poin Pelanggaran', 'required');
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'pelanggaran' => $this->input->post('pelanggaran'),
          'tipe_pelanggaran' => $this->input->post('tipe_pelanggaran'),
          'tgl_pelanggaran' => date_format(date_create($this->input->post('tgl_pelanggaran')), 'Y-m-d'),
          'poin_pelanggaran' => $this->input->post('poin_pelanggaran'),
          'deskripsi' => $this->input->post('deskripsi')

        );

        // Jalankan function insert pada model_siswa
        $query = $this->model_pelanggaran->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan data pelanggaran');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan data pelanggaran');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('pelanggaran/tambahData', 'refresh');
      } 
    }
    
    // Data untuk page siswa/add
    $data['pageTitle'] = 'Tambah Data Pelanggaran';
    $data['pageContent'] = $this->load->view('pelanggaran/pelanggaranAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function editData($id = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('pelanggaran', 'Pelanggaran', 'required');
      $this->form_validation->set_rules('tipe_pelanggaran', 'Tipe Pelanggaran', 'required');
      $this->form_validation->set_rules('tgl_pelanggaran', 'Tanggal Pelanggaran', 'required');
      $this->form_validation->set_rules('poin_pelanggaran', 'Poin Pelanggaran', 'required');
      $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'pelanggaran' => $this->input->post('pelanggaran'),
          'tipe_pelanggaran' => $this->input->post('tipe_pelanggaran'),
          'tgl_pelanggaran' => date_format(date_create($this->input->post('tgl_pelanggaran')), 'Y-m-d'),
          'poin_pelanggaran' => $this->input->post('poin_pelanggaran'),
          'deskripsi' => $this->input->post('deskripsi')

        );

        // Jalankan function insert pada model_siswa
        $query = $this->model_pelanggaran->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui data pelanggaran');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui data pelanggaran');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('pelanggaran/editData/'.$id, 'refresh');
      } 
    }
    
    // Ambil data siswa dari database
    $pelanggaran = $this->model_pelanggaran->get_where(array('nis' => $id))->row();

    $pelanggaran->tgl_pelanggaran = date_format(date_create($pelanggaran->tgl_pelanggaran), 'd-m-Y');
    // Jika data siswa tidak ada maka show 404
    if (!$pelanggaran) show_404();

    // Data untuk page siswa/add
    $data['pageTitle'] = 'Edit Data Pelanggaran';
    $data['pelanggaran'] = $pelanggaran;
    $data['pageContent'] = $this->load->view('pelanggaran/pelanggaranEdit', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function hapusData($id)
  {
    // Ambil data siswa dari database
    $pelanggaran = $this->model_pelanggaran->get()->row();

    // Jika data siswa tidak ada maka show 404
    if (!$pelanggaran) show_404();

    // Jalankan function delete pada model_siswa
    $query = $this->model_pelanggaran->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus data pelanggaran');
    else $message = array('status' => true, 'message' => 'Gagal menghapus  data pelanggaran');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('pelanggaran', 'refresh');
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
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(190,7,'DAFTAR PELANGGARAN ',0,1,'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(10,6,'No',1,0);
    $pdf->Cell(20,6,'NIS',1,0);
    $pdf->Cell(50,6,'Pelanggaran',1,0);
    $pdf->Cell(25,6,'Tipe',1,0);
    $pdf->Cell(25,6,'Tgl',1,0);
    $pdf->Cell(15,6,'Poin',1,0);
    $pdf->Cell(40,6,'Deskripsi',1,1);
    $pdf->SetFont('Arial','',9);
    $pelanggaran = $this->db->get('pelanggaran')->result();
    $no = 0; foreach ($pelanggaran as $row){
        $pdf->Cell(10,6,++$no,1,0);
        $pdf->Cell(20,6,$row->nis,1,0);
        $pdf->Cell(50,6,$row->pelanggaran,1,0);
        $pdf->Cell(25,6,$row->tipe_pelanggaran,1,0);
        $pdf->Cell(25,6,$row->tgl_pelanggaran,1,0);
        $pdf->Cell(15,6,$row->poin_pelanggaran,1,0);
        $pdf->Cell(40,6,$row->deskripsi,1,1);
    }
    $pdf->Output();
  }

  public function excel() {

    $data = array( 'title' => 'Data Pelanggaran',
    'pelanggaran' => $this->model_pelanggaran->get_admin());
    $title = 'Pelanggaran';
    $data['pelanggaran'] = $this->model_pelanggaran->get_admin()->result();
    $data['pageContent'] = $this->load->view('pelanggaran/pelanggaranList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
   }

  public function export_excel(){
    $data = array( 'title' => 'Data Pelanggaran',
    'pelanggaran' => $this->model_pelanggaran->get_admin());
    $title = 'Pelanggaran';
    $data['pageTitle'] = 'Pelanggaran';
    $data['pelanggaran'] = $this->model_pelanggaran->get_admin()->result();
    $this->load->view('pelanggaran/pelanggaranExcel', $data);
   }


  public function search(){

          // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('pelanggaran', 'Pelanggaran', 'required');
      $this->form_validation->set_rules('tipe_pelanggaran', 'tipe_pelanggaran', 'required');
      $this->form_validation->set_rules('tgl_pelanggaran', 'Tanggal Pelanggaran', 'required');
      $this->form_validation->set_rules('poin_pelanggaran', 'Poin Pelanggaran', 'required');
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'pelanggaran' => $this->input->post('pelanggaran'),
          'tipe_pelanggaran' => $this->input->post('tipe_pelanggaran'),
          'tgl_pelanggaran' => date_format(date_create($this->input->post('tgl_pelanggaran')), 'Y-m-d'),
          'poin_pelanggaran' => $this->input->post('poin_pelanggaran'),
          'deskripsi' => $this->input->post('deskripsi')
        );

        // Jalankan function insert pada model_siswa
        $query = $this->model_pelanggaran->get_by_keyword($keyword);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Data ditemukan');
        else $message = array('status' => true, 'message' => 'Data tidak ditemukan di database');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('pelanggaran/search', 'refresh');
      } 
    }
    
    // Data untuk page siswa/add
    $keyword = $this->input->post('keyword');
    $data['pageTitle'] = 'Cari Data Siswa';
    $data['pelanggaran']=$this->model_pelanggaran->get_by_keyword($keyword);
    $data['pageContent'] = $this->load->view('pelanggaran/pelanggaranList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);

  }

  // function sendemail($email,$saltid){  
  //   // configure the email setting
  //    if($this->model_pelanggaran->insertuser($data))  
  //    {  
  //     if($this->sendemail($email, $saltid))  
  //     {  
  //      // successfully sent mail to user email  
  //           $this->session->set_flashdata('msg','<div class="alert alert-success text-center"> Registrasi Berhasil! Silahkan cek email Anda untuk melakukan konfirmasi.</div>');  
  //           redirect(base_url('pelanggaran'));  
  //     }  
  //     else  
  //     {  
  //      $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Silahkan coba lagi...</div>');  
  //           redirect(base_url('pelanggaran')); 
  //     }  
  //    else  
  //    {  
  //     $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Terjadi Kesalahan, silahkan coba lagi...</div>');  
  //           redirect(base_url('pelanggaran'));  
  //    }  
  //    }  

  //   $config['protocol'] = 'smtp';  
  //     $config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name  
  //     $config['smtp_port'] = '465'; //smtp port number  
  //     $config['smtp_user'] = 'rameinajaweb@gmail.com';  
  //     $config['smtp_pass'] = 'RameinajaUdah'; //$from_email password  
  //     $config['mailtype'] = 'html';  
  //     $config['charset'] = 'iso-8859-1';  
  //     $config['wordwrap'] = TRUE;  
  //     $config['newline'] = "\r\n"; //use double quotes  
  //     $this->email->initialize($config);  
  //     $url = base_url()."pelanggaran/confirmation/".$saltid;  
  //     $this->email->from('rameinajaweb@gmail.com', 'BK SMA 1 BARUNAWATI');  
  //   $this->email->to($email);   
  //   $this->email->subject('Please Verify Your Email Address');  
  //   $message = "<html><head><head></head><body><p>Hi,</p><p>Thanks for registration.</p><p>Silahkan klik link di bawah ini untuk memverifikasi email Anda.</p>".$url."<br/><p>Sincerely,</p><p>RaMe Team</p></body></html>";  
  //   $this->email->message($message); 
  //   return $this->email->send();  
  //   }  
  //   public function confirmation($key)  
  //   {  
  //     if($this->model_pelanggaran->verifyemail($key))  
  //     {  
  //       $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Email Anda Berhasil Diverifikasi!</div>');  
  //       redirect(base_url('index.php/yayasan'));  
  //     }  
  //     else  
  //     {  
  //       $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Verifikasi Email Anda Gagal. Silahkan coba beberapa saat lagi...</div>');  
  //       redirect(base_url('pelanggaran'));  
  //     }  
  //   } 

}
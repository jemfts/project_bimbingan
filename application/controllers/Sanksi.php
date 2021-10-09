<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sanksi extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah siswa sudah login
    $this->cekLogin();

    // Cek apakah siswa login 
    // sebagai administrator
    // $this->isAdmin();

    // Load model siswa
    $this->load->model('model_sanksi');
    $this->load->model('model_pelanggaran');
  }

  public function index()
  {
    // Data untuk page index
    $data['pageTitle'] = 'Sanksi';
    if ($this->session->userdata('level') == 'siswa') {
        $data['sanksi'] = $this->model_sanksi->get()->result(); }
    else {
        $data['sanksi'] = $this->model_sanksi->get_admin()->result();
    };
    // $data['sanksi'] = $this->model_sanksi->get()->result();
    // $data['pelanggaran'] = $this->model_pelanggaran->get()->result();
    $data['pageContent'] = $this->load->view('sanksi/sanksiList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function excel() {

    $data = array( 'title' => 'Data Sanksi',
    'sanksi' => $this->model_sanksi->get());
    $title = 'Sanksi';
    $data['sanksi'] = $this->model_sanksi->get()->result();
    $data['pageContent'] = $this->load->view('sanksi/sanksiList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
   }

  public function export_excel(){
    $data = array( 'title' => 'Data Sanksi',
    'sanksi' => $this->model_sanksi->get());
    $title = 'Sanksi';
    $data['pageTitle'] = 'Sanksi';
    $data['sanksi'] = $this->model_sanksi->get()->result();
    $this->load->view('sanksi/sanksiExcel', $data);
   }

  public function tambahData()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('jenis_hukuman', 'Jenis Hukuman', 'required');
      $this->form_validation->set_rules('tgl_hukuman', 'Tanggal Hukuman', 'required');
      // $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {
        // $nis = $this->input->post('nis');
        // $jenis_hukuman = $this->input->post('jenis_hukuman');
        // $tgl_hukuman = $this->input->post('tgl_hukuman');
        $data1 = array(
                'nis'=>$this->input->post('nis'),
                'jenis_hukuman' => $this->input->post('jenis_hukuman'),
                'tgl_hukuman' => date_format(date_create($this->input->post('tgl_hukuman')), 'Y-m-d')
            );
        // $keterangan = $this->input->post('keterangan');
        $id_sanksi = $this->model_sanksi->insert('sanksi',$data1);
        $data = array(
                'nis'=>$this->input->post('nis'),
                'keterangan'=>$this->input->post('keterangan'),
                'id_sanksi'=>$id_sanksi
            );
        $query = $this->model_sanksi->insert('detail_sanksi',$data);


        // $data = array(
        //   'nis' => $this->input->post('nis'),
        //   // 'keterangan' => $this->input->post('keterangan'),
        //   'jenis_hukuman' => $this->input->post('jenis_hukuman'),
        //   'tgl_hukuman' => $this->input->post('tgl_hukuman')
        // );

        // Jalankan function insert pada model_siswa
        

        //cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan data sanksi');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan data sanksi');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('sanksi/index', 'refresh');
      } 
    }
    
    // Data untuk page siswa/add
    $data['pageTitle'] = 'Tambah Data Sanksi';
    // // $data['sanksi'] = $sanksi;
    // $data['pelanggaran'] = $pelanggaran;
    $data['pageContent'] = $this->load->view('sanksi/sanksiAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function editData($id = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('jenis_hukuman', 'Jenis Hukuman', 'required');
      $this->form_validation->set_rules('tgl_hukuman', 'Tanggal Hukuman', 'required');
      // $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          // 'keterangan' => $this->input->post('keterangan'),
          'jenis_hukuman' => $this->input->post('jenis_hukuman'),
          'tgl_hukuman' => date_format(date_create($this->input->post('tgl_hukuman')), 'Y-m-d')
        );

        // Jalankan function insert pada model_siswa
        $query = $this->model_sanksi->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui data sanksi');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui data sanksi');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('sanksi/editData/'.$id, 'refresh');
      } 
    }
    
    // Ambil data siswa dari database
    $sanksi = $this->model_sanksi->get_where(array('nis' => $id))->row();
    $sanksi1 = $this->model_sanksi->get_where1(array('nis' => $id))->row();

    // Jika data siswa tidak ada maka show 404
    if (!$sanksi) show_404();

    // Data untuk page siswa/add
    $data['pageTitle'] = 'Edit Data Sanksi';
    $data['sanksi'] = $sanksi;
    $data['sanksi1'] = $sanksi1;
    $data['pageContent'] = $this->load->view('sanksi/sanksiEdit', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function hapusData($id)
  {
    // Ambil data siswa dari database
    $sanksi = $this->model_sanksi->get_where(array('nis' => $id))->row();

    // Jika data siswa tidak ada maka show 404
    if (!$sanksi) show_404();

    // Jalankan function delete pada model_siswa
    $query = $this->model_sanksi->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus data sanksi');
    else $message = array('status' => true, 'message' => 'Gagal menghapus  data sanksi');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('sanksi', 'refresh');
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
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(190,7,'DAFTAR SANKSI ',0,1,'C');
    // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(6,6,'No',1,0);
    $pdf->Cell(15,6,'NIS',1,0);
    $pdf->Cell(50,6,'Jenis Hukuman',1,0);
    $pdf->Cell(30,6,'Tanggal Hukuman',1,0);
    $pdf->Cell(85,6,'Keterangan',1,1);
    $pdf->SetFont('Arial','',9);
    $sanksi = $this->db->query('SELECT * from sanksi s join detail_sanksi ds on s.id_sanksi=ds.id_sanksi')->result();
    $no = 0; foreach ($sanksi as $row){
        $pdf->Cell(6,6,++$no,1,0);
        $pdf->Cell(15,6,$row->nis,1,0);
        $pdf->Cell(50,6,$row->jenis_hukuman,1,0);
        $pdf->Cell(30,6,$row->tgl_hukuman,1,0);
        $pdf->Cell(85,6,$row->keterangan,1,1);
    $pdf->Output();
  }
}
public function search(){

          // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nis', 'NIS', 'required');
      $this->form_validation->set_rules('jenis_hukuman', 'Jenis Hukuman', 'required');
      $this->form_validation->set_rules('tgl_hukuman', 'Tanggal Hukuman', 'required');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'keterangan' => $this->input->post('keterangan'),
          'jenis_hukuman' => $this->input->post('jenis_hukuman'),
          'tgl_hukuman' => $this->input->post('tgl_hukuman')
        );

        // Jalankan function insert pada model_siswa
        $query = $this->model_sanksi->get_by_keyword($keyword);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Data ditemukan');
        else $message = array('status' => true, 'message' => 'Data tidak ditemukan di database');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('sanksi/search', 'refresh');
      } 
    }
    
    // Data untuk page siswa/add
    $keyword = $this->input->post('keyword');
    $data['pageTitle'] = 'Cari Data Sanksi';
    $data['sanksi']=$this->model_sanksi->get_by_keyword($keyword);
    $data['pageContent'] = $this->load->view('sanksi/sanksiList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);

  }
}
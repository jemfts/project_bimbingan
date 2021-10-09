<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->cekLogin();
    $this->isAdmin();
    $this->load->model('model_users');
  }

  public function index()
  {
    $this->load->library('pagination');
 
    // Pengaturan pagination
    $config['base_url'] = base_url('users/index/');
    $config['total_rows'] = $this->model_users->get()->num_rows();
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

    $data['pageTitle'] = 'Users';
    $data['users'] = $this->model_users->get_offset($config['per_page'], $config['offset'])->result();
    $data['pageContent'] = $this->load->view('users/userList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function add()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|is_unique[users.username]');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
      $this->form_validation->set_rules('level', 'Level', 'required|in_list[bk,siswa]');
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nama' => $this->input->post('nama'),
          'username' => $this->input->post('username'),
          'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          'status' => FALSE,
          'level' => $this->input->post('level')
        );

        // Jalankan function insert pada model_users
        $query = $this->model_users->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan user');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan user');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('users/add', 'refresh');
      } 
    }
    
    // Data untuk page users/add
    $data['pageTitle'] = 'Tambah Data User';
    $data['pageContent'] = $this->load->view('users/userAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function edit($id = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
      $this->form_validation->set_rules('level', 'Level', 'required|in_list[bk,siswa]');
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nama' => $this->input->post('nama'),
          'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          'status' => FALSE,
          'level' => $this->input->post('level')
        );

        // Jalankan function insert pada model_users
        $query = $this->model_users->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui user');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui user');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('users/edit/'.$id, 'refresh');
      } 
    }
    
    // Ambil data user dari database
    $user = $this->model_users->get_where(array('id' => $id))->row();

    // Jika data user tidak ada maka show 404
    if (!$user) show_404();

    // Data untuk page users/add
    $data['pageTitle'] = 'Edit Data User';
    $data['user'] = $user;
    $data['pageContent'] = $this->load->view('users/userEdit', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('template/layout', $data);
  }

  public function delete($id)
  {
    // Ambil data user dari database
    $user = $this->model_users->get_where(array('id' => $id))->row();

    // Jika data user tidak ada maka show 404
    if (!$user) show_404();

    // Jalankan function delete pada model_users
    $query = $this->model_users->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus user');
    else $message = array('status' => true, 'message' => 'Gagal menghapus user');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('users', 'refresh');
  }

  // public function orang() { return $this->db->get('users'); }

  // public function aktif($user) {
  //   $this->db->where('username', $user);
  //   $this->db->update('users', array('status' => TRUE));
  // }

  // public function nonaktif($user) {
  //   $this->db->where('username', $user);
  //   $this->db->update('users', array('status' => FALSE));
  // }

  // public function hapus($user) {
  //   $this->db->where('username', $user);
  //   $this->db->delete('users');
  // }

  public function update_last_notif() {
        $this->model_users->update_last_notif(
            $this->input->get('notif_id')
        );
        echo json_encode([
            'status' => 200,
            'message' => 'ok'
        ]);
    }

}
<?php
  class Model_siswa extends CI_Model {

    public $table = 'siswa';
    public function cekAkun($username, $password)
    {
      // Get data user yang mempunyai username == $username dan active == 1
      $this->db->where('username', $username);
      
      // Jalankan query
      $query = $this->db->get($this->table)->row();
      
      // Jika query gagal atau tidak menemukan username yang sesuai 
      // maka return false
      if (!$query) return false;
      
      // Ambil data password dari database
      $hash = $query->password;
      
      // Jika $hash tidak sama dengan $password maka return false
      if (!password_verify($password, $hash)) return false;
      
      // Update last_login user
      $last_login = $this->update($query->id, array('last_login' => date('Y-m-d H:i:s')));
      
      // Jika username dan password benar maka return data user
      return $query;        
    }
    public function get()
    {
      // Jalankan query
      $query = $this->db->query("SELECT * from siswa ORDER BY nis");
      

      // Return hasil query
      return $query;
    }

    public function get_offset($limit, $offset)
    {
      // Jalankan query
      $query = $this->db
        ->limit($limit, $offset)
        ->get($this->table);
 
      // Return hasil query
      return $query;
    }

    public function get_where($where)
    {
      // Jalankan query
      $query = $this->db
        ->where($where)
        ->get($this->table);

      // Return hasil query
      return $query;
    }
    public function insert($data)
    {
      // Jalankan query
      $query = $this->db->insert($this->table, $data);

      // Return hasil query
      return $query;
    }

    public function update($id, $data)
    {
      // Jalankan query
      $query = $this->db
        ->where('nis', $id)
        ->update($this->table, $data);
      
      // Return hasil query
      return $query;
    }

    public function delete($id)
    {
      // Jalankan query
      $query = $this->db
        ->where('nis', $id)
        ->delete($this->table);
      
      // Return hasil query
      return $query;
    }
    public function get_by_keyword($keyword){
      $this->db->select('*');
      $this->db->from('siswa');
      $this->db->like('nis',$keyword);
      $this->db->or_like('nama_lengkap',$keyword);
      $this->db->or_like('kelas',$keyword);
      return $this->db->get()->result();
    }
}
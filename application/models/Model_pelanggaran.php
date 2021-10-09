<?php
Class Model_pelanggaran extends CI_Model {

    public $table = 'pelanggaran';
    public function get()
    {
      // Jalankan query
      $query = $this->db->query("SELECT * from pelanggaran where nis='".$this->session->username."'");
      
      // Return hasil query
      return $query;
    }

    public function get_admin()
    {
      // Jalankan query
      $query = $this->db->query("SELECT * from pelanggaran");

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

    public function get_offset($limit, $offset)
    {
      // Jalankan query
      $query = $this->db
        ->limit($limit, $offset)
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
        ->where('id_pelanggaran', $id)
        ->update($this->table, $data);
      
      // Return hasil query
      return $query;
    }

    public function delete($id)
    {
      // Jalankan query
      $query = $this->db
        ->where('id_pelanggaran', $id)
        ->delete($this->table);
      
      // Return hasil query
      return $query;
    }

    
     public function get_by_keyword($keyword){
      $this->db->select('*');
      $this->db->from('pelanggaran');
      $this->db->like('nis',$keyword);
      $this->db->or_like('nama_lengkap',$keyword);
      return $this->db->get()->result();
    }
}

?>
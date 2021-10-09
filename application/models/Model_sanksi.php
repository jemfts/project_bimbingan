<?php
Class Model_sanksi extends CI_Model {

    public $table = 'sanksi';
    public function get()
    {
      // Jalankan query
      $query = $this->db->query("SELECT * from sanksi s join detail_sanksi ds on s.id_sanksi=ds.id_sanksi where s.nis='".$this->session->username."' group by s.nis ");

      // Return hasil query
      return $query;
    }

    public function get_admin()
    {
      // Jalankan query
      $query = $this->db->query("SELECT * from sanksi s join detail_sanksi ds on s.id_sanksi=ds.id_sanksi");

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

    public function get_where1($where)
    {
      // Jalankan query
      $query = $this->db
        ->where($where)
        ->get('detail_sanksi');

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
    
    public function insert($table,$data) 
    {
    $query = $this->db->insert($table, $data);
    $last_id = $this->db->insert_id();

    return $last_id; 
    }
    // public function insert($data)
    // {
    //   // Jalankan query
    //   $query = $this->db->query("INSERT into sanksi (nis, jenis_hukuman, tgl_hukuman) select s.nis, jenis_hukuman, tgl_hukuman from detail_sanksi ds join sanksi s on s.nis=ds.nis group by nis");

    //   // Return hasil query
    //   return $query;
    // }

    // public function insert1($data1)
    // {
    //   // Jalankan query
    //   $query = $this->db->insert('pelanggaran', $data1);

    //   // Return hasil query
    //   return $query;
    // }

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
      $this->db->select('s.nis, pelanggaran, tgl_pelanggaran, poin_pelanggaran, jenis_hukuman, tgl_hukuman');
      $this->db->from('sanksi s');
      $this->db->join('pelanggaran pg on s.nis=pg.nis');
      $this->db->like('nis',$keyword);
      $this->db->group_by('nis');
      return $this->db->get()->result();
    }
}

?>
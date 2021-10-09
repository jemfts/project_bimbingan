<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bimbingan extends CI_Model {  
	public $table = 'poin_reward';
    public function get()
    {
      // Jalankan query
      $query = $this->db->get($this->table);

      // Return hasil query
      return $query;
    }
	public function update($id, $data)
    {
      // Jalankan query
      $query = $this->db
        ->where('id_poin_reward', $id)
        ->update($this->table, $data);
      
      // Return hasil query
      return $query;
    }

}
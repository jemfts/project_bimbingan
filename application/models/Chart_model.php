<?php
class Chart_model extends CI_Model{
 
  //get data from database
  function get_data(){
      $this->db->select('nis,sum(jml_poin_reward) as reward');
      $this->db->group_by('nis');
      $this->db->order_by('reward', 'desc');
      $this->db->limit('3');
      $result = $this->db->get('poin_reward');
      return $result;
  }
 
}
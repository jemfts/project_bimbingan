<?php
Class Model_poin extends CI_Model {

    public $table = 'poin_reward';
    public function get()
    {
      // Jalankan query

      $query = $this->db->query("SELECT pr.nis, sum(jml_poin_reward) jml_poin_reward, tgl_poin_reward, keterangan, poin_pelanggaran from poin_reward pr left join pelanggaran p on pr.nis=p.nis where pr.nis='".$this->session->username."'");
      
      // Return hasil query
      return $query;
    }

    public function get_admin()
    {
      // Jalankan query

      $query = $this->db->query("SELECT avatar, last_login,nis, sum(jml_poin_reward) jml_poin_reward, tgl_poin_reward, keterangan from poin_reward pr join users u on pr.nis=u.username group by nis ORDER BY jml_poin_reward DESC");
      
      // Return hasil query
      return $query;
    }


    public function get_leaderboard()
    {
      // Jalankan query

      $query = $this->db->query("SELECT avatar, nis, sum(jml_poin_reward) jml_poin_reward, tgl_poin_reward, keterangan from poin_reward pr join users u on pr.nis=u.username ORDER BY jml_poin_reward");
      
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

    public function tukar(){
      $query = $this->db->query("UPDATE pelanggaran as pg join(SELECT poin_reward.nis, poin_reward.tgl_poin_reward,
                   sum(jml_poin_reward) as reward, poin_pelanggaran 
          FROM     poin_reward
          JOIN     pelanggaran on poin_reward.nis=pelanggaran.nis
          WHERE    jml_poin_reward >= 0 and poin_reward.nis='".$this->session->username."'
          GROUP BY NIS
        ) AS pn
       ON pn.nis= pg.nis SET 
       pg.poin_pelanggaran = CASE
                             WHEN pg.poin_pelanggaran >= pn.reward THEN pg.poin_pelanggaran - pn.reward
                             ELSE pn.reward - pn.reward
                          END");

      // $tgl_poin = $this->update($query->id, array('tgl_poin_reward' => date('Y-m-d H:i:s')));
      return $query;
    }

    public function sisa(){
      $query = $this->db->query("UPDATE poin_reward as pn join(SELECT poin_reward.nis, poin_reward.tgl_poin_reward,
                   sum(jml_poin_reward) as reward, poin_pelanggaran 
          FROM     poin_reward
          JOIN     pelanggaran on poin_reward.nis=pelanggaran.nis
           WHERE    jml_poin_reward >= 0 and poin_reward.nis='".$this->session->username."'
          GROUP BY NIS
        ) AS pn1
       ON pn.nis= pn1.nis SET 
       pn.jml_poin_reward = CASE
                             WHEN pn1.poin_pelanggaran >= pn1.reward THEN pn1.reward - pn1.poin_pelanggaran
                             ELSE pn1.reward - pn1.reward
                          END");

      // $tgl_poin = $this->update($query->id, array('tgl_poin_reward' => date('Y-m-d H:i:s')));

      return $query;
    }

    public function tukar1(){
      $query = $this->db->query("UPDATE pelanggaran as pg join(SELECT poin_reward.nis, poin_reward.tgl_poin_reward,
                   sum(jml_poin_reward) as reward, poin_pelanggaran 
          FROM     poin_reward
          JOIN     pelanggaran on poin_reward.nis=pelanggaran.nis
          WHERE    jml_poin_reward >= 0 and poin_reward.nis='".$this->session->username."'
          GROUP BY NIS
        ) AS pn
       ON pn.nis= pg.nis SET 
       pg.poin_pelanggaran = pn.reward - pg.poin_pelanggaran");

      // $tgl_poin = $this->update($query->id, array('tgl_poin_reward' => date('Y-m-d H:i:s')));
      return $query;
    }

    public function sisa1(){
      $query = $this->db->query("UPDATE pelanggaran as pg join(SELECT poin_reward.nis, poin_reward.tgl_poin_reward,
                   sum(jml_poin_reward) as reward, poin_pelanggaran 
          FROM     poin_reward
          JOIN     pelanggaran on poin_reward.nis=pelanggaran.nis
           WHERE    jml_poin_reward >= 0 and poin_reward.nis='".$this->session->username."'
          GROUP BY NIS
        ) AS pg1
       ON pg.nis= pg1.nis SET 
       pg.poin_pelanggaran = pg1.poin_pelanggaran - pg1.poin_pelanggaran");

      // $tgl_poin = $this->update($query->id, array('tgl_poin_reward' => date('Y-m-d H:i:s')));

      return $query;
    }

    public function sisa_tukar(){
      $query = $this->db->query("UPDATE poin_reward as pn join(SELECT poin_reward.nis,
                   sum(jml_poin_reward) as reward, poin_pelanggaran 
          FROM     poin_reward
          JOIN     pelanggaran on poin_reward.nis=pelanggaran.nis
          WHERE    poin_pelanggaran >= 0
          GROUP BY NIS
        ) AS pn1
       ON pn.nis= pn1.nis SET 
       pn.jml_poin_reward = pn1.reward - pn1.reward");

      return $query;
    }

     public function get_by_keyword($keyword){
      $this->db->select('nis, sum(jml_poin_reward) jml_poin_reward, tgl_poin_reward, keterangan');
      $this->db->from('poin_reward');
      $this->db->like('nis',$keyword);
      $this->db->group_by('nis');
      return $this->db->get()->result();
    }
}

?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class News_model extends CI_Model
{

    // get all news
    function get_all()
    {
        $query = $this->db->get('detail_bimbingan');
        return $query->result_array();
    }
    // get one news article by its id
    function get_one($id_det_bimbingan)
    {
        $query =$this->db->get_where('detail_bimbingan', array('id_det_bimbingan' => $id_det_bimbingan));
        // $this->db->get('detail_bimbingan');
        return $query->row();
    }

}

/* End of file news_model.php */
    /* Location: ./application/models/news_model.php */
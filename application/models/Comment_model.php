<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Comment_model extends CI_Model
{


    // get full tree comments based on news id

    function tree_all($id_det_bimbingan) {
        $result = $this->db->query("SELECT * FROM bimbing where id_det_bimbingan = $id_det_bimbingan ")->result_array();
        if(!empty($result)) {
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
        }
    }

    // to get child comments by entry id and parent id and news id
    function tree_by_parent($id_det_bimbingan,$in_parent) {
        $result = $this->db->query("SELECT * FROM bimbing where (parent_id = $in_parent) AND (id_det_bimbingan = $id_det_bimbingan) AND (username='".$this->session->username."' OR username='administrator')")->result_array();
        if(!empty($result)) {
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
        }
    }

    function tree_by_parent_admin($id_det_bimbingan,$in_parent) {
        $result = $this->db->query("SELECT * FROM bimbing where parent_id = $in_parent AND  id_det_bimbingan = $id_det_bimbingan")->result_array();
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
    }
    // to insert comments
    function add_new_comment()
    {
        $this->db->set("id_det_bimbingan", $this->input->post('id_det_bimbingan'));
        $this->db->set("parent_id", $this->input->post('parent_id'));
        $this->db->set("username", $this->input->post('username'));
        $this->db->set("nama", $this->input->post('nama'));
        $this->db->set("isi_bimbingan", $this->input->post('isi_bimbingan'));
        $this->db->set("tgl_bimbingan", time());
        $this->db->insert('bimbing');
        return $this->input->post('parent_id');
    }


}

/* End of file comment_model.php */

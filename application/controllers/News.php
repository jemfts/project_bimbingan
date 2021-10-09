 <?php

/** @property news_model $news_model *
* @property comment_model $comment_model
 */
class News extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->model('comment_model');
    }


    // this function to handle getting all news
    function index()
    {
        $data['pageTitle'] = 'Bimbingan Konseling';
        $data['news'] = $this->news_model->get_all();
        $data['pageContent'] = $this->load->view('content/news_list', $data, TRUE);

        $this->load->view('template/layout', $data);
    }

    /* this function to handle getting
      news details and its comments based on news id  */

    function lihatData($id_det_bimbingan)
    {   
        $data['pageTitle'] = 'Bimbingan Konseling';
        // get a post news based on news id
        $data['news'] = $this->news_model->get_one($id_det_bimbingan);
        // get a post COMMENTS based on news id and send it to view
        $data['comments'] = $this->show_tree($id_det_bimbingan);
        $data['pageContent'] = $this->load->view('content/show_one', $data, TRUE);


        $this->load->view('template/layout', $data);
    }
    // this function to handle add comments form on the news
    function tambahData($id_det_bimbingan)
    {

        // get a post id based on news id
        $data['news'] = $this->news_model->get_one($id_det_bimbingan);

        //set validation rules
        $this->form_validation->set_rules('username', 'NIS', 'required|trim|htmlspecialchars');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|htmlspecialchars');
        $this->form_validation->set_rules('isi_bimbingan', 'isi bimbingan', 'required|trim|htmlspecialchars');
        if ($this->form_validation->run() == FALSE) {
            // if not valid load comments
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect("news/lihatData/$id_det_bimbingan");
        } else {
            //if valid send comment to admin to tak approve
            $this->comment_model->add_new_comment();
            $this->session->set_flashdata('error_msg', 'Your comment is awaiting moderation.');
            redirect("news/lihatData/$id_det_bimbingan");
        }
    }

    function show_tree($id_det_bimbingan)
    {
        // create array to store all comments ids
        $store_all_id = array();
        // get all parent comments ids by using news id
        $id_result = $this->comment_model->tree_all($id_det_bimbingan);
        // loop through all comments to save parent ids $store_all_id array
        foreach ($id_result as $id_bimbingan) {
            array_push($store_all_id, $id_bimbingan['parent_id']);
        }
        // return all hierarchical tree data from in_parent by sending
        //  initiate parameters 0 is the main parent,news id, all parent ids

        return  $this->in_parent(0,$id_det_bimbingan, $store_all_id);
    }


    /* recursive function to loop
       through all comments and retrieve it
    */
    function in_parent($in_parent,$id_det_bimbingan,$store_all_id) {
        // this variable to save all concatenated html
        $html = "";
        // build hierarchy  html structure based on ul li (parent-child) nodes
        if (in_array($in_parent,$store_all_id)) {
            if ($this->session->userdata('level') == 'siswa') {
            $result = $this->comment_model->tree_by_parent($id_det_bimbingan,$in_parent); }
            else {
            $result = $this->comment_model->tree_by_parent_admin($id_det_bimbingan,$in_parent);
            };
            // $result = $this->comment_model->tree_by_parent($id_det_bimbingan,$in_parent);
            $html .=  $in_parent == 0 ? "<ul class='tree'>" : "<ul>";
            if(!empty($result)) {
            foreach ($result as $re) {
                $html .= " <li class='comment_box'>
            <div class='aut'>".$re['username']."</div>
            <div class='aut'>".$re['nama']."</div>
            <div class='comment-body'>".$re['isi_bimbingan']."</div>
            <div class='timestamp'>".date("F j, Y", $re['tgl_bimbingan'])."</div>
            <a  href='#comment_form' class='reply' id='" .$re['id_bimbingan'] . "'>Reply </a>";
                $html .=$this->in_parent($re['id_bimbingan'],$id_det_bimbingan, $store_all_id);
                $html .= "</li>";
            
            $html .=  "</ul>";
            }
        }
        }

        return $html;
    }

    public function point1() {
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
        $data = array(
          'nis' => $this->session->userdata('username'),
          'tgl_poin_reward' => $date
         ); 
        $this->db->insert('poin_reward', $data);
    redirect (base_url('Poin'));  
    }


    public function point() {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $data = array(
                    'nis' => $this->session->userdata('username'),
                    'tgl_poin_reward' => $date
                 ); 
        if($this->db->insert('poin_reward', $data)){
            $this->sendemail();
        }

        redirect (base_url('Poin'));
    }


    function sendemail(){
        $config = array();
       $config['charset'] = 'utf-8';
       $config['useragent'] = 'Codeigniter'; //bebas sesuai keinginan kamu
       $config['protocol']= "smtp";
       $config['mailtype']= "html";
       $config['smtp_host']= "ssl://smtp.gmail.com";
       $config['smtp_port']= "465";
       $config['smtp_timeout']= "5";
       $config['smtp_user']= "rameinajaweb@gmail.com";//isi dengan email kamu
       $config['smtp_pass']= "RameinajaUdah"; // isi dengan password kamu
       $config['crlf']="\r\n"; 
       $config['newline']="\r\n"; 
      
       $config['wordwrap'] = TRUE;
       //memanggil library email dan set konfigurasi untuk pengiriman email
       
       $this->email->initialize($config);
       //konfigurasi pengiriman
       $nama = $this->session->userdata('nama');
       $this->email->from('rameinajaweb@gmail.com', 'BK SMA 1 BARUNAWATI');
       $this->email->to('annisajema@ymail.com');
       $this->email->subject('BIMBINGAN SELESAI');
       $message = "<html><head><head></head><body><p>Hi, Admin</p><p>Akun atas nama '".$nama."', telah menyelesaikan bimbingannya. Mohon dilakukan pengecekan kembali</p><br/><p>Terima Kasih</p></body></html>";  
       $this->email->message($message);
       //Configure upload.
       $this->upload->initialize($config);
       $this->upload->initialize(array(
                            "upload_path"   => "./uploads/",
       "allowed_types" => "*"
       ));
       
       //Perform upload.
       if($this->upload->do_multi_upload("lampiran"))
        {
        
        $lamp = $this->upload->get_multi_upload_data();
        foreach ($lamp as $key=>$value)
        {
         $this->email->attach($value['full_path']); //mengambil path dari attachmen yang di uplad
        }
       }else
       {
        echo $this->upload->display_errors(); 
       }
       
       $send = $this->email->send();
       
            // refresh page
            redirect('Poin', 'refresh');
       
      
    
    }



}
/* End of file news.php */
/* Location: ./application/controllers/news.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Email extends CI_Controller {
  
  public function index()
  {

  	$data['pageTitle'] = 'Kirim Email';
    $data['pageContent'] =  $this->load->view('email/email', $data, TRUE);

     $this->load->view('template/layout', $data);
  }

  public function kirim()
  {
   $this->load->helper(array('form', 'url'));
   $this->load->library('upload');
   $this->load->library('email');
   
   //konfigurasi email
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
   $this->email->from('rameinajaweb@gmail.com', 'BK SMA 1 BARUNAWATI');
   $this->email->to($this->input->post('to'));
   $this->email->subject($this->input->post('subject'));
   $this->email->message($this->input->post('isi'));
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
   if ($send) $message =array('status' => true, 'message' => 'Berhasil mengirim email');
        else $message = array('status' => false, 'message' => 'Gagal mengirim email');

         $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('email', 'refresh');
   
  }
}

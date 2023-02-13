<?php

Class Bayes extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
		$data['data'] = $this->db->select('*')->from('dataset')->get()->result(); //Untuk mengambil data dari database webinar
		$data['rule'] = $this->db->select('*')->from('datates')->get()->result(); //Untuk mengambil data dari database webinar
		$this->template->load('template','bayes/list',$data);	
    }
	
	

function add() {
    $isi = array(
            'fakultas'     => $this->input->post('fakultas'),
			'administrasi'     => $this->input->post('administrasi'),
			'hasil'     => $this->input->post('hasil'),
			
        );
        $this->db->insert('dataset',$isi);
        redirect('bayes');
    }

	    
function edit(){
	if(isset($_POST['submit'])){
            $data = array(
            'fakultas'     => $this->input->post('fakultas'),
			'administrasi'     => $this->input->post('administrasi'),
			
        );
        $id   = $this->input->post('id');
        $this->db->where('id',$id);
        $this->db->update('datates',$data);
        redirect('bayes');
        }
    }

 function hapus(){
        $id = $this->uri->segment(3);
        if(!empty($id)){
            // proses delete data
            $this->db->where('id',$id);
            $this->db->delete('dataset');
        }
        redirect('bayes');
    }

}
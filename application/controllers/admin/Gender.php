<?php

 /**
 * Author: Amirul Momenin
 * Desc:Gender Controller
 *
 */
class Gender extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Gender_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of gender table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['gender'] = $this->Gender_model->get_limit_gender($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/gender/index');
		$config['total_rows'] = $this->Gender_model->get_count_gender();
		$config['per_page'] = 10;
		//Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';		
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
        $data['_view'] = 'admin/gender/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save gender
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		
		
		$params = array(
					 'gender_name' => html_escape($this->input->post('gender_name')),

				);
		 
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['gender'] = $this->Gender_model->get_gender($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Gender_model->update_gender($id,$params);
				$this->session->set_flashdata('msg','Gender has been updated successfully');
                redirect('admin/gender/index');
            }else{
                $data['_view'] = 'admin/gender/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $gender_id = $this->Gender_model->add_gender($params);
				$this->session->set_flashdata('msg','Gender has been saved successfully');
                redirect('admin/gender/index');
            }else{  
			    $data['gender'] = $this->Gender_model->get_gender(0);
                $data['_view'] = 'admin/gender/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details gender
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['gender'] = $this->Gender_model->get_gender($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/gender/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting gender
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $gender = $this->Gender_model->get_gender($id);

        // check if the gender exists before trying to delete it
        if(isset($gender['id'])){
            $this->Gender_model->delete_gender($id);
			$this->session->set_flashdata('msg','Gender has been deleted successfully');
            redirect('admin/gender/index');
        }
        else
            show_error('The gender you are trying to delete does not exist.');
    }
	
	/**
     * Search gender
	 * @param $start - Starting of gender table's index to get query
     */
	function search($start=0){
		if(!empty($this->input->post('key'))){
			$key =$this->input->post('key');
			$_SESSION['key'] = $key;
		}else{
			$key = $_SESSION['key'];
		}
		
		$limit = 10;		
		$this->db->like('id', $key, 'both');
$this->db->or_like('gender_name', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['gender'] = $this->db->get('gender')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/gender/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('gender_name', $key, 'both');

		$config['total_rows'] = $this->db->from("gender")->count_all_results();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$config['per_page'] = 10;
		// Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
		$data['key'] = $key;
		$data['_view'] = 'admin/gender/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export gender
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'gender_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $genderData = $this->Gender_model->get_all_gender();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Gender Name"); 
		   fputcsv($file, $header);
		   foreach ($genderData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $gender = $this->db->get('gender')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/gender/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Gender controller
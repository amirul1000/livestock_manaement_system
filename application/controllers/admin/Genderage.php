<?php

 /**
 * Author: Amirul Momenin
 * Desc:Genderage Controller
 *
 */
class Genderage extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Genderage_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of genderage table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['genderage'] = $this->Genderage_model->get_limit_genderage($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/genderage/index');
		$config['total_rows'] = $this->Genderage_model->get_count_genderage();
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
		
        $data['_view'] = 'admin/genderage/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save genderage
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		
		
		$params = array(
					 'breedgender_id' => html_escape($this->input->post('breedgender_id')),
'age' => html_escape($this->input->post('age')),
'status' => html_escape($this->input->post('status')),

				);
		<file_upload> 
		<careated_at_updated_at> 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['genderage'] = $this->Genderage_model->get_genderage($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Genderage_model->update_genderage($id,$params);
				$this->session->set_flashdata('msg','Genderage has been updated successfully');
                redirect('admin/genderage/index');
            }else{
                $data['_view'] = 'admin/genderage/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $genderage_id = $this->Genderage_model->add_genderage($params);
				$this->session->set_flashdata('msg','Genderage has been saved successfully');
                redirect('admin/genderage/index');
            }else{  
			    $data['genderage'] = $this->Genderage_model->get_genderage(0);
                $data['_view'] = 'admin/genderage/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details genderage
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['genderage'] = $this->Genderage_model->get_genderage($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/genderage/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting genderage
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $genderage = $this->Genderage_model->get_genderage($id);

        // check if the genderage exists before trying to delete it
        if(isset($genderage['id'])){
            $this->Genderage_model->delete_genderage($id);
			$this->session->set_flashdata('msg','Genderage has been deleted successfully');
            redirect('admin/genderage/index');
        }
        else
            show_error('The genderage you are trying to delete does not exist.');
    }
	
	/**
     * Search genderage
	 * @param $start - Starting of genderage table's index to get query
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
$this->db->or_like('breedgender_id', $key, 'both');
$this->db->or_like('age', $key, 'both');
$this->db->or_like('status', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['genderage'] = $this->db->get('genderage')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/genderage/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('breedgender_id', $key, 'both');
$this->db->or_like('age', $key, 'both');
$this->db->or_like('status', $key, 'both');

		$config['total_rows'] = $this->db->from("genderage")->count_all_results();
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
		$data['_view'] = 'admin/genderage/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export genderage
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'genderage_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $genderageData = $this->Genderage_model->get_all_genderage();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Breedgender Id","Age","Status"); 
		   fputcsv($file, $header);
		   foreach ($genderageData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $genderage = $this->db->get('genderage')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/genderage/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Genderage controller
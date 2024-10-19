<?php

 /**
 * Author: Amirul Momenin
 * Desc:Type Controller
 *
 */
class Type extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Type_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of type table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['type'] = $this->Type_model->get_limit_type($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/type/index');
		$config['total_rows'] = $this->Type_model->get_count_type();
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
		
        $data['_view'] = 'admin/type/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save type
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		
		
		$params = array(
					 'type_name' => html_escape($this->input->post('type_name')),

				);
		 
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['type'] = $this->Type_model->get_type($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Type_model->update_type($id,$params);
				$this->session->set_flashdata('msg','Type has been updated successfully');
                redirect('admin/type/index');
            }else{
                $data['_view'] = 'admin/type/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $type_id = $this->Type_model->add_type($params);
				$this->session->set_flashdata('msg','Type has been saved successfully');
                redirect('admin/type/index');
            }else{  
			    $data['type'] = $this->Type_model->get_type(0);
                $data['_view'] = 'admin/type/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details type
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['type'] = $this->Type_model->get_type($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/type/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting type
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $type = $this->Type_model->get_type($id);

        // check if the type exists before trying to delete it
        if(isset($type['id'])){
            $this->Type_model->delete_type($id);
			$this->session->set_flashdata('msg','Type has been deleted successfully');
            redirect('admin/type/index');
        }
        else
            show_error('The type you are trying to delete does not exist.');
    }
	
	/**
     * Search type
	 * @param $start - Starting of type table's index to get query
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
$this->db->or_like('type_name', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['type'] = $this->db->get('type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/type/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('type_name', $key, 'both');

		$config['total_rows'] = $this->db->from("type")->count_all_results();
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
		$data['_view'] = 'admin/type/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export type
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'type_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $typeData = $this->Type_model->get_all_type();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Type Name"); 
		   fputcsv($file, $header);
		   foreach ($typeData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $type = $this->db->get('type')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/type/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Type controller
<?php

 /**
 * Author: Amirul Momenin
 * Desc:Breed Controller
 *
 */
class Breed extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Breed_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of breed table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['breed'] = $this->Breed_model->get_limit_breed($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/breed/index');
		$config['total_rows'] = $this->Breed_model->get_count_breed();
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
		
        $data['_view'] = 'admin/breed/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save breed
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		
		
		$params = array(
					 'breed_name' => html_escape($this->input->post('breed_name')),
'status' => html_escape($this->input->post('status')),

				);
		 
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['breed'] = $this->Breed_model->get_breed($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Breed_model->update_breed($id,$params);
				$this->session->set_flashdata('msg','Breed has been updated successfully');
                redirect('admin/breed/index');
            }else{
                $data['_view'] = 'admin/breed/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $breed_id = $this->Breed_model->add_breed($params);
				$this->session->set_flashdata('msg','Breed has been saved successfully');
                redirect('admin/breed/index');
            }else{  
			    $data['breed'] = $this->Breed_model->get_breed(0);
                $data['_view'] = 'admin/breed/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details breed
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['breed'] = $this->Breed_model->get_breed($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/breed/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting breed
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $breed = $this->Breed_model->get_breed($id);

        // check if the breed exists before trying to delete it
        if(isset($breed['id'])){
            $this->Breed_model->delete_breed($id);
			$this->session->set_flashdata('msg','Breed has been deleted successfully');
            redirect('admin/breed/index');
        }
        else
            show_error('The breed you are trying to delete does not exist.');
    }
	
	/**
     * Search breed
	 * @param $start - Starting of breed table's index to get query
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
$this->db->or_like('breed_name', $key, 'both');
$this->db->or_like('status', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['breed'] = $this->db->get('breed')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/breed/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('breed_name', $key, 'both');
$this->db->or_like('status', $key, 'both');

		$config['total_rows'] = $this->db->from("breed")->count_all_results();
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
		$data['_view'] = 'admin/breed/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export breed
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'breed_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $breedData = $this->Breed_model->get_all_breed();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Breed Name","Status"); 
		   fputcsv($file, $header);
		   foreach ($breedData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $breed = $this->db->get('breed')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/breed/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Breed controller
<?php

 /**
 * Author: Amirul Momenin
 * Desc:Production Controller
 *
 */
class Production extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Production_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of production table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['production'] = $this->Production_model->get_limit_production($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/production/index');
		$config['total_rows'] = $this->Production_model->get_count_production();
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
		
        $data['_view'] = 'admin/production/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save production
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		$created_at = "";
$updated_at = "";

		if($id<=0){
															 $created_at = date("Y-m-d H:i:s");
														 }
else if($id>0){
															 $updated_at = date("Y-m-d H:i:s");
														 }

		$params = array(
					 'animal_id' => html_escape($this->input->post('animal_id')),
'production_type_id' => html_escape($this->input->post('production_type_id')),
'weight' => html_escape($this->input->post('weight')),
'description' => html_escape($this->input->post('description')),
'created_at' =>$created_at,
'updated_at' =>$updated_at,

				);
		 
		if($id>0){
							                        unset($params['created_at']);
						                          }if($id<=0){
							                        unset($params['updated_at']);
						                          } 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['production'] = $this->Production_model->get_production($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Production_model->update_production($id,$params);
				$this->session->set_flashdata('msg','Production has been updated successfully');
                redirect('admin/production/index');
            }else{
                $data['_view'] = 'admin/production/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $production_id = $this->Production_model->add_production($params);
				$this->session->set_flashdata('msg','Production has been saved successfully');
                redirect('admin/production/index');
            }else{  
			    $data['production'] = $this->Production_model->get_production(0);
                $data['_view'] = 'admin/production/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details production
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['production'] = $this->Production_model->get_production($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/production/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting production
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $production = $this->Production_model->get_production($id);

        // check if the production exists before trying to delete it
        if(isset($production['id'])){
            $this->Production_model->delete_production($id);
			$this->session->set_flashdata('msg','Production has been deleted successfully');
            redirect('admin/production/index');
        }
        else
            show_error('The production you are trying to delete does not exist.');
    }
	
	/**
     * Search production
	 * @param $start - Starting of production table's index to get query
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
$this->db->or_like('animal_id', $key, 'both');
$this->db->or_like('production_type_id', $key, 'both');
$this->db->or_like('weight', $key, 'both');
$this->db->or_like('description', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['production'] = $this->db->get('production')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/production/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('animal_id', $key, 'both');
$this->db->or_like('production_type_id', $key, 'both');
$this->db->or_like('weight', $key, 'both');
$this->db->or_like('description', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("production")->count_all_results();
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
		$data['_view'] = 'admin/production/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export production
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'production_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $productionData = $this->Production_model->get_all_production();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Animal Id","Production Type Id","Weight","Description","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($productionData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $production = $this->db->get('production')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/production/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Production controller
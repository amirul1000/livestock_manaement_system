<?php

 /**
 * Author: Amirul Momenin
 * Desc:Ad Controller
 *
 */
class Ad extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Ad_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of ad table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['ad'] = $this->Ad_model->get_limit_ad($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/ad/index');
		$config['total_rows'] = $this->Ad_model->get_count_ad();
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
		
        $data['_view'] = 'admin/ad/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save ad
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
					 'users_id' => html_escape($this->input->post('users_id')),
'breed_id' => html_escape($this->input->post('breed_id')),
'quantity' => html_escape($this->input->post('quantity')),
'gender' => html_escape($this->input->post('gender')),
'known_animal' => html_escape($this->input->post('known_animal')),
'its_name' => html_escape($this->input->post('its_name')),
'age' => html_escape($this->input->post('age')),
'slaugter' => html_escape($this->input->post('slaugter')),
'information' => html_escape($this->input->post('information')),
'sold_status' => html_escape($this->input->post('sold_status')),
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
			$data['ad'] = $this->Ad_model->get_ad($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Ad_model->update_ad($id,$params);
				$this->session->set_flashdata('msg','Ad has been updated successfully');
                redirect('admin/ad/index');
            }else{
                $data['_view'] = 'admin/ad/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $ad_id = $this->Ad_model->add_ad($params);
				$this->session->set_flashdata('msg','Ad has been saved successfully');
                redirect('admin/ad/index');
            }else{  
			    $data['ad'] = $this->Ad_model->get_ad(0);
                $data['_view'] = 'admin/ad/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details ad
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['ad'] = $this->Ad_model->get_ad($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/ad/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting ad
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $ad = $this->Ad_model->get_ad($id);

        // check if the ad exists before trying to delete it
        if(isset($ad['id'])){
            $this->Ad_model->delete_ad($id);
			$this->session->set_flashdata('msg','Ad has been deleted successfully');
            redirect('admin/ad/index');
        }
        else
            show_error('The ad you are trying to delete does not exist.');
    }
	
	/**
     * Search ad
	 * @param $start - Starting of ad table's index to get query
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
$this->db->or_like('users_id', $key, 'both');
$this->db->or_like('breed_id', $key, 'both');
$this->db->or_like('quantity', $key, 'both');
$this->db->or_like('gender', $key, 'both');
$this->db->or_like('known_animal', $key, 'both');
$this->db->or_like('its_name', $key, 'both');
$this->db->or_like('age', $key, 'both');
$this->db->or_like('slaugter', $key, 'both');
$this->db->or_like('information', $key, 'both');
$this->db->or_like('sold_status', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['ad'] = $this->db->get('ad')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/ad/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('users_id', $key, 'both');
$this->db->or_like('breed_id', $key, 'both');
$this->db->or_like('quantity', $key, 'both');
$this->db->or_like('gender', $key, 'both');
$this->db->or_like('known_animal', $key, 'both');
$this->db->or_like('its_name', $key, 'both');
$this->db->or_like('age', $key, 'both');
$this->db->or_like('slaugter', $key, 'both');
$this->db->or_like('information', $key, 'both');
$this->db->or_like('sold_status', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("ad")->count_all_results();
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
		$data['_view'] = 'admin/ad/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export ad
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'ad_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $adData = $this->Ad_model->get_all_ad();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Users Id","Breed Id","Quantity","Gender","Known Animal","Its Name","Age","Slaugter","Information","Sold Status","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($adData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $ad = $this->db->get('ad')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/ad/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Ad controller
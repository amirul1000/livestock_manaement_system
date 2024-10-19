<?php

 /**
 * Author: Amirul Momenin
 * Desc:Ad_image Controller
 *
 */
class Ad_image extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Ad_image_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of ad_image table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['ad_image'] = $this->Ad_image_model->get_limit_ad_image($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/ad_image/index');
		$config['total_rows'] = $this->Ad_image_model->get_count_ad_image();
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
		
        $data['_view'] = 'admin/ad_image/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save ad_image
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		$image = "";
 
		
		
		$params = array(
					 'ad_id' => html_escape($this->input->post('ad_id')),
'image' => $image,

				);
		
						$config['upload_path']          = "./public/uploads/images/ad_image";
						$config['allowed_types']        = "gif|jpg|png";
						$config['max_size']             = 100;
						$config['max_width']            = 1024;
						$config['max_height']           = 768;
						$this->load->library('upload', $config);
						
						if(isset($_POST) && count($_POST) > 0)     
							{  
							  if(strlen($_FILES['image']['name'])>0 && $_FILES['image']['size']>0)
								{
									if ( ! $this->upload->do_upload('image'))
									{
										$error = array('error' => $this->upload->display_errors());
									}
									else
									{
										$image = "uploads/images/ad_image/".$_FILES['image']['name'];
									    $params['image'] = $image;
									}
								}
								else
								{
									unset($params['image']);
								}
							}
							
						    
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['ad_image'] = $this->Ad_image_model->get_ad_image($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Ad_image_model->update_ad_image($id,$params);
				$this->session->set_flashdata('msg','Ad_image has been updated successfully');
                redirect('admin/ad_image/index');
            }else{
                $data['_view'] = 'admin/ad_image/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $ad_image_id = $this->Ad_image_model->add_ad_image($params);
				$this->session->set_flashdata('msg','Ad_image has been saved successfully');
                redirect('admin/ad_image/index');
            }else{  
			    $data['ad_image'] = $this->Ad_image_model->get_ad_image(0);
                $data['_view'] = 'admin/ad_image/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details ad_image
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['ad_image'] = $this->Ad_image_model->get_ad_image($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/ad_image/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting ad_image
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $ad_image = $this->Ad_image_model->get_ad_image($id);

        // check if the ad_image exists before trying to delete it
        if(isset($ad_image['id'])){
            $this->Ad_image_model->delete_ad_image($id);
			$this->session->set_flashdata('msg','Ad_image has been deleted successfully');
            redirect('admin/ad_image/index');
        }
        else
            show_error('The ad_image you are trying to delete does not exist.');
    }
	
	/**
     * Search ad_image
	 * @param $start - Starting of ad_image table's index to get query
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
$this->db->or_like('ad_id', $key, 'both');
$this->db->or_like('image', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['ad_image'] = $this->db->get('ad_image')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/ad_image/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('ad_id', $key, 'both');
$this->db->or_like('image', $key, 'both');

		$config['total_rows'] = $this->db->from("ad_image")->count_all_results();
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
		$data['_view'] = 'admin/ad_image/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export ad_image
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'ad_image_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $ad_imageData = $this->Ad_image_model->get_all_ad_image();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Ad Id","Image"); 
		   fputcsv($file, $header);
		   foreach ($ad_imageData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $ad_image = $this->db->get('ad_image')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/ad_image/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Ad_image controller
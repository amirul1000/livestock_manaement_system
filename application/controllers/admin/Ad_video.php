<?php

 /**
 * Author: Amirul Momenin
 * Desc:Ad_video Controller
 *
 */
class Ad_video extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Ad_video_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of ad_video table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['ad_video'] = $this->Ad_video_model->get_limit_ad_video($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/ad_video/index');
		$config['total_rows'] = $this->Ad_video_model->get_count_ad_video();
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
		
        $data['_view'] = 'admin/ad_video/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save ad_video
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		
		
		$params = array(
					 'ad_id' => html_escape($this->input->post('ad_id')),
'video' => html_escape($this->input->post('video')),

				);
		 
		 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['ad_video'] = $this->Ad_video_model->get_ad_video($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Ad_video_model->update_ad_video($id,$params);
				$this->session->set_flashdata('msg','Ad_video has been updated successfully');
                redirect('admin/ad_video/index');
            }else{
                $data['_view'] = 'admin/ad_video/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $ad_video_id = $this->Ad_video_model->add_ad_video($params);
				$this->session->set_flashdata('msg','Ad_video has been saved successfully');
                redirect('admin/ad_video/index');
            }else{  
			    $data['ad_video'] = $this->Ad_video_model->get_ad_video(0);
                $data['_view'] = 'admin/ad_video/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details ad_video
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['ad_video'] = $this->Ad_video_model->get_ad_video($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/ad_video/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting ad_video
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $ad_video = $this->Ad_video_model->get_ad_video($id);

        // check if the ad_video exists before trying to delete it
        if(isset($ad_video['id'])){
            $this->Ad_video_model->delete_ad_video($id);
			$this->session->set_flashdata('msg','Ad_video has been deleted successfully');
            redirect('admin/ad_video/index');
        }
        else
            show_error('The ad_video you are trying to delete does not exist.');
    }
	
	/**
     * Search ad_video
	 * @param $start - Starting of ad_video table's index to get query
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
$this->db->or_like('video', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['ad_video'] = $this->db->get('ad_video')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/ad_video/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('ad_id', $key, 'both');
$this->db->or_like('video', $key, 'both');

		$config['total_rows'] = $this->db->from("ad_video")->count_all_results();
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
		$data['_view'] = 'admin/ad_video/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export ad_video
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'ad_video_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $ad_videoData = $this->Ad_video_model->get_all_ad_video();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Ad Id","Video"); 
		   fputcsv($file, $header);
		   foreach ($ad_videoData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $ad_video = $this->db->get('ad_video')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/ad_video/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Ad_video controller
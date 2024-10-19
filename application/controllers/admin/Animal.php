<?php

 /**
 * Author: Amirul Momenin
 * Desc:Animal Controller
 *
 */
class Animal extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Animal_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of animal table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['animal'] = $this->Animal_model->get_limit_animal($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/animal/index');
		$config['total_rows'] = $this->Animal_model->get_count_animal();
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
		
        $data['_view'] = 'admin/animal/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save animal
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		$file_picture = "";
 
		$created_at = "";
$updated_at = "";

		if($id<=0){
															 $created_at = date("Y-m-d H:i:s");
														 }
else if($id>0){
															 $updated_at = date("Y-m-d H:i:s");
														 }

		$params = array(
					 'parents_animal_id' => html_escape($this->input->post('parents_animal_id')),
'type_id' => html_escape($this->input->post('type_id')),
'breed_id' => html_escape($this->input->post('breed_id')),
'gender_id' => html_escape($this->input->post('gender_id')),
'its_name' => html_escape($this->input->post('its_name')),
'tag_code' => html_escape($this->input->post('tag_code')),
'age' => html_escape($this->input->post('age')),
'color' => html_escape($this->input->post('color')),
'weight' => html_escape($this->input->post('weight')),
'known_animal' => html_escape($this->input->post('known_animal')),
'information' => html_escape($this->input->post('information')),
'date_of_birth' => html_escape($this->input->post('date_of_birth')),
'file_picture' => $file_picture,
'status' => html_escape($this->input->post('status')),
'created_at' =>$created_at,
'updated_at' =>$updated_at,

				);
		
						$config['upload_path']          = "./public/uploads/images/animal";
						$config['allowed_types']        = "gif|jpg|jpeg|png";
						/*$config['max_size']             = 100;
						$config['max_width']            = 1024;
						$config['max_height']           = 768;*/
						$this->load->library('upload', $config);
						
						if(isset($_POST) && count($_POST) > 0)     
							{  
							  if(strlen($_FILES['file_picture']['name'])>0 && $_FILES['file_picture']['size']>0)
								{
									if ( ! $this->upload->do_upload('file_picture'))
									{
										$error = array('error' => $this->upload->display_errors());
									}
									else
									{
										$file_picture = "uploads/images/animal/".$_FILES['file_picture']['name'];
									    $params['file_picture'] = $file_picture;
									}
								}
								else
								{
									unset($params['file_picture']);
								}
							}
							
						    
		if($id>0){
							                        unset($params['created_at']);
						                          }if($id<=0){
							                        unset($params['updated_at']);
						                          } 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['animal'] = $this->Animal_model->get_animal($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Animal_model->update_animal($id,$params);
				$this->session->set_flashdata('msg','Animal has been updated successfully');
                redirect('admin/animal/index');
            }else{
                $data['_view'] = 'admin/animal/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $animal_id = $this->Animal_model->add_animal($params);
				$this->session->set_flashdata('msg','Animal has been saved successfully');
                redirect('admin/animal/index');
            }else{  
			    $data['animal'] = $this->Animal_model->get_animal(0);
                $data['_view'] = 'admin/animal/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details animal
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['animal'] = $this->Animal_model->get_animal($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/animal/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting animal
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $animal = $this->Animal_model->get_animal($id);

        // check if the animal exists before trying to delete it
        if(isset($animal['id'])){
            $this->Animal_model->delete_animal($id);
			$this->session->set_flashdata('msg','Animal has been deleted successfully');
            redirect('admin/animal/index');
        }
        else
            show_error('The animal you are trying to delete does not exist.');
    }
	
	/**
     * Search animal
	 * @param $start - Starting of animal table's index to get query
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
$this->db->or_like('parents_animal_id', $key, 'both');
$this->db->or_like('type_id', $key, 'both');
$this->db->or_like('breed_id', $key, 'both');
$this->db->or_like('gender_id', $key, 'both');
$this->db->or_like('its_name', $key, 'both');
$this->db->or_like('tag_code', $key, 'both');
$this->db->or_like('age', $key, 'both');
$this->db->or_like('color', $key, 'both');
$this->db->or_like('weight', $key, 'both');
$this->db->or_like('known_animal', $key, 'both');
$this->db->or_like('information', $key, 'both');
$this->db->or_like('date_of_birth', $key, 'both');
$this->db->or_like('file_picture', $key, 'both');
$this->db->or_like('status', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['animal'] = $this->db->get('animal')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/animal/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('parents_animal_id', $key, 'both');
$this->db->or_like('type_id', $key, 'both');
$this->db->or_like('breed_id', $key, 'both');
$this->db->or_like('gender_id', $key, 'both');
$this->db->or_like('its_name', $key, 'both');
$this->db->or_like('tag_code', $key, 'both');
$this->db->or_like('age', $key, 'both');
$this->db->or_like('color', $key, 'both');
$this->db->or_like('weight', $key, 'both');
$this->db->or_like('known_animal', $key, 'both');
$this->db->or_like('information', $key, 'both');
$this->db->or_like('date_of_birth', $key, 'both');
$this->db->or_like('file_picture', $key, 'both');
$this->db->or_like('status', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("animal")->count_all_results();
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
		$data['_view'] = 'admin/animal/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export animal
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'animal_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $animalData = $this->Animal_model->get_all_animal();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Parents Animal Id","Type Id","Breed Id","Gender Id","Its Name","Tag Code","Age","Color","Weight","Known Animal","Information","Date Of Birth","File Picture","Status","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($animalData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $animal = $this->db->get('animal')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/animal/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Animal controller
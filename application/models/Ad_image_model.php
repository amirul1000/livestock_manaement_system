<?php

/**
 * Author: Amirul Momenin
 * Desc:Ad_image Model
 */
class Ad_image_model extends CI_Model
{
	protected $ad_image = 'ad_image';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get ad_image by id
	 *@param $id - primary key to get record
	 *
     */
    function get_ad_image($id){
        $result = $this->db->get_where('ad_image',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('ad_image');
			foreach ($fields as $field)
			{
			   $result[$field] = ''; 	  
			}
		}
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    } 
	
    /** Get all ad_image
	 *
     */
    function get_all_ad_image(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('ad_image')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit ad_image
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_ad_image($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('ad_image')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count ad_image rows
	 *
     */
	function get_count_ad_image(){
       $result = $this->db->from("ad_image")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-ad_image
	 *
     */
    function get_all_users_ad_image(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('ad_image')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-ad_image
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_ad_image($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('ad_image')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-ad_image rows
	 *
     */
	function get_count_users_ad_image(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("ad_image")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new ad_image
	 *@param $params - data set to add record
	 *
     */
    function add_ad_image($params){
        $this->db->insert('ad_image',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update ad_image
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_ad_image($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('ad_image',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete ad_image
	 *@param $id - primary key to delete record
	 *
     */
    function delete_ad_image($id){
        $status = $this->db->delete('ad_image',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}

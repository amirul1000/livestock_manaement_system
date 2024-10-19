<?php

/**
 * Author: Amirul Momenin
 * Desc:Ad Model
 */
class Ad_model extends CI_Model
{
	protected $ad = 'ad';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get ad by id
	 *@param $id - primary key to get record
	 *
     */
    function get_ad($id){
        $result = $this->db->get_where('ad',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('ad');
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
	
    /** Get all ad
	 *
     */
    function get_all_ad(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('ad')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit ad
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_ad($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('ad')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count ad rows
	 *
     */
	function get_count_ad(){
       $result = $this->db->from("ad")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-ad
	 *
     */
    function get_all_users_ad(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('ad')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-ad
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_ad($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('ad')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-ad rows
	 *
     */
	function get_count_users_ad(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("ad")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new ad
	 *@param $params - data set to add record
	 *
     */
    function add_ad($params){
        $this->db->insert('ad',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update ad
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_ad($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('ad',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete ad
	 *@param $id - primary key to delete record
	 *
     */
    function delete_ad($id){
        $status = $this->db->delete('ad',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}

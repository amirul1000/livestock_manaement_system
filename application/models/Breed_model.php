<?php

/**
 * Author: Amirul Momenin
 * Desc:Breed Model
 */
class Breed_model extends CI_Model
{
	protected $breed = 'breed';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get breed by id
	 *@param $id - primary key to get record
	 *
     */
    function get_breed($id){
        $result = $this->db->get_where('breed',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('breed');
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
	
    /** Get all breed
	 *
     */
    function get_all_breed(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('breed')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit breed
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_breed($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('breed')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count breed rows
	 *
     */
	function get_count_breed(){
       $result = $this->db->from("breed")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-breed
	 *
     */
    function get_all_users_breed(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('breed')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-breed
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_breed($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('breed')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-breed rows
	 *
     */
	function get_count_users_breed(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("breed")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new breed
	 *@param $params - data set to add record
	 *
     */
    function add_breed($params){
        $this->db->insert('breed',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update breed
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_breed($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('breed',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete breed
	 *@param $id - primary key to delete record
	 *
     */
    function delete_breed($id){
        $status = $this->db->delete('breed',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}

<?php

/**
 * Author: Amirul Momenin
 * Desc:Gender Model
 */
class Gender_model extends CI_Model
{
	protected $gender = 'gender';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get gender by id
	 *@param $id - primary key to get record
	 *
     */
    function get_gender($id){
        $result = $this->db->get_where('gender',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('gender');
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
	
    /** Get all gender
	 *
     */
    function get_all_gender(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('gender')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit gender
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_gender($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('gender')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count gender rows
	 *
     */
	function get_count_gender(){
       $result = $this->db->from("gender")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-gender
	 *
     */
    function get_all_users_gender(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('gender')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-gender
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_gender($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('gender')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-gender rows
	 *
     */
	function get_count_users_gender(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("gender")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new gender
	 *@param $params - data set to add record
	 *
     */
    function add_gender($params){
        $this->db->insert('gender',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update gender
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_gender($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('gender',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete gender
	 *@param $id - primary key to delete record
	 *
     */
    function delete_gender($id){
        $status = $this->db->delete('gender',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}

<?php

/**
 * Author: Amirul Momenin
 * Desc:Genderage Model
 */
class Genderage_model extends CI_Model
{
	protected $genderage = 'genderage';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get genderage by id
	 *@param $id - primary key to get record
	 *
     */
    function get_genderage($id){
        $result = $this->db->get_where('genderage',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('genderage');
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
	
    /** Get all genderage
	 *
     */
    function get_all_genderage(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('genderage')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit genderage
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_genderage($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('genderage')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count genderage rows
	 *
     */
	function get_count_genderage(){
       $result = $this->db->from("genderage")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-genderage
	 *
     */
    function get_all_users_genderage(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('genderage')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-genderage
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_genderage($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('genderage')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-genderage rows
	 *
     */
	function get_count_users_genderage(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("genderage")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new genderage
	 *@param $params - data set to add record
	 *
     */
    function add_genderage($params){
        $this->db->insert('genderage',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update genderage
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_genderage($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('genderage',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete genderage
	 *@param $id - primary key to delete record
	 *
     */
    function delete_genderage($id){
        $status = $this->db->delete('genderage',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}

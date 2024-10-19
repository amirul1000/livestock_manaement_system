<?php

/**
 * Author: Amirul Momenin
 * Desc:Production Model
 */
class Production_model extends CI_Model
{
	protected $production = 'production';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get production by id
	 *@param $id - primary key to get record
	 *
     */
    function get_production($id){
        $result = $this->db->get_where('production',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('production');
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
	
    /** Get all production
	 *
     */
    function get_all_production(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('production')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit production
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_production($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('production')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count production rows
	 *
     */
	function get_count_production(){
       $result = $this->db->from("production")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-production
	 *
     */
    function get_all_users_production(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('production')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-production
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_production($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('production')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-production rows
	 *
     */
	function get_count_users_production(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("production")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new production
	 *@param $params - data set to add record
	 *
     */
    function add_production($params){
        $this->db->insert('production',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update production
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_production($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('production',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete production
	 *@param $id - primary key to delete record
	 *
     */
    function delete_production($id){
        $status = $this->db->delete('production',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}

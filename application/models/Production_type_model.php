<?php

/**
 * Author: Amirul Momenin
 * Desc:Production_type Model
 */
class Production_type_model extends CI_Model
{
	protected $production_type = 'production_type';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get production_type by id
	 *@param $id - primary key to get record
	 *
     */
    function get_production_type($id){
        $result = $this->db->get_where('production_type',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('production_type');
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
	
    /** Get all production_type
	 *
     */
    function get_all_production_type(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('production_type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit production_type
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_production_type($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('production_type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count production_type rows
	 *
     */
	function get_count_production_type(){
       $result = $this->db->from("production_type")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-production_type
	 *
     */
    function get_all_users_production_type(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('production_type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-production_type
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_production_type($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('production_type')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-production_type rows
	 *
     */
	function get_count_users_production_type(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("production_type")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new production_type
	 *@param $params - data set to add record
	 *
     */
    function add_production_type($params){
        $this->db->insert('production_type',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update production_type
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_production_type($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('production_type',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete production_type
	 *@param $id - primary key to delete record
	 *
     */
    function delete_production_type($id){
        $status = $this->db->delete('production_type',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}

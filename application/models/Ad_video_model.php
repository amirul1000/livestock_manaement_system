<?php

/**
 * Author: Amirul Momenin
 * Desc:Ad_video Model
 */
class Ad_video_model extends CI_Model
{
	protected $ad_video = 'ad_video';
	
    function __construct(){
        parent::__construct();
    }
	
    /** Get ad_video by id
	 *@param $id - primary key to get record
	 *
     */
    function get_ad_video($id){
        $result = $this->db->get_where('ad_video',array('id'=>$id))->row_array();
		if(!(array)$result){
			$fields = $this->db->list_fields('ad_video');
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
	
    /** Get all ad_video
	 *
     */
    function get_all_ad_video(){
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('ad_video')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit ad_video
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_ad_video($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('ad_video')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count ad_video rows
	 *
     */
	function get_count_ad_video(){
       $result = $this->db->from("ad_video")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	
	 /** Get all users-ad_video
	 *
     */
    function get_all_users_ad_video(){
        $this->db->order_by('id', 'desc');
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('ad_video')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
	/** Get limit users-ad_video
	 *@param $limit - limit of query , $start - start of db table index to get query
	 *
     */
    function get_limit_users_ad_video($limit, $start){
		$this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
		$this->db->where('users_id', $this->session->userdata('id'));
        $result = $this->db->get('ad_video')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** Count users-ad_video rows
	 *
     */
	function get_count_users_ad_video(){
	   $this->db->where('users_id', $this->session->userdata('id'));
       $result = $this->db->from("ad_video")->count_all_results();
	   $db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $result;
    }
	
    /** function to add new ad_video
	 *@param $params - data set to add record
	 *
     */
    function add_ad_video($params){
        $this->db->insert('ad_video',$params);
        $id = $this->db->insert_id();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $id;
    }
	
    /** function to update ad_video
	 *@param $id - primary key to update record,$params - data set to add record
	 *
     */
    function update_ad_video($id,$params){
        $this->db->where('id',$id);
        $status = $this->db->update('ad_video',$params);
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
	
    /** function to delete ad_video
	 *@param $id - primary key to delete record
	 *
     */
    function delete_ad_video($id){
        $status = $this->db->delete('ad_video',array('id'=>$id));
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		return $status;
    }
}

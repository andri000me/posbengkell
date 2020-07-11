<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {
	

	public function __construct()
	{
		parent::__construct();
		//$this->load->database();
	}

	public function check_admin($data)
	{		
		$this->db->where($data);
		$this->db->from('tbl_user');		
		$query = $this->db->get();
		return $query;
	}

	public function save_user($data)
	{	
		$this->db->insert('tbl_user', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
}
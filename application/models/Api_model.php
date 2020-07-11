<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function login($username){
		$this->db->where('username', $username);
		$this->db->where("(role_user='TEKNISI' OR role_user='GUDANG' OR role_user='MANAGER')", NULL, FALSE);		
        $data = $this->db->get("view_data_pegawai")->row();
        return $data;	
	}

	public function task_get($user, $role_user, $status){		
		if ($role_user == "GUDANG") 
	    	$this->db->where('id_gudang', $user->id);						
		elseif ($role_user == "TEKNISI") 
	    	$this->db->where('id_teknisi', $user->id);			
	    elseif ($role_user == "MANAGER") {	    	
	    	$this->db->where('id_bengkel', $user->id_bengkel);			
	    }
	    
	    if ($status > 1) {
	    	$this->db->where('status !=', 1);			
		}else{
	    	$this->db->where('status', $status);
		}
	    $data = $this->db->get("view_perintah_kerja")->result_array();
	    
        return $data;	
	}

}
<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class DataBengkel  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();		
    	$authRole = $this->session->userdata('roleuser');        	
    	$allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();    	
        if($allow->data_bengkel !=  'ya'){
            redirect('dashboard');
        }
    }
    
    public function index(){
        $authRole = $this->session->userdata('roleuser');
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
		$data['subtitle_small'] = 'Data Bengkel';
		$data['page'] = 'data_bengkel';            
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
		$this->themes->Display('superadmin/data_bengkel/data_bengkel', $data);
    }       

    public function AddBengkel($id = -1){
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));        
        $data['page'] = 'add_bengkel';
        if ($id == -1) {
            $data['subtitle_small'] = 'Tambah Data Bengkel';  
            $data['data_bengkel'] = null;
        }else{
            $data['subtitle_small'] = 'Edit Data Bengkel';
            $data['data_bengkel'] = $this->db->get_where('tbl_info_bengkel', ['id'=>$id])->row();
        }                
        $this->themes->Display('superadmin/data_bengkel/add_bengkel', $data);        
    }

    public function ViewDataBengkel(){
        $data['data'] = $this->db->get('tbl_info_bengkel')
                                ->result_array();
        echo json_encode($data);
    }     

    public function ViewAdminManager($idbengkel = -1){        
        $this->db->where('id_bengkel', $idbengkel);
        $this->db->where("(role_user='ADMIN' OR role_user='MANAGER')", NULL, FALSE);

        $data['data'] = $this->db->order_by('id','asc')
                                ->get('tbl_user')
                                ->result_array();
        echo json_encode($data);
    }

    
    public function SaveAdminManager(){
        $idbengkel = $this->input->post('id_bengkel');                            
        $username  = $this->input->post('username');                            
        $role_user = $this->input->post('role_user');        
        $password  = password_hash($this->input->post('password'),PASSWORD_DEFAULT);

        if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
                $updateUser = $this->db->where(['id' => $id])
                                    ->update('tbl_user',[
                                        'id_bengkel' => $idbengkel,
                                        'username' => $username,
                                        'role_user' => strtoupper($role_user),
                                    ]);
            if($updateUser){
                $msg = array(
                    'msg'=>'Data '.strtoupper($role_user).' berhasil diubah',
                    'icon' => 'success',
                );                
            }else{
                $msg = array(
                    'msg'=>'Gagal mengubah data',
                    'icon' => 'error',
                );
            }
        }else{
            $cekUser = $this->db->get_where('tbl_user',[
                    'id_bengkel' => $idbengkel,                
                    'username' => $username,
                ]);

            if($cekUser->num_rows() > 0){
                $msg = array(
                    'msg'=>'Username sudah digunakan',
                    'icon' => 'error',
                );
            }else{
                $saveUser =$this->db->insert('tbl_user',[
                    'id_bengkel' => $idbengkel,                
                    'username' => $username,
                    'password' => $password,
                    'role_user' => strtoupper($role_user),
                ]);
                
                if($saveUser){
                    $msg = array(
                        'msg'=>'Data '.strtoupper($role_user).' berhasil ditambah',
                        'icon' => 'success',
                    );                    
                }else{
                    $msg = array(
                        'msg'=>'Gagal menyimpan data',
                        'icon' => 'error',
                    );
                }
            }
        }        
        echo json_encode($msg);
    }

    public function SaveInfoBengkel(){         
    	$id = $this->input->post('id');

    	$input_info_bengkel = array(
           'nama_pemilik' => $this->input->post('nama_pemilik'),
           'no_npwp' => $this->input->post('no_npwp'),
           'no_telepon' => $this->input->post('no_telepon'),
           'alamat' => $this->input->post('alamat'),
        );

    	$data_bengkel = $this->db->get_where('tbl_info_bengkel', ['id' => $id])->row();
    	if ($data_bengkel != null) {
    		//update
    		$updateInfoBengkel = $this->db->where(['id' => $id])
                            ->update('tbl_info_bengkel', $input_info_bengkel);
                                    
	        if ($updateInfoBengkel){
	            $msg = array(
	                'msg'=>'Data Info Bengkel Berhasil diubah',
	                'icon' => 'success',
	            );
	        }else {
	            $msg = array(
	                'msg'=>'Simpan Data Info Bengkel Gagal',
	                'icon' => 'error',
	            );
	        }                
    	}else{
    		$input_info_bengkel['id'] = $id;
    		//insert
    		$insertInfoBengkel = $this->db->insert('tbl_info_bengkel', $input_info_bengkel);
                                    
	        if ($insertInfoBengkel){
	            $msg = array(
	                'msg'=>'Simpan Data Info Bengkel Berhasil',
	                'icon' => 'success',
	            );
	        }else {
	            $msg = array(
	                'msg'=>'Simpan Data Info Bengkel Gagal',
	                'icon' => 'error',
	            );
	        }                
    	}        
            
        echo json_encode($msg);
    }

    public function ChangeLogoBengkel(){
    	$id = $this->input->post('id');
        $this->db->where('id', $id);
        $data_bengkel = $this->db->get('tbl_info_bengkel')->row();        

        $imgUpload = $this->_uploadImage(time()."Logo_".$id, 'file');
        $data_info_bengkel = array('foto' => $imgUpload);

        $updateInfoBengkel = $this->db->where(['id' => $id])
                            ->update('tbl_info_bengkel', $data_info_bengkel);
        if ($updateInfoBengkel){
            if($data_bengkel->foto != null){
                unlink('./upload/'.$data_bengkel->foto);
            }

            $msg = array(
                'msg'=>'Ganti Logo Bengkel Berhasil',
                'icon' => 'success',
            );
        }else {
            $msg = array(
                'msg'=>'Ganti Logo Bengkel Gagal',
                'icon' => 'error',
            );
        }                
            
        echo json_encode($msg);
    }

    public function _uploadImage($name, $name_file)
    {
        $config['upload_path']          = './upload/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = $name;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; // 2MB
    
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($name_file)) {
            
            // //Compress Image
            $config['image_library'] ='gd2';
            $config['source_image']  = './upload/'.$this->upload->data("file_name");
            $config['create_thumb']  = FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']       = '100%';
            $config['width']         = 200;
            $config['height']        = 200;
            $config['new_image']     = './upload/'.$this->upload->data("file_name");
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            
            return $this->upload->data("file_name");
        }else{
            var_dump($this->upload->display_errors());die();
            return "http://placehold.it/500x325";
        }  
    }

    public function DeleteBengkel(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_info_bengkel',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_info_bengkel',['id'=>$id]);
            if($deleteData){        
                $this->db->delete('tbl_info_bengkel',['id'=>$id]);
                $msg = array(
                    'msg'=>'Berhasil menghapus data',
                    'icon' => 'success',
                );                
            }else{
                $msg = array(
                    'msg'=>'Gagal menghapus data',
                    'icon' => 'error',
                );
            }
        }else{
            $msg = array(
                'msg'=>'Data tidak ditemukan',
                'icon' => 'error',
            );
        }
        
        echo json_encode($msg);
    }

    public function DeleteAdminManager(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_user',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_user',['id'=>$id]);
            if($deleteData){        
                $this->db->delete('tbl_user',['id'=>$id]);
                $msg = array(
                    'msg'=>'Berhasil menghapus data',
                    'icon' => 'success',
                );                
            }else{
                $msg = array(
                    'msg'=>'Gagal menghapus data',
                    'icon' => 'error',
                );
            }
        }else{
            $msg = array(
                'msg'=>'Data tidak ditemukan',
                'icon' => 'error',
            );
        }
        
        echo json_encode($msg);
    }
    
    public function GetAdminManager(){
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $cekData = $this->db->get('tbl_user');        
        if($cekData->num_rows() > 0 ){
            $data = $cekData->row_array();
            echo json_encode($data);
        }else{
            $msg = array(
                'msg'=>'Data tidak ditemukan',
                'icon' => 'error',
            );
            echo json_encode($msg);
        }   
    }
}
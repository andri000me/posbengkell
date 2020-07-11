<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class InfoBengkel  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();        
        $authRole = $this->session->userdata('roleuser');           
        $allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();      
        if($allow->info_bengkel !=  'ya'){
            redirect('dashboard');
        }
    }

    public function index(){
        $idbengkel = $this->session->userdata('idbengkel');        
        $authRole = $this->session->userdata('roleuser');              
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                 
		$data['subtitle_small'] = 'Info Bengkel';
		$data['page'] = 'info_bengkel';            
        $data['data_bengkel'] = $this->db->get_where('tbl_info_bengkel', ['id' => $idbengkel])->row();

		$this->themes->Display('admin/info_bengkel/info_bengkel', $data);
    }
    
    public function SaveInfoBengkel(){         
        $idbengkel = $this->session->userdata('idbengkel');                
        $data_info_bengkel = array(
           'nama_pemilik' => $this->input->post('nama_pemilik'),
           'no_npwp' => $this->input->post('no_npwp'),
           'no_telepon' => $this->input->post('no_telepon'),
           'alamat' => $this->input->post('alamat'),
        );

        $updateInfoBengkel = $this->db->where(['id' => $idbengkel])
                            ->update('tbl_info_bengkel', $data_info_bengkel);
                                    
        if ($updateInfoBengkel){
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
            
        echo json_encode($msg);
    }

    public function ChangeLogoBengkel(){
        $idbengkel = $this->session->userdata('idbengkel');                
        
        $this->db->where('id', $idbengkel);
        $data_bengkel = $this->db->get('tbl_info_bengkel')->row();        

        $imgUpload = $this->_uploadImage(time()."Logo_".$idbengkel, 'file');
        $data_info_bengkel = array('foto' => $imgUpload);

        $updateInfoBengkel = $this->db->where(['id' => $idbengkel])
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
}
<?php 
if(!defined('BASEPATH')) exit ('no file allowed');
class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index($err = "")
	{		
		$data["errorlogin"] = $err;
		$this->load->view('auth/login', $data);
    }
    
    public function login()
	{
		$username	=	$this->input->post('username');
		$data = ['username' => $username];
		$pass = $this->input->post('password');

		$check = $this->crud_model->check_admin($data)->result();	
		
		$where 	=	[
			'username'	=>	$username,
			'password'	=>	md5($pass)
		];
		$this->db->where($where);
		$getData = $this->db->get('tbl_user');	
		
		if($getData->num_rows() >= 1){		
			$getData	=	$getData->row();

			$this->session->set_userdata('userdata', $check);
			$this->session->set_userdata('roleuser', $getData->role_user);	
			$this->session->set_userdata('idbengkel', $getData->id_bengkel);

			if ($getData->role_user == "ADMIN" || $getData->role_user == "SUPERADMIN" || 
				$getData->role_user == "KASIR" || $getData->role_user == "GUDANG" || $getData->role_user == "KA_TEKNISI") {

				redirect('dashboard',$data);		
			}else{
				$this->index('Username or Password is Wrong.');		
			}
		}else{			
			$this->index('Username or Password is Wrong.');		
		}
    }

    public function resetPassword()	{
		$password = password_hash($this->input->post('new_pass'),PASSWORD_DEFAULT);
		$id = $this->input->post('id_reset');
		$checkData = $this->db->get_where('tbl_user',['id'=>$id]);
		if($checkData->num_rows() > 0){
			$resetPassword = $this->db->where(['id'=>$id])->update('tbl_user',
														['password'=>$password]);
			if($resetPassword){
				$msg = array(
					'msg'=>'Password berhasil diubah',
					'icon' => 'success',
				);
			}else{
				$msg = array(
					'msg'=>'Gagal mengubah password',
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
    
    public function logout(){
		$this->session->unset_userdata('userdata');
		$this->session->unset_userdata('roleuser');
		$this->session->unset_userdata('idbengkel');
		$this->session->unset_userdata('idPembelian');

		redirect('/', 'refresh');
	}
}
<?php  
if(!defined('BASEPATH')) exit ('no file allowed');
class Pegawai  extends CI_Controller{
    public function __construct()
	{
		parent::__construct();	
		date_default_timezone_set("Asia/Jakarta");
		isAuth();
        $authRole = $this->session->userdata('roleuser');           
        $allow = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();      
        if($allow->data_pegawai !=  'ya'){
            redirect('dashboard');
        }
    }
    
    public function index(){ 
        $authRole = $this->session->userdata('roleuser');        
        $data['allow'] = $this->db->get_where('tbl_batasan_akses',['role'=>$authRole])->row();
        $data['subtitle'] = ucwords(str_replace('_', ' ', $authRole));                         
		$data['subtitle_small'] = 'Pegawai';
		$data['page'] = 'pegawai';
		$this->themes->Display('admin/pegawai/pegawai', $data);
    }
    
    public function ViewPegawai(){
        $roleuser = $this->session->userdata('roleuser');            
        $idbengkel = $this->session->userdata('idbengkel');                
        $this->db->where("(role_user<>'ADMIN' AND role_user<>'MANAGER')", NULL, FALSE);        
        $this->db->where('id_bengkel', $idbengkel);
        $data['data'] = $this->db->order_by('id','asc')
                                ->get('view_data_pegawai')
                                ->result_array();
        echo json_encode($data);
    }

    public function DeletePegawai(){
        $id = $this->input->post('id');
        $cekData = $this->db->get_where('tbl_user',['id'=>$id]);
        if($cekData->num_rows() > 0 ){
            $deleteData = $this->db->delete('tbl_user',['id'=>$id]);
            if($deleteData){
                $deletePetugas = $this->db->delete('tbl_pegawai',['id_user'=>$id]);
                if($deletePetugas){
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

    public function SavePegawai(){
        $idbengkel = $this->session->userdata('idbengkel');                    
        $nip = $this->input->post('nip');
        $nama = $this->input->post('nama');
        $role_user = $this->input->post('role_user');        
        $username = $this->input->post('username');                    
        $password = password_hash($this->input->post('password'),PASSWORD_DEFAULT);

        if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
                $updateUser = $this->db->where(['id' => $id])
                                    ->update('tbl_user',[
                                        'id_bengkel' => $idbengkel,
                                        'username' => $username,
                                        'role_user' => strtoupper($role_user),
                                    ]);
            if($updateUser){
                $updatePegawai = $this->db->where(['id_user'=>$id])
                                          ->update('tbl_pegawai',[ 
                                            'nama' => $nama,                                           
                                            'nip' => $nip,
                                          ]);
                if($updatePegawai){
                    $msg = array(
                        'msg'=>'Data Pegawai berhasil diubah',
                        'icon' => 'success',
                    );
                }else{
                    $msg = array(
                        'msg'=>'Gagal mengubah data',
                        'icon' => 'success',
                    );
                }
            }else{
                $msg = array(
                    'msg'=>'Gagal mengubah data',
                    'icon' => 'error',
                );
            }
        }else{
            $cekUser = $this->db->get_where('tbl_user',[
                    // 'id_bengkel' => $idbengkel,                
                    'username' => $username,
                ]);
            $cekPetugas = $this->db->get_where('tbl_pegawai',[
                    'nip' => $nip,
                ]);

            if($cekUser->num_rows() > 0){
                $msg = array(
                    'msg'=>'Username sudah digunakan',
                    'icon' => 'error',
                );
            }elseif($cekPetugas->num_rows() > 0){
                $msg = array(
                    'msg'=>'Pegawai sudah ada',
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
                    $getUser = $this->db->order_by('id','desc')->get('tbl_user')->row();
                    $savePetugas =$this->db->insert('tbl_pegawai',[
                        'id_user' => $getUser->id,
                        'nip' => $nip,
                        'nama' => $nama
                    ]);
                    if($savePetugas){
                        $msg = array(
                            'msg'=>'Data Pegawai berhasil ditambah',
                            'icon' => 'success',
                        );
                    }else{
                        $msg = array(
                            'msg'=>'Gagal menambah data Pegawai',
                            'icon' => 'error',
                        );
                    }
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

    public function getPegawai(){
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $cekData = $this->db->get('view_data_pegawai');
        // $cekData = $this->db->join('tbl_petugas','tbl_petugas.id_user = tbl_user.id')
        //                     ->get_where('tbl_user',['tbl_user.id'=>$id]);
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
<?php
if(!defined('BASEPATH')) exit('no file allowed');
function isAuth(){
    $Ci =& get_instance();
    $roleuser = $Ci->session->userdata('roleuser');    
    $userdata = $Ci->session->userdata('userdata');

    // if ($userdata === null || ($roleuser != "ADMIN" && count($userdata) <= 0)) {
    if ($userdata === null || count($userdata) <= 0) {
        redirect('/');
    }else{
    	if ($roleuser != "ADMIN" && $roleuser != "SUPERADMIN" && $roleuser != "KASIR" && $roleuser != "GUDANG"  && $roleuser != "KA_TEKNISI") {
    		redirect('/');
    	}
    }
}





<?php
if(!defined('BASEPATH')) exit('no file allowed');
class Themes{
    protected $_ci;
     function __construct(){
        $this->_ci =&get_instance();
    }

    function Display($theme, $data=null){
        $data['content']=$this->_ci->load->view($theme,$data,true);
        $data['nav_top']=$this->_ci->load->view('theme/section/nav_top.php',$data,true);
        $data['form_search_top']=$this->_ci->load->view('theme/section/form_search_top.php',$data,true);
        $data['nav_side_menu']=$this->_ci->load->view('theme/section/nav_side_menu.php',$data,true);
        $data['footer']=$this->_ci->load->view('theme/section/footer.php',$data,true);
        $data['settings_panel']=$this->_ci->load->view('theme/section/settings_panel.php',$data,true);
        $data['ajax']=$this->_ci->load->view('theme/section/ajax.php',$data,true);
        $data['modal']=$this->_ci->load->view('theme/section/modal.php',$data,true);
        $this->_ci->load->view('theme/theme-files-new.php', $data);
    }
}
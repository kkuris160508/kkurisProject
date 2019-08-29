<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오전 11:28
 */
class Form extends CI_Controller{
    public $tmpVar = 1;
    public function index($tmpVar1){
        $tmpVar1 = 2;
        $this->load->helper(array('form', 'url'));

        $this->load->library(array('form_validation','DebugVar')); //데이터 검증 라이브러리 호출

        if($this->form_validation->run() == FALSE){
            $this->load->view('myform');
        } else {
            $this->load->view('formsuccess');
        }

        $this->DebugVar->debug_var($tmpVar1);

    }
}

?>
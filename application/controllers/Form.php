<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오전 11:28
 */
class Form extends CI_Controller{

    public function index(){
        $this->load->helper(array('form', 'url','MY_array'));

        $this->load->library('form_validation'); //데이터 검증 라이브러리 호출

        if($this->form_validation->run() == FALSE){
            $this->load->view('myform');
        } else {
            $this->load->view('formsuccess');
        }

    }
}

?>
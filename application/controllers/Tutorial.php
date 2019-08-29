<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-22
 * Time: 오전 10:38
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Tutorial extends CI_Controller{
    public function members(){
        $this->load->model('Member_model'); //모델 로딩

        $data['members'] = $this->Member_model->GetMembers(); //모델에 GetMembers 메서드를 사용

        $this->load->view('Tutorial/members', $data); // 모델에서 가져온 값을 뷰에 전달달
    }
    public function getFnReturn(){
        $str = FALSE;
        if(is_php('5.3')){
            $str = quoted_printable_encode($str);
        }
        echo $str;
    }
}
?>
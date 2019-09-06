<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 2:21
 */

class Test extends CI_Controller{

    public function index(){

//        $this->Debug_->test('chris');
//        $result = $this->debug->debug_var($_SERVER); // 시발 debug 를 소문자로...ㅡㅡ

//        echo $result;
        $this->forms();
    }

    public function forms(){
        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)

        $this->load->library('form_validation'); //폼 검증 라이브러리 로드

        //폼 검증 필드 규칙 사전 정의
        $this->form_validation->set_rules('username', '아이디', 'required|min_length[5]|min_length[12]');
        $this->form_validation->set_rules('password', '비밀번호', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', '비밀번호 확인', 'required');
        $this->form_validation->set_rules('email', '이메일', 'required|valid_email');

        if($this->form_validation->run() == FALSE){
            $this->load->view('test/forms_v');
        } else {
            $this->load->view('test/form_success_v');
        }
    }

}
?>

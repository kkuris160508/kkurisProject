<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-09-05
 * Time: 오후 2:29
 */
class Auth extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_m');
        $this->load->helper('form');
    }

    public function index(){
        $this->login();
    }

    public function login(){
//        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
        $this->load->library('form_validation');
        $this->load->helper('alert');

        $this->form_validation -> set_rules('account_id', '아이디', 'required|alpha_numeric');
        $this->form_validation -> set_rules('PW', '비밀번호',  'required');

        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

        if($this->form_validation -> run() == TRUE){
            $auth_data = array(
                'account_id' => $this->input->post('account_id', TRUE),
                'PW' => $this->input->post('PW', TRUE)
            );

            $result = $this->Auth_m->login($auth_data);

            if($result){
                $newdata = array( //데이터 검증 부 에서 아이디 비밀번호가 맞았을 때 아이디, 이메일, 로그인 여부를 배열로 만듬
                  'account_id'=>$result->account_id,
                  'email'=>$result->email,
                  'logged_in'=>TRUE
                );

                $this->session->set_userdata($newdata); //세션 생성
                alert('로그인 되었습니다.', '/Main/lists');
                exit;
            } else {

                alert('아이디나 비밀번호를 확인해 주세요.', '/Main/lists');
                exit;
            }

        } else {
            $this->load->view('Auth/header_login_v');
            $this->load->view('Auth/login_v');
        }
    }


    public function logout(){
        $this->load->helper('alert');
        $this->session->sess_destroy();

        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        alert('로그아웃 되었습니다.', '/Main/lists');
        exit;


    }
}
?>
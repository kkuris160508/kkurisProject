<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 4:05
 */
class Join extends CI_Controller{
    public function joinForm(){
        $data = array(
            'title' => 'JoinPage',
            'contents' => array(
                '0' => 'ID',
                '1' => 'Password',
                '2' => 'Email'
            ),
            'btnName' => '로그인'
        );
        $this->load->view('Join/join_view_header',$data);
        $this->load->view('Join/join_view_contents',$data['contents']);
        $this->load->view('Join/join_view_footer');

//        $result = $this->debug->debug_var($data);
//        echo $result;
    }

    public function joinOK($id, $email, $pw = 1234){
//        echo $id;
//        echo $email;
        $accountInfo = array(
            'ID' => $id,
            'PW' => $pw,
            'EMAIL' => $email
        );

        $this->load->model('Join_model');
        $data['accountTB'] = $this->Join_model->getAccount($id, $email);
        $this->load->view('Join/join_check_view',$data);
        //전달 받은 id, pw, email 을 DB 에 ID, pw, email 을 select 한 리턴 값과 비교 하여 맞으면 OK page, 아니면 오류? 다시? 페이지로

//        $tmpVar = $data['accountTB'][0]->ID;
//        $result = $this->debug->debug_var($data);
//        echo $result;

        if(!$data['accountTB']) {
            $this->load->model('Join_model');
            $this->Join_model->insAccount($id, $email);
            $this->load->view('Join/join_ok_view',$accountInfo);
        } else {
            echo 'hello '.$id;
        }
    }
}

?>

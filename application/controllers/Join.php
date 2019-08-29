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
                'ID' => '',
                'Password' => '',
                'Email' => ''
            ),
            'btnName' => '회원가입'
        );
        $this->load->view('Join/join_view_header',$data['title']);
        $this->load->view('Join/join_view_contents',$data['contents']);
        $this->load->view('Join/join_view_footer');

//        $result = $this->debug->debug_var($data);
//        echo $result;
    }
}

?>
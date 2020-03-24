<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_admin_member_members_excel extends CI_Controller
{

    private $CI;

    function __construct()
    {
        $this->CI = & get_instance();
        Events::register('before', array($this, 'alert'));
//        Events::register('after', array($this, 'alert2'));
    }

    public function alert() {

        $result = array();

        echo '<script>alert("이벤트 실행");</script>';

        $result['result'] = 'alert 함수를 통해 담겨진 내용입니다';

        return $result;
    }

//    public function alert2() {
//
//        $result = array();
//
//        echo '<script>alert("이벤트 실행2");</script>';
//
//        $result['result'] = 'alert2 함수를 통해 담겨진 내용입니다';
//
//        return $result;
//    }
}
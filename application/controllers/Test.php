<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 2:21
 */

class Test extends CI_Controller{

    public function index(){
        $this->load->library('Debug'); //데이터 검증 라이브러리 호출

//        $this->Debug_->test('chris');
        $result = $this->debug->debug_var(); // 시발 debug 를 소문자로...ㅡㅡ

        echo $result;
    }


}
?>

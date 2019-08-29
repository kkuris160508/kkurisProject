<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 2:21
 */

class Test1 extends CI_Controller{
    public function index(){
        $this->load->library('DebugVar'); //데이터 검증 라이브러리 호출

        $this->Debugvar->test('chris');
    }
}
?>
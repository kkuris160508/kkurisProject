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
        $result = $this->debug->debug_var($_SERVER); // 시발 debug 를 소문자로...ㅡㅡ

        echo $result;
    }

    function test(){
        printf("URI Segment 1 : %s <br/>", $this->uri->segment(1));
        printf("URI Segment 2 : %s <br/>", $this->uri->segment(2));
        printf("URI Segment 3 : %s <br/>", $this->uri->segment(3));
        printf("URI Segment 4 : %s <br/>", $this->uri->segment(4));
        printf("URI Segment 5 : %s <br/>", $this->uri->segment(5,'End'));
    }
}
?>

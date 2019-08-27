<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-22
 * Time: 오전 10:38
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Tutorial extends CI_Controller{
    public function index(){
        $data = array(
            'title'=>'Tutorial::index',
            'content'=>'Hello Index'
        );
        $this->load->view('header', $data);
        $this->load->view('content', $data);
        $this->load->view('footer');
    }
    public function second(){
        $data = array(
            'title'=>'Tutorial::second',
            'content'=>'Hello Second'
        );
        $this->load->view('header', $data);
        $this->load->view('content', $data);
        $this->load->view('footer');

    }
}
?>
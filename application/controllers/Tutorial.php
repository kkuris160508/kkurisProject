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
        $this->load->view('index');
    }
    public function second(){
        $this->load->view('second');
    }
}
?>
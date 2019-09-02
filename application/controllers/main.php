<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-09-02
 * Time: 오후 2:32
 */

class Main extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('todo_m');
        $this->load->helper(array('url','date'));
    }

    function index(){
        $this->lists();
    }

    function lists(){
        $data['list'] = $this->todo_m->get_list();
        $this->load->view('todo/list_v', $data);
    }
}
?>
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
        $this->load->helper(array('url','date', 'form'));
    }

    function index(){
        $this->lists();
    }

    function lists(){
        $data['list'] = $this->todo_m->get_list();
        $this->load->view('todo/header_v');
        $this->load->view('todo/list_contents_v', $data);
        $this->load->view('todo/footer_v');
    }

    function view(){
        $id = $this->uri->segment(3); //todo 번호에 해당하는 데이터 가져오기
        $data['views'] = $this->todo_m->get_views($id);
        $this->load->view('todo/header_v');
        $this->load->view('todo/view_contents_v', $data);
        $this->load->view('todo/footer_v');
    }

    // write controller 추가
    function write(){ //쓰기 함수 $_POST 의 유무에 따라 if-else 분기 처리. post 전송이 없을 경우 else 실행되어 입력 폼이 출력.
        if($_POST){ //쓰기 화면에서 내용을 채우고 작성 버튼을 클릭하면 if 구문 실행. $this->input->post('content') 는 $_POST['content'] 와 동일하게 post 변수를 받음. post 함수 두번째 파라미터 에 TRUE 시 XSS 공격을 막을수 있게 함.

            $content = $this->input->post('content', TRUE);
            $created_on = $this->input->post('created_on', TRUE);
            $due_date = $this->input->post('due_date', TRUE);

            $this->todo_m->insert_todo($content, $created_on, $due_date); //전송받은 데이터를 파라미터로 todo_m 에 insert_todo 함수 실행

            redirect('/Main/lists');

            exit;
        } else {
            $this->load->view('todo/header_v');
            $this->load->view('todo/write_contents_v');
            $this->load->view('todo/footer_v');
//            $this->load->view('todo/write_contents_v');
        }
    }
}
?>
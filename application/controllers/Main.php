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
//        $this->load->library('pagination'); // 페이지 네이션 설정
//        $config['base_url'] = 'ci_board/page'; //페이징 주소
//        $config['total_rows'] = $this->todo_m->get_list($this->uri->segment(3), 'count'); //게시물 전체 개수
//
//        $config['per_page'] = 5; // 한 페이지에 표시할 게시물 수
//        $config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
//
//        $this->pagination->initialize($config);
//        $data['pagination'] = $this->pagination->create_links();
//
//        $page = $this->uri->segment(5,1);
//
//        if($page > 1){
//            $start = (($page / $config['per_page'])) * $config['per_page'];
//        } else {
//            $start = ($page - 1) * $config['per_page'];
//        }
//
//        $limit = $config['per_page'];
//
//        $data['list'] = $this->todo_m->get_list($this->uri->segment(3), '', $start, $limit);
//        $this->load->view('')

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
        $this->load->library('form_validation');

        $this->form_validation->set_rules('subject','제목','required');
        $this->form_validation->set_rules('content','내용','required');
        $this->form_validation->set_rules('created_on','시작일','regex_match[/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/]');
        $this->form_validation->set_rules('due_date','종료일','regex_match[/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/]');
//        /^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/
        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        if($this->form_validation->run() == TRUE){
            $this->load->helper('alert');

//            $uri_array = $this->segment_explode($this->uri->uri_string());

            $subject = $this->input->post('subject', TRUE);
            $content = $this->input->post('content', TRUE);
            $created_on = $this->input->post('created_on', TRUE);
            $due_date = $this->input->post('due_date', TRUE);

            $this->todo_m->insert_todo($subject, $content, $created_on, $due_date, 2); //전송받은 데이터를 파라미터로 todo_m 에 insert_todo 함수 실행

//            if (in_array('page', $uri_array)) {
//                $pages = urldecode($this -> url_explode($uri_array, 'page'));
//            } else {
//                $pages = 1;
//            }
//
//            if (!$this -> input -> post('subject', TRUE) AND !$this -> input -> post('contents', TRUE)) {
//                // 글 내용이 없을 경우, 프로그램 단에서 한 번 더 체크
//                alert('비정상적인 접근입니다.', '/Main/lists/' . $this -> uri -> segment(3) . '/page/' . $pages);
//                exit ;
//            }
//
//            $write_data = array(
//                'subject' => $this -> input -> post('subject', TRUE),
//                'contents' => $this -> input -> post('contents', TRUE),
//                'table' => $this -> uri -> segment(3)
//            );
//
////            $result = $this -> board_m -> insert_board($write_data);
////
//            if ($result) {
//                alert("입력되었습니다.",'/Main/lists/'.$this->uri->segment(3).'/page/'.$pages);
//                exit;
//            } else {
//                alert("다시 입력해주세요.",'/Main/lists/'.$this->uri->segment(3).'/page/'.$pages);
//                exit;
//            }



            redirect('/Main/lists');

            exit;

        } else {
            $this->load->view('todo/header_v');
            $this->load->view('todo/write_contents_v');
            $this->load->view('todo/footer_v');
        }
//        if($_POST){ //쓰기 화면에서 내용을 채우고 작성 버튼을 클릭하면 if 구문 실행. $this->input->post('content') 는 $_POST['content'] 와 동일하게 post 변수를 받음. post 함수 두번째 파라미터 에 TRUE 시 XSS 공격을 막을수 있게 함.
//
//            $subject = $this->input->post('subject', TRUE);
//            $content = $this->input->post('content', TRUE);
//            $created_on = $this->input->post('created_on', TRUE);
//            $due_date = $this->input->post('due_date', TRUE);
//
//            $this->todo_m->insert_todo($subject, $content, $created_on, $due_date, 2); //전송받은 데이터를 파라미터로 todo_m 에 insert_todo 함수 실행
//
//            redirect('/Main/lists');
//
//            exit;
//        } else {
//            $this->load->view('todo/header_v');
//            $this->load->view('todo/write_contents_v');
//            $this->load->view('todo/footer_v');
//        }
    }
//    function checkDateFormat($date) {
//        if (preg_match("/[0-31]{2}\/[0-12]{2}\/[0-9]{4}/", $date)) {
//            if(checkdate(substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4)))
//                return true;
//            else
//                return false;
//        } else {
//            return false;
//        }
//    }


    function delete(){
        $id = $this->uri->segment(3);
        $this->todo_m->delete_todo($id);

        redirect('/Main/lists');
    }

    function login(){
        if($_POST){
            $id = $this->input->post('account_id');
            $pw = $this->input->post('Password');
            $email = $this->input->post('EMAIL');

            $this->todo_m->insert_account_todo($id, $pw, $email);

            redirect('/Main/lists');

            exit;

        } else {
            $this->load->view('todo/login_header_v');
            $this->load->view('todo/login_contents_v');
            $this->load->view('todo/footer_v');
        }
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
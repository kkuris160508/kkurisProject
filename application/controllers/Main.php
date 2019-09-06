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
        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)

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
        $this->form_validation->set_rules('created_on', '시작일', 'callback_date_valid');
        $this->form_validation->set_rules('due_date', '종료일', 'callback_date_valid');
//        $this->form_validation->set_rules('created_on', 'Date of birth', 'required|regex_match_date[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]');
//        $this->form_validation->set_rules('due_date', 'Date of birth', 'required|regex_match_date[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]');

        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        if($this->form_validation->run() == TRUE){

            $subject = $this->input->post('subject', TRUE);
            $content = $this->input->post('content', TRUE);
            $created_on = $this->input->post('created_on', TRUE);
            $due_date = $this->input->post('due_date', TRUE);

            $result = $this->debug->debug_var($created_on);
            echo 'before : '.$result;

//            $startDate = date("Y-d-m",strtotime($created_on));
//            $endDate = date("Y-d-m,",strtotime($due_date));

            $this->todo_m->insert_todo($subject, $content, $created_on, $due_date, 2); //전송받은 데이터를 파라미터로 todo_m 에 insert_todo 함수 실행

//            $result = $this->debug->debug_var($startDate);
//            echo 'after :' .$result;

//            redirect('/Main/lists');
//            $this->load->view('test/form_success_v');

            exit;

        } else {
            $this->load->view('todo/header_v');
            $this->load->view('todo/write_contents_v');
            $this->load->view('todo/footer_v');
        }

    }

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

    public function date_valid($date) //mm-dd-yyyy
    {
        $result = $this->debug->debug_var($date);
        echo 'date_valid() before :' .$result;

        $fixdate = date('m-d-Y',strtotime($date));

        $result = $this->debug->debug_var($date);
        echo 'date_valid() after :' .$result;

        $parts = explode("-", $fixdate);
        if (count($parts) == 3) {
            if (checkdate($parts[0], $parts[1], $parts[2]))
            {
                return TRUE;
            }
        }
        $this->form_validation->set_message('date_valid', 'The Date field must be mm/dd/yyyy');
        return false;
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
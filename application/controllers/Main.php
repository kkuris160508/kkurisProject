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
        $this->load->helper(array('url','date', 'form','alert'));
    }

    function index(){
        $this->lists();
    }

    function lists(){
        $param = array(
            'id'=>'목록'
        );
//        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)

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
        $this->load->view('todo/header_v', $param);
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
        $param = array(
            'id'=>'작성'
        );
//        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
        $this->load->library('form_validation');

        $this->form_validation->set_rules('subject','제목','required');
        $this->form_validation->set_rules('content','내용','required');
//        $this->form_validation->set_rules('created_on', '시작일', 'callback_date_valid');
//        $this->form_validation->set_rules('due_date', '종료일', 'callback_date_valid');

        $this->form_validation->set_rules('created_on', '시작일', "callback_dob_check");
        $this->form_validation->set_rules('due_date', '종료일', "callback_dob_check");

        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';



        if ( @$this -> session -> userdata('logged_in') == TRUE) {

            $writer = $this -> session -> userdata('account_id');
            $result = $this->todo_m->getAccountInfoNo($writer);

//            $result2 = $this->debug->debug_var($writer); // 시발 debug 를 소문자로...ㅡㅡ
//            echo $result2;
//            $result3 = $this->debug->debug_var($result); // 시발 debug 를 소문자로...ㅡㅡ
//            echo $result3[0]->no;

            if($this->form_validation->run() == TRUE){

                $subject = $this->input->post('subject', TRUE);
                $content = $this->input->post('content', TRUE);
                $created_on = $this->input->post('created_on', TRUE);
                $due_date = $this->input->post('due_date', TRUE);

                $this->debug->debug_var($created_on);

                $this->todo_m->insert_todo($subject, $content, $created_on, $due_date, $result[0]->no); //전송받은 데이터를 파라미터로 todo_m 에 insert_todo 함수 실행


                redirect('/Main/lists');

            } else {
                $this->load->view('todo/header_v', $param);
                $this->load->view('todo/write_contents_v');
                $this->load->view('todo/footer_v');
            }
        } else {
            $this->load->helper('alert');
            alert('글을 작성하시려면 로그인 하십시오.', '/Auth/login');
        }
        
    }

    function delete(){
        $id = $this->uri->segment(3);
        $this->todo_m->delete_todo($id);

        redirect('/Main/lists');
    }

    function join(){
//        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)

        if($_POST){
            $id = $this->input->post('account_id');
            $pw = $this->input->post('Password');
            $email = $this->input->post('EMAIL');

            $result = $this->todo_m->getAccountInfo($id);

            if($result){
                $this->todo_m->insert_account_todo($id, $pw, $email);
                alert('가입이 완료 되었습니다. 로그인 하여 주십시오','/Main/lists');
//                redirect('/Main/lists');
            } else {
                alert('가입되지 않았습니다 다시 가입하여 주십시오','/Main/join');
            }
            exit;


        } else {
            $this->load->view('todo/login_header_v');
            $this->load->view('todo/login_contents_v');
            $this->load->view('todo/footer_v');
        }
    }

//    public function date_valid($date) //mm-dd-yyyy
//    {
//
////        $pattern = '/(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]/';
//            $pattern = '[/(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}/]';
//
//
//            $result = $this->debug->debug_var($date);
//            echo 'date_valid() before :' .$result;
//
//            $fixdate = date('m-d-Y',strtotime($date));
//
////        $result = $this->debug->debug_var($date);
////        echo 'date_valid() after :' .$result;
//
//            $parts = explode("-", $fixdate);
//            if (count($parts) == 3) {
//                if (checkdate($parts[0], $parts[1], $parts[2]))
//                {
//                    return TRUE;
//                }
//
//            } else if(preg_match($pattern,$date) == 0){
//                $this->form_validation->set_message('date_valid',  '<p style="color: #FF0000;"> 날짜 형식만 입력 가능합니다. <br> ex) YYYY-MM-DD');
//                exit;
//            }
//
//    }

    public function dob_check($str){
        $this->load->library('form_validation');

        if (!DateTime::createFromFormat('Y-m-d', $str)) { //yes it's YYYY-MM-DD
            $this->form_validation->set_message('dob_check', '<p style="color: #FF0000;"> 날짜 형식만 입력 가능합니다. <br> ex) YYYY-MM-DD');
            return FALSE;
        } else {
            return TRUE;
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
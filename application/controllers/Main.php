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
        $this->load->library(array('pagination','form_validation')); // 페이지 네이션 설정
        $this->load->model('todo_m');
        $this->load->helper(array('url','date', 'form','alert','date','cookie'));
    }

    function index(){
        $this->lists();
    }

    function sendEmail(){
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'entz160508@gmail.com',
            'smtp_pass' => '6034265nro',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );

        $this->load->library('email', $config);

        $this->email->from('entz160508@gmail.com','entz');
        $this->email->to('entz0630@gmail.com');
        $this->email->cc('entz0630@gmail.com');
        $this->email->bcc('ntiq1@naver.com');

        $this->email->subject('email test');
        $this->email->message('test email');

        $this->email->set_newline("\r\n");

        if ( ! $this->email->send())
        {
            echo 'error';
        } else {
            echo 'success';

        }
        echo $this->email->print_debugger();
//        $this->email->send(); //이메일 발송

        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
    }

    function lists(){
//        $this->load->library('pagination'); // 페이지 네이션 설정
        $tmpIP = $this->input->ip_address();

        if($tmpIP == '211.52.72.56' || $tmpIP == '106.245.165.216' || $tmpIP == '221.155.202.250'){

            if($tmpIP == '211.52.72.56'){
                $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
            }


//            $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
//
//            $result2 = $this->debug->debug_var($_SERVER); // debug 를 소문자로...ㅡㅡ
//            echo $result2;

            $param = array(
                'id'=>'목록'
            );


            $config['base_url'] = 'http://34.80.199.17/Main/lists'; //페이징 주소

            $config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
            $config['uri_segment'] = 3; //페이지 번호가 위치한 세그먼트

            $config['total_rows'] = $this->todo_m->get_list('count');

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();

            $page = $this->uri->segment(3,1);

//            $result2 = $this->debug->debug_var($data); // debug 를 소문자로...ㅡㅡ
//            echo $result2;

            if($page > 1){
                $start = (($page / $config['per_page'])) * $config['per_page'];
            } else {
                $start = ($page - 1) * $config['per_page'];
            }

            $limit = $config['per_page'];

            $data['list'] = $this->todo_m->get_list('',$start, $limit);

            $this->load->view('header_v', $param);
            $this->load->view('todo/list_contents_v', $data);
            $this->load->view('todo/footer_v');

            $tmpIDX = $this->input->post('id');

//            $this->debug->debug_var($tmpIDX); // 시발 debug 를 소문자로...ㅡㅡ

        } else {
            echo "접속 불가";
        }

    }

    function doUpload(){

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('upload_success', $data);
        }
    }

    function view(){
        $param = array(
            'id'=>'보기'
        );

        if ( @$this -> session -> userdata('logged_in') == TRUE) {

            $id = $this->uri->segment(3); //todo 번호에 해당하는 데이터 가져오기
            $data['views'] = $this->todo_m->get_views($id);
            $data['accountInfo'] = $this->session->userdata('account_id');

//            echo $this->session->userdata('account_id');
            $adminPermit = $this -> session -> userdata('account_id');
            $data['permit'] = $this->todo_m->getAdminPermit($adminPermit);


            $result2 = $this->debug->debug_var($data); // 시발 debug 를 소문자로...ㅡㅡ
            echo $result2;

            $this->increaseReadCnt($id);

            $this->load->view('header_v', $param);
            $this->load->view('todo/view_contents_v', $data);
            $this->load->view('todo/footer_v');

//            $postID = $this->input->post('accountID', TRUE);

            $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)

        } else {
            $this->load->helper('alert');
            alert('글을 읽으시려면 로그인 하십시오.', '/Auth/login');

//            $this->load->view('header_v', $param);
//            $this->load->view('todo/view_contents_v', $data);
//            $this->load->view('todo/footer_v');
        }
    }

    function uploadTest(){

        $fileName = $this->input->post('file_name', TRUE); // DB에 파일 이름 저장
        echo $fileName;

        $this->todo_m->insFileData($fileName);

        alert(" DB저장 완료", '/Main/imgList');

//        if ($result == 1){
//            echo 'DB저장완료';
//            alert('DB저장 완료', '/uploads/'.$fileName);

//        } else {
//            echo '저장안됨';
//        }
//        $this->debug->debug_var($fileName);
    }

    function imgList(){

        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
        //업로드 된 파일이름 리스트를 모델에서 받아옴
        $result['list'] = $this->todo_m->getFileName();

//        $this->debug->debug_var($result);

        $this->load->view('view_file_v',$result);


    }
    function reply($id){                                         //잠정 스탑..
//        $this->load->library('form_validation');
//        $this->load->helper('alert');
        $param = array(
            'id'=>'댓글'
        );
//        echo $id;


        if ( @$this -> session -> userdata('logged_in') == TRUE) {
//            echo 'session is on';
////            $id = $this->uri->segment(3);
//
            $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
//
            $writer = $this -> session -> userdata('account_id');
            $writerNo = $this->todo_m->getAccountInfoNo($writer);
//
            $this->debug->debug_var($writer);
            $this->debug->debug_var($writerNo);

            $data['views'] = $this->todo_m->get_views($id);
//
            $this->debug->debug_var($data['views']);

////            echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
//
            $this->load->view('header_v', $param);
            $this->load->view('reply_contents_v', $data);
            $this->load->view('todo/footer_v');
//
            $replyContents = $this->input->post('replyContent', TRUE);
            $postID = $this->input->post('id', TRUE);
//
            $this->debug->debug_var($replyContents);
            $this->debug->debug_var($postID);

//            $this->todo_m->insReply($replyContents, $postID, $writerNo[0]->no);
//
//            alert('댓글이 등록 되었습니다.',"/Main/view/'{$postID}'");
//
////            if($this->form_validation->run() == TRUE){
////
////            alert('댓글이 등록 되었습니다.',"/Main/view/'{$postID}'");
////            } else {
////
////                $this->load->view('header_v', $param);
////                $this->load->view('todo/view_contents_v', $data);
////                $this->load->view('todo/footer_v');
////            }
        }
    }

    // write controller 추가
    function write(){ //쓰기 함수 $_POST 의 유무에 따라 if-else 분기 처리. post 전송이 없을 경우 else 실행되어 입력 폼이 출력.
        $param = array(
            'id'=>'작성'
        );
//        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
//        $this->load->library('form_validation');

        $this->form_validation->set_rules('subject','제목','required');
        $this->form_validation->set_rules('content','내용','required');
//        $this->form_validation->set_rules('created_on', '시작일', 'callback_date_valid');
//        $this->form_validation->set_rules('due_date', '종료일', 'callback_date_valid');

        $this->form_validation->set_rules('created_on', '시작일', "required");
        $this->form_validation->set_rules('due_date', '종료일', "required");

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
                $status = $this->input->post('statusSelect', TRUE);

//                $this->debug->debug_var($created_on);

                $this->todo_m->insert_todo($subject, $content, $created_on, $due_date, $result[0]->no, $status); //전송받은 데이터를 파라미터로 todo_m 에 insert_todo 함수 실행


                alert('작성이 완료 되었습니다.', '/Main/lists');
//                redirect('/Main/lists');

            } else {
                $this->load->view('header_v', $param);
                $this->load->view('todo/write_contents_v');
                $this->load->view('todo/footer_v');
            }
        } else {
            $this->load->helper('alert');
            alert('글을 작성하시려면 로그인 하십시오.', '/Auth/login');
        }
        
    }

    function edit(){
        $this->load->helper('alert');
        $param = array(
            'id'=>'수정'
        );

        if ( @$this -> session -> userdata('logged_in') == TRUE) {

            $id = $this->uri->segment(3);

            $data['views'] = $this->todo_m->get_views($id);

            $this->load->view('header_v', $param);
            $this->load->view('todo/edit_contents_v', $data);
            $this->load->view('todo/footer_v');

            $subject = $this->input->post('subject', TRUE);
            $content = $this->input->post('content', TRUE);
            $postID = $this->input->post('id', TRUE);
            $fixStatus = $this->input->post('statusSelect', TRUE);
            $type = '';

            $tmpRes = $this->todo_m->get_views($postID);
            $tmpSubject = $tmpRes->subject;
            $tmpContent = $tmpRes->content;

            if(!$this->input->post('content',TRUE) && !$this->input->post('subject', TRUE)){
                $type = 0;
                $data['edit'] = $this->todo_m->set_edit_views($postID, $tmpSubject, $tmpContent, $fixStatus, $type);

            } else if ($this->input->post('content',TRUE) && !$this->input->post('subject', TRUE)){
                $type = 2;
                $data['edit'] = $this->todo_m->set_edit_views($postID, $tmpSubject, $content, $fixStatus, $type);

            } else if (!$this->input->post('content',TRUE) && $this->input->post('subject', TRUE)) {
                $type = 1;
                $data['edit'] = $this->todo_m->set_edit_views($postID, $subject, $tmpContent, $fixStatus, $type);
            } else {
                $type = 4;
                $data['edit'] = $this->todo_m->set_edit_views($postID, $subject, $content, $fixStatus, $type);
            }

            if($data['edit'] == 1){
                alert('수정되었습니다.','/Main/view/'.$postID);
            }
        }
    }

    function delete(){

        if ( @$this -> session -> userdata('logged_in') == TRUE) {
            $id = $this->uri->segment(3);
            $accountNo = $this->uri->segment(4);
            $accountID = $this->uri->segment(5);

            $writer = $this -> session -> userdata('account_id');

            if($accountID == $writer){
               $this->todo_m->delete_todo($id, $accountNo);
                alert('삭제 되었습니다.', '/Main/lists');
            } else {
                alert('삭제 할 권한이 없습니다.','/Main/lists');
            }


        } else {

            $this->load->helper('alert');
            alert('글을 삭제하시려면 로그인 하십시오.', '/Auth/login');
        }

    }

    function join(){
        form_open('/Auth/login');
//        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)
        $this->load->library('form_validation');
//        $this->load->helper('password');

        $this->form_validation->set_rules('accountID','아이디','required|alpha_numeric');
        $this->form_validation->set_rules('password','비밀번호','required|min_length[6]');
        $this->form_validation->set_rules('email','이메일','required|valid_email');

        echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

        if($this->form_validation->run() == TRUE){

            $id = $this->input->post('accountID', TRUE);
            $hash = password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT);
            $email = $this->input->post('email', TRUE);

//            $hashPW = password_hash($pw,1);


            $result = $this->todo_m->getAccountInfo($id);

            if($result){
                $this->todo_m->insert_account_todo($id, $hash, $email);

//                echo '<form action="http://34.80.199.17/Auth/autoLogin" method="post">';
/*                    echo '<input type="hidden" name="id" value="<?php echo $id?>">';*/
/*                    echo '<input type="hidden" name="pw" value="<?php echo $pw?>">';*/
/*                    echo '<input type="hidden" name="email" value="<?php echo $email?>">';*/
//                echo '</form>';

//                $cookie = array(
//                    'name' => 'user_id',
//                    'value' => $id,
//                    'expire' => '3600',
//                    'prefix' => 'myprefix_'
//                );

                $cookieArray1 = array(
                    'name' => 'user_id',
                    'value' => $id,
                    'expire' => '3600',
                    'prefix' => 'myprefix_'
                );
                $cookieArray2 = array(
                    'name' => 'user_pw',
                    'value' => $hash,
                    'expire' => '3600',
                    'prefix' => 'myprefix_'
                );

                $this->input->set_cookie($cookieArray1);
                $this->input->set_cookie($cookieArray2);
                $this->input->cookie(array('myprefix_user_id','myprefix_user_pw'));
//                set_cookie('user_id', $this->input->post('account_id'), 3600);


                alert('가입이 완료 되었습니다. 로그인 하여 주십시오','/Auth/autoLogin');

//                redirect('/Main/lists');
            } else {
                alert('가입되지 않았습니다 다시 가입하여 주십시오','/Main/join');
//                alert('가입되지 않았습니다 다시 가입하여 주십시오');
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

    function dob_check($str){
        $this->load->library('form_validation');

        if (!DateTime::createFromFormat('Y-m-d', $str)) { //yes it's YYYY-MM-DD
            $this->form_validation->set_message('dob_check', '<p style="color: #FF0000;"> 날짜 형식만 입력 가능합니다. <br> ex) YYYY-MM-DD');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function increaseReadCnt($id){

        $this->todo_m->updateIncreaseReadCount($id);
    }

    function searchText(){
        $param = array(
            'id'=>'보기'
        );

//        $this->output->enable_profiler(TRUE); //프로파일러 output (일종의 디버그 바)

        $this->load->library('form_validation');

        $this->form_validation->set_rules('searchTxt','텍스트','required');
//        if($this->form_validation->run() == TRUE || $this->uri->segment(3,1) >= 1){
        if($this->form_validation->run() == TRUE){

            $txt = $this->input->post('searchTxt', TRUE);
            $cate = $this->input->post('selectCategory', TRUE);
//
//            $text = $txt;
//            $category = $cate;

//            if($txt != '' AND $cate != ''){
//                $tmpTxt = $txt;
//                $tmpCate = $cate;
//                echo $tmpTxt;
//            }

//            $this->load->library('pagination'); // 페이지 네이션 설정
//
//            $config['base_url'] = "http://34.80.199.17/Main/searchText/"; //페이징 주소
//
//            $config['per_page'] = 5; // 한 페이지에 표시할 게시물 수
//            $config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
//
////        function getSearchItems($type = '', $txt='', $cate='', $offset='', $limit='')
//            $config['total_rows'] = $this->todo_m->getSearchItems('count', $txt, $cate);
//            $result['cnt'] = $config['total_rows'];
//
//            $this->pagination->initialize($config);
//            $result['pagination'] = $this->pagination->create_links();
//
//            $result2 = $this->debug->debug_var($result); // debug 를 소문자로...ㅡㅡ
//            echo $result2;
//
//            $page = $this->uri->segment(5,1);
//            echo $page."page<br>";
//
//            if($page > 1){
//                $start = (($page / $config['per_page'])) * $config['per_page'];
//                echo $start."start page>1<br>";
//            } else {
//                $start = ($page - 1) * $config['per_page'];
//                echo $start."start else <br>";
//            }
//
//            $limit = $config['per_page'];
//
////            $result['lists'] = $this->todo_m->getSearchItems('', $txt, $cate, $start, $limit);
            $result['lists'] = $this->todo_m->getSearchItems('', $txt, $cate);
            $result['cnt'] = $this->todo_m->getSearchItems('count', $txt, $cate);

            $this->load->view('header_v', $param);
            $this->load->view('todo/search_list_contents_v', $result);
            $this->load->view('todo/footer_v');

        } else {
            alert('글이 존재하지 않습니다.', '/Main/lists');
        }


    }

    function dateTime(){
        $gmt = local_to_gmt(time());
        echo $gmt.'<br>';

        $timezone = 'UP8'; // (UTC +8:00) Australian Western Standard Time, Beijing Time
        $daylight_saving = TRUE;
        echo $gmtTimezone = gmt_to_local($gmt, $timezone, $daylight_saving).'<br>';

        echo $humanTime = unix_to_human($gmtTimezone).'<br>';

        $now = time();
        echo $now;
    }

    function test(){
        printf("URI Segment 1 : %s <br/>", $this->uri->segment(1));
        printf("URI Segment 2 : %s <br/>", $this->uri->segment(2));
        printf("URI Segment 3 : %s <br/>", $this->uri->segment(3));
        printf("URI Segment 4 : %s <br/>", $this->uri->segment(4));
        printf("URI Segment 5 : %s <br/>", $this->uri->segment(5,'End'));
    }

    function test2(){
        $prefs = array(
            'show_next_prev'  => TRUE,
            'next_prev_url'   => 'http://34.80.199.17/Main/test2/'
        );

        $this->load->library('calendar', $prefs);

        echo $this->calendar->generate($this->uri->segment(2), $this->uri->segment(3));

    }

//    function test3(){
////        $this->load->helper('password');
//
//
//        $tmpString = 'auddhkd3';
//
////        password_hash();
////        $tmpHash = password_get_info($tmpString);
//        $tmpHash = password_hash($tmpString,1);
//
//        echo $tmpHash;
////        $tmpHash_1 = '$2y$10$BerPkp2prYfJAWscLhFml.3jvDluLT0752UwwnBCejHyL0fBxeu6u';
//
////        if(password_verify($tmpString, $tmpHash_1)){
////            echo 'password is vaild';
////        } else {
////            echo 'password is wrong';
////        }
//
//
//        $result3 = $this->debug->debug_var($tmpHash); // 시발 debug 를 소문자로...ㅡㅡ
//        echo $result3[0]->no;
//
//
//
//    }

    function lotto(){

        $lottoVal = array();
        $num = 6;

        $lottoVal[] = rand(1, 45);
        while( count($lottoVal) < $num ) {
            $tmp_no = rand(1, 45);
            if( array_search($tmp_no, $lottoVal)===false ) {
                $lottoVal[]  = $tmp_no;
            }
        }

        for($i = 0; $i < 6; $i++){
            sort($lottoVal);
//            echo $lottoVal[$i]."<br>";
        }

        $param = array(
            'id' => '번호'
        );

        $data['views'] = $this->todo_m->getFixLottoNum();
        $data['lottoVal'] = $lottoVal;




        $difArr_1 = array();
        $difArr_2 = array();
        $newDifArr_2 = array();

        $difArr_1 = $data['lottoVal'];
//        $difArr_2 = $data['views'];

        foreach ($data['views'] as $difArr_2) {
            $newDifArr_2[0] = $difArr_2 -> num_1;
            $newDifArr_2[1] = $difArr_2 -> num_2;
            $newDifArr_2[2] = $difArr_2 -> num_3;
            $newDifArr_2[3] = $difArr_2 -> num_4;
            $newDifArr_2[4] = $difArr_2 -> num_5;
            $newDifArr_2[5] = $difArr_2 -> num_6;
        }

//        $difArray = array_diff($difArr_1, $difArr_2);

//        $result = $this->debug->debug_var($newDifArr_2);
//        echo $result;
//        $result1 = $this->debug->debug_var($difArr_1);
//        echo $result1;


//        for($k = 0; $k < 6; $k++){
//            $newDifArr_2[$k] = $difArr_2 -> num_;
//            echo $newDifArr_2[$k];
//        }

        // getFixLottoNum 의 값과 내가 뽑은 값 비교.
        // 몇개가 맞았는지
           // 2중 for 문?
//        for($i = 0; $i < 6; $i++){
//            for($j = 0; $j < 6; $j++){
//                if($difArr_1[$i] == $newDifArr_2[$j]){
//                    echo $difArr_2[$j];
//                }
//            }
//        }


        $difArr = array_intersect($newDifArr_2, $difArr_1);

        $data['lottoCnt'] = sizeof($difArr);
        $data['matchNum'] = $difArr;


//
//        $result2 = $this->debug->debug_var($data);
//        echo $result2;


        $this->load->view('lotto/lotto_header_v', $param);
        $this->load->view('lotto/lotto_contents_v', $data);
        $this->load->view('lotto/lotto_footer_v');


        // 만든 lottoVal DB에 insert

    }

    function test_curl(){

        $idx ='897';

        $data['idx'] = $this->todo_m->getFixLottoIDX();
        $id = array();
//
//        foreach($data['idx'] as $id){
//            $qIDX = $id->idx ;
//        }
//
//        $result = $this->debug->debug_var($qIDX);
//        echo $result;


        $result = $this->debug->debug_var($data['idx']->idx);
        echo $result;


        if (function_exists('curl_init')) {
            // curl 리소스를 초기화
            $ch = curl_init();

            // url을 설정
//            curl_setopt($ch, CURLOPT_URL, 'http://www.google.com');
            curl_setopt($ch, CURLOPT_URL, "https://search.naver.com/search.naver?sm=tab_drt&where=nexearch&query='{$idx}'%ED%9A%8C%EB%A1%9C%EB%98%90");

            // 헤더는 제외하고 content 만 받음
            curl_setopt($ch, CURLOPT_HEADER, 0);

            // 응답 값을 브라우저에 표시하지 말고 값을 리턴

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // 브라우저처럼 보이기 위해 user agent 사용
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5) Gecko/20041107 Firefox/1.0');
            $content = curl_exec($ch);


            // 리소스 해제를 위해 세션 연결 닫음
            curl_close($ch);
            $body = $content;

//            $firstExplode = explode("num_box\"> <span class=\"", $body);
            $firstExplode = explode('num_box"> <span class="', $body);
            $secondExplode = explode('</span> <span class="bonus">', $firstExplode[1]);
            $explodeStr1 = array();
//            echo $firstExplode[1];
            $explodeStr = explode('num ball',$secondExplode[0]);
            for($i = 0; $i < sizeof($explodeStr); $i++){
                $explodeStr1[$i] = explode('">', $explodeStr[$i]);
            }
            for($j = 1; $j < sizeof($explodeStr1); $j++){
//                echo sizeof($explodeStr1[0]);
//                echo sizeof($explodeStr1);
                echo $explodeStr1[$j][0]."<br>";
            }


//            $explodeStr1 = explode('</span> <span class="num ball', $explodeStr[1]);

//            echo $explodeStr1[1];
//            '</span> <span class="num ball'

//
//            $result2 = $this->debug->debug_var($explodeStr1[][]);
//            echo $result2;


        } else {
            return false;
            // curl 라이브러리가 설치 되지 않음. 다른 방법 알아볼 것
        }
    }
}
?>
<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-09-02
 * Time: 오후 2:35
 */
class Todo_m extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }

    function get_list($type='',$offset='', $limit=''){

        $limit_query = '';

        if ($limit != '' OR $offset != '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
        }

        $sql = "SELECT it.id, it.subject, it.content, it.used, it.hit, it.writer, it.writetime, 
                (CASE WHEN created_on = '0000-00-00' THEN '1970-01-01' ELSE created_on END) AS created_on,
                (CASE WHEN due_date = '0000-00-00' THEN '1970-01-01' ELSE due_date END) AS due_date,
                (CASE WHEN it.status = 'start' THEN '시작' WHEN it.status = 'inProgress' THEN '진행중' WHEN it.status = 'resolved' THEN '완료' END) AS status,
                acc.*
                FROM items AS it
                LEFT JOIN accountTB AS acc ON it.writer = acc.no
                ORDER BY it.id DESC" . $limit_query;

        $query = $this->db->query($sql);

        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }

        return $result;

    }

//    function get_list($table = 'ci_board', $type = '', $offset = '', $limit = '') {
//        $limit_query = '';
//
//        if ($limit != '' OR $offset != '') {
//            // 페이징이 있을 경우 처리
//            $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
//        }
//
//        $sql = "SELECT * FROM " . $table . " ORDER BY board_id DESC " . $limit_query;
//        $query = $this -> db -> query($sql);
//
//        if ($type == 'count') {
//            $result = $query -> num_rows();
//        } else {
//            $result = $query -> result();
//        }
//
//        return $result;
//    }

//    public function get_list($tbl='ci_board', $type='*', $offset=0, $limit=5)
//    {
//        $field = ($type == 'count') ? "count(*) AS cnt" : $type;
//        $limit_sql = ($offset != '' || $limit != '') ? " LIMIT ${offset}, ${limit}" : '';
//
//        if ($type=='count') {
//            $sql = "select ${field} from ${tbl}";
//            $query = $this->db->query($sql);
//            $row = $query->row();
//            $result = $row->cnt;
//        } else {
//            $sql = "select ${field} from ${tbl} ORDER BY board_id DESC".$limit_sql;
//            $query = $this->db->query($sql);
//            $result = $query->result_array();
//        }
//
//        return $result;
//    }

    function get_views($id){
        $sql = "SELECT it.id, it.subject, it.content, it.used, it.hit, it.writer, it.writetime, 
                    (CASE WHEN created_on = '0000-00-00' THEN '1970-01-01' ELSE created_on END) AS created_on,
                    (CASE WHEN due_date = '0000-00-00' THEN '1970-01-01' ELSE due_date END) AS due_date,
                    (CASE WHEN it.status = 'start' THEN '시작' WHEN it.status = 'inProgress' THEN '진행중' WHEN it.status = 'resolved' THEN '완료' END) AS status,
                    acc.*
                FROM items AS it
                LEFT JOIN accountTB AS acc ON it.writer = acc.no
                WHERE it.id = '" .$id ."'
                ORDER BY it.id DESC";

//        $sql1 = "UPDATE items SET hit = hit + 1 WHERE id = '".$id."'"; //조회수 증가 쿼리

        $query = $this->db->query($sql);
//        $this->db->query($sql1);

        $result = $query->row();

        return $result;
    }

    function set_edit_views($id, $subject, $content, $status, $type){
        $addQuery = '';
        $sql = '';

//        if($subject !== ''){
//            $addQuery = "subject = '{$subject}'";
//            $addQuery .= ",";
//        } else {
//            $addQuery = '';
//        }
//
//        if($content !== ''){
//            $addQuery .= "content = '{$content}'";
//            $addQuery .= ",";
//        } else {
//            $addQuery = '';
//        }
//        if($status !== ''){
//            $addQuery .= "status = '{$status}'";
//            $addQuery .= ",";
//        } else {
//            $addQuery = '';
//        }
        if($type == 1){
            $sql = "UPDATE items SET subject = '{$subject}', status = '{$status}' WHERE id = '{$id}'";
        } else if ($type == 2){
            $sql = "UPDATE items SET content = '{$content}', status = '{$status}' WHERE id = '{$id}'";
        } else if ($type == 0 || $type == 4){
            $sql = "UPDATE items SET subject = '{$subject}', content = '{$content}', status = '{$status}' WHERE id = '{$id}'";
        }

//        $sql = "UPDATE items SET subject = '{$subject}', content = '{$content}', status = '{$status}' WHERE id = '{$id}'";


        $query = $this->db->query($sql);

        if($this->db->affected_rows() == 0){

            return 0;

        } else {

            return 1;
        }
    }

    function updateIncreaseReadCount($id){

        $sql1 = "UPDATE items SET hit = hit + 1 WHERE id = '".$id."'"; //조회수 증가 쿼리

        $this->db->query($sql1);

        if($this->db->affected_rows() == 0){

            return 0;

        } else {

            return 1;
        }
    }

    function insert_todo($subject, $content, $created_on, $due_date, $writer, $status){
        $sql = "INSERT INTO items (subject, content, created_on, due_date, writer, writetime, status) 
                VALUES ('" .$subject. "','" .$content. "','".$created_on."','".$due_date. "' , '".$writer. "',now(), '$status')";
//        echo $sql;
        $query = $this->db->query($sql); // return 없고 insert 이후 완료. 결과는 컨트롤러에서 받음.
    }

    function delete_todo($id, $no){
        $sql = "DELETE FROM items WHERE id = '" . $id . "' AND writer = '" . $no . "'";
        $this->db->query($sql);

//        echo $query->num_rows();
        if($this->db->affected_rows() == 0){

            return 0;

        } else {

            return 1;
        }
    }

    function insert_account_todo($accountID, $pw, $email){
        $sql = "INSERT INTO accountTB (account_id, PW, EMAIL) VALUES ('" .$accountID. "','" .$pw. "','".$email."')";
        $query = $this->db->query($sql);
    }

    function getAccountInfo($id){
        $sql = "SELECT * FROM accountTB WHERE account_id = '" . $id . "'";
        $query = $this->db->query($sql);

        if($query->num_rows() < 0 || $query->num_rows() == ''){
            return true;

        } else {

            return false;
        }
    }

    function getAccountInfoNo($writer){
        $sql = "SELECT no FROM accountTB WHERE account_id = '" . $writer . "'";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;

    }

    function getSearchItems($type = '', $txt, $cate, $offset='', $limit=''){

        $limit_query = '';

        if ($limit != '' OR $offset != '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
        }

        if($txt == '' OR $cate == ''){
            echo $txt . "<br>cate:".$cate;
            exit;
        }

        $sql = "SELECT it.id, it.subject, it.content, it.used, it.hit, it.writer, it.writetime, 
                    (CASE WHEN created_on = '0000-00-00' THEN '1970-01-01' ELSE created_on END) AS created_on,
                    (CASE WHEN due_date = '0000-00-00' THEN '1970-01-01' ELSE due_date END) AS due_date,
                    acc.*
                FROM items AS it
                LEFT JOIN accountTB AS acc on it.writer = acc.no
                WHERE " . $cate . " LIKE '%" . $txt. "%' ORDER BY it.id DESC" . $limit_query;

//        echo $sql1;
        $query = $this->db->query($sql);

        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }

        return $result;

    }

    function getItemAccountInfo($accountID){
        $sql = "SELECT * FROM ITEMS AS it 
                LEFT JOIN accountTB AS acc
                ON it.writer = acc.no
                WHERE it.writer = {$accountID}";

        $query = $this->db->query($sql);

        $result = $query -> num_rows();

        return $result;
    }

    function getAdminPermit($adminID){
        $sql = "SELECT permit FROM accountTB WHERE account_id = '{$adminID}'";

        $query = $this->db->query($sql);
        $result = $query->row();

        return $result;
    }

    function insReply($contents, $id, $writerNo){
        $sql = "INSERT INTO items_reply (items_no, contents, writer_no) VALUES ('{$id}','{$contents}', '{$writerNo}')";

//        echo $sql;

        $query = $this->db->query($sql);

    }

    function insFileData($fileName){
        $sql = "INSERT INTO upload_files (file_name) values ('".$fileName."')";

        $query = $this->db->query($sql);

    }

    function getFileName(){
        $sql = "SELECT * FROM upload_files";

        $query = $this->db->query($sql);
        $result = $query -> result();

        return $result;
    }

    function getFixLottoNum(){
        $sql = "select IDX, num_1, num_2, num_3, num_4, num_5, num_6 from lotto_fix_info_TB order by IDX desc limit 1";

        $query = $this->db->query($sql);
        $result = $query -> result();

        return $result;

    }


}

?>
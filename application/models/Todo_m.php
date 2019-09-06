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

    function get_list(){
        $sql = "SELECT * FROM items as it
                LEFT JOIN accountTB as acc
                ON it.writer = acc.no
                ORDER BY id DESC";
        $query = $this->db->query($sql);
        $result = $query->result();

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
        $sql = "SELECT * FROM items WHERE id = '" .$id . "'";
        $sql1 = "UPDATE items SET hit = hit + 1 WHERE id = '".$id."'";

        $query = $this->db->query($sql);
        $query1 = $this->db->query($sql1);

        $result = $query->row();

        return $result;
    }

    function insert_todo($subject, $content, $created_on, $due_date, $writer){
        $sql = "INSERT INTO items (subject, content, created_on, due_date, writer, writetime) VALUES ('" .$subject. "','" .$content. "','".$created_on."','".$due_date. "' , '".$writer. "',now())";
        $query = $this->db->query($sql); // return 없고 insert 이후 완료. 결과는 컨트롤러에서 받음.
    }

    function delete_todo($id){
        $sql = "DELETE FROM items WHERE id = '" . $id . "'";
        $this->db->query($sql);
    }

    function insert_account_todo($accountID, $pw, $email){
        $sql = "INSERT INTO accountTB (account_id, PW, EMAIL) VALUES ('" .$accountID. "','" .$pw. "','".$email."')";
        $query = $this->db->query($sql);
    }
}

?>
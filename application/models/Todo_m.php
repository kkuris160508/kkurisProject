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

//    function get_list(){
//        $sql = "SELECT * FROM items";
//        $query = $this->db->query($sql);
//        $result = $query->result();
//
//        return $result;
//    }

    function get_list($table = 'ci_board', $type = '', $offset = '', $limit = '') {
        $limit_query = '';

        if ($limit != '' OR $offset != '') {
            // 페이징이 있을 경우 처리
            $limit_query = ' LIMIT ' . $offset . ', ' . $limit;
        }

        $sql = "SELECT * FROM ci_board ORDER BY board_id DESC '{$limit_query}'";
        $query = $this -> db -> query($sql);

        if ($type == 'count') {
            $result = $query -> num_rows();
        } else {
            $result = $query -> result();
        }

        return $result;
    }

    function get_views($id){
        $sql = "SELECT * FROM items WHERE id = '" .$id . "'";
        $query = $this->db->query($sql);
        $result = $query->row();

        return $result;
    }

    function insert_todo($content, $created_on, $due_date){
        $sql = "INSERT INTO items (content, created_on, due_date) VALUES ('" .$content. "','".$created_on."','".$due_date. "')";
        $query = $this->db->query($sql); // return 없고 insert 이후 완료. 결과는 컨트롤러에서 받음.
    }

    function delete_todo($id){
        $sql = "DELETE FROM items WHERE id = '" . $id . "'";
        $this->db->query($sql);
    }
}

?>
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
        $sql = "SELECT * FROM items";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    function get_view($id){
        $sql = "SELECT * FROM items WHERE id = '" .$id . "'";
        $query = $this->db->query($sql);
        $result = $query->row();

        return $result;
    }

}

?>
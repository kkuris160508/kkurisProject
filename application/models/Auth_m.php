<?php if(!defined('BASEPATH')) exit ('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-09-05
 * Time: 오후 5:52
 */
class Auth_m extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function setlogin($auth){

        $sql = "SELECT * FROM accountTB where account_id = '" . $auth['account_id']. "' AND PW = '" . $auth['PW_']. "' ";

//        echo $sql;
        $query = $this->db->query($sql);

        if($query->num_rows() > 0){
            $result = $query -> row();
            return $result;
        } else {
            return false;
        }
    }

    public function getPW($id){
        $sql = "SELECT account_id, PW FROM accountTB WHERE account_id = '{$id}'";

//        echo $sql;
        $query = $this->db->query($sql);
        $result = $query -> row();

        return $result;
    }
}

?>
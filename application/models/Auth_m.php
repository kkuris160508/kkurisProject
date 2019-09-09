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

    public function login($auth){
        $sql = "SELECT account_id, PW FROM accountTB where account_id = '" . $auth['account_id']. "' AND PW = '" . $auth['PW']. "' ";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0){
            $result = $query -> rows();
            return $result;
        } else {
            return false;
        }
    }
}

?>
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
        $sql = "SELECT username, email FROM accountTB where account_id = '" . $auth['username']. "' AND PW = '" . $auth['password']. "' ";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0){
            return $query -> rows();
        } else {
            return false;
        }
    }
}

?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-30
 * Time: 오후 2:29
 */
class Join_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAccount(){
        $this->load->database();
        $query = $this->db->query("SELECT ID, PW, EMAIL FROM accountTB")->result();
        $this->db->close();
        return $query;
    }
}

?>
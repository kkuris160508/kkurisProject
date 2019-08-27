<?php
defined('BASEPATH') OR exit('No Direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-27
 * Time: 오전 10:44
 */
    class Member_model extends CI_Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function GetMembers(){
            $this->load->database();
            $result = $this->db->query("select id, name from members")->result();
            $this->db->close();

            return $result;
        }
    }

?>
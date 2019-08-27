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

        private $members = array(
            '1' => 'Edward',
            '2' => 'Alex',
            '3' => 'John'
        );

        public function GetMembers(){
            return $this->members;
        }
    }

?>
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

    public function getAccount($id, $email){
        $this->load->database();
        $query = $this->db->query("SELECT ID, PW, EMAIL FROM accountTB WHERE ID = '{$id}' AND EMAIL = '{$email}'")->result();

//        $this->db->close();
        return $query;
//        echo $query;
    }

    public function insAccount($id, $email, $pw = 1234){
        $data = array(
            'ID'=>$id,
            'PW'=>$pw,
            'EMAIL'=>$email
        );
        $this->load->database();
        $this->db->insert('accountTB', $data);
        $this->db->close();
    }
}

?>
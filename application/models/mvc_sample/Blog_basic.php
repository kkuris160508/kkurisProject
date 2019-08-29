<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 블로그 기본 Model
 *
 * Created on 2014. 10. 20.
 * @author 불의회상(hoksi2k@hanmail.net)
 * @version 1.0
 */
class Blog_basic_model extends CI_Model {
    protected $tbl;

    public function __construct() {
        parent::__construct();

        // $this->load->database(); // Database Load
        $this->tbl = 'blog_basic';
        $this->pkey = 'blog_basic_id';
    }

    public function blog_basic() {
        $len = 10;

        return $this->db->order_by('created', 'desc')->limit($len)->get($this->tbl)->result_array();
    }

    public function insert($data) {
        $this->db->set('created', 'now()', FALSE);
        $this->db->insert($this->tbl, $data);

        return $this->db->insert_id();
    }
}
?>
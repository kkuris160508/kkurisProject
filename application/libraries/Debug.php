<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 1:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug{
    public function test($tmpVar = 'chris'){
        return "hi ".$tmpVar;
    }
}

?>
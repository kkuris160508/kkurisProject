
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-27
 * Time: 오전 9:24
 */
class Product extends CI_Controller{
//    public function _remap($method){
//        if($method === 'some_method'){
//            $this->$method();
//        } else {
//            $this->default_method();
//        }
//    }
//
    public function _remap($method, $param = array()){
        $method = 'process_'.$method;
        if(method_exists($this, $method)){
            return call_user_func_array(array($this, $method), $param);
        }
        show_404();
    }

//    public function shoes($sandals, $id){
//        echo $sandals;
//        echo $id;
//    }
//
//

}

?>
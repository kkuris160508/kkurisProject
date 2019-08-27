
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-27
 * Time: 오전 9:24
 */
class Product extends CI_Controller{

    public function shoes($sandals, $id){
        echo $sandals;
        echo $id;
    }
}

?>
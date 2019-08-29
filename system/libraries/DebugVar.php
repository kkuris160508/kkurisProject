<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 1:57
 */

class DebugVar{
    function isDevDebug()
    {

        $dev_ip = array("211.52.72.51",
            "211.52.72.56",
            "211.52.72.59" );

        return 1;//in_array( $_SERVER["REMOTE_ADDR"], $dev_ip);

    }

    function debug_var($var = '')
    {

        if($this->isDevDebug())
        {
            echo $this->_before();
            if (is_array($var))
            {
                print_r($var);
            }
            elseif (is_object($var))
            {
                print_r($var);
            }
            else
            {
                echo $var;
            }
            echo $this->_after();
        }
    }

    function _before()
    {
        $before = '<div style="position:relative; z-index:999999; padding:10px 20px 10px 20px; background-color:#fbe6f2; border:1px solid #d893a1; color: #000; font-size: 12px;" class="Debug">'."\n";
        $before .= '<h5 style="font-family:verdana,sans-serif; font-weight:bold; font-size:18px; margin:0px 0px 10px 0px;">Debug Helper Output</h5>'."\n";
        $before .= '<xmp style="font-weight: bold;">'."\n";
        return $before;
    }

    function _after()
    {
        $after = '</xmp>'."\n";
        $after .= '<h5 style="font-family:verdana,sans-serif; font-weight:bold; font-size:18px; margin:0px 0px 10px 0px;">END</h5>'."\n";
        $after .= '</div>'."\n";
        return $after;
    }
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 4:21
 */

?>
    <?php foreach($contents as $key => $value) :?>
    <p><?php echo $value;?></p>
        <?php if($key == '1'):?>
            <input type="password" name="input"+<?php echo $value?>>
        <?php else:?>
            <input type="text" name="input"+<?php echo $value?>>
        <?php endif;?>
    <?php endforeach;?>
    <br>
<button type="submit" class = 'accountBtn' onclick="location.href='/JoinOK/JoinOK'"><?php echo $btnName;?></button>

<!---->
<?php //$result = $this->debug->debug_var($key);?>
<?php //echo $result;?>


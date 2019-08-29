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
    <input type="text" name="input_"+<?php echo $value?>>
        <? if($key == 'Password'){?>
            <input type="password" name="input"+<?php echo $value?>>
        <?}?>
    <?php endforeach;?>
    <br>
<button type="submit"><?php echo $btnName;?></button>

<?php $result = $this->debug->debug_var($contents);?>
<?php echo $result;?>


<!--<input type="text" name="input_ID">-->
<!--<p>--><?php //echo $Password;?><!--</p>-->
<!--<input type="password" name="input_PW">-->
<!--<p>--><?php //echo $Email;?><!--</p>-->
<!--<input type="text" name="input_email">-->
<!--<br>-->

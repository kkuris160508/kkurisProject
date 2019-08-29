<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 4:21
 */

?>
<?php foreach($contents as $key => $value):?>
<p><?=$key?></p>
<input type="text" name="input_ID">

<br>
<button type="submit">회원가입</button>
<?php endforeach;?>
<?php $result = $this->debug->debug_var($contents);?>
<?php echo $result;?>

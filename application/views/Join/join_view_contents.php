<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오후 4:21
 */

?>
    <p><?php echo $ID;?></p>
    <input type="text" name="input_ID">
    <p><?php echo $Password;?></p>
    <input type="password" name="input_PW">
    <p><?php echo $Email;?></p>
    <input type="text" name="input_email">
    <br>
<button type="submit"><?php echo $btnName;?></button>

<?php $result = $this->debug->debug_var($_REQUEST);?>
<?php echo $result;?>
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
            <input type="password" id = "<?php echo $value?>" placeholder="<?php echo $value?>">
        <?php else:?>
            <input type="text" id = "<?php echo $value?>" placeholder="<?php echo $value?>">
        <?php endif;?>
        <input type="hidden" id = "hidden" value="<?php echo $value?>">
    <?php endforeach;?>
    <br>
<button type="submit" class = 'accountBtn' onclick="location.href='/Join/joinOK/'+$('#ID').val()+'/'+$('#Email').val()"><?php echo $btnName;?></button>

<!---->
<?php //$result = $this->debug->debug_var($key);?>
<?php //echo $result;?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var pwVal = $('#Password').val();
        var idVal = $('#ID').val();
        var emVal = $('#Email').val();

    });
</script>

<html>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var pwVal = $('#Password').val();
        var idVal = $('#ID').val();
        var emVal = $('#Email').val();

    });
</script>
    <?php echo form_open('/Join/joinCheck')?>

    <?php foreach($contents as $key => $value) :?>
    <p><?php echo $value;?></p>
        <?php if($key == '1'):?>
            <input type="password" id = "<?php echo $value?>" placeholder="<?php echo $value?>">
        <?php else:?>
            <input type="text" id = "<?php echo $value?>" placeholder="<?php echo $value?>">
        <?php endif;?>

    <?php endforeach;?>
    <br>
<!--    <input type="hidden" name = "Password" value="Password">-->
<button type="submit" class = 'accountBtn' onclick="location.href='/Join/joinCheck/'+$('#ID').val()+'/'+$('#Email').val()"><?php echo $btnName;?></button>
</form>
<!---->
<?php //$result = $this->debug->debug_var($key);?>
<?php //echo $result;?>

</body>
</html>
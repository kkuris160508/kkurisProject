<html>
<head>
    <title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>
<?php echo form_open('/Main/uploadTest')?>

<ul>
    <?php foreach ($upload_data as $item => $value):?>
        <li><?php echo $item;?>: <?php echo $value;?></li>
    <?php
//       $this->debug->debug_var($upload_data['file_name']); // 시발 debug 를 소문자로...ㅡㅡ
        ?>

        <?php echo form_hidden('file_name',$upload_data['file_name'])?>
    <?php endforeach; ?>
</ul>

<div class="form-actions">
    <input type="submit" class="btn btn-primary" id="replyWrite_btn" value="완료" />
</div>

<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>

</body>
</html>

<?php echo form_close();?>
<html>
<body>

<?php foreach($list as $item):?>
<p>
    <img src="http://34.80.199.17/uploads/<?php echo $item -> file_name?>" width="245">
    <?php var_dump($item->file_name);?>
</p>
<?php endforeach;?>
</body>
</html>

http://34.80.199.17/uploads/35dcf2fb9e1.png
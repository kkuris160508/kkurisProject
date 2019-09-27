<html>
<body>
<?php var_dump($list);?>
<?php foreach($list as $item => $fileName):?>
<p>
    <img src="/34.80.199.17/uploads/<?php echo $fileName?>" width="245">
</p>
<?php endforeach;?>
</body>
</html>
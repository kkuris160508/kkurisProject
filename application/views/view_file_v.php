<html>
<body>

<?php foreach($list as $item):?>
<p>
    <img src="/34.80.199.17/uploads/<?php echo $item -> file_name?>" width="245">
    <?php var_dump($item->file_name);?>
</p>
<?php endforeach;?>
</body>
</html>
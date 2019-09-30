<html>
<body>

<?php foreach($list as $item):?>
<p>
    <div class="imgContentDiv">
        <img src="http://34.80.199.17/uploads/<?php echo $item -> file_name?>" width="245">
    <!--    --><?php //var_dump($item->file_name);?>
    </div>
</p>
<?php endforeach;?>
</body>
</html>
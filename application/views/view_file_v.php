<html>
<nav id="gnb"> <!-- gnb start -->
    <ul>
        <li><a rel="external" href="/Main/lists/">todo 애플리케이션 프로그램(Main 페이지)</a></li>
    </ul>
</nav><!-- gnb end -->
<body>

<?php foreach($list as $item):?>
<p>
    <div class="imgContentDiv" style="outline: 1px solid #e6e6e6; border: 10px solid white; box-shadow: 5px 7px 7px #aaa;">
        <div style="width: 100%; padding-bottom: 100%; background-position: center; background-size: cover; background-image: url(http://34.80.199.17/uploads/<?php echo $item -> file_name?>);"></div>
<!--        <img src="http://34.80.199.17/uploads/--><?php //echo $item -> file_name?><!--" width="245">-->
    <!--    --><?php //var_dump($item->file_name);?>
    </div>
</p>
<?php endforeach;?>
</body>
</html>
<html>
<nav id="gnb"> <!-- gnb start -->
    <ul>
        <li><a rel="external" href="/Main/lists/">todo 애플리케이션 프로그램(Main 페이지)</a></li>
    </ul>
</nav><!-- gnb end -->
<body>

<?php foreach($list as $item):?>
<p>
<div class = 'articleDiv'>
    <div class="imgContentDiv" style="width: 432px; height:432px; outline: 1px solid #e6e6e6; border: 10px solid white; box-shadow: 5px 7px 7px #aaa;">
        <div style="width: 100%; padding-bottom: 100%; background-position: center; background-size: cover; background-image: url(http://34.80.199.17/uploads/<?php echo $item -> file_name?>);"></div>
<!--        <img src="http://34.80.199.17/uploads/--><?php //echo $item -> file_name?><!--" width="245">-->
    <!--    --><?php //var_dump($item->file_name);?>
    </div>
    <div class="txtContentDiv" style="width:432px; height:123px;outline: 1px solid #e6e6e6; border: 10px solid white; box-shadow: 5px 7px 7px #aaa;">
        <div class= 'subjectContentDiv' style="width:432px; height: 30%"> subject</div>
        <div class= 'textContentDiv' style="width: 432px; height: 60%;"> contents</div>
    </div>
</div>
</p>
<?php endforeach;?>
</body>
</html>
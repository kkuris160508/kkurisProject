
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title>CodeIgniter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<div id="main">
    <header id="header" data-role="header" data-position="fixed">
        <blockquote>
            <p>
                만들면서 배우는 CodeIgniter
            </p>
            <small>실행 예제</small>
            <p>
                <?php
                if ( @$this -> session -> userdata('logged_in') == TRUE) {
                    ?>
                    <?php echo $this -> session -> userdata('account_id');?> 님 환영합니다. <a href="/Main/Auth/logout" class="btn">로그아웃</a>
                    <?php
                } else {
                    ?>
                    <a href="/Main/Auth/login" class="btn btn-primary"> 로그인 </a>
                    <?php
                }
                ?>
            </p>
        </blockquote>
    </header>
    <nav id="gnb">
        <ul>
            <li>
                <a rel="external" href="/Main/<?php echo $this -> uri -> segment(1); ?>/lists/<?php echo $this -> uri -> segment(3); ?>"> 게시판 프로젝트 </a>
            </li>
        </ul>
    </nav>

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
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
</head>
<body>

<div id="main" style="margin-left: 20px;">
    <header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
        <blockquote>
            <p>
                CodeIgniter <?php echo CI_VERSION?>
            </p>
            <p>
                <?php
                if ( @$this -> session -> userdata('logged_in') == TRUE) {
                    ?>
                    <?php echo $this -> session -> userdata('account_id');?> 님 환영합니다. <br>
                    <a href="/Auth/logout" class="btn btn-danger">로그아웃</a>
                    <?php
                } else {
                    ?>
                    <a href="/Auth/login" class="btn btn-primary"> 로그인 </a>
                    <a href="/Main/join" class="btn btn-success"> 회원가입 </a>
                    <?php
                }
                ?>
            </p>
        </blockquote>
    </header> <!-- Header End -->
    <nav id="gnb"> <!-- gnb start -->
        <ul>
            <li><a rel="external" href="/Main/lists/">todo 애플리케이션 프로그램(Main 페이지)</a></li>
            <li><a rel="external" href="/Main/lotto/">??? </a></li>
        </ul>
    </nav><!-- gnb end -->
    <article id="board_area">
        <header>
            <h1>Todo <?php echo $id;?></h1>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <title>CodeIgniter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>
<body>
<div id="main">
    <header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
        <blockquote>
            <p>CodeIgniter</p>
        </blockquote>
    </header> <!-- Header End -->
    <nav id="gnb"> <!-- gnb start -->
        <ul>
            <li><a rel="external" href="/Main/lists/">todo 애플리케이션 프로그램</a></li>
            <li><a rel="external" href="/Main/lotto/">??? </a></li>
        </ul>
    </nav><!-- gnb end -->
    <article id="board_area">
        <header>
            <h1>Todo 목록</h1>
        </header>
<table class="table table-striped table-dark">
    <thead class="thead-dark">
    <tr>
        <th scope="col">번호</th>
        <th scope="col">제목</th>
        <th scope="col">내용</th>
        <th scope="col">시작일</th>
        <th scope="col">종료일</th>
        <th scope="col">조회수</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $lt) : ?>
        <tr>
            <th scope="row">
                <?php echo $lt -> id;?>
            </th>
            <td>
                <a rel="external" href="/Main/view/<?php echo $lt -> id; ?>">
                    <?php echo $lt -> subject;?>
                </a>
            </td>
            <td>
                <a rel="external" href="/Main/view/<?php echo $lt -> id; ?>">
                    <?php echo $lt -> content;?>
                </a>
            </td>
            <td>
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> created_on)); ?>"><?php echo $lt -> created_on;?></time>
            </td>
            <td>
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> due_date)); ?>"><?php echo $lt -> due_date;?></time>
            </td>
            <!-- 조회수 영역 추가-->
            <td>
                <?php echo $lt -> hit;?>
            </td>
        </tr>
        <?php endforeach?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="4"><a href="/Main/write/" class="btn btn-success">
                쓰기
            </a></th>
    </tr>
    </tfoot>
</table>
<div><p></p></div>
</article>
    <footer>
        <blockquote>
            <p><a class="azubu" href="http://www.cikorea.net/" target="blank">CodeIgniter 한국 사용자 포럼</a></p>
            <small>Copyright by <em class="black"><a href="mailto:entz160508@gmail.com">Chris</a></em></small>
            <p align="right">작업 및 공부중.......</p>
        </blockquote>
    </footer>
</div>
<p align="right">Page has been rendered <?php echo $this->benchmark->elapsed_time();?> seconds</p>
</body>
</html>



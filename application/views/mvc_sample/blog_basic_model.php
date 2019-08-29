<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>블로그 기본</title>
    <meta name="author" content="불의회상(hoksi2k@hanmail.net)">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/bootstrap-2.3.2/css/bootstrap.min.css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="/assets/bootstrap-2.3.2/css/bootstrap-responsive.css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="/assets/font-awesome-3.2.1/css/font-awesome.min.css" media="screen" charset="utf-8" />
    <!-- Jquery -->
    <script src="/assets/jquery-1.8.3/jquery.min.js"></script>
    <!--[if IE 7]>
    <link rel="stylesheet" href="/assets/font-awesome-3.2.1/css/font-awesome-ie7.min.css" media="screen" charset="utf-8" />
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="/assets/js/plugin/html5.js"></script>
    <![endif]-->
    <style>body {margin-top:60px;}</style>
</head>

<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="<?=site_url('mvc_sample/blog_basic')?>">Blog basic</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#post_blog" data-toggle="modal"><i class="icon-pencil"></i> Post</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">
    <?php foreach($blogs as $blog): ?>
        <div class="row">
            <div class="span12">
                <h3><i class="icon-beer"></i> <?=$blog['title']?></h3>
            </div>
            <div class="span12 well">
                <?=nl2br($blog['content'])?>
            </div>
        </div>
    <?php endforeach ?>
</div>

<form action="<?=site_url('mvc_sample/blog_basic/post')?>" method="post">
    <div id="post_blog" class="modal hide fade">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h2>등록</h2>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="title">제목*</label>
                    <div class="controls">
                        <input id="title" name="title" type="text" placeholder="" class="input-block-level" required="">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="content">내용*</label>
                    <div class="controls">
                        <textarea id="content" rows="10" name="content" class="input-block-level" required=""></textarea>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="modal-footer">
            <button id="post_btn" class="btn btn-primary">등록</button>
        </div>
    </div>
</form>

<script src="/assets/bootstrap-2.3.2/js/bootstrap.min.js"></script>
</body>
</html>
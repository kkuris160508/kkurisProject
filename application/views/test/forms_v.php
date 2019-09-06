<article id="board_area">
    <header><h1></h1></header>
<!--    --><?php //echo validation_errors();?>
        <?php
            if(form_error('username')){
                $error_username = form_error('username');
            } else {
                $error_username = form_error('username_check');
            }
        ?>
        <?php echo form_open('Test/forms')?>
<!--    <form method="POST" class="form-horizontal">-->
        <fieldset>
            <legend> 폼 검증</legend>
            <div class="control-group">
                <label class="control-label" for="input01">아이디</label>
                <div class="controls">
<!--                    <input type="text" name="username" class="input-xlarge" id="input01" />-->
<!--                    <p class="help-block">아이디를 입력하세요.</p>-->
                    <?php echo form_input('username',set_value('username'))?>
                    <p class = 'help-block'>
                        <?php
                            if($error_username == FALSE){
                                echo "아이디를 입력하세요";
                            } else {
                                echo $error_username;
                            }
                        ?>
                    </p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input02">비밀번호</label>
                <div class="controls">
                    <!--<input type="password" name="password" class="input-xlarge" id="input02" />
                    <p class="help-block">비밀번호를 입력하세요.</p>-->
                    <?php echo form_password('password',set_value('password'))?>
                    <p class = 'help-block'>
                        <?php
                        if(form_error('password') == FALSE){
                            echo "";
                        } else {
                            echo form_error('password');
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input03">비밀번호 확인</label>
                <div class="controls">
<!--                    <input type="password" name="passconf" class="input-xlarge" id="input03" />-->
<!--                    <p class="help-block">비밀번호를 한 번 더 입력하세요.</p>-->
                    <?php echo form_password('passconf',set_value('passconf'))?>
<!--                    <p class="help-block">비밀번호를 한 번 더 입력하세요.</p>-->
                    <p class = 'help-block'>
                        <?php
                        if(form_error('passconf') == FALSE){
                            echo "";
                        } else {
                            echo form_error('passconf');
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input04">이메일</label>
                <div class="controls">
<!--                    <input type="text" name="email" class="input-xlarge" id="input04" />-->
<!--                    <p class="help-block">이메일을 입력하세요.</p>-->
                    <?php echo form_input('email',set_value('email'))?>
                    <p class = 'help-block'>
                        <?php
                        if(form_error('email') == FALSE){
                            echo "";
                        } else {
                            echo form_error('email');
                        }
                        ?>
                    </p>
                </div>
            </div>
        </fieldset>

        <div><input type="submit" value="전송" class="btn btn-primary"/></div>
    <?php echo form_close();?>
<!--    </form>-->
</article>
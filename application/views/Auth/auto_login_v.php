<article id="board_area">
    <header><h1></h1></header>
    <?php
    $attributes = array(
        'class' => 'form-horizontal',
        'id' => 'auth_login'
    );
    echo form_open('/Auth/autoLogin');
    ?>
    <fieldset>
        <legend>로그인</legend>
        <div class="control-group">
            <label class="control-label" for="input1">아이디</label>
            <div id = 'inputID' class="controls">
                <!--                <input type="text" class="input-xlarge" id="input1" name="account_id"-->
                <!--                       value="--><?php //echo set_value('account_id'); ?><!--" />-->
                <?php echo form_input('account_id',get_cookie('myprefix_user_id',TRUE))?>
                <p class="help-block"></p>
            </div>
            <label class="control-label" for="input2">비밀번호</label>
            <div id = 'inputPW' class="controls">
                <!--                <input type="PW" class="input-xlarge" id="input2" name="PW"-->
                <!--                       value="--><?php //echo set_value('PW'); ?><!--" />-->
<!--                --><?php //echo form_password('PW', set_value('PW'))?>
                <?php echo form_password('PW')?>
                <p class="help-block"></p>
            </div>
            <div class="controls">
                <p class="help-block"><?php echo validation_errors();?></p>
            </div>

            <div class="form_actions">
                <!--                <button type="submit" class="btn btn-primary">확인</button>-->
                <input type="submit" class="btn btn-primary" id="login_btn" value="확인" />
                <input type="submit" class="btn btn-danger" id="cancel_btn" value="취소" />
                <a href="/Main/join" class="btn btn-success"> 회원가입 </a>
                <!--                <button class="btn" onclick="document.location.reload()">취소</button>-->

                <!--                <div class="form-actions">-->
                <!--                    <input type="submit" class="btn btn-primary" id="login_btn" value="회원가입" />-->
                <!--                </div>-->
            </div>
        </div>
    </fieldset>
    <?php echo form_close();?>
</article>
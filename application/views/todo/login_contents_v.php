
<?php echo form_open('/Main/join')?>
<!--        <form class="form-horizontal" accept-charset="utf-8" method="post" action="" id="write_action">--> <!-- form open 사용으로 form 태그 삭제 -->
<fieldset>
    <div class="control-group">
        <label class="control-label" for="input00">아이디</label>
        <div class="controls">
            <!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
            <?php echo form_input('accountID', set_value('accountID'))?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
            <p class="help-block">
                <?php
                if(form_error('accountID') == FALSE){
                    echo "";
                } else {
                    echo form_error('accountID');
                }
                ?>
            </p>
        </div>
        <label class="control-label" for="input01">패스워드</label>
        <div class="controls">
            <!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
            <?php echo form_password('password')?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
            <p class="help-block">
                <?php
                if(form_error('password') == FALSE){
                    echo "";
                } else {
                    echo form_error('password');
                }
                ?>
            </p>
        </div>
        <label class="control-label" for="input02">이메일</label>
        <div class="controls">
            <!--                        <input type="text" class="input-xlarge" id="input02" name="created_on">-->
            <?php echo form_input('email', set_value('email'),"placeholder='xxx@xxx.xxx'")?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
            <p class="help-block">
                <?php
                if(form_error('email') == FALSE){
                    echo "";
                } else {
                    echo form_error('email');
                }
                ?>
            </p>
        </div>

        <div class="form-actions">
            <input type="submit" class="btn btn-primary" id="login_btn" value="회원가입" />
       </div>
    </div>
</fieldset>
<!--        </form>-->
<?php echo form_close();?>
</article>

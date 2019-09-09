
<?php echo form_open('/Main/join')?>
<!--        <form class="form-horizontal" accept-charset="utf-8" method="post" action="" id="write_action">--> <!-- form open 사용으로 form 태그 삭제 -->
<fieldset>
    <div class="control-group">
        <label class="control-label" for="input00">아이디</label>
        <div class="controls">
            <!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
            <?php echo form_input('account_id', set_value('account_id'))?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
            <p class="help-block">
                <?php
                if(form_error('account_id') == FALSE){
                    echo "";
                } else {
                    echo form_error('account_id');
                }
                ?>
            </p>
        </div>
        <label class="control-label" for="input01">패스워드</label>
        <div class="controls">
            <!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
            <?php echo form_password('Password')?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
            <p class="help-block">
                <?php
                if(form_error('Password') == FALSE){
                    echo "";
                } else {
                    echo form_error('Password');
                }
                ?>
            </p>
        </div>
        <label class="control-label" for="input02">이메일</label>
        <div class="controls">
            <!--                        <input type="text" class="input-xlarge" id="input02" name="created_on">-->
            <?php echo form_input('EMAIL', set_value('EMAIL'),"placeholder='xxx@xxx.xxx'")?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
            <p class="help-block">
                <?php
                if(form_error('EMAIL') == FALSE){
                    echo "";
                } else {
                    echo form_error('EMAIL');
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

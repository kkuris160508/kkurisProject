
        <?php echo form_open('/Main/write')?>
<!--        <form class="form-horizontal" accept-charset="utf-8" method="post" action="" id="write_action">--> <!-- form open 사용으로 form 태그 삭제 -->
            <fieldset>
                <div class="control-group">
                    <?php
                    $extraOpt = array(
                        'placeholder'=>'YYYY-MM-DD',
                        'onClick'=>'Chk_Text();'
                    );
                    ?>
                    <label class="control-label" for="input00">제목</label>
                    <div class="controls">
                        <!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
                        <?php echo form_input('subject', set_value('subject'))?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                        <p class="help-block">
                            <?php
                                if(form_error('subject') == FALSE){
                                    echo "";
                                } else {
                                    echo form_error('subject');
                                }
                            ?>
                        </p>
                    </div>
                    <label class="control-label" for="input01">내용</label>
                    <div class="controls">
<!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
                        <?php echo form_input('content', set_value('content'))?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                        <p class="help-block">
                            <?php
                            if(form_error('content') == FALSE){
                                echo "";
                            } else {
                                echo form_error('content');
                            }
                            ?>
                        </p>
                    </div>
                    <label class="control-label" for="input02">시작일</label>
                    <div class="controls">
<!--                        <input type="text" class="input-xlarge" id="input02" name="created_on">-->

                        <?php echo form_input('created_on', set_value('created_on'),$extraOpt)?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                        <p class="help-block">
                            <?php
                            if(form_error('created_on') == FALSE){
                                echo "";
                            } else {
                                echo form_error('created_on');
                            }
                            ?>
                        </p>
                    </div>
                    <label class="control-label" for="input03">종료일</label>
                    <div class="controls">
<!--                        <input type="text" class="input-xlarge" id="input03" name="due_date">-->
                        <?php echo form_input('due_date',set_value('due_date'),$extraOpt)?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                        <p class="help-block">
                            <?php
                            if(form_error('due_date') == FALSE){
                                echo "";
                            } else {
                                echo form_error('due_date');
                            }
                            ?>
                        </p>
                    </div>

                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" id="write_btn" value="작성" />
                    </div>
                </div>
            </fieldset>
<!--        </form>-->
        <?php echo form_close();?>
    </article>

        <SCRIPT LANGUAGE="JavaScript">
            <!--
            function Chk_Text(){

                var ChkText=/^([a-zA-Z0-9]{1,20})$/

                if(ChkText.test(ChkID)==false){
                    alert("'"+ChkID + "' 는 사용이 불가능 합니다. \n 영문문자나 숫자 아이디만 사용이 가능합니다.")
                    return;
                }
            }

            //-->
        </SCRIPT>


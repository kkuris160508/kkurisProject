<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js" integrity="sha256-PsB+5ZEsBlDx9Fi/GXc1bZmC7wEQzZK4bM/VwNm1L6c=" crossorigin="anonymous"></script>
<?php echo form_open('/Main/write')?>
<!--        <form class="form-horizontal" accept-charset="utf-8" method="post" action="" id="write_action">--> <!-- form open 사용으로 form 태그 삭제 -->
            <fieldset>
                <div class="control-group">
                    <?php
                    $extraOpt = array(
                        'style'       => 'width:100%;height:50%;resize:none;'
                    );
                    $exOpt = array(
                        'id'          => 'sdate',
                        'data'        => 'created_on',
                        'value'       => set_value('created_on'),
                        'placeholder' => 'YYYY-MM-DD'
                    );
                    $exOpt1 = array(
                        'id'          => 'edate',
                        'data'        => 'created_on',
                        'value'       => set_value('created_on'),
                        'placeholder' => 'YYYY-MM-DD'
                    );
                    ?>

                    <div id = 'subjectDiv' style="float: left;">
                        <label class="control-label" for="input00">제목</label>
                        <div class="controls">
                            <!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
                            <?php echo form_input('subject', set_value('subject'))?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                            <div class = 'subjectForm'>
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
                        </div>
                    </div>
                    <div id = 'startDate' style="float: left; margin-left: 50px; margin-right: 50px;">
                        <label class="control-label" for="input02">시작일</label>
                        <div class="controls">
                            <!--                        <input type="text" class="input-xlarge" id="input02" name="created_on">-->
                            <div class = 'startDateForm'>
                            <?php echo form_input($exOpt)?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
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
                        </div>
                    </div>
                    <div id = 'endDateDiv' style="margin-left: 50px;">
                        <label class="control-label" for="input03">종료일</label>
                        <div class="controls">
                            <!--                        <input type="text" class="input-xlarge" id="input03" name="due_date">-->
                            <div class = 'endDateForm'>
                            <?php echo form_input($exOpt1)?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
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
                        </div>
                    </div>
                    <div id = 'contentsDiv'>
                        <label class="control-label" for="input01">내용</label>
                        <div class="controls">
    <!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
                            <?php echo form_textarea('content', set_value('content'), $extraOpt)?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용 -->
    <!--                        --><?php //echo form_textarea('content', set_value('content'), "style=width:100%; height:50%; resize:none;")?><!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용 -->
                            <div class = 'contentsForm'>
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
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" id="write_btn" value="작성" />
                    </div>
                </div>
            </fieldset>
<!--        </form>-->
        <?php echo form_close();?>
    </article>


<script type="text/javascript">
    $(function(){
        $("#sdate").datepicker({
            dateFormat:"YYYY-MM-DD"
        });
        $("#edate").datepicker({
            dateFormat:"YY-MM-DD"
        });
    });

    </script>


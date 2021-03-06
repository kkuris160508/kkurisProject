<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!--<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js" integrity="sha256-PsB+5ZEsBlDx9Fi/GXc1bZmC7wEQzZK4bM/VwNm1L6c=" crossorigin="anonymous"></script>-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>-->
<?php echo form_open('/Main/write')?>
<!--        <form class="form-horizontal" accept-charset="utf-8" method="post" action="" id="write_action">--> <!-- form open 사용으로 form 태그 삭제 -->
            <fieldset>
                <div class="control-group">
                    <?php
                    $extraOpt = array(
                        'style'       => 'width:100%;height:50%;resize:none;'
                    );
                    $exOpt = array(
                        'id'          => 'created_on',
                        'name'        => 'created_on',
                        'data'        => 'created_on',
                        'value'       => set_value('created_on'),
                        'placeholder' => 'YYYY-MM-DD'
                    );
                    $exOpt1 = array(
                        'id'          => 'due_date',
                        'name'        => 'due_date',
                        'data'        => 'due_date',
                        'value'       => set_value('due_date'),
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
                    <div id = 'startDate' style="float: left; margin-left: 50px; margin-right: 10px;">
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
                    <div id = 'endDateDiv' style="margin-right: 50px;float:left;">
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
                    <div>
                        <label class="control-label" for="input04"> 상태 </label>
                        <div class="controls">
                            <select name = 'statusSelect' id = 'statusSelect' class = 'statusSelect'>
                                <option value = 'start' <?php echo set_select('statusSelect', 'start', TRUE)?>>시작</option>
                                <option value = 'inProgress' <?php echo set_select('statusSelect', 'inProgress')?>>진행중</option>
                                <option value = 'resolved' <?php echo set_select('statusSelect', 'resolved')?>>완료</option>
                            </select>
                        </div>
                    </div>
                    <br>
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
        $.datepicker.setDefaults({
            dateFormat: "yy-mm-dd",
            buttonImageOnly: false,
            yearSuffix: "년",
            showButtonPanel: true,
            currentText: '오늘날짜',
            closeText: '닫기',
            nextText: '다음달',
            prevText: '이전달',
            changeMonth: true,
            changeYear: true,
            gotoCurrent: true,
            autoClose: true
        });

        var date = $(this).datepicker('getDate');

        var startDate;
        $("#created_on").datepicker({
            onSelect: function (selected1) {
                $("input[name='created_on']").val();

                startDate = $("input[name='created_on']").val();

                $("#due_date").datepicker("option","minDate",selected1);
            }
        });
        $("#created_on").datepicker("setDate", new Date());

        $("#due_date").datepicker({
            onSelect: function (selected2) {
                $("input[name='due_date']").val();
                $("#created_on").datepicker("option","maxDate",selected2);
            }
        });

        $("#due_date").datepicker("setDate", new Date());
    });

</script>


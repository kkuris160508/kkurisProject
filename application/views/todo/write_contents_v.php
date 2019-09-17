<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<?php echo form_open('/Main/write')?>
<!--        <form class="form-horizontal" accept-charset="utf-8" method="post" action="" id="write_action">--> <!-- form open 사용으로 form 태그 삭제 -->
            <fieldset>
                <div class="control-group">
                    <?php
                    $extraOpt = array(
                        'style'       => 'width:100%;height:50%;resize:none;'
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
                            <?php echo form_input('created_on', set_value('created_on'), "placeholder='YYYY-MM-DD'")?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
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
                            <?php echo form_input('due_date',set_value('due_date'),"placeholder='YYYY-MM-DD'")?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
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
    $(function(){ // 날짜 입력

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();

        if(dd < 10){
            dd = '0'+dd
        }

        if(mm < 10){
            mm = '0'+mm
        }

        today = yyyy+'/'+mm+'/'+dd;     //오늘날짜 ex. 2016/11/12
        var todaydate = [today];        //배열에 넣음


        $("#startDate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yymmdd",
            minDate: 0,
            maxDate: '+1Y+6M',
            showButtonPanel: true,

            beforeShowDay: function(dateStr){
                var dd = dateStr.getDate();
                var mm = dateStr.getMonth()+1;
                var yyyy = dateStr.getFullYear();

                if(dd < 10){
                    dd = '0'+dd
                }

                if(mm < 10){
                    mm = '0'+mm
                }

                date = yyyy+'/'+mm+'/'+dd;        //jquery 달력의 날짜를 yyyy/mm/dd 형태로 만듬.
                var Highlight = todaydate[date];    //스타일을 적용할 날짜

                if ($.inArray(date, todaydate) >= 0) {    //jquery달력의 날짜가 오늘날짜와 같다면
                    return [true, "Highlighted", Highlight];    //스타일 적용
                } else {
                    return [true, '', ''];
                }
            }
        });
    });

    </script>


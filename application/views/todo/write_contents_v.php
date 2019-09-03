
        <?php echo form_open('/Main/write')?>
<!--        <form class="form-horizontal" accept-charset="utf-8" method="post" action="" id="write_action">--> <!-- form open 사용으로 form 태그 삭제 -->
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input00">제목</label>
                    <div class="controls">
                        <!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
                        <?php echo form_input('subject')?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                        <p class="help-block"></p>
                    </div>
                    <label class="control-label" for="input01">내용</label>
                    <div class="controls">
<!--                        <input type="text" class="input-xlarge" id="input01" name="content">-->
                        <?php echo form_input('content')?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                        <p class="help-block"></p>
                    </div>
                    <label class="control-label" for="input02">시작일</label>
                    <div class="controls">
<!--                        <input type="text" class="input-xlarge" id="input02" name="created_on">-->
                        <?php echo form_input('created_on', '',"placeholder='YYYY-MM-DD'")?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                        <p class="help-block"></p>
                    </div>
                    <label class="control-label" for="input03">종료일</label>
                    <div class="controls">
<!--                        <input type="text" class="input-xlarge" id="input03" name="due_date">-->
                        <?php echo form_input('due_date','',"placeholder='YYYY-MM-DD'")?> <!-- form open 사용해야함 csrf protection TRUE 일 때 POST 방식으로 DB 접근권한을 한번 막기때문에 form open 사용-->
                        <p class="help-block"></p>
                    </div>

                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" id="write_btn" value="작성" />
                    </div>
                </div>
            </fieldset>
<!--        </form>-->
        <?php echo form_close();?>
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



        <?php echo form_open('/Main/write')?>

            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input01">내용</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input01" name="content">
                        <?php echo form_input('content')?>
                        <p class="help-block"></p>
                    </div>
                    <label class="control-label" for="input02">시작일</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input02" name="created_on">
                        <?php echo form_input('created_on')?>
                        <p class="help-block"></p>
                    </div>
                    <label class="control-label" for="input03">종료일</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input03" name="due_date">
                        <?php echo form_input('due_date')?>
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
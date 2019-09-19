<?php echo form_open('/Main/edit')?>

<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th colspan = "7"><?php echo $views -> id;?> 번 할일</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="col">상태</th>
        <th scope="col">작성자</th>
        <th scope="col">제목</th>
        <th scope="col">시작일</th>
        <th scope="col">종료일</th>
        <th scope="col">조회수</th>
        <th scope="col">작성일</th>
    </tr>
    <tr>
        <th>
            <?php echo $views -> status;?>

        </th>
        <th>
            <a href="mailto:<?php echo $views -> EMAIL?>"><?php echo $views -> account_id;?></a>
            <?php $transID = $views->no;?>
            <?php $transAccountID = $views->account_id;?>
        </th>
        <th>
<!--            --><?php //echo $views -> subject;?>
            <?php echo form_input('subject',set_value($views->subject))?>
        </th>
        <th>
            <?php echo $views -> created_on;?>
        </th>
        <th>
            <?php echo $views -> due_date;?>
        </th>
        <th>
            <?php echo $views -> hit;?>
        </th>
        <th>
            <?php echo $views -> writetime;?>
        </th>
    </tr>
    <tr>
        <th rowspan="2">내용</th>
        <th colspan="5">
<!--            --><?php //echo $views -> content;?>
            <?php echo form_input('content',set_value($views->content))?>
        </th>
    </tr>



    </tbody>
    <tfoot>
<!--    <tr>-->
<!--        <th colspan="6">-->
<!--            <a href="http://34.80.199.17/Main/edit/" class="btn btn-success">완료</a> //완료 시 form action -->
<!--        </th>-->
<!--    </tr>-->
    </tfoot>
    <div class="form-actions">
        <input type="submit" class="btn btn-primary" id="write_btn" value="완료" />
    </div>
</table>
</article>

<?php echo form_close();?>
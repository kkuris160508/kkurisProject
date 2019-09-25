<?php echo form_open('/Main/reply')?>
<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th colspan = "7" name = 'id'><?php echo $views -> id;?> 번 할일</th>
        <?php echo form_hidden('id',$views->id)?>
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
        <th name="accountID">
            <a href="mailto:<?php echo $views -> EMAIL?>"><?php echo $views -> account_id;?></a>
            <?php $transID = $views->no;?>
            <?php $transAccountID = $views->account_id;?>
            <!--                    --><?php //form_hidden('accountID',$transAccountID)?>
        </th>
        <th>
            <?php echo $views -> subject;?>
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
        <th>내용</th>
        <th colspan="7">
            <?php echo nl2br($views -> content);?> <!-- 게시글 줄바꿈 처리-->
        </th>
    </tr>

    <tr>
        <td>댓글</td>
        <td colspan="6" name = 'replyContent'>
<!--            --><?php
//            $extraOpt = array(
//                'style'       => 'width:100%;height:50%;resize:none;',
//                'placeholder' => '댓글영역'
//            );
//            ?>
            <?php echo form_textarea('replyContent');?>
        </td>
    </tr>

    </tbody>
    <tfoot>

    <tr>
        <td>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" id="write_btn" value="완료" />
            </div>
        </td>
    </tr>

    </tfoot>
</table>
</article>
<?php form_close();?>


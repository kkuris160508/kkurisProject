
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
                <th>
                    <a href="mailto:<?php echo $views -> EMAIL?>"><?php echo $views -> account_id;?></a>
                    <?php $transID = $views->no;?>
                    <?php $transAccountID = $views->account_id;?>
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
                <th rowspan="2">내용</th>
                <th colspan="6">
                    <?php echo $views -> content;?>
                </th>
            </tr>



            </tbody>
            <tfoot>
            <tr>
                <th colspan="6">
                    <a href="http://34.80.199.17/Main/lists/" class="btn btn-primary">목록</a>
                    <a href="http://34.80.199.17/Main/delete/<?php echo $this -> uri -> segment(3); ?>/<?php echo $transID; ?>/<?php echo $transAccountID; ?>" class="btn btn-danger">삭제</a>
                    <a href="http://34.80.199.17/Main/write/" class="btn btn-success">쓰기</a>
                    <a href="http://34.80.199.17/Main/edit/<?php echo $this -> uri -> segment(3); ?>" class="btn btn-success">수정</a>
                </th>
            </tr>
            </tfoot>
        </table>
    </article>


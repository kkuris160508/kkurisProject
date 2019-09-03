
        <table cellspacing="0" cellpadding="0" class="table table-striped">
            <thead>
            <tr>
                <th scope="col"><?php echo $views -> id;?> 번 할일</th>
                <th scope="col"><?php echo $views -> content;?></th>
                <th scope="col">시작일</th>
                <th scope="col">종료일</th>
                <th scope="col">조회수</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>
                    <?php echo $views -> subject;?>
                </th>
                <th>
                    <?php echo $views -> content;?>
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
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="4">
                    <a href="http://34.80.199.17/Main/lists/" class="btn btn-primary">목록</a>
                    <a href="http://34.80.199.17/Main/delete/<?php echo $this -> uri -> segment(3); ?>" class="btn btn-danger">삭제</a>
                    <a href="http://34.80.199.17/Main/write/" class="btn btn-success">쓰기</a>
                </th>
            </tr>
            </tfoot>
        </table>
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


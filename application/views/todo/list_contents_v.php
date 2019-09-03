        <table cellspacing="0" cellpadding="0" class="table table-striped">
            <thead>
            <tr>
                <th scope="col">번호</th>
                <th scope="col">내용</th>
                <th scope="col">시작일</th>
                <th scope="col">종료일</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($list as $lt)
            {
                ?>
                <tr>
                    <th scope="row"><?php echo $lt -> board_id;?></th>
                    <td><a rel="external" href="/bbs/<?php echo $this -> uri -> segment(1); ?>/view/<?php echo $this -> uri -> segment(3); ?>/<?php echo $lt -> board_id; ?>"> <?php echo $lt -> subject;?></a></td>
                    <td><?php echo $lt -> user_name;?></td>
                    <td><?php echo $lt -> hits;?></td>
                    <td>
                        <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> reg_date)); ?>">
                            <?php echo mdate("%Y-%M-%j", human_to_unix($lt -> reg_date));?>
                        </time></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="4"><a href="/Main/write/" class="btn btn-success">
                        쓰기
                    </a></th>
            </tr>
            </tfoot>
        </table>
        <div><p></p></div>
    </article>

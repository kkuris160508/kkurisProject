
<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">번호</th>
        <th scope="col">작성자</th>
        <th scope="col">제목</th>
        <th scope="col">내용</th>
        <th scope="col">시작일</th>
        <th scope="col">종료일</th>
        <th scope="col">조회수</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $lt) : ?>
        <tr>
            <th scope="row">
                <?php echo $lt -> id;?>
            </th>
            <th scope="row">
                <?php echo $lt -> account_id;?>
            </th>
            <td>
                <a rel="external" href="/Main/view/<?php echo $lt -> id; ?>"><?php echo $lt -> subject;?></a>
            </td>
            <td>
                <a rel="external" href="/Main/view/<?php echo $lt -> id; ?>"><?php echo $lt -> content;?></a>
            </td>
            <td>
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> created_on)); ?>"><?php echo $lt -> created_on;?></time>
            </td>
            <td>
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> due_date)); ?>"><?php echo $lt -> due_date;?></time>
            </td>
            <!-- 조회수 영역 추가-->
            <td>
                <?php echo $lt -> hit;?>
            </td>
        </tr>
        <?php endforeach?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="7"><a href="/Main/write/" class="btn btn-success">
                쓰기
            </a></th>
    </tr>
    <tr>
        <ul class = "pagination">
            <!--            --><?php //foreach() : ?>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <!--            --><?php //endforeach?>
        </ul>
    </tr>
    </tfoot>
</table>

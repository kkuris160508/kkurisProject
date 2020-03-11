<!--<a href="/Auth/login/" class="btn btn-success">로그인/회원가입</a>-->
<?php
    $opt = array(
        'style' => 'text-overflow:ellipsis;word-wrap:break-word;overflow:hidden;white-space:nowrap;display:inline-block;width:500px;'
    )
?>

</header>
<table class="table table-striped" style="width: 1700px; text-align: center">
    <thead class="thead-dark">
    <tr>
        <th scope="col">번호</th>
        <th scope="col">상태</th>
        <th scope="col">작성자</th>
        <th scope="col">제목</th>
<!--        <th scope="col">내용</th>-->
        <th scope="col">시작일</th>
        <th scope="col">종료일</th>
        <th scope="col">조회수</th>
        <th scope="col">작성시간</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $lt) : ?>
        <tr>

            <th scope="row" style="width: 100px;">
                <?php echo form_checkbox('id', 'accept', false);?>
                <?php echo $lt -> id;?>
            </th>
            <th scope="row" style="width: 100px;">
                <?php echo $lt -> status;?>
            </th>
            <th scope="row" style="width: 150px;">
                <a href="mailto:<?php echo $lt -> EMAIL?>"><?php echo $lt -> account_id;?></a>
            </th>
            <td style="width: 300px;">
                <a rel="external" href="/Main/view/<?php echo $lt -> id; ?>" style="text-overflow:ellipsis;word-wrap:break-word;overflow:hidden;white-space:nowrap;display:inline-block;width:120px;"><?php echo $lt -> subject;?></a>
            </td>
<!--            <td>-->
<!--                <a rel="external" href="/Main/view/--><?php //echo $lt -> id; ?><!--" style="text-overflow:ellipsis;word-wrap:break-word;overflow:hidden;white-space:nowrap;display:inline-block;width:500px;">--><?php //echo $lt -> content;?><!--</a>-->
<!--            </td>-->
            <td style="width: 200px;">
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> created_on)); ?>"><?php echo $lt -> created_on;?></time>
            </td>
            <td style="width: 200px;">
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> due_date)); ?>"><?php echo $lt -> due_date;?></time>
            </td>
            <!-- 조회수 영역 추가-->
            <td style="width: 100px;">
                <?php echo $lt -> hit;?>
            </td>
            <td style="width: 200px;">
                <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt -> writetime)); ?>"><?php echo $lt -> writetime;?></time>
            </td>
        </tr>
    <?php endforeach?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="8"><?php echo $pagination;?></th>
    </tr>
    </tfoot>
</table>
<div style="width: 1700px; text-align: end">
    <a href="/Main/write/" class="btn btn-success">쓰기</a>
</div>


<?php echo form_open('/Main/searchText')?>
    <table style="width: 1000px;">
    <td>
        <td style="width:80px">
            <!-- 드랍박스 메뉴 추가 -->
            <select name = 'selectCategory' id = 'selectCategory' class = 'selectCategory'>
                <option value = 'subject' <?php echo set_select('selectCategory','subject', TRUE); ?>>제목</option>
                <option value = 'content' <?php echo set_select('selectCategory','content'); ?>>내용</option>
                <option value = 'account_id' <?php echo set_select('selectCategory','account_id'); ?>>작성자</option>
            </select>
        </td>
        <td colspan = '6' style="width:800px"><?php echo form_input('searchTxt','',"placeholder='검색어를 입력하세요'; style = 'width:850px;'")?></td>
        <td> <div class="form-actions"><input type ='submit' class="btn btn-primary" id = 'searchLists' value="검색"></div></td>

        <!-- input 영역 추가 -->
    </tr>
    </table>
<?php echo form_close();?>

<td> <input type ='submit' class="btn btn-success" name = 'searchTxtReset' value="reset"></td>
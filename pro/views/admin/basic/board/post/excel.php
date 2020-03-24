
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo config_item('charset');?>" />
<style type="text/css">
th {font-weight:bold;padding:5px; min-width:120px; width:120px; _width:120px; text-align:center; line-height:18px; font-size:12px; color:#959595; font-family:dotum,돋움; border-right:1px solid #e4e4e4;}
td {text-align:center; line-height:40px; font-size:12px; color:#474747; font-family:gulim,굴림; border-right:1px solid #e4e4e4;}
</style>
<table width="100%" border="1" bordercolor="#E4E4E4" cellspacing="0" cellpadding="0">
		<tr>
			<th>게시판</th>
			<th>제목</th>
			<th>작성자</th>
            <th>조회</th>
            <th>추천/비추</th>
            <th>날짜</th>
            <th>IP주소</th>
            <th>상태</th>
		</tr>
	<?php
	if (element('list', element('data', $view))) {
		foreach (element('list', element('data', $view)) as $result) {
	?>
			<tr>
                <td><?php echo html_escape(element('brd_name', element('board', $result))); ?></td>
                <td><?php echo element('post_title', $result);?></td>
                <td><?php echo element('post_userid', $result);?></td>
                <td><?php echo element('post_hit', $result);?></td>
                <td><?php echo element('post_like', $result);?> / <?php echo element('post_dislike', $result);?></td>
                <td><?php echo element('post_datetime', $result);?></td>
                <td><?php echo element('post_ip', $result);?></td>
                <td><?php echo element('post_secret', $result) === '1' ? '비밀' : '공개'; ?></td>
			</tr>
		<?php
			}
		}
		?>
</table>

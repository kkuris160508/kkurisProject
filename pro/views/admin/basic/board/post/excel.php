<?php
/////**
////* Created by PhpStorm.
////* User: chris
////* Date: 2020-03-23
////* Time: 오후 4:06
////*/
//
//echo 2;
//?>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo config_item('charset');?>" />
<style type="text/css">
th {font-weight:bold;padding:5px; min-width:120px; width:120px; _width:120px; text-align:center; line-height:18px; font-size:12px; color:#959595; font-family:dotum,돋움; border-right:1px solid #e4e4e4;}
td {text-align:center; line-height:40px; font-size:12px; color:#474747; font-family:gulim,굴림; border-right:1px solid #e4e4e4;}
</style>
<table width="100%" border="1" bordercolor="#E4E4E4" cellspacing="0" cellpadding="0">
		<tr>
			<th>게시판</th>
			<th>이미지</th>
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
				<td height="30"><?php echo html_escape(element('mem_userid', $result)); ?></td>
				<td>
					<span><?php echo html_escape(element('mem_username', $result)); ?></span>
					<?php echo element('mem_is_admin', $result) ? '(최고관리자)' : ''; ?>
					<?php echo element('mem_denied', $result) ? '(차단회원)' : ''; ?>
				</td>
				<td><?php echo html_escape(element('mem_nickname', $result)); ?></td>
				<td><?php echo html_escape(element('mem_email', $result)); ?></td>
				<?php if ($this->cbconfig->item('use_selfcert')) { ?>
					<td>
						<?php
						echo (element('selfcert_type', element('meta', $result)) === 'phone') ? '휴대폰 ' : '';
						echo (element('selfcert_type', element('meta', $result)) === 'ipin') ? 'IPIN ' : '';
						echo is_adult(element('selfcert_birthday', element('meta', $result))) ? '성인' : '';
						?>
					</td>
				<?php } ?>
				<?php if ($this->cbconfig->item('use_sociallogin')) { ?>
					<td>
						<?php if ($this->cbconfig->item('use_sociallogin_facebook') && element('facebook_id', element('social', $result))) { ?>페이스북 <?php } ?>
						<?php if ($this->cbconfig->item('use_sociallogin_twitter') && element('twitter_id', element('social', $result))) { ?>트위터 <?php } ?>
						<?php if ($this->cbconfig->item('use_sociallogin_google') && element('google_id', element('social', $result))) { ?>구글 <?php } ?>
						<?php if ($this->cbconfig->item('use_sociallogin_naver') && element('naver_id', element('social', $result))) { ?>네이버 <?php } ?>
						<?php if ($this->cbconfig->item('use_sociallogin_kakao') && element('kakao_id', element('social', $result))) { ?>카카오 <?php } ?>
					</td>
				<?php } ?>
				<td><?php echo number_format(element('mem_point', $result)); ?></td>
				<td><?php echo number_format((int) element('total_deposit', element('meta', $result))); ?></td>
				<td><?php echo element('mem_register_datetime', $result); ?></td>
				<td><?php echo element('mem_lastlogin_datetime', $result); ?></td>
				<td><?php echo element('member_group', $result); ?></td>
				<td><?php echo element('mem_level', $result); ?></td>
				<td>
					<?php echo element('mem_email_cert', $result) ? 'O' : 'X';; ?>
					<?php echo element('mem_open_profile', $result) ? 'O' : 'X';; ?>
					<?php echo element('mem_receive_email', $result) ? 'O' : 'X';; ?>
					<?php echo element('mem_use_note', $result) ? 'O' : 'X';; ?>
					<?php echo element('mem_receive_sms', $result) ? 'O' : 'X';; ?>
				</td>
				<td><?php echo element('mem_denied', $result) ? '차단' : '승인'; ?></td>
			</tr>
		<?php
			}
		}
		?>
</table>

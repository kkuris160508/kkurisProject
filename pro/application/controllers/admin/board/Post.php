<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Post class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 관리자>게시판설정>게시물관리 controller 입니다.
 */
class Post extends CB_Controller
{

	/**
	 * 관리자 페이지 상의 현재 디렉토리입니다
	 * 페이지 이동시 필요한 정보입니다
	 */
	public $pagedir = 'board/post';

	/**
	 * 모델을 로딩합니다
	 */
	protected $models = array('Post', 'Board', 'Post_file', 'Post_meta', 'Board_category');

	/**
	 * 이 컨트롤러의 메인 모델 이름입니다
	 */
	protected $modelname = 'Post_model';

	/**
	 * 헬퍼를 로딩합니다
	 */
	protected $helpers = array('form', 'array');

	function __construct()
	{
		parent::__construct();

		/**
		 * 라이브러리를 로딩합니다
		 */
		$this->load->library(array('pagination', 'querystring'));
	}

	/**
	 * 목록을 가져오는 메소드입니다
	 */
	public function index()
	{
		// 이벤트 라이브러리를 로딩합니다
		$eventname = 'event_admin_board_post_index';
		$this->load->event($eventname);

		$view = array();
		$view['view'] = array();

		// 이벤트가 존재하면 실행합니다
		$view['view']['event']['before'] = Events::trigger('before', $eventname);

		/**
		 * 페이지에 숫자가 아닌 문자가 입력되거나 1보다 작은 숫자가 입력되면 에러 페이지를 보여줍니다.
		 */
		$param =& $this->querystring;
		$page = (((int) $this->input->get('page')) > 0) ? ((int) $this->input->get('page')) : 1;
		$findex = 'post_id';
		$forder = 'desc';
		$sfield = $this->input->get('sfield', null, '');
		$skeyword = $this->input->get('skeyword', null, '');

		$per_page = admin_listnum();
		$offset = ($page - 1) * $per_page;

		/**
		 * 게시판 목록에 필요한 정보를 가져옵니다.
		 */
		$this->{$this->modelname}->allow_search_field = array('post_id', 'post_title', 'post_content', 'mem_id', 'post_username', 'post_nickname', 'post_email', 'post_homepage', 'post_datetime', 'post_ip', 'post_device'); // 검색이 가능한 필드
		$this->{$this->modelname}->search_field_equal = array('post_id', 'mem_id'); // 검색중 like 가 아닌 = 검색을 하는 필드
		$this->{$this->modelname}->allow_order_field = array('post_id'); // 정렬이 가능한 필드
		$where = array(
			'post_del <>' => 2,
		);
		if ($brdid = (int) $this->input->get('brd_id')) {
			$where['brd_id'] = $brdid;
		}
		$result = $this->{$this->modelname}
			->get_admin_list($per_page, $offset, $where, '', $findex, $forder, $sfield, $skeyword);
		$list_num = $result['total_rows'] - ($page - 1) * $per_page;
		if (element('list', $result)) {
			foreach (element('list', $result) as $key => $val) {
				$result['list'][$key]['post_display_name'] = display_username(
					element('post_userid', $val),
					element('post_nickname', $val)
				);
				$result['list'][$key]['board'] = $board = $this->board->item_all(element('brd_id', $val));
				$result['list'][$key]['num'] = $list_num--;
				if ($board) {
					$result['list'][$key]['boardurl'] = board_url(element('brd_key', $board));
					$result['list'][$key]['posturl'] = post_url(element('brd_key', $board), element('post_id', $val));
				}
				$result['list'][$key]['category'] = '';
				if (element('post_category', $val)) {
					$result['list'][$key]['category'] = $this->Board_category_model->get_category_info(element('brd_id', $val), element('post_category', $val));
				}
				if (element('post_image', $val)) {
					$imagewhere = array(
						'post_id' => element('post_id', $val),
						'pfi_is_image' => 1,
					);
					$file = $this->Post_file_model->get_one('', '', $imagewhere, '', '', 'pfi_id', 'ASC');
					$result['list'][$key]['thumb_url'] = thumb_url('post', element('pfi_filename', $file), 80);
				} else {
					$result['list'][$key]['thumb_url'] = get_post_image_url(element('post_content', $val), 80);
				}
			}
		}
		$view['view']['data'] = $result;

		$select = 'brd_id, brd_name';
		$view['view']['boardlist'] = $this->Board_model->get_board_list();

		/**
		 * primary key 정보를 저장합니다
		 */
		$view['view']['primary_key'] = $this->{$this->modelname}->primary_key;

		/**
		 * 페이지네이션을 생성합니다
		 */
		$config['base_url'] = admin_url($this->pagedir) . '?' . $param->replace('page');
		$config['total_rows'] = $result['total_rows'];
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$view['view']['paging'] = $this->pagination->create_links();
		$view['view']['page'] = $page;

		/**
		 * 쓰기 주소, 삭제 주소등 필요한 주소를 구합니다
		 */
		$search_option = array('post_title' => '제목', 'post_content' => '내용', 'post_username' => '실명', 'post_nickname' => '닉네임', 'post_email' => '이메일', 'post_homepage' => '홈페이지', 'post_datetime' => '작성일', 'post_ip' => 'IP');
		$view['view']['skeyword'] = ($sfield && array_key_exists($sfield, $search_option)) ? $skeyword : '';
		$view['view']['search_option'] = search_option($search_option, $sfield);
		$view['view']['listall_url'] = admin_url($this->pagedir);
		$view['view']['list_delete_url'] = admin_url($this->pagedir . '/listdelete/?' . $param->output());
		$view['view']['list_trash_url'] = admin_url($this->pagedir . '/listtrash/?' . $param->output());

		// 이벤트가 존재하면 실행합니다
		$view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

		/**
		 * 어드민 레이아웃을 정의합니다
		 */
		$layoutconfig = array('layout' => 'layout', 'skin' => 'index');
		$view['layout'] = $this->managelayout->admin($layoutconfig, $this->cbconfig->get_device_view_type());
		$this->data = $view;
		$this->layout = element('layout_skin_file', element('layout', $view));
		$this->view = element('view_skin_file', element('layout', $view));
	}

	/**
	 * 목록 페이지에서 선택삭제를 하는 경우 실행되는 메소드입니다
	 */
	public function listdelete()
	{
		// 이벤트 라이브러리를 로딩합니다
		$eventname = 'event_admin_board_post_listdelete';
		$this->load->event($eventname);

		// 이벤트가 존재하면 실행합니다
		Events::trigger('before', $eventname);

		/**
		 * 체크한 게시물의 삭제를 실행합니다
		 */
		if ($this->input->post('chk') && is_array($this->input->post('chk'))) {
			foreach ($this->input->post('chk') as $val) {
				if ($val) {
					$this->board->delete_post($val);
				}
			}
		}

		// 이벤트가 존재하면 실행합니다
		Events::trigger('after', $eventname);

		/**
		 * 삭제가 끝난 후 목록페이지로 이동합니다
		 */
		$this->session->set_flashdata(
			'message',
			'정상적으로 삭제되었습니다'
		);
		$param =& $this->querystring;
		$redirecturl = admin_url($this->pagedir . '?' . $param->output());
		redirect($redirecturl);
	}

	/**
	 * 목록 페이지에서 휴지통을 클릭한 경우 실행되는 메소드입니다
	 */
	public function listtrash()
	{
		// 이벤트 라이브러리를 로딩합니다
		$eventname = 'event_admin_board_post_listtrash';
		$this->load->event($eventname);

		// 이벤트가 존재하면 실행합니다
		Events::trigger('before', $eventname);

		/**
		 * 체크한 게시물의 삭제를 실행합니다
		 */
		if ($this->input->post('chk') && is_array($this->input->post('chk'))) {
			foreach ($this->input->post('chk') as $val) {
				if ($val) {
					$updatedata = array(
						'post_del' => 2,
					);
					$this->Post_model->update($val, $updatedata);
					$metadata = array(
						'trash_mem_id' => $this->member->item('mem_id'),
						'trash_datetime' => cdate('Y-m-d H:i:s'),
						'trash_ip' => $this->input->ip_address(),
					);
					$board = $this->Post_model->get_one($val, 'brd_id');
					$this->Post_meta_model->save($val, element('brd_id', $board), $metadata);
				}
			}
		}

		// 이벤트가 존재하면 실행합니다
		Events::trigger('after', $eventname);

		/**
		 * 삭제가 끝난 후 목록페이지로 이동합니다
		 */
		$this->session->set_flashdata(
			'message',
			'정상적으로 휴지통으로 이동되었습니다'
		);
		$param =& $this->querystring;
		$redirecturl = admin_url($this->pagedir . '?' . $param->output());
		redirect($redirecturl);
	}
    public function excel()
    {
        echo 1;
        // 이벤트 라이브러리를 로딩합니다
//        $eventname = 'event_admin_member_members_excel';
//        $eventname = 'event_admin_board_post_excel';
//        $this->load->event($eventname);
//
//        $view = array();
//        $view['view'] = array();
//
//        // 이벤트가 존재하면 실행합니다
//        $view['view']['event']['before'] = Events::trigger('before', $eventname);

//        /**
//         * 페이지에 숫자가 아닌 문자가 입력되거나 1보다 작은 숫자가 입력되면 에러 페이지를 보여줍니다.
//         */
//        $param =& $this->querystring;
//        $findex = $this->input->get('findex', null, 'member.mem_id');
//        $forder = $this->input->get('forder', null, 'desc');
//        $sfield = $this->input->get('sfield', null, '');
//        $skeyword = $this->input->get('skeyword', null, '');
//
//        /**
//         * 게시판 목록에 필요한 정보를 가져옵니다.
//         */
//        $this->{$this->modelname}->allow_search_field = array('mem_id', 'mem_userid', 'mem_email', 'mem_username', 'mem_nickname', 'mem_level', 'mem_homepage', 'mem_register_datetime', 'mem_register_ip', 'mem_lastlogin_datetime', 'mem_lastlogin_ip', 'mem_is_admin'); // 검색이 가능한 필드
//        $this->{$this->modelname}->search_field_equal = array('mem_id', 'mem_level', 'mem_is_admin'); // 검색중 like 가 아닌 = 검색을 하는 필드
//        $this->{$this->modelname}->allow_order_field = array('member.mem_id', 'mem_userid', 'mem_username', 'mem_nickname', 'mem_email', 'mem_point', 'mem_register_datetime', 'mem_lastlogin_datetime', 'mem_level'); // 정렬이 가능한 필드
//
//        $where = array();
//        if ($this->input->get('mem_is_admin')) {
//            $where['mem_is_admin'] = 1;
//        }
//        if ($this->input->get('mem_denied')) {
//            $where['mem_denied'] = 1;
//        }
//        if ($mgr_id = (int) $this->input->get('mgr_id')) {
//            if ($mgr_id > 0) {
//                $where['mgr_id'] = $mgr_id;
//            }
//        }
//        $result = $this->{$this->modelname}
//            ->get_admin_list('', '', $where, '', $findex, $forder, $sfield, $skeyword);
//
//        if (element('list', $result)) {
//            foreach (element('list', $result) as $key => $val) {
//
//                $where = array(
//                    'mem_id' => element('mem_id', $val),
//                );
//                $result['list'][$key]['member_group_member'] = $this->Member_group_member_model->get('', '', $where, '', 0, 'mgm_id', 'ASC');
//                $mgroup = '';
//                if ($result['list'][$key]['member_group_member']) {
//                    foreach ($result['list'][$key]['member_group_member'] as $mk => $mv) {
//                        if (element('mgr_id', $mv)) {
//                            $mgroup[] = $this->Member_group_model->item(element('mgr_id', $mv));
//                        }
//                    }
//                }
//                $result['list'][$key]['member_group'] = '';
//                if ($mgroup) {
//                    foreach ($mgroup as $mk => $mv) {
//                        if ($result['list'][$key]['member_group']) {
//                            $result['list'][$key]['member_group'] .= ', ';
//                        }
//                        $result['list'][$key]['member_group'] .= element('mgr_title', $mv);
//                    }
//                }
//                $result['list'][$key]['display_name'] = display_username(
//                    element('mem_userid', $val),
//                    element('mem_nickname', $val),
//                    element('mem_icon', $val)
//                );
//                $result['list'][$key]['meta'] = $this->Member_meta_model->get_all_meta(element('mem_id', $val));
//                $result['list'][$key]['social'] = $this->Social_meta_model->get_all_meta(element('mem_id', $val));
//            }
//        }
//
//        $view['view']['data'] = $result;
//        $view['view']['all_group'] = $this->Member_group_model->get_all_group();
//
//        /**
//         * primary key 정보를 저장합니다
//         */
//        $view['view']['primary_key'] = $this->{$this->modelname}->primary_key;
//

        // 이벤트가 존재하면 실행합니다
//        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

//        header('Content-type: application/vnd.ms-excel');
//        header('Content-Disposition: attachment; filename=게시물_' . cdate('Y_m_d') . '.xls');
//        echo $this->load->view('admin/' . ADMIN_SKIN . '/' . $this->pagedir . '/excel', $view, true);

//        echo $this->load->view('admin/basic/board/post/excel', true);
    }
}

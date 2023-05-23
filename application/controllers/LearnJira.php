<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LearnJira extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('myjira');
		$this->load->helper('project_jira');
	}
	public function index()
	{

//		echo add_comment('XXXXX-3','test1');// thêm comment 'test1' vào XXXXX-3
//		echo get_comment('XXXXX-3');// lấy tất cả comment của XXXXX-3
//		echo update_comment('XXXXX-3','10001','Hello Jira'); // sửa nội dung comment có id là 10001 thành 'Hello Jira'
//		echo delete_comment('XXXXX-3','10002');// Xóa comment có id là 10002
//		echo set_transition('XXXXX-7','bug','TEST'); // chuyển task XXXX-7 sang transitionname bug với comment là test

		// làm việc với project
//		echo Get_Project_Info('XXX1');
//		echo get_all_project_list();
//		echo Get_project_version('XXX1');
//		echo Get_Project_Components();
//		echo Get_project_type();
//		echo get_pagenated_project_versions('XXXXX');
//		echo create_project();
//		echo updateproject('XXX1','TEST2');

//		echo get_All_Fields(); // lay ra tat  ca cac custom fields
//		echo create_custom_field();// tao moi mot costum_field

//		echo getIssue('XXXXX-3');
//		echo create_issue('XXXXX','bug x3','TEST','nothing');
//		echo create_sub_task('XXXXX','AXX','khong co','TEST','XXXXX-9');
//		echo updateIssue('XXXXX-9','Ngovu','TEST','khong co gi','TASK1');
//		echo update_label('XXXXX-9');

//		echo change_assignee('XXXXX-9','Ngovu');
//		echo change_assignee_by_accountid('XXXXX-10','63419d59409249995eed188e');
//		echo deleteIssues('XXXXX-6');

//		echo read_property_issue('XXXXX-3');

//		echo add_worklog('XXXXX-4','1w 2d 1h');
//		echo get_worklog('XXXXX-4');

		// work with JQL
//		$jql='project in ("XXXXX") AND status in (Done, "In Progress") AND created >= -30d order by created DESC';
//		echo "<br>";
//		echo "<h2> Simple_quuery</h2>";
//		echo Simple_quuery($jql);
//		echo "<br>";
//		echo "<h2>Simple_quuery_with_linkedIssue </h2>";
//		echo Simple_quuery_with_linkedIssue('XXXXX-3');
//		echo "<br>";
//		$jql='project in (LT, XXXXX) order by created DESC';
//		echo "<h2> JQL_with_pagination </h2>";
//		echo "<br>";
//		echo JQL_with_pagination($jql);
//		echo "<br>";
//		echo "<h2>JQL_with_class </h2>";
//		echo JQL_with_class('XXXXX','test','In Progress');

		// issue link
//		echo "<h2>get_issue_link</h2>";
//		echo get_issue_link();
//		echo "<h2>get_remove_issue_link</h2>";
//		echo get_remove_issue_link('XXXXX-3');
//		echo "<h2>create_issue_link</h2>";
//		echo create_issue_link('XXXXX-4','XXXXX-3','Relates','test XXXXX');

		// board và epic
//		echo "<h2>get_board_list</h2>";
//		echo get_board_list();
//		echo "<h2>get_board_info</h2>";
//		echo get_board_info();
//		echo "<h2>get_board_epics</h2>";
//		echo get_board_epics();

		// Attachment tệp đính kèm
//		echo getAttachment('10001');
//		echo getAttachment_save_outDir('10001');
//		echo removeAttachment('10003');

		//user
//		echo "<h2></h2>";
//		echo get_user_info('63419d59409249995eed188e');
//		echo find_user('63419d59409249995eed188e');
//		echo find_user_in_project('XXXXX');
//		echo find_user_by_query();
//		echo create_user('vu','Ngovu19280','ngovu2121@gmail.com','ngovu');
//		echo update_user('ngovu2121@gmail.com','Ngovu19280','ngovu2121@gmail.com','ngovu');
//		echo delete_user('63419d59409249995eed188e');

//		echo "<h2>create_group</h2>";
//		echo create_group();
//		echo get_user_from_group();
//		echo "<h2>get_all_priorty_list</h2>";
//		echo get_all_priorty_list();
//		echo "<h2>get_priorty</h2>";
//		echo get_priorty('3');
	}
}


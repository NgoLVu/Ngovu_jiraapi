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
		echo Get_Project_Info('XXXXX');
		echo get_all_project_list();
		echo Get_project_version('XXX1');
		echo Get_Project_Components();
		echo Get_project_type();
		echo get_pagenated_project_versions('XXXXX');
//		echo updateproject('TES','TEST2');

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
	}
}


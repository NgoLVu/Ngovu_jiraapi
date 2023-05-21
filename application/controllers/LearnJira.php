<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LearnJira extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('myjira');
	}
	public function index()
	{
//		createproject();
		echo getIssue('XXXXX-6');
//		echo Get_Project_Info('XXXXX');
//		echo add_comment('XXXXX-3','hello');
//		echo get_comment('XXXXX-3');
//		echo update_comment('XXXXX-3','10000','Hello World');
//		echo delete_comment('XXXXX-3','10000');
//		echo get_all_project_list();
//		echo Get_project_version('XXXXX');
//		echo Get_Project_Components();
//		echo Get_project_type();
//		echo Get_All_Field_List();
//		echo get_pagenated_project_versions('XXXXX');
//		echo create_custom_field();
//		echo Get_epic_info();
//		echo deleteproject('XXXXX');
//		echo get_user_info('ngovu5122000@gmail.com');
//		echo create_issue('XXXXX','bug x1','TEST','nothing');
//		echo deleteIssues('XXXXX-6');
		echo add_worklog('XXXXX-3','1w 2d 1h');
		echo get_worklog('XXXXX-3');
	}
}


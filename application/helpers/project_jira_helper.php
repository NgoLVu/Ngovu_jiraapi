<?php
require 'vendor/autoload.php';
use JiraRestApi\Project\ProjectService;
use JiraRestApi\Project\Project;
use JiraRestApi\JiraException;

if ( ! function_exists('Get_Project_Info'))
{
	function Get_Project_Info($project)
	{
		try {
			$proj = new ProjectService();

			$p = $proj->get($project);

			var_dump($p);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('create_project')){
	function create_project()
	{
//		try {
			$p = new Project();

			$p->setKey('ZZZZZ')
				->setName('ZZZZZ')
				->setProjectTypeKey('software')
				->setProjectTemplateKey('com.atlassian.jira-core-project-templates:jira-core-project-management')
				->setDescription('This is project')
				->setLeadName('Ngovu')
				->setUrl('http://localcodeign.com/')
				->setAssigneeType('PROJECT_LEAD')
				->setAvatarId(10130)
				->setIssueSecurityScheme(10000)
				->setPermissionScheme(10100)
				->setNotificationScheme(10100)
				->setCategoryId(10100)
;

			$proj = new ProjectService();

			$pj = $proj->createProject($p);

			// 'http://example.com/rest/api/2/project/10042'
			var_dump($pj->self);
			// 10042
			var_dump($pj->id);
//		} catch (JiraRestApi\JiraException $e) {
//			print('Error Occured! ' . $e->getMessage());
//		}
	}
}
if( ! function_exists('updateproject')){
	function updateproject($projectID){
//		try {
			$p = new Project();

			$p->setName('XXX2')
				->setProjectTypeKey('software')
				->setProjectTemplateKey('com.atlassian.servicedesk:itil-v2-service-desk-project')
				->setDescription('Updated Example Project description')
				->setleadAccountId('712020:30552601-5816-4298-b86a-e59cd7e44d98')

//				->setUrl('https://localcodeign.atlassian.net/jira/software/projects/XXX1/')
				->setAssigneeType('PROJECT_LEAD')
				->setAvatarId(10130)
			;

			$proj = new ProjectService();

			$pj = $proj->updateProject($p, $projectID);

			var_dump($pj);
			echo "success";
//		} catch (JiraRestApi\JiraException $e) {
//			print('Error Occured! ' . $e->getMessage());
//		}
	}
}
if( ! function_exists('deleteproject')){
	function deleteproject($project)
	{
		try {
			$proj = new ProjectService();

			$pj = $proj->deleteProject($project);

			var_dump($pj);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('get_all_project_list')){
	function get_all_project_list(){
		try {
			$proj = new ProjectService();

			$prjs = $proj->getAllProjects();

			foreach ($prjs as $p) {
//				echo sprintf('Project Key:%s, Id:%s, Name:%s, projectCategory: %s\n',
//					$p->key, $p->id, $p->name, $p->projectCategory['name']
//				);
				var_dump($p);
			}
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('Get_Project_Components')){
	function Get_Project_Components(){
		try {
			$proj = new ProjectService();

			$prjs = $proj->getAllProjects();

			// Extract and show Project Components for every Jira Project
			foreach ($prjs as $p) {
				var_export($proj->getProjectComponents($p->id));
			}
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('Get_project_type')) {
	function Get_project_type()
	{
		try {
			$proj = new ProjectService();

			// get all project type
			$prjtyps = $proj->getProjectTypes();

			foreach ($prjtyps as $pt) {
				var_dump($pt);
			}

			// get specific project type.
			$pt = $proj->getProjectType('software');
			var_dump($pt);

		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('get_project_version')){
	function get_project_version($projectKey){
		try {
			$proj = new ProjectService();

			$vers = $proj->getVersions($projectKey);

			foreach ($vers as $v) {
				// $v is  JiraRestApi\Issue\Version
				var_dump($v);
			}
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('get_pagenated_project_versions')){
	function get_pagenated_project_versions($project){
//		try {
		$param = [
			'startAt' => 0,
			'maxResults' => 10,
			'orderBy' => 'name',
			//'expand' => null,
		];

		$proj = new ProjectService();

		$vers = $proj->getVersionsPagenated($project, $param);

		foreach ($vers as $v) {
			// $v is  JiraRestApi\Issue\Version
			var_dump($v);
		}
//		} catch (JiraRestApi\JiraException $e) {
//			print('Error Occured! ' . $e->getMessage());
//		}
	}
}

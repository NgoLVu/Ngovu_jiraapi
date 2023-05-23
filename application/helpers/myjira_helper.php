<?php
require 'vendor/autoload.php';

use JiraRestApi\Project\ProjectService;
use JiraRestApi\Project\Project;
use JiraRestApi\JiraException;
use JiraRestApi\Issue\IssueService;
use JiraRestApi\Field\Field;
use JiraRestApi\Field\FieldService;
use JiraRestApi\Issue\Comment;
use JiraRestApi\User\UserService;
use JiraRestApi\Issue\IssueField;
use JiraRestApi\Issue\Worklog;
use JiraRestApi\Issue\Transition;

if ( ! function_exists('getIssue'))
{
	function getIssue($issueKey)
	{
//		$issueService = new IssueService();
//		$issue = $issueService->get($issueKey);
//
//		return $issue->fields->summary;
		try {
			$issueService = new IssueService();

			$queryParam = [
				'fields' => [  // default: '*all'
					'summary',
					'comment',
				],
				'expand' => [
					'renderedFields',
					'names',
					'schema',
					'transitions',
					'operations',
					'editmeta',
					'changelog',
				]
			];
			$issue = $issueService->get($issueKey, $queryParam);

			var_dump($issue->fields);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if ( ! function_exists('create_issue'))
{
	function create_issue($projectkey,$summary,$issuetype,$description)
	{

		try {
			$issueField = new IssueField();

			$issueField->setProjectKey($projectkey)
				->setSummary($summary)
				->setIssueTypeAsString($issuetype)
				->setDescription($description)
//				->addVersionAsString('1.0.1')
//				->addVersionAsArray(['1.0.2', '1.0.3'])
//				->addComponentsAsArray(['Component-1', 'Component-2'])
				// set issue security if you need.
//				->setSecurityId(10001 /* security scheme id */)
//				->setDueDateAsString('2023-06-19')
				// or you can use DateTimeInterface
				//->setDueDateAsDateTime(
				//            (new DateTime('NOW'))->add(DateInterval::createFromDateString('1 month 5 day'))
				// )
			;

			$issueService = new IssueService();

			$ret = $issueService->create($issueField);

			//If success, Returns a link to the created issue.
			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if (! function_exists('updateIssue')) {
	function updateIssue($issueKey,$assigneeName,$issueType,$description,$summary)
	{
		$issueField = new IssueField(true);
		$issueField->setAssigneeNameAsString($assigneeName)
			->setIssueTypeAsString($issueType)
			->setSummary($summary)
			->setDescription($description)
		;
		$editParams = [
			'notifyUsers' => false,
		];
		$issueService = new IssueService();
		$ret = $issueService->update($issueKey, $issueField, $editParams);
		echo "Jira issue create success!";
	}
}
if (! function_exists('update_label')){
	function update_label($issueKey){
		try {
			$issueService = new IssueService();

			$addLabels = [
				'triaged', 'customer-request', 'sales-request'
			];

			$removeLabel = [
				'will-be-remove', 'this-label-is-typo'
			];

			$ret = $issueService->updateLabels($issueKey,
				$addLabels,
				$removeLabel,
				$notifyUsers = false
			);

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'updateLabels Failed : '.$e->getMessage());
		}
	}
}
if (! function_exists('update_fix_versions')){
	function update_fix_versions($issueKey){
		try {
			$issueService = new IssueService();

			$addVersions = [
				'1.1.1', 'named-version'
			];

			$removeVersions = [
				'1.1.0', 'old-version'
			];

			$ret = $issueService->updateFixVersions($issueKey,
				$addVersions,
				$removeVersions,
				$notifyUsers = false
			);

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'updateFixVersions Failed : '.$e->getMessage());
		}
	}
}
if (! function_exists('deleteIssues')) {
	function deleteIssues($issuekey)
	{
//		$issueKey = $issuekey;

		try {
			$issueService = new IssueService();

			$ret = $issueService->deleteIssue($issuekey);
			// if you want to delete issues with sub-tasks
			//$ret = $issueService->deleteIssue($issueKey, array('deleteSubtasks' => 'true'));

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(FALSE, 'Remove Issue Failed : ' . $e->getMessage());
		}
	}
}
if (!function_exists('addAttachment')) {
	function addAttachment($issuekey)
	{
//		$issueKey = 'TEST-879';

		try {
			$issueService = new IssueService();

			// multiple file upload support.
			$ret = $issueService->addAttachments($issuekey,
				['screen_capture.png', 'bug-description.pdf', 'README.md']
			);

			print_r($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(FALSE, 'Attach Failed : ' . $e->getMessage());
		}
	}
}
if ( ! function_exists('create_sub_task')){
	function create_sub_task($projectKey,$summary,$desctription,$subTask,$issueKey){
		try{
		$issueField = new IssueField();

		$issueField->setProjectKey($projectKey)
			->setSummary($summary)
//			->setAssigneeNameAsString('lesstif')
//			->setPriorityNameAsString('Critical')
			->setDescription($desctription)
//			->addVersion('1.0.1')
//			->addVersion('1.0.3')
//			->setIssueTypeAsString($subTask)  //issue type must be Sub-task
//			->setParentKeyOrId($issueKey)  //Issue Key
		;

		$issueService = new IssueService();

		$ret = $issueService->create($issueField);

		//If success, Returns a link to the created sub task.
		var_dump($ret);
	} catch (JiraRestApi\JiraException $e) {
		print('Error Occured! ' . $e->getMessage());
	}
	}
}
if ( ! function_exists('change_assignee')){
	function change_assignee($issueKey,$assignee){
		try {
			$issueService = new IssueService();

			// if assignee is -1, automatic assignee used.
			// A null assignee will remove the assignee.
//			$assignee = 'newAssigneeName';

			$ret = $issueService->changeAssignee($issueKey, $assignee);

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(FALSE, 'Change Assignee Failed : ' . $e->getMessage());
		}
	}
}
if ( ! function_exists('change_assignee_by_accountid')){
	function change_assignee_by_accountid($issueKey,$accountID){
		try {
			$issueService = new IssueService();

//			$accountId = 'usre-account-id';

			$ret = $issueService->changeAssigneeByAccountId($issueKey, $accountID);

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(FALSE, 'Change Assignee Failed : ' . $e->getMessage());
		}
	}
}
if ( ! function_exists('read_property_issue')){
	function read_property_issue($issueKey){
		try {
			$issueService = new IssueService();
			$property = $issueService->getProperty($issueKey, '');
			var_dump($property);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if ( ! function_exists('write_property_issue')){
	function write_property_issue($issueKey){
		try {
			$issueService = new IssueService();
			$property = new Property();
			$property->value = "- First entry\n- second entry";
			$issueService->setProperty($issueKey, $property);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}


if ( ! function_exists('Issue_time_tracking')){
	function Issue_time_tracking($issueKey){
//		$issueKey = 'TEST-961';

		try {
			$issueService = new IssueService();

			// get issue's time tracking info
			$ret = $issueService->getTimeTracking($this->issueKey);
			var_dump($ret);

			$timeTracking = new TimeTracking;

			$timeTracking->setOriginalEstimate('3w 4d 6h');
			$timeTracking->setRemainingEstimate('1w 2d 3h');

			// add time tracking
			$ret = $issueService->timeTracking($this->issueKey, $timeTracking);
			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'testSearch Failed : '.$e->getMessage());
		}
	}
}
if ( ! function_exists('get_worklog')){
	function get_worklog($issueKey){
		try {
			$issueService = new IssueService();

			// get issue's all worklog
			$worklogs = $issueService->getWorklog($issueKey)->getWorklogs();
			var_dump($worklogs);

			// get worklog by id
//			$wlId = 12345;
//			$wl = $issueService->getWorklogById($issueKey, $wlId);
//			var_dump($wl);

		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'testSearch Failed : '.$e->getMessage());
		}
	}
}
if ( ! function_exists('add_worklog')){
	function add_worklog($issueKey,$timespent){
		try {
			$workLog = new Worklog();

			$workLog->setComment('This is a worklog comment') // noi dung nhat ky cong viec
				->setStarted(date("Y-m-d H:i:s"))
				->setTimeSpent($timespent);

			$issueService = new IssueService();

			$ret = $issueService->addWorklog($issueKey, $workLog);

			$workLogid = $ret->{'id'};

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'Create Failed : '.$e->getMessage());
		}
	}
}
if ( ! function_exists('edit_worklog')){
	function edit_worklog($issueKey,$timespent){
		try {
			$workLog = new Worklog();

			$workLog->setComment('I did edit previous worklog here.')
				->setStarted('2016-05-29 13:15:34')
				->setTimeSpent($timespent);

			$issueService = new IssueService();

			$ret = $issueService->editWorklog($issueKey, $workLog, $workLogid);

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'Edit worklog Failed : '.$e->getMessage());
		}
	}
}
if( ! function_exists('get_All_Fields')){
	function get_All_Fields(){
		try {
			$fieldService = new FieldService();

			// return custom field only.
			$ret = $fieldService->getAllFields(Field::CUSTOM);

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'testSearch Failed : '.$e->getMessage());
		}
	}
}
if( ! function_exists('create_custom_field')){
	function create_custom_field()
	{
		try {
			$field = new Field();

			$field->setName('XXXX1')
//				->setDescription('Custom field for picking groups')
				->setDescription('mo ta ')
				->setType('com.atlassian.jira.plugin.system.customfieldtypes:grouppicker')
				->setSearcherKey('com.atlassian.jira.plugin.system.customfieldtypes:grouppickersearcher');

			$fieldService = new FieldService();

			$ret = $fieldService->create($field);

			var_dump($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'Field Create Failed : '.$e->getMessage());
		}

	}
}
if( ! function_exists('Get_epic_info')){
	function Get_epic_info(){
		try {
			$epic_service = new JiraRestApi\Epic\EpicService();
			$epic_id = 1;
			$epic = $epic_service->getEpic($epic_id);

			var_dump($epic);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('get_user_info')){
	function get_user_info($username){
		try {
			$us = new UserService();

			$user = $us->get(['username' =>$username]);

			var_dump($user);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('add_comment')){
	function add_comment($issueKey,$comments){
//		$issueKey = 'TEST-879';

		try {
			$comment = new Comment();
		$body = $comments;
		$comment->setBody($body)
//			->setVisibilityAsString('role', 'Users');
		;


			$issueService = new IssueService();
			$ret = $issueService->addComment($issueKey, $comment);
			print_r($ret);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(FALSE, 'add Comment Failed : ' . $e->getMessage());
		}
	}
}
if( ! function_exists('get_comment')){

	function get_comment($issueKey){
//		$issueKey = 'TEST-879';
		try {
			$issueService = new IssueService();

			$param = [
				'startAt' => 0,
				'maxResults' => 3,
				'expand' => 'renderedBody',
			];
//			get comment by comment id
//			$commentId = 13805;
			$comments = $issueService->getComments($issueKey, $param);

			var_dump($comments);

		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'get Comment Failed : '.$e->getMessage());
		}
	}
}
if( ! function_exists('delete_comment')){
	function delete_comment($issueKey, $commentId){
//		$issueKey = 'TEST-879';

		try {
//			$commentId = 12345;

			$issueService = new IssueService();

			$ret = $issueService->deleteComment($issueKey, $commentId);

		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'Delete comment Failed : '.$e->getMessage());
		}
	}
}
if( ! function_exists('update_comment')){
	function update_comment($issueKey, $commentId,$content){
//		$issueKey = 'TEST-879';

		try {
//			$commentId = 12345;
			$issueService = new IssueService();

			$comment = new Comment();
			$comment->setBody($content);

			$issueService->updateComment($issueKey, $commentId, $comment);

		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(false, 'Update comment Failed : '.$e->getMessage());
		}
	}
}
if( ! function_exists('set_transition')){
	function set_transition($issueKey,$name,$comment){
		try {
			$transition = new Transition();
			$transition->setTransitionName($name);
			$transition->setCommentBody($comment);

			$issueService = new IssueService();

			$issueService->transition($issueKey, $transition);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(FALSE, 'add Comment Failed : ' . $e->getMessage());
		}
	}
}
if( ! function_exists('get_transition')){
	function get_transition($issueKey,$name){
		try {
			$transition = new Transition();
			$transition->setTransitionName($name);
			$transition->setCommentBody($comment);

			$issueService = new IssueService();

			$issueService->transition($issueKey, $transition);
		} catch (JiraRestApi\JiraException $e) {
			$this->assertTrue(FALSE, 'add Comment Failed : ' . $e->getMessage());
		}
	}
}
if( ! function_exists('create_user')){
	function create_user(){
		try {
			$us = new UserService();

			// create new user
			$user = $us->create([
				'name'=>'charlie',
				'password' => 'abracadabra',
				'emailAddress' => 'charlie@atlassian.com',
				'displayName' => 'Charlie of Atlassian',
			]);

			var_dump($user);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('get_user_info')){
	function get_user_info($username){
		try {
			$us = new UserService();

			$user = $us->get(['username' => $username]);

			var_dump($user);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('find_users')){
	function find_user(){
		try {
			$us = new UserService();

			$paramArray = [
				//'username' => null,
				'project' => 'TEST',
				//'issueKey' => 'TEST-1',
				'startAt' => 0,
				'maxResults' => 50, //max 1000
				//'actionDescriptorId' => 1,
			];

			$users = $us->findAssignableUsers($paramArray);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('find_user')){
	function find_user(){
		try {
			$us = new UserService();

			$paramArray = [
				'username' => '.', // get all users.
				'startAt' => 0,
				'maxResults' => 1000,
				'includeInactive' => true,
				//'property' => '*',
			];

			// get the user info.
			$users = $us->findUsers($paramArray);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if( ! function_exists('delete_user')){
	function delete_user($username){
		try {
			$us = new UserService();

			$paramArray = ['username' => $username];

			$users = $us->deleteUser($paramArray);
		} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}
if(! function_exists('update_user')){
	function update_user(){
		try {
			$us = new UserService();

			$paramArray = ['username' => 'user@example.com'];

			// create new user
			$user = [
				'name'=>'charli',
				'password' => 'abracada',
				'emailAddress' => 'charli@atlassian.com',
				'displayName' => 'Charli of Atlassian',
			];

			$updatedUser = $us->update($paramArray, $user);

    var_dump($updatedUser);

} catch (JiraRestApi\JiraException $e) {
			print('Error Occured! ' . $e->getMessage());
		}
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
	public function index(){
		$this->load->view('student/index');
	}
	public function	form_load(){
		$this->load->view('login');
	}
	public function form()
	{
		// Data cần truyền qua view
		$data = array(
			'title' => 'Đây là trang login',
			'message' => 'Nhập Thông Tin Đăng Nhập'
		);

		// Load view và truyền data qua view
		$this->load->view('login_form', $data);
	}
}

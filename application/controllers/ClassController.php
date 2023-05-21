<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ClassController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("class_model");
	}
	public function index()
	{
//		$message = $this->student_model->test();
//		$data['select'] = $this->student_model->get_last_ten_entries();
//		//echo $this->student_model->test();
//		//echo $this->student_model->insert_entry($info_array);
//		$this->load->view('student/index', array_merge($info_array, $data));
	}
	public function insert_data()
	{
		$info_array = array(
			"id" => $this->input->post('id'),
			"name" => $this->input->post('name'),
		);
		$ketqua = $this->class_model->insert_entry($info_array);
		// $this->load->view('student/index',$ketqua);
		redirect(base_url('/'));
	}

	public function edit_data($id)
	{
//		if(empty($id)){
//			$this->session->setFlashdata('error_message','Unknown Data ID.') ;
//			return redirect()->to('/');
//		}
		$data['edit'] = $this->student_model->edit_entry($id);
		$this->load->view('student/update', $data);
	}

	public function update_data($id)
	{
		$data = array(
			//"id"=> $this->input->post('id'),
			"namestudent" => $this->input->post('namestudent'),
			"address" => $this->input->post('address'),
		);
		$this->student_model->update_entry($id, $data);
		//return $this->load->view('student/index');
		redirect(base_url('/'));
	}

	public function delete_data($id)
	{
		//product id
		//$id = $this->uri->segment(4);
		$this->class_model->delete_entry($id);
		redirect(base_url('/'));
	}
	public function search_data($id){

	}
}

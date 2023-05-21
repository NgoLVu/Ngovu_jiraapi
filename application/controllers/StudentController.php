<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class StudentController extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("student_model");
		$this->load->model("Class_model");
	}

	public function index()
	{
//		$info_array=array(
//			"id"=>"000",
//			"name"=>"ngovu",
//			"address"=>"diachi",
//		);
		$config = array();
		$config['base_url'] = base_url('/index.php/StudentController/index');
		$config['total_rows'] = $this->student_model->get_count();;
		$config["per_page"] = 4;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["results"] = $this->student_model->
		get_last_ten_entries($config["per_page"], $page);
		$data['links']= $this->pagination->create_links();
		$data['select']=$this->student_model->get_last_ten_entries($config['per_page'],$page);
		$CClass['cclass']=$this->Class_model->get_last_ten_entries();

		//echo $this->student_model->insert_entry($info_array);
		//$this->load->view('student/index',array_merge($info_array,$data));
		$this->load->view('student/index',array_merge($data,$CClass));

	}
	public function Layid($id="",$name=""){
		echo "id la ".$id." and name: ".$name;
	}
//	public function testqr(){
//		//$query = $this->db->query('SELECT id, namestudent, address FROM tb_student');
//		$data['select']=$this->student_model->get_last_ten_entries();
//		$this->load->view('/hello',$data);
//	}
	public function insert_data(){
		$info_array=array(
			"id"=> $this->input->post('id'),
			"namestudent"=> $this->input->post('namestudent'),
			"address"=>$this->input->post('address'),
			"id_class"=>$this->input->post('id_class'),
		);
		$ketqua=$this->student_model->insert_entry($info_array);
		// $this->load->view('student/index',$ketqua);
		redirect(base_url('/'));
	}
	public function edit_data($id){
		$data['edit']=$this->student_model->edit_entry($id);
		$data['select']=$this->student_model->get_last_ten_entries();
		$CClass['cclass']=$this->Class_model->get_last_ten_entries();
		$this->load->view('student/update',array_merge($data,$CClass));
	}
	public function update_data($id){
		$data=array(
			//"id"=> $this->input->post('id'),
			"namestudent"=> $this->input->post('namestudent'),
			"address"=>$this->input->post('address'),
			"id_class"=>$this->input->post('id_class'),
		);
		$this->student_model->update_entry($id,$data);
		//return $this->load->view('student/index');
		redirect(base_url('/'));
	}
	public function delete_data($id){
		//product id
		//$id = $this->uri->segment(4);
		$this->student_model->delete_entry($id);
		redirect(base_url('/'));
	}
	public function search_data($id){
		$keyword=$this->input->post('keyword');
		$data['searcha']=$this->student_model->search_entry($keyword);
		$this->load->view('student/index',$data);

	}
}

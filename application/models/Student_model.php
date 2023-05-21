<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student_model extends CI_Model{
	private $table="tb_students";

	public function get_last_ten_entries($limit,$offset)
	{
	//	return $this->db->query("select tb_students.id,namestudent,address,name from".$this->table);
		$this->db->select('tb_students.id,tb_students.nameStudent,tb_students.address,tb_class.name');
	//	$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_class', 'tb_students.id_class = tb_class.id');
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $query = $this->db->get();
		//return $query->result();

	}

	public function insert_entry($data)
	{
	    return	$this->db->insert($this->table, $data);
	}
	public function edit_entry($id){
		return $query = $this->db->get_where($this->table, array('id' => $id))->row();
	}
	public function update_entry($id,$data)
	{
		$this->db->where('tb_students.id', $id);
		$this->db->update($this->table,$data);
	}
	public function delete_entry($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	public function search_entry($id){
		$this->db->where('id', $id);
		return $this->db->query("select * from".$this->table);
	}
	public function get_count(){
		return $this->db->count_all($this->table);
	}
}

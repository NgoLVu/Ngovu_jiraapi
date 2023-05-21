<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Class_model
 */
class Class_model extends CI_Model
{
	private $table = "tb_class";

	public function test()
	{
		return "test model";
	}

	public function get_last_ten_entries()
	{
		return $this->db->query("select * from " . $this->table);

	}

	/**
	 *
	 * @param $data
	 * @return mixed
	 *
	 */
	public function insert_entry($data)
	{

		return $this->db->insert($this->table, $data);
	}

	public function edit_entry($id)
	{
//		$this->db->query("select * from ".$this->table);
//		$this->db->where('id',$id);
		return $query = $this->db->get_where($this->table, array('id' => $id))->row();
	}

	public function update_entry($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);

	}

	public function delete_entry($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
}

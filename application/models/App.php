<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function insert($table = '', $data = '')
	{
		return $this->db->insert($table, $data);
	}

	public function get_all($table)
	{
		$this->db->from($table);
		return $this->db->get();
	}

	public function get_all_orderby($table, $field, $sort = "ASC")
	{
		$this->db->from($table);
		$this->db->order_by($field, $sort);
		return $this->db->get();
	}

	public function get_where($table, $where)
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}

	public function get_where_orderby($table, $where, $field, $sort = "ASC")
	{
		$this->db->from($table);
		$this->db->where($where);
		$this->db->order_by($field, $sort);
		return $this->db->get();
	}

	public function update($table = null, $data = null, $where = null)
	{
		$this->db->set($data, null);
		$this->db->where($where);
		return $this->db->update($table);
	}

	public function delete($table = null, $where = null)
	{
		$this->db->where($where);
		return $this->db->delete($table);
	}

	public function total_rows($table)
	{
		return $this->db->count_all_results($table);
	}

	public function total_rows_where($table, $where)
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get()->num_rows();
	}

	//pastikan fieldnya id String
	public function GenerateId($table, $data = 'R')
	{
		$query = $this->db->select('id')
			->from($table)
			->get();
		$row = $query->last_row();
		if ($row) {
			$idPostfix = (int)substr($row->id, 1) + 1;
			$nextId = $data . STR_PAD((string)$idPostfix, 7, "0", STR_PAD_LEFT);
		} else {
			$nextId = $data . '0000001';
		} // For the first time
		return $nextId;
	}
}

<?php

class m_fakultas extends CI_Model
{
	// GET DATA
	public function all_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_fakultas');
		return $this->db->get()->result();
	}
}

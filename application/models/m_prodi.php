<?php

class m_prodi extends CI_Model
{
	// GET DATA
	public function all_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_prodi');
		return $this->db->get()->result();
	}
}

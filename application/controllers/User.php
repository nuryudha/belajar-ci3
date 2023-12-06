<?php

class User extends CI_Controller
{

	public function index()
	{
		$data = array(
			'title' => 'User',
			'subtitle' => '',
			'page' => 'v_user', // file page  di folder view
		);
		$this->load->view('v_template', $data, false); // load template
	}
}

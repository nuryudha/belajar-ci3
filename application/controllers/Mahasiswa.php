<?php

class Mahasiswa extends CI_Controller
{

	public $m_mahasiswa;
	public $m_fakultas;
	public $m_prodi;
	public $form_validation;
	public $input;
	public $session;
	public $upload;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_mahasiswa');
		$this->load->model('m_fakultas');
		$this->load->model('m_prodi');
	}

	// Home Mahasiswa
	public function index()
	{
		$data = array(
			'title' => 'Mahasiswas',
			'subtitle' => '',
			'page' => 'mahasiswa/v_mahasiswa', // file page  di folder view
			'mhs' => $this->m_mahasiswa->all_data(),
		);
		$this->load->view('v_template', $data, false); // load template
	}

	public function input_mahasiswa()
	{
		//membaca Validasi form input
		$this->form_validation->set_rules('nim', 'NIM', 'required', [
			'required' => '%s Harus Diisi'
		]);
		$this->form_validation->set_rules('nama_mahasiswa', 'Nama Mahasiswa', 'required', [
			'required' => '%s Harus Diisi'
		]);
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required', [
			'required' => '%s Harus Diisi'
		]);
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', [
			'required' => '%s Harus Diisi'
		]);
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
			'required' => '%s Harus Dipilih'
		]);
		$this->form_validation->set_rules('id_fakultas', 'Jenis Fakultas', 'required', [
			'required' => '%s Harus Dipilih'
		]);
		$this->form_validation->set_rules('id_prodi', 'Jenis Program Studi', 'required', [
			'required' => '%s Harus Dipilih'
		]);

		//configurasi file
		$config['upload_path'] = './foto/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['max_size'] = '1024'; //dalam KB'
		$this->upload->initialize($config);
		$field_name = 'foto';


		if ($this->form_validation->run() ==  FALSE) {
			// Jika validasi form gagal atau tidak lolos validasi
			$data = array(
				'title' => 'Input Mahasiswa',
				'subtitle' => '',
				'page' => 'mahasiswa/v_input_mahasiswa', // file page  di folder view
				'fakultas' => $this->m_fakultas->all_data(),
				'prodi' => $this->m_prodi->all_data(),

			);
			$this->load->view('v_template', $data, false); // load template
		} else {
			//  Jika Lolos validasi 
			// Upload Foto
			if (!$this->upload->do_upload($field_name)) {
				$data = array(
					'title' => 'Input Mahasiswa',
					'subtitle' => '',
					'page' => 'mahasiswa/v_input_mahasiswa', // file page  di folder view
					'fakultas' => $this->m_fakultas->all_data(),
					'prodi' => $this->m_prodi->all_data(),
					'error_upload' => $this->upload->display_errors(),

				);
				$this->load->view('v_template', $data, false); // load template
			} else {
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './foto/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'nim' => $this->input->post('nim'),
					'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'id_fakultas' => $this->input->post('id_fakultas'),
					'id_prodi' => $this->input->post('id_prodi'),
					'foto' => $upload_data['uploads']['file_name'],
				);
				$this->m_mahasiswa->insert_data($data);
				$this->session->set_flashdata('pesan', 'Data Mahasasiswa Behasil Ditambahkan');
				redirect('mahasiswa/index');
			}
		}
	}

	public function edit_mahasiswa($id_mahasiswa)
	{
		//membaca Validasi form input
		$this->form_validation->set_rules('nim', 'NIM', 'required', [
			'required' => '%s Harus Diisi'
		]);
		$this->form_validation->set_rules('nama_mahasiswa', 'Nama Mahasiswa', 'required', [
			'required' => '%s Harus Diisi'
		]);
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required', [
			'required' => '%s Harus Diisi'
		]);
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required', [
			'required' => '%s Harus Diisi'
		]);
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required', [
			'required' => '%s Harus Dipilih'
		]);
		$this->form_validation->set_rules('id_fakultas', 'Jenis Fakultas', 'required', [
			'required' => '%s Harus Dipilih'
		]);
		$this->form_validation->set_rules('id_prodi', 'Jenis Program Studi', 'required', [
			'required' => '%s Harus Dipilih'
		]);

		//configurasi file
		$config['upload_path'] = './foto/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['max_size'] = '1024'; //dalam KB'
		$this->upload->initialize($config);
		$field_name = 'foto';


		if ($this->form_validation->run() ==  FALSE) {
			// Jika validasi form gagal atau tidak lolos validasi
			$data = array(
				'title' => 'Edit Mahasiswa',
				'subtitle' => '',
				'page' => 'mahasiswa/v_edit_mahasiswa', // file page  di folder view
				'mhs' => $this->m_mahasiswa->detail_data($id_mahasiswa),
				'fakultas' => $this->m_fakultas->all_data(),
				'prodi' => $this->m_prodi->all_data(),

			);
			$this->load->view('v_template', $data, false); // load template

		} else {
			//  Jika Lolos validasi 
			// Upload Foto
			if (!$this->upload->do_upload($field_name)) {
				//Jika Tidak ganti foto
				$data = array(
					'id_mahasiswa' => $id_mahasiswa,
					'nim' => $this->input->post('nim'),
					'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'id_fakultas' => $this->input->post('id_fakultas'),
					'id_prodi' => $this->input->post('id_prodi'),

				);
				$this->m_mahasiswa->update_data($data);
				$this->session->set_flashdata('pesan', 'Data Mahasasiswa Behasil diupdate');
				redirect('mahasiswa/index');
			} else {
				$upload_data = array('uploads' => $this->upload->data());
				$config['image_library'] = 'gd2';
				$config['source_image'] = './foto/' . $upload_data['uploads']['file_name'];
				$this->load->library('image_lib', $config);
				$data = array(
					'id_mahasiswa' => $id_mahasiswa,
					'nim' => $this->input->post('nim'),
					'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'id_fakultas' => $this->input->post('id_fakultas'),
					'id_prodi' => $this->input->post('id_prodi'),
					'foto' => $upload_data['uploads']['file_name'],
				);
				$this->m_mahasiswa->update_data($data);
				$this->session->set_flashdata('pesan', 'Data Mahasasiswa Behasil diupdate');
				redirect('mahasiswa/index');
			}

			// $data = array(
			// 	'id_mahasiswa' => $id_mahasiswa,
			// 	'nim' => $this->input->post('nim'),
			// 	'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
			// 	'tempat_lahir' => $this->input->post('tempat_lahir'),
			// 	'tgl_lahir' => $this->input->post('tgl_lahir'),
			// 	'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			// 	'id_fakultas' => $this->input->post('id_fakultas'),
			// 	'id_prodi' => $this->input->post('id_prodi'),
			// );
			// $this->m_mahasiswa->update_data($data);
			// $this->session->set_flashdata('pesan', 'Data Mahasasiswa Behasil diupdate');

			// redirect('mahasiswa/index');
		}
	}

	public function delete_mahasiswa($id_mahasiswa)
	{

		$data = array('id_mahasiswa' => $id_mahasiswa);
		$this->m_mahasiswa->delete_data($data);
		$this->session->set_flashdata('pesan', 'Data Mahasasiswa Behasil didelete');

		redirect('mahasiswa/index');
	}
}

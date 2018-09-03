<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helloworld extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mymodel');
	}

	public function index()
	{
		$this->load->model('Mymodel');
		$data = $this->Mymodel->GetMahasiswa('mahasiswa');
		$data = array('data'=>$data);
		$this->load->view('data_mahasiswa', $data);
	}

	public function add_data()
	{
		$this->load->view('Form_add');
	}

	public function insert()
	{
		$data = array(
			'no_induk' => $this->input->post('nim'),
			'nama' => $this->input->post('nama'), 
			'alamat'=> $this->input->post('alamat')
			);
		$data = $this->Mymodel->insert('mahasiswa',$data);
		redirect(base_url(),'refresh');
	}

	public function edit_data()
	{
		if(isset($_POST['submit']))
		{
			$nim = $this->input->post('nim');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');

			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				);

			$where = array(
				'no_induk' => $nim
				);
			$this->Mymodel->update('mahasiswa', $where ,$data);


			redirect('Helloworld');
		}else 
		{
			$id = $this->uri->segment(3);

			$data = array(
				'title' => 'Data Mahasiswa',
				'mhs' => $this->db->get_where('mahasiswa', array('no_induk' => $id))->row_array()
			);
			$this->load->view('Form_edit', $data);

		}

	}

	public function Delete_data()
	{
		$nim = $this->uri->segment(3);

		$where = array(
			'no_induk' => $nim
		);
		$this->Mymodel->delete('mahasiswa', $where);
		
		redirect('Helloworld');

	}
}
?>
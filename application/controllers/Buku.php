<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')!=TRUE) {
			redirect('admin/login','refresh');
		}
		$this->load->model('m_skincare','skincare');
	}

	public function index()
	{
		$data['tampil_skincare']=$this->skincare->tampil();
		$data['kategori']=$this->skincare->data_kategori();
		$data['konten']="v_buku";
		$data['judul']="Daftar Buku";
		$this->load->view('template', $data);
	}
	public function toko()
	{
		$data['tampil_skincare']=$this->skincare->tampil();
		$data['kategori']=$this->skincare->data_kategori();
		$data['konten']="toko";
		$data['judul']="Toko Togamedia";
		$this->load->view('template', $data);
	}
	public function tambah()
	{
		$this->form_validation->set_rules('merk_skincare', 'merk_skincare', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
		if ($this->form_validation->run()==TRUE) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '1000';
			$config['max_width']  = '5000';
			$config['max_height']  = '5000';
			if ($_FILES['gambar_produk']['name']!="") {
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('gambar_produk')) {
					$this->session->set_flashdata('pesan', $this->upload->display_errors());
				}else {
					if ($this->skincare->simpan_skincare($this->upload->data('file_name'))) {
						$this->session->set_flashdata('pesan', 'Sukses menambah ');
					}else{
						$this->session->set_flashdata('pesan', 'Gagal menambah');
					}
					redirect('buku','refresh');
				}
			}else{
				if ($this->skincare->simpan_buku('')) {
					$this->session->set_flashdata('pesan', 'Sukses menambah');
				}else{
					$this->session->set_flashdata('pesan', 'Gagal menambah');
				}
				redirect('buku','refresh');
			}
			
		}else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('buku','refresh');
		}
	}
	public function edit_skincare($id)
	{
		$data=$this->skincare->detail($id);
		echo json_encode($data);
	}
	public function skincare_update()
	{
		if($this->input->post('edit')){
			if($_FILES['gambar_produk']['name']==""){
				if($this->skincare->edit_skincare()){
					$this->session->set_flashdata('pesan', 'Sukses update');
					redirect('buku');
				} else {
					$this->session->set_flashdata('pesan', 'Gagal update');
					redirect('buku');
				}
			} else {
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']  = '20000';
				$config['max_width']  = '5024';
				$config['max_height']  = '5768';
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('gambar_produk')){
					$this->session->set_flashdata('pesan', 'Gagal Upload');
					redirect('buku');
				}
				else{
					if($this->skincare->edit_buku_dengan_foto($this->upload->data('file_name'))){
						$this->session->set_flashdata('pesan', 'Sukses update');
						redirect('buku');
					} else {
						$this->session->set_flashdata('pesan', 'Gagal update');
						redirect('buku');
					}
				}
			}
			
		}

	}
	public function hapus($id_buku='')
	{
		if ($this->buku->hapus_buku($id_buku)) {
			$this->session->set_flashdata('pesan', 'Sukses Hapus Buku');
			redirect('buku','refresh');
		}else{
			$this->session->set_flashdata('pesan', 'Gagal Hapus Buku');
			redirect('buku','refresh');
		}
	}

}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */
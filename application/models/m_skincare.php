<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_skincare extends CI_Model {
    public function tampil()
    {
        $tm_skincare=$this->db
                      ->join('kategori','kategori.id_kategori=skincare.id_kategori')
                      ->get('skincare')
                      ->result();
        return $tm_skincare;
    }
    public function data_kategori()
    {
        return $this->db->get('kategori')
                        ->result();
    }
    public function simpan_skincare($file_cover)
    {
        if ($file_cover=="") {
             $object = array(
                'id_skincare' => $this->input->post('id_skincare'), 
                'merk_skincare' => $this->input->post('merk_skincare'), 
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'deskripsi' => $this->input->post('deskripsi'), 
                'id_kategori' => $this->input->post('id_kategori')
             );
        }else{
            $object = array(
                'id_skincare' => $this->input->post('id_skincare'), 
                'merk_skincare' => $this->input->post('merk_skincare'), 
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'deskripsi' => $this->input->post('deskripsi'), 
                'id_kategori' => $this->input->post('id_kategori'),
                'gambar_produk' => $file_cover
             );
        }
        return $this->db->insert('skincare', $object);
    }
    public function detail($a)
    {
        $tm_skincare=$this->db
                      ->join('kategori', 'kategori.id_kategori=skincare.id_kategori')
                      ->where('id_skincare', $a)
                      ->get('skincare')
                      ->row();
        return $tm_skincare;
    }
    public function edit_skincare()
    {
        $data = array(
            'id_skincare' => $this->input->post('id_skincare'), 
            'merk_skincare' => $this->input->post('merk_skincare'), 
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'deskripsi' => $this->input->post('deskripsi'), 
            'id_kategori' => $this->input->post('id_kategori')

            );

        return $this->db->where('id_skincare', $this->input->post('id_skincare_lama'))
                        ->update('skincare', $data);
    }
    public function edit_buku_dengan_foto($file_cover)
    {
        $data = array(
            'id_skincare' => $this->input->post('id_skincare'), 
            'merk_skincare' => $this->input->post('merk_skincare'), 
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'deskripsi' => $this->input->post('deskripsi'), 
            'id_kategori' => $this->input->post('id_kategori'),
            'gambar_produk' => $file_cover

            );

        return $this->db->where('id_skincare', $this->input->post('id_skincare_lama'))
                        ->update('skincare', $data);
    }
    public function hapus_buku($id_buku='')
    {
        return $this->db->where('id_skincare', $id_skincare)
                    ->delete('skincare');
    }
    

}

/* End of file M_buku.php */
/* Location: ./application/models/M_buku.php */
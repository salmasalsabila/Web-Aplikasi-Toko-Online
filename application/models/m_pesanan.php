<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pesanan extends CI_Model {
	public function tm_pesanan()
	{
		$tm_pesanan=$this->db ->get('pembelian')
							  ->result();
		return $tm_pesanan;
	}
	public function detail_pesanan($a)
	{
		return $this->db->where('id_beli', $a)
					    ->get('pembelian')
					    ->row();
	}
}

/* End of file M_pesanan.php */
/* Location: ./application/models/M_pesanan.php */
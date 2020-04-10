<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myigniter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('cart');
	}


	public function index()
	{
		if ($this->session->userdata('user_data')) {
			$table = "barang";
			$data['cari'] = $this->myigniter_model->get($table);
	
			$data['title'] = "Kasri 1.0";
			$data['judule'] = "POS By Group 2";
			$content = "myigniter_view";
			$this->template->output($data, $content);
		} else {
			redirect('auth');
		}
	}

	public function daftarkeranjang()
	{		
		if ($this->session->userdata('user_data')) {
			$this->load->view('keranjang_view');
		} else {
			redirect('auth');
		}
	}

	public function total()
	{
		echo $this->cart->total();
	}

	public function keranjang($id)
	{
		$table = "barang";
		$condition['id'] = $id;
		$get = $this->myigniter_model->getData($table, $condition);
		$jml = $get->num_rows();
		$tambah = TRUE;

		foreach ($this->cart->contents() as $items){
			$kode = $id;
			  if($items['id'] == $kode){
			  	$total = $items['qty'] + 1;
			  	$data = array(
					'rowid'   => $items['rowid'],
					'qty'     => $total
				);

				$this->cart->update($data);
				$tambah = FALSE;
				break;
			  }
		}

		if($tambah){
	        if($jml == 0){
	        	/*
	        	echo "<script>
	        	alert('Id barang yang dimasukan tidak ada!');
	        	</script>";
	        	*/
	        }else{
	        	foreach ($get->result() as $row) {
					$data = array(
						'id'      => $row->id,
						'qty'     => 1,
						'price'   => $row->harga_jual,
						'name'    => $row->nama
					);
					$this->cart->insert($data);
					break;
				}
			}
		}
	}

	public function client()
	{
		if ($this->session->userdata('user_data')) {
			$this->load->view('client_kasir');
		} else {
			redirect('auth');
		}
	}

	public function penjualan()
	{
		if ($this->session->userdata('user_data')) {
			$table = "penjualan";
			$data['penjualan'] = $this->myigniter_model->get($table);

			$data['title'] = "penjualan";
			$content = "penjualan";
			$data['judule'] = "PENJUALAN";
			$this->template->output($data, $content);
		} else {
			redirect('auth');
		}
	}

	public function setoran()
	{
		if ($this->session->userdata('user_data')) {
			$table = "penjualan";
			$condition['setor'] = '0';
				$data['setoran'] = $this->myigniter_model->setoran($table, $condition);
				$data['setoran_selesai'] = $this->myigniter_model->setoran_selesai();

			$data['title'] = "Penyetoran";
			$content = "setoran";
			$data['judule'] = "SETORAN";
			$this->template->output($data, $content);
		} else {
			redirect('auth');
		}
	}

	public function riwayat()
	{
		if ($this->session->userdata('user_data')) {
			$data['penjualan'] = $this->myigniter_model->getRiwayat();
			$data['title'] = "riwayat";
			$content = "riwayat";
			$data['judule'] = "RIWAYAT";
			$this->template->output($data, $content);
		} else {
			redirect('auth');
		}
	}

	public function setoranSubmit()
	{
		$this->load->helper('date');
		$datestring = "%Y-%m-%d";
		$tgl = mdate($datestring);

		$tgl_jual = $this->input->post('tgljual');
		$tablePenjualan = "penjualan";
		$condition['tgl'] = $tgl_jual;
		$selectTotal = $this->myigniter_model->totalSetor($tablePenjualan, $condition);
		foreach ($selectTotal->result() as $tot) {
			$total_jual = $tot->total_harga;
			$total_setor = $this->input->post('setor');
			$selisih = $total_setor - $total_jual;
			$table = "setor";
			$data = array(
				'penyetor' => $this->input->post('nama') ,
				'tgl_jual' => $tgl_jual ,
				'tgl_setor' => $tgl ,
				'total_jual' => $total_jual,
				'total_setor' => $total_setor,
				'selisih' => $selisih
				);
			$this->myigniter_model->addData($table, $data);
		}
		$data = array('setor' => 1, );
		$updatePenjualan = $this->myigniter_model->updateData($tablePenjualan, $data, $condition);

		redirect('myigniter/setoran','refresh');
	}

	public function deleterow($id)
	{
		$data = array(
			'rowid'   => $id,
			'qty'     => 0
		);

		$this->cart->update($data);
		redirect('myigniter');
	}
	public function delete()
	{
        $this->cart->destroy();
   		redirect('myigniter');
	}

    public function selesai()
    {
    	$this->load->helper('date');
		$datestring = "%Y-%m-%d";

		$tgl = mdate($datestring);
		$table = "penjualan";
		$carts = array();
    	foreach ($this->cart->contents() as $insert){
    		$total = $insert['price']*$insert['qty'];
    		$data = array(
    			'id_barang' => $insert['id'],
    			'qty' => $insert['qty'],
    			'total_harga' => $total,
    			'tgl' => $tgl
    			);

    		$this->myigniter_model->addData($table, $data);
			$carts[] = array(
				'qty' => $data['qty'],
				'total_harga' => $data['total_harga'],
				'nama' => $insert['name']
			);
		}
		$this->session->set_userdata('struk_tanggal', date('d F Y H:i:s'));
		$this->session->set_userdata('struk', $carts);
		$this->session->set_userdata('struk_read', 0);
        $this->cart->destroy();
   		redirect('myigniter');
	}
	
	public function remove_struk_read()
	{
		$this->session->set_userdata('struk_read', 1);
	}

}

/* End of file myigniter.php */
/* Location: ./application/controllers/myigniter.php */
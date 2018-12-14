<?php

require APPPATH . '/libraries/REST_Controller.php';
class Transaksi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data transaksi
    function index_get() {
        $id_transaksi = $this->get('id_transaksi');
        $kode_parkiran = $this->get('kode_parkiran');
        if ($id_transaksi == '') {
            $this->db->select('*');
			$this->db->from('parkir_transaksi');
			$this->db->join('parkir', 'parkir_transaksi.no_karcis = parkir.no_karcis');
			$this->db->where('kode_parkiran', $kode_parkiran);
			$this->db->where('status', '2');
			$transaksi = $this->db->get()->result();
        } else {
            $this->db->where('id_transaksi', $id_transaksi);
            $transaksi = $this->db->get('parkir_transaksi')->result();
        }
        $this->response(array("result"=>$transaksi, "status"=>"success"));
    }

    // insert new data to transaksi
    function index_post() {
        $data = array(
                    'no_karcis'    => $this->post('no_karcis'),
                    'user'  => "1",
                    'biaya'   => $this->post('biaya'));
        $insert = $this->db->insert('parkir_transaksi', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>
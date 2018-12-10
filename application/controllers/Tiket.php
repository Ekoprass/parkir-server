<?php

require APPPATH . '/libraries/REST_Controller.php';

class Tiket extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data tiket
    function index_get() {
        $id_pembelian = $this->get('id_pembelian');
        if ($id_pembelian == '') {

            $this->db->select('pembelian.id_pembelian, pembeli.nama, pembelian.tanggal_beli, pembelian.total_harga, tiket.tujuan');    
            $this->db->from('pembelian');
            $this->db->join('pembeli', 'pembelian.id_pembeli = pembeli.id_pembeli');
            $this->db->join('tiket', 'pembelian.id_tiket = tiket.id_tiket');
            $tiket = $this->db->get()->result();
        } else {
            $this->db->select('pembelian.id_pembelian, pembeli.nama, pembelian.tanggal_beli, pembelian.total_harga, tiket.tujuan');    
            $this->db->from('pembelian');
            $this->db->join('pembeli', 'pembelian.id_pembeli = pembeli.id_pembeli');
            $this->db->join('tiket', 'pembelian.id_tiket = tiket.id_tiket');
            $this->db->where('pembelian.id_pembelian', $id_pembelian);
            $tiket = $this->db->get()->result();
        }
        $this->response($tiket, 200);
    }

    // insert new data to tiket
    function index_post() {
      
       $check = $this->db->where('id_pembelian',$this->post('id_pembelian'))->get('pembelian')->num_rows();
        if($check>0){
            $this->response(array('message'=> 'id_pembelian sudah ada.','status' => 'fail', 502));
        }else{
            $check_pembeli = $this->db->where('id_pembeli',$this->post('id_pembeli'))->get('pembeli')->num_rows();
            $check_tiket = $this->db->where('id_tiket',$this->post('id_tiket'))->get('tiket')->num_rows();
            if($check_pembeli==0){
                $this->response(array('message'=> 'id_pembeli tidak ada.','status' => 'fail', 502));
            }elseif($check_tiket==0){
                $this->response(array('message'=> 'id_tiket tidak ada.','status' => 'fail', 502));
            }else{
              $data = array(
                    'id_pembelian'  => $this->post('id_pembelian'),
                    'id_pembeli'    => $this->post('id_pembeli'),
                    'tanggal_beli'    => $this->post('tanggal_beli'),
                    'total_harga'   => $this->post('total_harga'),
                    'id_tiket'   => $this->post('id_tiket')
                );
                $insert = $this->db->insert('pembelian', $data);
                if ($insert) {
                    $this->response($data, 200);
                } 
                else {
                    $this->response(array('status' => 'fail', 502));
                }
        } }
       
    }

    // update data tiket
    function index_put() {
        $id_pembelian = $this->put('id_pembelian');

        $check = $this->db->where('id_pembelian',$this->put('id_pembelian'))->get('pembelian')->num_rows();
        if($check > 1){
            $this->response(array('message'=> 'id_pembelian sudah ada.','status' => 'fail', 502));
        }else{
            $check_pembeli = $this->db->where('id_pembeli',$this->put('id_pembeli'))->get('pembeli')->num_rows();
            $check_tiket = $this->db->where('id_tiket',$this->put('id_tiket'))->get('tiket')->num_rows();
            if($check_pembeli==0){
                $this->response(array('message'=> 'id_pembeli tidak ada.','status' => 'fail', 502));
            }elseif($check_tiket==0){
                $this->response(array('message'=> 'id_tiket tidak ada.','status' => 'fail', 502));
            }else{
            $data = array(
                        'id_pembelian'  => $this->put('id_pembelian'),
                        'id_pembeli'    => $this->put('id_pembeli'),
                        'tanggal_beli'  => $this->put('tanggal_beli'),
                        'total_harga'   => $this->put('total_harga'),
                        'id_tiket'      => $this->put('id_tiket'));
            $this->db->where('id_pembelian', $id_pembelian);
            $update = $this->db->update('pembelian', $data);
            if ($update) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }}
    }

    // delete tiket
    function index_delete() {
        $id_pembelian = $this->delete('id_pembelian');
        $this->db->where('id_pembelian', $id_pembelian);
        $delete = $this->db->delete('pembelian');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
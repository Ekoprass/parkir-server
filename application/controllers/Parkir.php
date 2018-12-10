<?php

require APPPATH . '/libraries/REST_Controller.php';
class Parkir extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data parkir
    function index_get() {
        $no_karcis = $this->get('no_karcis');
        if ($no_karcis == '') {
            $parkir = $this->db->get('parkir')->result();
        } else {
            $this->db->where('no_karcis', $no_karcis);
            $parkir = $this->db->get('parkir')->result();
        }
        $this->response($parkir, 200);
    }

    // insert new data to parkir
    function index_post() {
        $data = array(
                    'no_karcis'    => $this->post('no_karcis'),
                    'waktu_masuk'  => $this->post('waktu_masuk'),
                    'plat_nomor'   => $this->post('plat_nomor'),
                    'kode_parkiran'=> $this->post('kode_parkiran'),
                    'status'       => '1');
        $insert = $this->db->insert('parkir', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data parkir
    function index_put() {
        $id_parkir = $this->put('no_karcis');
        $data = array(
                    'plat_nomor'          => $this->post('plat_nomor'),
                    'kode_parkiran'       => $this->post('kode_parkiran'));
        $this->db->where('no_karcis', $no_karcis);
        $update = $this->db->update('parkir', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete parkir
    function index_delete() {
        $id_parkir = $this->delete('no_karcis');
        $this->db->where('no_karcis', $no_karcis);
        $delete = $this->db->delete('parkir');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
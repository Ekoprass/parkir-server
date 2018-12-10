<?php

require APPPATH . '/libraries/REST_Controller.php';
class Parkiran extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data parkiran
    function index_get() {
        $kode_parkiran = $this->get('kode_parkiran');
        if ($kode_parkiran == '') {
            $parkiran = $this->db->get('parkiran')->result();
        } else {
            $this->db->where('kode_parkiran', $kode_parkiran);
            $parkiran = $this->db->get('parkiran')->result();
        }
        $this->response(array("result"=>$parkiran, "status"=>"success"));
    }

    // insert new data to parkiran
    function index_post() {
        $data = array(
                    'kode_parkiran'    => $this->post('kode_parkiran'),
                    'nama_parkiran'          => $this->post('nama_parkiran'),
                    'kapasitas'          => $this->post('kapasitas'));
        $insert = $this->db->insert('parkiran', $data);
        if ($insert) {
            $this->response(array("result"=>$data, "status"=>"success"));
        } else {
            $this->response(array("result"=>$data, "status"=>"fail"));
        }
    }

    // update data parkiran
    function index_put() {
        $id_parkiran = $this->put('kode_parkiran');
        $data = array(
                    'nama_parkiran'          => $this->post('nama_parkiran'),
                    'kapasitas'          => $this->post('kapasitas'));
        $this->db->where('kode_parkiran', $kode_parkiran);
        $update = $this->db->update('parkiran', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete parkiran
    function index_delete() {
        $id_parkiran = $this->delete('kode_parkiran');
        $this->db->where('kode_parkiran', $kode_parkiran);
        $delete = $this->db->delete('parkiran');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
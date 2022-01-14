<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ref_bank_model', 'ref_bank'); //1
    }

    // -----------------------------------
    // ref_bank (1)
    // -----------------------------------
    public function count_ref_bank_get()
    {
        $data = $this->ref_bank->count();
        $this->response($data, 200);
    }

    public function ref_bank_get()
    {
        $id = $this->get('id');
        $keyword = $this->get('keyword');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        if ($keyword) {
            $data = $this->ref_bank->find($keyword, $limit, $offset);
        } else {
            $data = $this->ref_bank->get($limit, $offset);
        }
        $this->response($data, 200);
    }

    public function ref_bank_post()
    {
        $data = [
            'kode' => $this->post('kode', true),
            'nama' => $this->post('nama', true),
            'rekening' => $this->post('rekening', true)
        ];
        if ($this->post('kode') === null | $this->post('kode') === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were added'
            ], 404);
        } else {
            $this->ref_bank->create($data);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully added'
            ], 200);
        }
    }

    public function ref_bank_put()
    {
        $id = $this->put('id');
        $data = [
            'kode' => $this->put('kode', true),
            'nama' => $this->put('nama', true),
            'rekening' => $this->put('rekening', true)
        ];
        if ($id === null | $id === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were changed'
            ], 404);
        } else {
            $this->ref_bank->update($data, $id);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully changed'
            ], 200);
        }
    }

    public function ref_bank_delete()
    {
        $id = $this->delete('id');
        if ($id === null | $id === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were deleted'
            ], 404);
        } else {
            $this->ref_bank->delete($id);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully deleted'
            ], 200);
        }
    }
}

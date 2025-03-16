<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\BrandModel;

class Brand extends BaseController
{
    use ResponseTrait;

    public function get()
    {
        $brandmod = new BrandModel();
        $brand = $brandmod->findAll();

        return json_encode($brand);
    }

    public function insert()
    {
        $data = [
            'brand'         => $this->request->getVar('brand'),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $brandmod = new BrandModel();
        $brandmod->save($data);

        return $this->respond(['message' => 'Insert brand successfully!'], 200);
    }

    public function update()
    {
        $brandmod = new BrandModel();
        $brandmod->set('brand', $this->request->getVar('brand'))->where('id', $this->request->getVar('id'))->update();

        return $this->respond(['message' => 'Update brand successfully!'], 200);
    }

    public function delete()
    {
        $brandmod = new BrandModel();
        $brandmod->where('id', $this->request->getVar('id'))->delete();

        return $this->respond(['message' => 'Delete brand successfully!'], 200);
    }

}

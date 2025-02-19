<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Users extends BaseController
{
    use ResponseTrait;

    public function create()
    {
        $data = [
            'name'          => $this->request->getVar('name'),
            'email'         => $this->request->getVar('email'),
            'password'      => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role'          => $this->request->getVar('role'),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $usermod = new UserModel();
        $usermod->save($data);

        return $this->respond(['message' => 'Create user successfully!'], 200);
    }
}

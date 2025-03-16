<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\UserlogModel;

class Login extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function actionlogin()
    {
        $data = [
            'email'     => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password'),
        ];

        $usermod = new UserModel();
        $logindata   = $usermod->where('email', $data['email'])->get()->getRow();

        $request = service('request');
        $clientIP = $request->getIPAddress();

        if ($logindata) {
            if (!password_verify($data['password'], $logindata->password)) {
                session()->setFlashdata('error', 'Incorrect username or password, please try again ! ');
                return redirect()->to('login');
            } else {
                session()->set('userid', $logindata->user_id);
                session()->set('name', $logindata->name);
                session()->set('email', $logindata->email);
                session()->set('type', $logindata->type);
                session()->set('ip', $clientIP);

                if (substr_count($clientIP, '.') === 3) {
                    $locationData = file_get_contents("https://freeipapi.com/api/json/".$clientIP);
                    $locationData = json_decode($locationData, true);
                } else {
                    $locationData = [];
                }

                session()->set('logindata', json_encode($locationData));

                $logmod = new UserlogModel();
                $log = [
                    'userid'        => $logindata->user_id,
                    'email'         => $logindata->email,
                    'name'          => $logindata->name,
                    'action'        => 'LOGIN',
                    'created_at'    => date('Y-m-d H:i:s'),
                    'description'   => json_encode($locationData),
                ];
                $logmod->insert($log);

                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('error', 'Account not found!');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        $logmod = new UserlogModel();
        $log = [
            'userid'         => session('userid'),
            'email'          => session('email'),
            'name'           => session('name'),
            'action'         => '/logout',
            'created_at'     => date('Y-m-d H:i:s'),
            'description'    => session('logindata'),
        ];
        $logmod->insert($log);

        session()->destroy();
        return redirect()->to('login');
    }
}

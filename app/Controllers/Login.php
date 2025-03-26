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
                session()->set('access', $this->access($logindata->type));
                session()->set('ip', $clientIP);
                if($data['email'] == $data['password']){
                    session()->set('firstlogin', true);
                } else {
                    session()->set('firstlogin', false);
                }

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

                $usermod->set('lastlogin_at', date('Y-m-d H:i:s'))->where('user_id', $logindata->user_id)->update();

                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('error', 'Incorrect username or password, please try again !');
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

    public function access($type)
    {
        $menu = [
            'dashboard' => [
                'name'  => 'Dashboard',
                'icon'  => 'layout',
                'path'  => '/'
            ],
            'cs' => [
                'name'  => 'Customer Service',
                'icon'  => 'sliders',
                'path'  => 'cs'
            ],
            'engineer' => [
                'name'  => 'Engineer',
                'icon'  => 'zap',
                'path'  => 'engineer'
            ],
            'allTicket' => [
                'name'  => 'All Ticket',
                'icon'  => 'book',
                'path'  => 'allTicket'
            ],
            'part' => [
                'name'  => 'Parts',
                'icon'  => 'cpu',
                'path'  => 'parts'
            ],
            'performance' => [
                'name'  => 'Performance',
                'icon'  => 'users',
                'path'  => 'performance'
            ],
            'setting' => [
                'name'  => 'Settings',
                'icon'  => 'settings',
                'path'  => 'setting'
            ],
            'logout' => [
                'name'  => 'Sign Out',
                'icon'  => 'log-out',
                'path'  => 'logout'
            ],
        ];

        $access = [
            'ENGINEER'  => ['dashboard', 'engineer', 'logout'],
            'CS'        => ['dashboard', 'cs', 'part', 'logout'],
            'ADMIN'     => ['dashboard', 'cs', 'part', 'allTicket', 'logout'],
            'MANAGER'   => ['dashboard', 'cs', 'part', 'allTicket', 'performance', 'setting', 'logout'],
            'SUPERUSER' => ['dashboard', 'cs', 'engineer', 'part', 'performance', 'setting', 'logout'],
        ];

        if (array_key_exists(strtoupper($type), $access)) {
            $assigned = $access[strtoupper($type)];
            $auth = [];
            for ($i=0; $i < count($assigned); $i++) { 
                $auth[] = $menu[$assigned[$i]];
            };
        } else {
            $auth = [
                [
                    'name'  => 'Sign Out',
                    'icon'  => 'log-out',
                    'path'  => 'logout'
                ]
            ];
        }

        return $auth;
    }
}

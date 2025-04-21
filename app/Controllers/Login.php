<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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

        // Hardcoded credentials check
        if ($data['email'] === 'admin@test' && $data['password'] === 'admin') {
            session()->set('userid', '1');
            session()->set('name', 'Test User');
            session()->set('email', $data['email']);
            session()->set('type', 'ADMIN');
            session()->set('access', $this->access('ADMIN'));
            session()->set('ip', $this->request->getIPAddress());
            session()->set('firstlogin', false);
            
            return redirect()->to('/');
        } else {
            session()->setFlashdata('error', 'Incorrect username or password, please try again!');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
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
            'customer-database' => [
                'name'  => 'Customer Database',
                'icon'  => 'book-open',
                'path'  => 'customer-database'
            ],
            'ship-inquiry' => [
                'name'  => 'Ship Inquiry',
                'icon'  => 'anchor',
                'path'  => 'ship-inquiry'
            ],
            'sales-report' => [
                'name'  => 'Sales Report',
                'icon'  => 'file',
                'path'  => 'sales-report'
            ],
            'logout' => [
                'name'  => 'Sign Out',
                'icon'  => 'log-out',
                'path'  => 'logout'
            ],
        ];

        $access = [
            'ENGINEER'  => ['dashboard', 'customer-database', 'ship-inquiry', 'sales-report', 'logout'],
            'CS'        => ['dashboard', 'customer-database', 'ship-inquiry', 'sales-report', 'logout'],
            'ADMIN'     => ['dashboard', 'customer-database', 'ship-inquiry', 'sales-report', 'logout'],
            'MANAGER'   => ['dashboard', 'customer-database', 'ship-inquiry', 'sales-report', 'logout'],
            'SUPERUSER' => ['dashboard', 'customer-database', 'ship-inquiry', 'sales-report', 'logout'],
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

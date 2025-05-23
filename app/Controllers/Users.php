<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\UserlogModel;
use PhpParser\Node\Expr\FuncCall;

class Users extends BaseController
{
    use ResponseTrait;

    public function create()
    {
        $data = [
            'user_id'       => $this->createid(),
            'name'          => $this->request->getVar('name'),
            'email'         => $this->request->getVar('email'),
            'password'      => password_hash($this->request->getVar('email'), PASSWORD_DEFAULT),
            'type'          => $this->request->getVar('type'),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $usermod = new UserModel();
        $usermod->save($data);

        $logmod = new UserlogModel();
        $log = [
            'userid'         => session('userid'),
            'email'          => session('email'),
            'name'           => session('name'),
            'action'         => '/user/create',
            'created_at'     => date('Y-m-d H:i:s'),
            'description'    => json_encode($data),
        ];
        $logmod->insert($log);

        return $this->respond(['message' => 'Create user successfully!'], 200);
    }

    public function changepassword()
    {
        $data = [
            'password'      => password_hash($this->request->getVar('newpassword'), PASSWORD_DEFAULT),
        ];

        $usermod = new UserModel();
        $usermod->set($data)->where('user_id', $this->request->getVar('user_id'))->update();

        $logmod = new UserlogModel();
        $log = [
            'userid'         => session('userid'),
            'email'          => session('email'),
            'name'           => session('name'),
            'action'         => '/user/changepassword',
            'created_at'     => date('Y-m-d H:i:s'),
            'description'    => json_encode(['user' => $this->request->getVar('user_id'), 'data' => $data]),
        ];
        $logmod->insert($log);

        return $this->respond(['message' => 'Change password successfully!'], 200);
    }


    public function changetype()
    {
        $data = [
            'type'      => password_hash($this->request->getVar('type'), PASSWORD_DEFAULT),
        ];

        $usermod = new UserModel();
        $usermod->set($data)->where('user_id', $this->request->getVar('user_id'))->update();

        return $this->respond(['message' => 'Change type successfully!'], 200);
    }

    public function delete()
    {
        $usermod = new UserModel();
        $usermod->where('user_id', $this->request->getVar('user_id'))->delete();

        $logmod = new UserlogModel();
        $log = [
            'userid'         => session('userid'),
            'email'          => session('email'),
            'name'           => session('name'),
            'action'         => '/user/delete',
            'created_at'     => date('Y-m-d H:i:s'),
            'description'    => json_encode($this->request->getVar('user_id')),
        ];
        $logmod->insert($log);

        return $this->respond(['message' => 'Delete user successfully!'], 200);
    }

    public function view()
    {
        $usermod = new UserModel();
        $data = $usermod->where('email', $this->request->getVar('email'))->get()->getRow();

        return json_encode($data);
    }

    public function createid()
    {
        $usermod = new UserModel();
        $lastdata = $usermod->orderBy('created_at', 'DESC')->limit(1)->get()->getRow();
        if ($lastdata) {
            $lastid = $lastdata->user_id;
            //U + [2 digit year] + [3 digit sequence]
            $lastyear = substr($lastid, 1, 2);
            $lastseq = (int)substr($lastid, 3, 4);
            if (date('y') == $lastyear) {
                $newseq = $lastseq + 1;
                $newid = 'U' . $lastyear . sprintf("%04d", $newseq);
                return $newid;
            } else {
                $newid = 'U' . date('y') . sprintf("%04d", 1);
                return $newid;
            }
        } else {
            $newid = 'U' . date('y') . sprintf("%04d", 1);
            return $newid;
        }
    }

    public function getall()
    {
        $usermod = new UserModel();
        $alldata = $usermod->findAll();
        return json_encode($alldata);
    }

    public function getlog()
    {
        $userlogmod = new UserlogModel();
        $data = $userlogmod->orderBy('created_at', 'DESC')->limit(50)->get()->getResult();

        return json_encode($data);
    }

    public function searchlog()
    {
        $userlogmod = new UserlogModel();
        if ($this->request->getVar('user')) {
            $userlogmod->where('userid', $this->request->getVar('user'));
        }
        if ($this->request->getVar('start')) {
            $userlogmod->where('created_at >=', $this->request->getVar('start'));
        }
        if ($this->request->getVar('end')) {
            $userlogmod->where('created_at <=', $this->request->getVar('end'));
        }
        $userlogmod->orderBy('created_at', 'DESC');
        $data = $userlogmod->get()->getResult();

        return json_encode($data);
    }

    public function validation()
    {
        $usermod = new UserModel();
        $data = $usermod->where('email', $this->request->getVar('email'))->get()->getResult();
        if ($data) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function get($type)
    {
        $type       = strtoupper($type);
        $usermod    = new UserModel();
        $data       = $usermod->where('type', $type)->get()->getResult();

        return json_encode($data);
    }

    public function getlogid($id)
    {
        $userlogmod = new UserlogModel();
        $data = $userlogmod->where('id', $id)->get()->getRow();
        return json_encode($data);
    }
}

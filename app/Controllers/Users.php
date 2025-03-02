<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
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
            'password'      => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'type'          => $this->request->getVar('type'),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $usermod = new UserModel();
        $usermod->save($data);

        return $this->respond(['message' => 'Create user successfully!'], 200);
    }

    public function changepassword()
    {
        $data = [
            'password'      => password_hash($this->request->getVar('newpassword'), PASSWORD_DEFAULT),
        ];

        $usermod = new UserModel();
        $usermod->set($data)->where('user_id', $this->request->getVar('user_id'))->update();

        return $this->respond(['message' => 'Change password successfully!'], 200);
    }

    public function delete()
    {
        $usermod = new UserModel();
        $usermod->where('user_id', $this->request->getVar('user_id'))->delete();

        return $this->respond(['message' => 'Delete user successfully!'], 200);
    }

    public function createid()
    {
        $usermod = new UserModel();
        $lastdata = $usermod->orderBy('created_at', 'DESC')->limit(1)->get()->getRow();
        if($lastdata){
            $lastid = $lastdata->user_id;
            //U + [2 digit year] + [3 digit sequence]
            $lastyear = substr($lastid, 1, 2);
            $lastseq = (int)substr($lastid, 3, 4);
            if(date('y') == $lastyear){
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
}

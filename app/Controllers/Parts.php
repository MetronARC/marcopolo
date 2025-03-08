<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\PartsModel;
use App\Models\PartslogModel;

class Parts extends BaseController
{
    use ResponseTrait;

    public function insert()
    {
        $data = [
            'part_id'       => $this->createid(),
            'device'        => $this->request->getVar('device'),
            'brand'         => $this->request->getVar('brand'),
            'type'          => $this->request->getVar('type'),
            'name'          => $this->request->getVar('name'),
            'price'         => $this->request->getVar('price'),
            'status'        => 'STOCK',
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $partmod = new PartsModel();
        $partmod->save($data);

        return $this->respond(['message' => 'Insert sparepart successfully!'], 200);
    }

    public function assign()
    {
        $data = [
            'rma'           => $this->request->getVar('rma'),
            'status'        => 'ASSIGNED',
        ];

        $partmod = new PartsModel();
        $partmod->set($data)->where('part_id', $this->request->getVar('part_id'))->update();

        return $this->respond(['message' => 'Assign sparepart successfully!'], 200);
    }

    public function use()
    {
        $data = [
            'used_at'   => date('Y-m-d H:i:s'),
            'status'    => 'USED',
        ];

        $partmod = new PartsModel();
        $partmod->set($data)->where('part_id', $this->request->getVar('part_id'))->update();

        $log = [
            'rma'           => $this->request->getVar('rma'),
            'engineer'      => $this->request->getVar('engineer'),
            'part_id'       => $this->request->getVar('part_id'),
            'status'        => 'USED',
            'used'          => true,
            'note'          => $this->request->getVar('note'),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $partlogmod = new PartslogModel();
        $partlogmod->save($log);

        return $this->respond(['message' => 'Update sparepart successfully!'], 200);
    }

    public function search()
    {
        $partmod = new PartsModel();
        if ($this->request->getVar('brand')) { $partmod->where('brand');}
        if ($this->request->getVar('type')) { $partmod->where('type');}
        if ($this->request->getVar('name')) { $partmod->where('name');}
        $data = $partmod->get()->getResult();

        return json_encode($data);
    }

    public function cancel()
    {
        $data = [
            'rma'       => null,
            'status'    => 'STOCK',
        ];

        $partmod = new PartsModel();
        $partmod->set($data)->where('part_id', $this->request->getVar('part_id'))->update();

        $log = [
            'rma'           => $this->request->getVar('rma'),
            'engineer'      => $this->request->getVar('engineer'),
            'part_id'       => $this->request->getVar('part_id'),
            'status'        => 'CANCEL',
            'used'          => false,
            'note'          => $this->request->getVar('note'),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $partlogmod = new PartslogModel();
        $partlogmod->save($log);

        return $this->respond(['message' => 'Update sparepart successfully!'], 200);
    }

    public function createid()
    {
        $partmod = new PartsModel();
        $lastdata = $partmod->orderBy('created_at', 'DESC')->limit(1)->get()->getRow();
        if($lastdata){
            $lastid = $lastdata->user_id;
            //P + [2 digit year] + [2 digit year] + [2 digit year] + [3 digit sequence]
            $lastyear   = substr($lastid, 1, 2);
            $lastmonth  = substr($lastid, 3, 2);
            $lastday    = substr($lastid, 5, 2);
            $lastseq    = (int)substr($lastid, 7, 3);
            if(date('y') == $lastyear){
                if(date('m') == $lastmonth){
                    if(date('d') == $lastday){
                        $newseq     = $lastseq + 1;
                        $newid      = 'P' . $lastyear . $lastmonth . $lastday . sprintf("%03d", $newseq); 
                    } else {
                        $newid      = 'P' . $lastyear . $lastmonth . date('d') . sprintf("%03d", 1); 
                    };
                } else {
                    $newid      = 'P' . $lastyear . date('m') . date('d') . sprintf("%03d", 1); 
                }
            } else {
                $newid      = 'P' . date('y') . date('m') . date('d') . sprintf("%03d", 1); 
            }
        } else {
            $newid      = 'P' . date('y') . date('m') . date('d') . sprintf("%03d", 1);
        }

        return $newid;
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use App\Models\TicketModel;
use App\Models\TicketlogModel;
use App\Models\UserlogModel;
use App\Models\DeviceModel;

class Ticket extends BaseController
{
    use ResponseTrait;

    public function create()
    {
        if ($this->request->getVar('customdevice')) {
            $device = $this->request->getVar('customdevice');
            $devicemod = new DeviceModel();
            $newdevice = [
                'device'        => $device,
                'created_at'    => date('Y-m-d H:i:s')
            ];
            $devicemod->save($newdevice);
        } else {
            $device = $this->request->getVar('device');
        }

        $data = [
            'rma' => $this->createrma(),
            'customer_name' => $this->request->getVar('customer_name'),
            'customer_address' => $this->request->getVar('customer_address'),
            'customer_phone' => $this->request->getVar('customer_phone'),
            'customer_email' => $this->request->getVar('customer_email'),
            'service_no' => $this->request->getVar('service_no'),
            'device' => $device,
            'brand' => $this->request->getVar('brand'),
            'type' => $this->request->getVar('type'),
            'sn' => $this->request->getVar('sn'),
            'warranty' => $this->request->getVar('warranty'),
            'warranty_date' => $this->request->getVar('warranty_date'),
            'device_condition' => $this->request->getVar('device_condition'),
            'problem' => $this->request->getVar('problem'),
            'detail_problem' => $this->request->getVar('detail_problem'),
            'accessories' => $this->request->getVar('accessories'),
            'engineer' => $this->request->getVar('engineer'),
            'ticket_status' => 'CHECKING',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $ticketmod = new TicketModel();
        $ticketmod->save($data);

        $ticketlog = [
            'rma' => $data['rma'],
            'note' => 'Ticket created',
            'user' => $this->request->getVar('user'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $ticketlogmod = new TicketlogModel();
        $ticketlogmod->save($ticketlog);

        $logmod = new UserlogModel();
        $log = [
            'userid'         => session('userid'),
            'email'          => session('email'),
            'name'           => session('name'),
            'action'         => '/ticket/create',
            'created_at'     => date('Y-m-d H:i:s'),
            'description'    => json_encode($data),
        ];
        $logmod->insert($log);

        return $this->respond(['message' => 'Create ticket successfully!'], 200);
    }

    public function update_engineer()
    {
        $data = [
            'ticket_status' => $this->request->getVar('ticket_status'),
        ];

        $ticketmod = new TicketModel();
        $ticketmod->set($data)->where('rma', $this->request->getVar('rma'))->update();

        $ticketlog = [
            'rma' => $this->request->getVar('rma'),
            'note' => $this->request->getVar('note'),
            'user' => $this->request->getVar('user'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $ticketlogmod = new TicketlogModel();
        $ticketlogmod->save($ticketlog);

        $logmod = new UserlogModel();
        $log = [
            'userid'         => session('userid'),
            'email'          => session('email'),
            'name'           => session('name'),
            'action'         => '/ticket/update/engineer',
            'created_at'     => date('Y-m-d H:i:s'),
            'description'    => json_encode($data),
        ];
        $logmod->insert($log);

        return $this->respond(['message' => 'Update ticket successfully!'], 200);
    }

    public function update_cs()
    {
        if ($this->request->getVar('ticket_status') == 'CHECKING') {
            $data = [
                'ticket_status' => $this->request->getVar('ticket_status'),
            ];

            $ticketmod = new TicketModel();
            $ticketmod->set($data)->where('rma', $this->request->getVar('rma'))->update();

            $ticketlog = [
                'rma' => $this->request->getVar('rma'),
                'note' => $this->request->getVar('note'),
                'user' => $this->request->getVar('user'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $ticketlogmod = new TicketlogModel();
            $ticketlogmod->save($ticketlog);

            $logmod = new UserlogModel();
            $log = [
                'userid'         => session('userid'),
                'email'          => session('email'),
                'name'           => session('name'),
                'action'         => '/ticket/update/cs',
                'created_at'     => date('Y-m-d H:i:s'),
                'description'    => json_encode($ticketlog),
            ];
            $logmod->insert($log);

            return $this->respond(['message' => 'Update ticket successfully!'], 200);
        } else {
            $data = [
                'ticket_status' => $this->request->getVar('ticket_status'),
                'close_date' => date('Y-m-d H:i:s'),
                'payment' => $this->request->getVar('payment'),
                'payment_amount' => $this->request->getVar('payment_amount'),
                'payment_at' => date('Y-m-d H:i:s'),
                'payment_note' => $this->request->getVar('payment_note'),
            ];

            $ticketmod = new TicketModel();
            $ticketmod->set($data)->where('rma', $this->request->getVar('rma'))->update();

            $ticketlog = [
                'rma' => $this->request->getVar('rma'),
                'note' => 'Ticket closed',
                'user' => $this->request->getVar('user'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $ticketlogmod = new TicketlogModel();
            $ticketlogmod->save($ticketlog);

            $logmod = new UserlogModel();
            $log = [
                'userid'         => session('userid'),
                'email'          => session('email'),
                'name'           => session('name'),
                'action'         => '/ticket/update/cs',
                'created_at'     => date('Y-m-d H:i:s'),
                'description'    => json_encode($ticketlog),
            ];
            $logmod->insert($log);

            return $this->respond(['message' => 'Update ticket successfully!'], 200);
        }
    }

    public function unfinish()
    {
        $ticketmod = new TicketModel();
        $data = $ticketmod->where('status !==', 'FINISHED')->get()->getResult();
        return json_encode($data);
    }

    public function unfinish_checking()
    {
        $ticketmod = new TicketModel();
        $data = $ticketmod->orderBy('created_at', 'DESC')->where('ticket_status', 'CHECKING')->get()->getResult();

        return json_encode($data);
    }

    public function unfinish_part()
    {
        $ticketmod = new TicketModel();
        $data = $ticketmod->orderBy('created_at', 'DESC')->where('ticket_status', 'WAIT FOR PART')->get()->getResult();

        return json_encode($data);
    }

    public function unfinish_engineer()
    {
        $status = [
            'CHECKING',
            'WAIT FOR PART',
            'WAIT FOR DATA',
            'WAIT FOR PASSWORD',
            'WAIT FOR PRICE',
            'WAIT FOR PREPLACEMENT',
            'WAIT FOR UNIT',
            'WAIT FOR ESCALATION',
        ];
        $ticketmod = new TicketModel();
        $ticketmod->orderBy('created_at', 'DESC');
        $ticketmod->where('engineer', $this->request->getVar('user'));
        $ticketmod->whereIn('ticket_status', $status);
        $data = $ticketmod->get()->getResult();

        return json_encode($data);
    }

    public function unfinish_cs()
    {
        $status = [
            'CHECKING',
            'WAIT FOR PICKUP',
        ];
        $ticketmod = new TicketModel();
        $data = $ticketmod->orderBy('created_at', 'DESC')->whereIn('ticket_status', $status)->get()->getResult();

        return json_encode($data);
    }

    public function finish()
    {
        //
    }

    public function view()
    {
        $ticketmod = new TicketModel();
        $dataticket = $ticketmod->where('rma', $this->request->getVar('rma'))->get()->getRow();

        $ticketlogmod = new TicketlogModel();
        $datalog = $ticketlogmod->where('rma', $this->request->getVar('rma'))->orderBy('created_at', 'DESC')->get()->getResult();

        $dataticket->log = $datalog;
        return json_encode($dataticket);
    }

    public function stat()
    {
        $ticketmod      = new TicketModel();
        $ticketlogmod   = new TicketlogModel();
        $unfinish       = $ticketmod->orderBy('created_at', 'DESC')->where('ticket_status !=', 'FINISHED')->get()->getResult();
        $ticketCounts   = [];

        foreach ($unfinish as $ticket) {
            $status = strtolower($ticket->ticket_status);
            if($status == 'checking'){
                $logs = $ticketlogmod->where('rma', $ticket->rma)->get()->getResult();
                if (count($logs) == 1) {
                    if (!isset($ticketCounts['New Ticket'])) {
                        $ticketCounts['New Ticket'] = 0;
                    } else {
                        $ticketCounts['New Ticket']++;
                    }
                } else {
                    if (!isset($ticketCounts['Repair'])) {
                        $ticketCounts['Repair'] = 0;
                    } else {
                        $ticketCounts['Repair']++;
                    }
                }
            } else {
                if (!isset($ticketCounts[ucwords($status)])) {
                    $ticketCounts[ucwords($status)] = 0;
                }
                $ticketCounts[ucwords($status)]++;
            }
        }
        return json_encode($ticketCounts);
    }

    public function stat_device()
    {
        $ticketmod      = new TicketModel();
        $ticketmod->where('created_at >=', date('Y-m-01 00:00:00'));
        $ticketmod->where('created_at <=', date('Y-m-d 23:59:59'));
        $data = $ticketmod->get()->getResult();

        $deviceCounts = [];
        foreach ($data as $item) {
            $device = $item->device;
            if (!isset($deviceCounts[$device])) {
                $deviceCounts[$device] = 0;
            }
            $deviceCounts[$device]++;
        }

        return json_encode($deviceCounts);
    }

    public function stat_engineer()
    {
        $ticketmod      = new TicketModel();
        $ticketmod->where('created_at >=', date('Y-m-01 00:00:00'));
        $ticketmod->where('created_at <=', date('Y-m-d 23:59:59'));
        $ticketmod->where('engineer', $this->request->getVar('user'));
        $data = $ticketmod->get()->getResult();

        $ticketCounts = [];
        foreach ($data as $item) {
            $status = $item->ticket_status;
            if (!isset($ticketCounts[$status])) {
                $ticketCounts[$status] = 0;
            }
            $ticketCounts[$status]++;
        }

        return json_encode($ticketCounts);
    }

    public function createrma()
    {
        $ticketmod = new TicketModel();
        $lastdata = $ticketmod->orderBy('created_at', 'DESC')->limit(1)->get()->getRow();
        if ($lastdata) {
            $lastid = $lastdata->rma;
            //T + [2 digit year] + [2 digit month] + [3 digit sequence]
            $lastyear = substr($lastid, 1, 2);
            $lastmonth = substr($lastid, 3, 2);
            $lastseq = (int)substr($lastid, 5, 3);
            if (date('y') == $lastyear) {
                if (date('m') == $lastmonth) {
                    $newseq = $lastseq + 1;
                    $newid = 'T' . $lastyear . $lastmonth . sprintf("%03d", $newseq);
                    return $newid;
                } else {
                    $newid = 'T' . $lastyear . date('m') . sprintf("%03d", 1);
                    return $newid;
                }
            } else {
                $newid = 'T' . date('y') . date('m') . sprintf("%03d", 1);
                return $newid;
            }
        } else {
            $newid = 'T' . date('y') . date('m') . sprintf("%03d", 1);
            return $newid;
        }
    }

    public function ticketprint($rma)
    {
        $ticketmod      = new TicketModel();
        $data = $ticketmod->where('rma', $rma)->get()->getRow();
        $container = [
            'ticket' => $data
        ];
        return view('pages/ticketprint', $container);
    }

    public function getdevice()
    {
        $devicemod = new DeviceModel();
        $data = $devicemod->findAll();
        return json_encode($data);
    }

    public function search()
    {
        $ticketmod      = new TicketModel();
        if ($this->request->getVar('search_rma')) {
            $ticketmod->where('rma', $this->request->getVar('search_rma'));
        }
        if ($this->request->getVar('search_engineer')) {
            $ticketmod->where('engineer', $this->request->getVar('search_engineer'));
        }
        if ($this->request->getVar('search_status')) {
            $ticketmod->where('ticket_status', $this->request->getVar('search_status'));
        }
        if ($this->request->getVar('search_device')) {
            $ticketmod->where('device', $this->request->getVar('search_device'));
        }
        if ($this->request->getVar('search_startdate')) {
            $ticketmod->where('created_at >=', $this->request->getVar('search_startdate'));
        }
        if ($this->request->getVar('search_enddate')) {
            $ticketmod->where('created_at <=', $this->request->getVar('search_enddate'));
        }

        $data = $ticketmod->orderBy('created_at', 'DESC')->get()->getResult();
        return json_encode($data);
    }
}

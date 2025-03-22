<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pages extends BaseController
{
    public function index()
    {
        return view('dashboard');
    }

    public function ticketEngineer()
    {
        return view('pages/engineer');
    }

    public function ticketCS()
    {
        return view('pages/customerService');
    }

    public function parts()
    {
        return view('pages/parts');
    }

    public function engineerDetails()
    {
        return view('pages/engineerDetails');
    }

    public function performance()
    {
        return view('pages/performance');
    }

    public function viewTicket()
    {
        $session = session();
        if (!$session->has('view_ticket_rma')) {
            return redirect()->to('/engineer');
        }
        return view('pages/view_ticket');
    }

    public function setViewTicket()
    {
        $rma = $this->request->getPost('rma');
        if ($rma) {
            $session = session();
            $session->set('view_ticket_rma', $rma);
            return redirect()->to('/view_ticket');
        }
        return redirect()->to('/engineer');
    }
} 
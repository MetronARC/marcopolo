<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Pages extends BaseController
{
    public function index()
    {
        return view('pages/dashboard');
    }

    public function customerDatabase()
    {
        return view('pages/customer-database');
    }

    public function salesReport()
    {
        return view('pages/sales-report');
    }

    public function shipInquiry()
    {
        return view('pages/ship-inquiry');
    }
} 
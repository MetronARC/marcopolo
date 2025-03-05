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
} 
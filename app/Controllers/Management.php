<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Management extends BaseController
{
    public function index()
    {
        return view('management');
    }
}

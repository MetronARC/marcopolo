<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CILogViewer\CILogViewer;

class Logs extends BaseController
{
    public function index() {
        $logViewer = new CILogViewer();
        return $logViewer->showLogs();
    }
}

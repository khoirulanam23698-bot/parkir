<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
       
        $logs = ActivityLog::latest()->get();
        
        // Tampilkan ke view
        return view('admin.activity_logs.index', compact('logs'));
    }
}
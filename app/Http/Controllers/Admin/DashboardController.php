<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Project;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'messagesCount' => Message::count(),
            'unreadCount' => Message::whereNull('read_at')->count(),
            'projectsCount' => Project::count(),
            'servicesCount' => Service::count(),
            'recentMessages' => Message::latest()->take(5)->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;

class SiteController extends Controller
{
    public function home()
    {
        return view('home', [
            'settings' => Setting::many([
                'site_name', 'hero_title', 'hero_accent', 'hero_subtitle',
                'about_text', 'about_photo',
                'contact_email', 'contact_phone', 'contact_whatsapp',
                'linkedin_url', 'github_url', 'location',
            ]),
            'services' => Service::orderBy('position')->get(),
            'projects' => Project::orderBy('position')->get(),
        ]);
    }

    public function project(Project $project)
    {
        return view('projects.show', [
            'project' => $project,
            'settings' => Setting::many(['site_name', 'contact_email', 'contact_whatsapp']),
            'otherProjects' => Project::where('id', '!=', $project->id)->orderBy('position')->take(2)->get(),
        ]);
    }
}

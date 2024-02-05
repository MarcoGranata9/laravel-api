<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with('type')->paginate(8);
        return response()->json([
            'results' => $projects,
            'success' => true,
        ]);
    }

    public function show($slug) {
        $project = Project::with('type')->where('slug', $slug)->first();

        if ($project) {
            return response()->json([
                'results' => $project,
                'success' => true,
            ]);
        } else {
            return response()->json([
                'message' => 'Nessun progetto trovato',
                'success' => false,
            ]);
        }
    }
}

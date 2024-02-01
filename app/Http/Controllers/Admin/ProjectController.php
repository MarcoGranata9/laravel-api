<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $project = new Project();
        $project->fill($form_data);

        // Salvataggio immagine
        if($request->hasFile('cover_img')) {
            $path = Storage::put('project_images', $request->cover_img);
            $project->cover_img = $path;
        }

        $project->save();

        if ($request->has('technologies')) {
            $project->technologys()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', ['project'=> $project->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateProjectRequest  $request
     * @param  App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();

        // Gestione immagini
        if($request->hasFile('cover_img')) {
            // Se il post ha un'immagine allora cancellala
            if($project->cover_img) {
                Storage::delete($project->cover_img);
            }

            $path = Storage::put('project_images', $request->cover_img);
            $form_data['cover_img'] = $path;
        }

        $project->update($form_data);

        if ($request->has('technologies')) {
            $project->technologys()->sync($request->technologies);
        } else {
            $project->technologys()->sync([]);
        }
        
        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "$project->title è stato eliminato");
    }

    public function trash()
    {
        $projects = Project::onlyTrashed()->get();

        return view('admin.projects.trash', compact('projects'));
    }

    public function trash_delete($slug)
    {
        $project = Project::onlyTrashed()->where('slug', $slug)->first();
        $project->forceDelete();
        

        return redirect()->route('admin.projects.trash')->with('message', "$project->title è stato eliminato definitivamente");
    }

    public function restore($slug)
    {
        $project = Project::onlyTrashed()->where('slug', $slug)->first();
        $project->restore();

        return redirect()->route('admin.projects.index')->with('message', "$project->title è stato ripristinato");
    }
}
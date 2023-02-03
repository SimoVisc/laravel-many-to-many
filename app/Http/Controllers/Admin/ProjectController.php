<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        
        $data = $request->validated();

        if ( isset($data['cover_image']) ) {
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }
        
        
        $new_project = new Project();
        $new_project->fill($data);
        $new_project->slug = Str::slug($new_project->name);
        $new_project->save();

        return redirect()->route('admin.projects.index')->with('message', "The Project $new_project->name was successfully created!");
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        $old_name = $project->name;

        $project->slug = Str::slug($data['name']);
        if ( isset($data['cover_image']) ) {
            if( $project->cover_image ) {
                Storage::delete($project->cover_image);
            }
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }

        if( isset($data['no_image']) && $project->cover_image  ) {
            Storage::delete($project->cover_image);
            $project->cover_image = null;
        }
        $project->update($data);

        return redirect()->route('admin.projects.index')->with('message', "The project $old_name was successfully updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $old_name = $project->name;

        
        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', "The project $old_name was successfully deleted!");
    }
}

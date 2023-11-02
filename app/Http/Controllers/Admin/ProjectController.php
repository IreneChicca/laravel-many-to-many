<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Type;
use App\Models\Technology;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     ** @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     ** @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types= Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     ** @param  \Illuminate\Http\Request  $request
     ** @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        
        $data = $request->validated();

        $project = new Project();
        $project->fill($data);

        if(Arr::exists($data, 'img')) {
        $img_path = Storage::put("uploads/projects/img",$data['img']);
        $project->img= $img_path;
        };

        $project->save();

        if(Arr::exists($data, 'technologies')) {
        $project->technologies()->attach($data['technologies']);}

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     ** @param  int  $id
     ** @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     ** @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types= Type::all();
        $technologies = Technology::all();

        $tech_ids = $project->technologies->pluck('id')->toArray();
        return view('admin.projects.edit', compact('project', 'types','technologies','tech_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Project $project)
    {
        $data = $request->all();
        $project->update($data);


        if(Arr::exists($data, 'img')) {

            if($project->img){
                Storage::delete($project->img);

            }

            $img_path = Storage::put("uploads/projects/img",$data['img']);
            $project->img= $img_path;
        }

        $project->save();

        if(Arr::exists($data, "technologies"))
        $project->technologies()->sync($data["technologies"]);
        else
        $project->technologies()->detach();
    
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();

        if($project->img){
            Storage::delete($project->img);

        }

        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
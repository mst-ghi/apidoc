<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Version;
use PDF;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$projects = Project::whereUserId(auth()->user()->id)->latest()->get();
		return view('project-list', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
        $this->validate(request(), [
        	'name'        => "required",
        	'platform'    => "required",
        	'description' => "required",
		]);
        $project = new Project();
        $project->user_id     = auth()->user()->id;
        $project->name        = $request->name;
        $project->platform    = $request->platform;
        $project->description = $request->description;
		$project->status      = isset($request->status)?true:false;
		$project->save();

        $version = new Version();
        $version->project_id = $project->id;
        $version->version    = "1.0.0";
        $version->explain    = $request->description??"This is Test Description";
        $version->save();

		return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project $project
     * @param  Version|null $version
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Version $version=null)
    {
        /** @var Version $version */
        if ($version){
            $versio = $version;
        }else{
            $versio = Version::whereProjectId($project->id)->orderBy('created_at', 'desc')->first();
        }

        return view('project.project', compact('project', 'versio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('project.project-update', compact('project'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Project      $project
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Project $project)
    {
		$this->validate(request(), [
			'name'        => "required",
			'platform'    => "required",
			'description' => "required",
		]);
		$project->name        = $request->name;
		$project->platform    = $request->platform;
		$project->description = $request->description;
		$project->status      = isset($request->status)?true:false;
		$project->save();

		return redirect()->route('projects.show', ['project'=>$project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
		try {
			$project->delete();
		} catch (\Exception $e) {
		}
		return redirect()->back();
    }

	/**
	 * @param Project $project
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function active(Project $project)
	{
		$project->status = true;
		$project->save();
		return redirect()->back();
    }

	/**
	 * @param Project $project
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deactive(Project $project)
	{
		$project->status = false;
		$project->save();
		return redirect()->back();
    }

    /**
     * @param Project $project
     * @param Version $version
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function reportRoute(Project $project, Version $version)
	{
        $pro = Project::whereUserId(auth()->user()->id)->findOrFail($project->id);
        $ver = Version::whereProjectId($pro->id)->findOrFail($version->id);
        $routes = $ver->getAllRoute();
		return view('report.report-route', compact('routes', 'ver'));
    }

	/**
	 * @param Project $project
	 * @return mixed
	 */
	public function downloadPdfRoute(Project $project, Version $version)
	{
	    $pro = Project::whereUserId(auth()->user()->id)->findOrFail($project->id);
	    $ver = Version::whereProjectId($pro->id)->findOrFail($version->id);
	    $routes = $ver->getAllRoute();
		$pdf = PDF::loadView('report.report-route-download', compact('routes'));
		return $pdf->download('report-route.pdf');
    }
}

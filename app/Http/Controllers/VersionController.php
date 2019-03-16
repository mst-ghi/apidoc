<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Project $project)
    {
        return view('version.version', compact('project'));
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
     * @return
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
           'pro_id'  => 'required|numeric',
           'version' => 'required|string',
           'explain' => 'required|string',
        ]);

        $version = new Version();
        $version->project_id = $request->pro_id;
        $version->version    = $request->version;
        $version->explain    = $request->explain;
        $version->save();

        return redirect()->route('projects.show', ['project'=>$request->pro_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function show(Version $version)
    {
        return view('version.version-update', compact('version'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showSelect(Request $request)
    {
        return redirect()->route('projects.show.ver', ['project'=>$request->ver_pro_id, 'version'=>$request->ver_id_select]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function edit(Version $version)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Version $version
     * @return
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Version $version)
    {
        $this->validate(request(), [
            'version' => 'required|string',
            'explain' => 'required|string',
        ]);

        $version->version    = $request->version;
        $version->explain    = $request->explain;
        $version->save();

        return redirect()->route('versions.index.pro', ['project'=>$version->project_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        try {
            $version->delete();
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Version;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Version $version
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Version $version)
    {
        $routes = $version->getAllRoute();
        return view('route.route-list', compact('version', 'routes'));
    }

    /**
     * @param Route $route
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details(Route $route)
    {
//        $comments = $route->comments;
//        $requests = $route->requests;
//        $responses = $route->responses;
        return view('route.deatils', compact('route', ''));
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
        	'folder_id'      =>'required',
        	'uri'            =>'required',
        	'methodd'        =>'required',
        	'description'    =>'required',
		]);

        $route = new Route();
        $route->folder_id   = $request->folder_id;
        $route->uri 		= $request->uri;
        $route->method 	    = $request->methodd;
        $route->description = $request->description;
        $route->status      = isset($request->status)?true:false;
        $route->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        return view('route.route', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Route        $route
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Route $route)
    {
		$this->validate(request(), [
			'uri'         =>'required',
			'methodd'     =>'required',
			'description' =>'required',
		]);

		$route->uri 		= $request->uri;
		$route->method 	    = $request->methodd;
		$route->description = $request->description;
		$route->status      = isset($request->status)?true:false;
		$route->save();

		return redirect()->route('projects.show', ['project'=>$route->project_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
		try {
			$route->delete();
		} catch (\Exception $e) {
		}
		
		return redirect()->back();
	}


	/**
	 * @param Route $route
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function active(Route $route)
	{
		$route->status = true;
		$route->save();
		return redirect()->back();
	}

	/**
	 * @param Route $route
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deactive(Route $route)
	{
		$route->status = false;
		$route->save();
		return redirect()->back();
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Route;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param Route $route
	 * @return \Illuminate\Http\Response
	 */
    public function index(Route $route)
    {
		$responses = $route->responses;
		return view('response.response', compact('responses', 'route'));
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
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(Request $request)
    {
		$this->validate(request(), [
			'route_id'    => 'required',
			'fields'      => 'required',
			'description' => 'required',
		]);

		$response = new Response();
		$response->route_id    = $request->route_id;
		$response->fields      = $request->fields;
		$response->description = $request->description;
		$response->status      = isset($request->status)?true:false;
		$response->save();

		return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        return view('response.response-update', compact('response'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Response     $response
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Response $response)
    {
		$this->validate(request(), [
			'fields'      => 'required',
			'description' => 'required',
		]);

		$response->fields      = $request->fields;
		$response->description = $request->description;
		$response->status      = isset($request->status)?true:false;
		$response->save();

		return redirect()->route('responses.index.route', ['route'=>$response->route_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
		try {
			$response->delete();
		} catch (\Exception $e) {
		}
		return redirect()->back();
	}

	/**
	 * @param Response $response
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function active(Response $response)
	{
		$response->status = true;
		$response->save();
		return redirect()->back();
	}

	/**
	 * @param Response $response
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deactive(Response $response)
	{
		$response->status = false;
		$response->save();
		return redirect()->back();
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Route;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param Route $route
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(Route $route)
    {
		$requests = $route->requests;
		return view('request.request', compact('requests', 'route'));
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
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function store(HttpRequest $request)
    {
		$this->validate(request(), [
			'route_id'    => 'required',
			'fields'      => 'required',
			'description' => 'required',
		]);

		$requestModel = new Request();
		$requestModel->route_id    = $request->route_id;
		$requestModel->fields      = $request->fields;
		$requestModel->description = $request->description;
		$requestModel->status      = isset($request->status)?true:false;
		$requestModel->save();

		return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
		return view('request.request-update', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param HttpRequest $httpRequest
	 * @param Request     $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(HttpRequest $httpRequest, Request $request)
    {
		$this->validate(request(), [
			'fields'      => 'required',
			'description' => 'required',
		]);

		$request->fields      = $httpRequest->fields;
		$request->description = $httpRequest->description;
		$request->status      = isset($httpRequest->status)?true:false;
		$request->save();

		return redirect()->route('requests.index.route', ['route'=>$request->route_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
		try {
			$request->delete();
		} catch (\Exception $e) {
		}
		return redirect()->back();
	}


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function active(Request $request)
	{
		$request->status = true;
		$request->save();
		return redirect()->back();
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deactive(Request $request)
	{
		$request->status = false;
		$request->save();
		return redirect()->back();
	}
}

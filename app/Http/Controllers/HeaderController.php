<?php

namespace App\Http\Controllers;

use App\Models\Header;
use App\Models\Route;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param Route $route
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(Route $route)
    {
    	$headers = $route->headers;
        return view('header.header', compact('headers', 'route'));
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
        	'route_id'    => 'required',
        	'fields'      => 'required',
        	'description' => 'required',
		]);

        $header = new Header();
        $header->route_id    = $request->route_id;
        $header->fields      = $request->fields;
        $header->description = $request->description;
		$header->status      = isset($request->status)?true:false;
		$header->save();

		return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function show(Header $header)
    {
        return view('header.header-update', compact('header'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function edit(Header $header)
    {
        //
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Models\Header       $header
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function update(Request $request, Header $header)
    {
		$this->validate(request(), [
			'fields'      => 'required',
			'description' => 'required',
		]);

		$header->fields      = $request->fields;
		$header->description = $request->description;
		$header->status      = isset($request->status)?true:false;
		$header->save();

		return redirect()->route('headers.index.route', ['route'=>$header->route_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function destroy(Header $header)
    {
		try {
			$header->delete();
		} catch (\Exception $e) {
		}
		return redirect()->back();
	}


	/**
	 * @param Header $header
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function active(Header $header)
	{
		$header->status = true;
		$header->save();
		return redirect()->back();
	}

	/**
	 * @param Header $header
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deactive(Header $header)
	{
		$header->status = false;
		$header->save();
		return redirect()->back();
	}
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Route;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param Route $route
	 * @return
	 */
    public function index(Route $route)
    {
        $comments = Comment::whereRouteId($route->id)->orderBy('created_at', 'desc')->get();
        return view('comment.comment', compact('route', 'comments'));
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
           'route_id' => 'required',
           'title'    => 'required|string',
           'body'     => 'required|string',
        ]);
        
        /** @var Comment $comment */
        $comment = new Comment();
        $comment->route_id = $request->route_id;
        $comment->title    = $request->title;
        $comment->body     = $request->body;
        $comment->status   = isset($request->status)??0;
        $comment->save();
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('comment.comment-update', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Comment $comment)
    {
        $this->validate(request(), [
            'title'    => 'required|string',
            'body'     => 'required|string',
        ]);

        $comment->title    = $request->title;
        $comment->body     = $request->body;
        $comment->status   = isset($request->status)??0;
        $comment->save();

        return redirect()->route('comments.index.route', ['route'=>$comment->route_id]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }


    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active(Comment $comment)
    {
        $comment->status = true;
        $comment->save();
        return redirect()->back();
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactive(Comment $comment)
    {
        $comment->status = false;
        $comment->save();
        return redirect()->back();
    }
}

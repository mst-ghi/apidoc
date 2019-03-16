@extends('layouts.app')

@section('styles')
    <style>
        td a{
            margin-right: 5px !important;
        }
    </style>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary mr-1" href="{{route('routes.index.ver',['version'=>$route->folder->version->id])}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link btn btn-success mr-1 hvr-bubble-bottom"
                                    data-toggle="modal" data-target="#commentModal"><i class="fa fa-plus"></i> Add Comment</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h2><span class="badge badge-info hvr-bounce-in mr-2">{{strtoupper($route->method)}}</span> <b>{{$route->uri}}</b></h2>
                    <h4 class="text-justify">{{$route->description}}</h4>

                    <br>
                    <h5 class="card-title">List of Comments</h5>
                    @foreach($comments as $item)
                    <div class="jumbotron jumbotron-fluid">
                        <div class="row">
                            <div class="col-10">
                                <div class="container">
                                    <h5>Author : {{$item->user->name}}</h5>
                                    <h2>Title : {{$item->title}}</h2>
                                    <p class="lead text-justify">{{$item->body}}</p>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <a href="{{route('comments.show', ['comment'=>$item->id])}}" class="hvr-pulse mb-3"><i class="fa fa-edit text-primary"
                                                                style="font-size: 1.3rem"></i></a><br>
                                @if ($item->status == 1)
                                    <a href="{{route('comments.deactive', ['comment'=>$item->id])}}"
                                       class="hvr-pulse mb-3"><i class="fas fa-flag text-info"
                                                            style="font-size: 1.3rem"></i></a><br>
                                @else
                                    <a href="{{route('comments.active', ['comment'=>$item->id])}}"
                                       class="hvr-pulse mb-3"><i class="far fa-flag text-dark"
                                                            style="font-size: 1.3rem"></i></a><br>
                                @endif
                                <a href="{{route('comments.destroy', ['comment'=>$item->id])}}" class="hvr-pulse mb-3"
                                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$item->id}}').submit();"
                                ><i class="fa fa-trash text-danger" style="font-size: 1.3rem"></i></a>
                                <form id="delete-form-{{$item->id}}"
                                      action="{{route('comments.destroy', ['comment'=>$item->id])}}" method="POST"
                                      style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Route Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add new Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('comments.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="route_id" value="{{$route->id}}" required>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" aria-describedby="title" id="title" name="title" placeholder="Title" value="{{old('title')}}" required>
                        <small id="title" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea type="text" class="form-control" aria-describedby="body" id="body" name="body" placeholder="Body" required>{{old('body')}}</textarea>
                        <small id="body" class="form-text text-muted">Body Of Comment </small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="status" name="status">
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Store Comment</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

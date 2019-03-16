@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <button type="button" class="nav-link btn btn-success mr-1 hvr-bubble-bottom" data-toggle="modal" data-target="#projectModal"><i class="fa fa-plus"></i> Add Project</button>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>List Of Project </h3>

                    <ul class="list-group list-group-flush">
                        @foreach($projects as $item)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-1 text-center">
                                    <span class="badge badge-secondary mb-3 hvr-bounce-in">{{$item->platform}}</span>
                                    <a href="{{route('projects.show.ver', ['project'=>$item->id, 'version'=>''])}}"><i class="fa fa-eye hvr-pulse-grow" style="font-size: x-large; margin-bottom: 10px"></i></a><br>
                                    <a href="{{route('projects.edit', ['project'=>$item->id])}}"><i class="fa fa-edit hvr-pulse-grow" style="font-size: x-large; margin-bottom: 10px"></i></a><br>
                                    @if ($item->status == 1)
                                    <a href="{{route('projects.deactive', ['project'=>$item->id])}}"><i class="fas fa-flag hvr-pulse-grow" style="font-size: x-large; color: #008500; margin-bottom: 10px"></i></a><br>
                                    @else
                                    <a href="{{route('projects.active', ['project'=>$item->id])}}"><i class="far fa-flag hvr-pulse-grow" style="font-size: x-large; color: dodgerblue; margin-bottom: 10px"></i></a><br>
                                    @endif
                                    <a href="{{route('projects.destroy', ['project'=>$item->id])}}"
                                       onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
                                    ><i class="fa fa-trash-alt hvr-pulse-grow" style="font-size: x-large; color: red; margin-bottom: 10px"></i></a>
                                    <form id="delete-form" action="{{route('projects.destroy', ['project'=>$item->id])}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </div>
                                <div class="col-md-1">
                                    {{$item->name}}
                                </div>
                                <div class="col-md-10 text-justify">
                                    {{$item->description}}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Route Modal -->
<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add New Route</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('projects.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" aria-describedby="name" id="name" name="name" placeholder="Name" value="{{old('name')}}" required>
                        <small id="name" class="form-text text-muted">For Example => Toranj Api</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Platform</label>
                        <input type="text" class="form-control" aria-describedby="platform" id="platform" name="platform" placeholder="Platform" value="{{old('platform')}}" required>
                        <small id="platform" class="form-text text-muted">For Example => Cross</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea type="text" class="form-control" aria-describedby="description" id="description" name="description" placeholder="Description" required>{{old('description')}}</textarea>
                        <small id="description" class="form-text text-muted">Description Of Project</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="status" name="status">
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Store Project</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

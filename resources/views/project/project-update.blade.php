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
                            <a class="nav-link btn btn-primary mr-1" href="{{URL::previous()}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Update <b>{{$project->name}}</b></h5>
                    <form action="{{route('projects.update', ['response'=>$project->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" aria-describedby="name" id="name" name="name" placeholder="Name" value="{{isset($project->name)?$project->name:old('name')}}" required>
                            <small id="name" class="form-text text-muted">For Example => Toranj Api</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Platform</label>
                            <input type="text" class="form-control" aria-describedby="platform" id="platform" name="platform" placeholder="Platform" value="{{isset($project->platform)?$project->platform:old('platform')}}" required>
                            <small id="platform" class="form-text text-muted">For Example => Cross</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea type="text" class="form-control" aria-describedby="description" id="description" name="description" placeholder="Description" required>{{isset($project->description)?$project->description:old('description')}}</textarea>
                            <small id="description" class="form-text text-muted">Description Of Project</small>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" {{$project->status == 1?"checked":""}}>
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
</div>
@endsection

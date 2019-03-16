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
                            <a class="nav-link btn btn-primary mr-1" href="{{route('projects.show',['project'=>$project->id])}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link btn btn-outline-secondary mr-1 hvr-bubble-bottom"
                                    data-toggle="modal" data-target="#versionModal"><i class="fa fa-plus"></i> Add Version</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">List of Version Stored For <b>{{$project->name}}</b> Project</h5>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="10%">Version</th>
                            <th scope="col" width="75%">Explain</th>
                            <th scope="col" width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $row = 1; ?>
                        @foreach($project->versions as $item)
                        <tr>
                            <th scope="row">{{$row}}</th>
                            <td>{{$item->version}}</td>
                            <td><p class="text-justify">{{$item->explain}}</p></td>
                            <td>
                                <a href="{{route('versions.show', ['version'=>$item->id])}}" class="hvr-pulse"><i class="fa fa-edit text-success" style="font-size: 1.3rem"></i></a>
                                <a href="{{route('versions.destroy', ['version'=>$item->id])}}" class="hvr-pulse"
                                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$item->id}}').submit();"
                                ><i class="fa fa-trash text-danger" style="font-size: 1.3rem"></i></a>
                                <form id="delete-form-{{$item->id}}" action="{{route('versions.destroy', ['version'=>$item->id])}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </td>
                        </tr>
						<?php $row++; ?>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Version Modal -->
<div class="modal fade" id="versionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add New Version Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('versions.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="pro_id" value="{{$project->id}}" required>
                    <div class="form-group">
                        <label for="version">Version</label>
                        <input type="text" class="form-control" aria-describedby="version" id="version"
                               name="version" placeholder="Version" value="{{old('version')}}" required>
                        <small id="uri" class="form-text text-muted">For Example => 1.0.0</small>
                    </div>
                    <div class="form-group">
                        <label for="explain">Explain</label>
                        <textarea type="text" class="form-control" aria-describedby="explain" id="explain"
                                  name="explain" placeholder="Explain" required>{{old('explain')}}</textarea>
                        <small id="description" class="form-text text-muted">An Explanation Of The Version</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Store Version</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

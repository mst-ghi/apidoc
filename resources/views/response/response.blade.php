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
                            <button type="button" class="nav-link btn btn-success mr-1 hvr-bubble-bottom" data-toggle="modal" data-target="#responseModal"><i class="fa fa-plus"></i> Add Response</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title">List of Response Parameters For <b>{{$route->uri}}</b> Route</h5>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="25%">Field</th>
                            <th scope="col" width="45%">Description</th>
                            <th scope="col" width="10%">Status</th>
                            <th scope="col" width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $row = 1; ?>
                        @foreach($responses as $item)
                        <tr>
                            <th scope="row">{{$row}}</th>
                            <td>{{$item->fields}}</td>
                            <td><p class="text-justify">{{$item->description}}</p></td>
                            @if ($item->status == 1)
                            <td><span class="badge badge-success hvr-bounce-in" style="font-size: .9rem">Active</span></td>
                            @else
                            <td><span class="badge badge-danger hvr-bounce-in" style="font-size: .9rem">Inactive</span></td>
                            @endif
                            <td>
                                <a href="{{route('responses.show', ['response'=>$item->id])}}" class="hvr-pulse"><i class="fa fa-edit text-success" style="font-size: 1.3rem"></i></a>
                                @if ($item->status == 1)
                                    <a href="{{route('responses.deactive', ['response'=>$item->id])}}" class="hvr-pulse"><i class="fas fa-flag text-info" style="font-size: 1.3rem"></i></a>
                                @else
                                    <a href="{{route('responses.active', ['response'=>$item->id])}}" class="hvr-pulse"><i class="far fa-flag text-dark" style="font-size: 1.3rem"></i></a>
                                @endif
                                <a href="{{route('responses.destroy', ['response'=>$item->id])}}" class="hvr-pulse"
                                   onclick="event.preventDefault(); document.getElementById('delete-form-{{$item->id}}').submit();"
                                ><i class="fa fa-trash text-danger" style="font-size: 1.3rem"></i></a>
                                <form id="delete-form-{{$item->id}}" action="{{route('responses.destroy', ['response'=>$item->id])}}" method="POST" style="display: none;">
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

<!-- Route Modal -->
<div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add new Response Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('responses.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="route_id" value="{{$route->id}}" required>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Field</label>
                        <input type="text" class="form-control" aria-describedby="fields" id="fields" name="fields" placeholder="Field" value="{{old('fields')}}" required>
                        <small id="fields" class="form-text text-muted">For Example => name : Mostafa</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea type="text" class="form-control" aria-describedby="description" id="description" name="description" placeholder="Description" required>{{old('description')}}</textarea>
                        <small id="description" class="form-text text-muted">Description Of Header</small>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="status" name="status">
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Store Response</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

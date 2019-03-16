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
                            <a class="nav-link btn btn-primary" href="{{URL::previous()}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{route('routes.update', ['route'=>$route->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Uri</label>
                            <input type="text" class="form-control" aria-describedby="uri" id="uri" name="uri" placeholder="Uri" value="{{isset($route->uri)?$route->uri:old('uri')}}" required>
                            <small id="uri" class="form-text text-muted">For Example : /user</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Method</label>
                            <input type="text" class="form-control" aria-describedby="methodd" id="methodd" name="methodd" placeholder="Method" value="{{isset($route->method)?$route->method:old('methodd')}}" required>
                            <small id="methodd" class="form-text text-muted">For Example : GET</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea type="text" class="form-control" aria-describedby="description" id="description" name="description" placeholder="Description" required>{{isset($route->description)?$route->description:old('description')}}</textarea>
                            <small id="description" class="form-text text-muted">Description Of Route</small>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" {{$route->status==1?"checked":""}}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

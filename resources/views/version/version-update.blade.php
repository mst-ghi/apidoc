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
                    <h5 class="card-title">Update Version <b>{{$version->version}}</b> Info</h5>
                    <form action="{{route('versions.update', ['version'=>$version->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="version">Version</label>
                            <input type="text" class="form-control" aria-describedby="version" id="version"
                                   name="version" placeholder="Version" value="{{isset($version->version)?$version->version:old('version')}}" required>
                            <small id="uri" class="form-text text-muted">For Example => 1.0.0</small>
                        </div>
                        <div class="form-group">
                            <label for="explain">Explain</label>
                            <textarea type="text" class="form-control" aria-describedby="explain" id="explain"
                                      name="explain" placeholder="Explain" required>{{isset($version->explain)?$version->explain:old('explain')}}</textarea>
                            <small id="description" class="form-text text-muted">An Explanation Of The Version</small>
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

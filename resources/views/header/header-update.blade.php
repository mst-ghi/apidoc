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
                    <h5 class="card-title">Update <b>{{$header->fields}}</b></h5>
                    <form action="{{route('headers.update', ['header'=>$header->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Field</label>
                            <input type="text" class="form-control" aria-describedby="fields" id="fields" name="fields" placeholder="Field" value="{{isset($header->fields)?$header->fields:old('fields')}}" required>
                            <small id="fields" class="form-text text-muted">For Example => Accept : application/json</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea type="text" class="form-control" aria-describedby="description" id="description" name="description" placeholder="Description" required>{{isset($header->description)?$header->description:old('description')}}</textarea>
                            <small id="description" class="form-text text-muted">Description Of Header</small>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" {{$header->status == 1?"checked":""}}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

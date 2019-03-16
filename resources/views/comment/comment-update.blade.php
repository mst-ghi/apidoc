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
                    <h5 class="card-title">Update <b>{{$comment->title}}</b></h5>
                    <form action="{{route('comments.update', ['comment'=>$comment->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" aria-describedby="title" id="title" name="title" placeholder="Title" value="{{isset($comment->title)?$comment->title:old('title')}}" required>
                            <small id="title" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea type="text" class="form-control" aria-describedby="body" id="body" name="body" placeholder="Body" required>{{isset($comment->body)?$comment->body:old('body')}}</textarea>
                            <small id="body" class="form-text text-muted">Body Of Comment </small>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" {{$comment->status==1?"checked":''}}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

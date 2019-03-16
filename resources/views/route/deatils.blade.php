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
                            <a class="nav-link btn btn-primary mr-1" href="{{route('projects.show.ver',['project'=>$route->folder->version->project_id,'version'=>$route->folder->version->id])}}"><i class="fa fa-arrow-left"></i> Back</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h2><b>{{$route->uri}}</b></h2>
                    <h3><span class="badge badge-info hvr-bounce-in mr-2">{{strtoupper($route->method)}} Method</span> </h3>
                    <h4 class="text-justify">{{$route->description}}</h4>

                    <div class="card-body">
                        <h5 class="card-title">List of <b>Header</b> Parameters <button class="hrr btn btn-sm ml-2 hvr-bounce-in" data-title="Header" data-toggle="modal" data-target="#modalReq"><i class="fa fa-plus"></i></button></h5>
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
                            @foreach($route->headers as $item)
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
                                        <a href="{{route('headers.show', ['header'=>$item->id])}}" class="hvr-pulse"><i class="fa fa-edit text-success" style="font-size: 1.3rem"></i></a>
                                        @if ($item->status == 1)
                                            <a href="{{route('headers.deactive', ['header'=>$item->id])}}" class="hvr-pulse"><i class="fas fa-flag text-info" style="font-size: 1.3rem"></i></a>
                                        @else
                                            <a href="{{route('headers.active', ['header'=>$item->id])}}" class="hvr-pulse"><i class="far fa-flag text-dark" style="font-size: 1.3rem"></i></a>
                                        @endif
                                        <a href="{{route('headers.destroy', ['header'=>$item->id])}}" class="hvr-pulse"
                                           onclick="event.preventDefault(); document.getElementById('delete-form-{{$item->id}}').submit();"
                                        ><i class="fa fa-trash text-danger" style="font-size: 1.3rem"></i></a>
                                        <form id="delete-form-{{$item->id}}" action="{{route('headers.destroy', ['header'=>$item->id])}}" method="POST" style="display: none;">
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

                    <div class="card-body">
                        <h5 class="card-title">List of <b>Request</b> Parameters <button class="hrr btn btn-sm ml-2 hvr-bounce-in" data-title="Request" data-toggle="modal" data-target="#modalReq"><i class="fa fa-plus"></i></button></h5>
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
                            @foreach($route->requests as $item)
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
                                        <a href="{{route('requests.show', ['request'=>$item->id])}}" class="hvr-pulse"><i class="fa fa-edit text-success" style="font-size: 1.3rem"></i></a>
                                        @if ($item->status == 1)
                                            <a href="{{route('requests.deactive', ['request'=>$item->id])}}" class="hvr-pulse"><i class="fas fa-flag text-info" style="font-size: 1.3rem"></i></a>
                                        @else
                                            <a href="{{route('requests.active', ['request'=>$item->id])}}" class="hvr-pulse"><i class="far fa-flag text-dark" style="font-size: 1.3rem"></i></a>
                                        @endif
                                        <a href="{{route('requests.destroy', ['request'=>$item->id])}}" class="hvr-pulse"
                                           onclick="event.preventDefault(); document.getElementById('delete-form-{{$item->id}}').submit();"
                                        ><i class="fa fa-trash text-danger" style="font-size: 1.3rem"></i></a>
                                        <form id="delete-form-{{$item->id}}" action="{{route('requests.destroy', ['request'=>$item->id])}}" method="POST" style="display: none;">
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

                    <div class="card-body">
                        <h5 class="card-title">List of <b>Response</b> Parameters <button class="hrr btn btn-sm ml-2 hvr-bounce-in" data-title="Response" data-toggle="modal" data-target="#modalReq"><i class="fa fa-plus"></i></button></h5>
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
                            @foreach($route->responses as $item)
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

                    <div class="card-body">
                        <h5 class="card-title">List of <b>Comments</b> <button class="btn btn-sm ml-2 hvr-bounce-in" data-toggle="modal" data-target="#commentModal"><i class="fa fa-plus"></i></button></h5>
                        @foreach($route->comments as $item)
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
</div>


<!-- Modal -->
<div class="modal fade" id="modalReq" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add new <b id="req-type"></b> Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-modal" action="" method="post">
                    @csrf
                    <input type="hidden" name="route_id" value="{{$route->id}}" required>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Field</label>
                        <input type="text" class="form-control" aria-describedby="fields" id="fields" name="fields" placeholder="Field" value="{{old('fields')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea type="text" class="form-control" aria-describedby="description" id="description" name="description" placeholder="Description" required>{{old('description')}}</textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="status" name="status">
                        <label class="form-check-label" for="status">Active</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Store</button>
                    </div>
                </form>
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

@section('scripts')
    <script src="{{asset('js/jquery-2.0.1.js')}}"></script>
    <script>
        $(document).on('click', '.hrr', function () {
            $('#req-type').html($(this).data('title'));
            switch ($(this).data('title')) {
                case 'Header':
                    $('#form-modal').attr('action', '{{route('headers.store')}}');
                    break;
                case 'Request':
                    $('#form-modal').attr('action', '{{route('requests.store')}}');
                    break;
                case "Response":
                    $('#form-modal').attr('action', '{{route('responses.store')}}');
                    break;
            }
            $('#modalReq').modal('show');
        });

    </script>
@stop

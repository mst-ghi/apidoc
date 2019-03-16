@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/treeview.css')}}">

@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary mr-1" href="{{route('projects.index')}}"><i
                                        class="fa fa-arrow-left"></i> Back</a>
                            </li>
                            <li class="nav-item ml-3">
                                <form class="form-inline" action="{{route('versions.show.select')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="ver_pro_id" value="{{$project->id}}">
                                    <div class="input-group">
                                        @if ($project->versions->isNotEmpty())
                                            <select name="ver_id_select" class="custom-select" id="inputGroupSelect04"
                                                    aria-label="Example select with button addon">
                                                @foreach($project->versions as $version)
                                                    @if ($version->id == $versio->id)
                                                        <option value="{{$version->id}}" selected>{{$version->version}}</option>
                                                    @else
                                                        <option value="{{$version->id}}">{{$version->version}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif
                                        <div class="input-group-append">
                                            @if ($project->versions->isNotEmpty())
                                                <button class="btn btn-outline-secondary" type="submit"><i
                                                        class="fa fa-check"></i> Select Version
                                                </button>
                                                <a href="{{route('versions.index.pro', ['project'=>$project->id])}}"
                                                   class="btn btn-outline-secondary"><i class="fa fa-list"></i> List Of
                                                    Version</a>
                                            @endif
                                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                                    data-target="#versionModal"><i class="fa fa-plus"></i> Add New Version
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tree well">
                            <button class="btn btn-outline-secondary folder" data-toggle="modal" data-id="" data-title="Add New Root Folder"
                                    data-target="#folderModal"><i class="fa fa-plus"></i> Add Root Folder</button>
                            @if (isset($versio))
                            <a href="{{route('routes.index.ver', ['version'=>$versio->id])}}" class="btn btn-outline-secondary"><i class="fa fa-list"></i> list Of All Route</a>
                            <ul>
                                {{createTree($versio->id)}}
                            </ul>
                            @endif

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Route Modal -->
    <div class="modal fade" id="routeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="route-modal-title">Add New Route</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('routes.store')}}" method="post">
                        @csrf
                        <input type="hidden" id="folder_id" name="folder_id" value="" required>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Uri</label>
                            <input type="text" class="form-control" aria-describedby="uri" id="uri" name="uri"
                                   placeholder="Uri" value="{{old('uri')}}" required>
                            <small id="uri" class="form-text text-muted">For Example => /user</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Method</label>
                            <input type="text" class="form-control" aria-describedby="methodd" id="methodd"
                                   name="methodd" placeholder="Method" value="{{old('methodd')}}" required>
                            <small id="methodd" class="form-text text-muted">For Example => GET</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea type="text" class="form-control" aria-describedby="description" id="description"
                                      name="description" placeholder="Description"
                                      required>{{old('description')}}</textarea>
                            <small id="description" class="form-text text-muted">A Description Of The Route</small>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status">
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Store Route</button>
                        </div>
                    </form>
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


    <!-- Version Modal -->
    <div class="modal fade" id="folderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="folder-title-modal">Add New Root Folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('folders.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="version_id" value="{{$versio->id}}" required>
                        <input type="hidden" id="parent_id" name="parent_id" value="">
                        <div class="form-group">
                            <label for="version">Title</label>
                            <input type="text" class="form-control" aria-describedby="title" id="title"
                                   name="title" placeholder="Title" value="{{old('version')}}" required>
                            <small id="uri" class="form-text text-muted">For Example => User</small>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Store Folder</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/jquery-2.0.1.js')}}"></script>
    <script src="{{asset('js/treeview.js')}}"></script>
    <script>
        $(document).on('click', '.folder', function () {
            $('#parent_id').val($(this).data('id'));
            $('#folder-title-modal').text($(this).data('title'));
            $('#folderModal').modal('show');
        });
        $(document).on('click', '.route', function () {
            $('#folder_id').val($(this).data('id'));
            $('#route-modal-title').text($(this).data('title'));
            $('#routeModal').modal('show');
        });
    </script>
@stop

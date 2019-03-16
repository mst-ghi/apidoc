@extends('layouts.app')

@section('styles')
    <style>
        td a {
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
                                <a class="nav-link btn btn-primary" href="{{route('projects.show.ver', ['project'=>$version->project_id, 'version'=>$version->id])}}"><i class="fa fa-arrow-left"></i> Back</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-secondary ml-2" href="{{route('projects.reportRoute', ['project'=>$version->project_id, 'version'=>$version->id])}}"><i class="fa fa-eye"></i> Preview Export</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">List Routes</h5>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="20%">Uri</th>
                                <th scope="col" width="10%">Method</th>
                                <th scope="col" width="35%">Description</th>
                                <th scope="col" width="5%">Status</th>
                                <th scope="col" width="25%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $row = 1; ?>
                            @foreach($routes as $item)
                                <tr>
                                    <th scope="row">{{$row}}</th>
                                    <td><span class="badge badge-secondary hvr-bounce-in"
                                              style="font-size: .9rem">{{$item->uri}}</span></td>
                                    <td><span class="badge badge-info hvr-bounce-in"
                                              style="font-size: .9rem">{{strtoupper($item->method)}}</span></td>
                                    <td><p class="text-justify">{{$item->description}}</p></td>
                                    @if ($item->status == 1)
                                        <td><span class="badge badge-success hvr-bounce-in" style="font-size: .9rem">Active</span>
                                        </td>
                                    @else
                                        <td><span class="badge badge-danger hvr-bounce-in" style="font-size: .9rem">Inactive</span>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{route('routes.show', ['route'=>$item->id])}}" class="hvr-pulse"><i
                                                class="fa fa-edit text-success" style="font-size: 1.3rem"></i></a>
                                        <a href="{{route('headers.index.route', ['route'=>$item->id])}}"
                                           class="hvr-pulse"><i class="fa fa-heading text-secondary"
                                                                style="font-size: 1.3rem"></i></a>
                                        <a href="{{route('requests.index.route', ['route'=>$item->id])}}"
                                           class="hvr-pulse"><i class="fa fa-arrow-alt-circle-right text-secondary"
                                                                style="font-size: 1.3rem"></i></a>
                                        <a href="{{route('responses.index.route', ['route'=>$item->id])}}"
                                           class="hvr-pulse"><i class="fa fa-arrow-alt-circle-left text-secondary"
                                                                style="font-size: 1.3rem"></i></a>
                                        <a href="{{route('comments.index.route', ['route'=>$item->id])}}"
                                           class="hvr-pulse"><i class="fa fa-comment text-primary"
                                                                style="font-size: 1.3rem"></i></a>
                                        @if ($item->status == 1)
                                            <a href="{{route('routes.deactive', ['route'=>$item->id])}}"
                                               class="hvr-pulse"><i class="fas fa-flag text-info"
                                                                    style="font-size: 1.3rem"></i></a>
                                        @else
                                            <a href="{{route('routes.active', ['route'=>$item->id])}}"
                                               class="hvr-pulse"><i class="far fa-flag text-dark"
                                                                    style="font-size: 1.3rem"></i></a>
                                        @endif
                                        <a href="{{route('routes.destroy', ['route'=>$item->id])}}" class="hvr-pulse"
                                           onclick="event.preventDefault(); document.getElementById('delete-form-{{$item->id}}').submit();"
                                        ><i class="fa fa-trash text-danger" style="font-size: 1.3rem"></i></a>
                                        <form id="delete-form-{{$item->id}}"
                                              action="{{route('routes.destroy', ['route'=>$item->id])}}" method="POST"
                                              style="display: none;">
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

@endsection

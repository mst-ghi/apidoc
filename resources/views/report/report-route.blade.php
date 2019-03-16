@extends('layouts.app')

@section('styles')
    <style>
        tr th{
            font-size: 14px !important;
            text-align: left !important;
        }
        tr td{
            font-size: 14px !important;
            text-align: left !important;
        }
        tr td p{
            font-size: 12px !important;
            text-align: left !important;
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
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary ml-2" href="{{route('projects.downloadPdfRoute', ['project'=>$ver->project_id, 'version'=>$ver->id])}}"><i class="fa fa-file"></i> Export Pdf</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="5px" scope="col">Method</th>
                            <th width="20px" scope="col">Route</th>
                            <th width="25px" scope="col">Header</th>
                            <th width="25px" scope="col">Request</th>
                            <th width="25px" scope="col">Response</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($routes as $item)
                            <tr>
                                <td><span class="badge badge-secondary" style="font-size: small">{{ strtoupper($item->method) }}</span></td>
                                <td><b>{{ $item->uri }}</b></td>
                                <td>
                                    @foreach ($item->headers as $header)
                                        <b>{{$header->fields}}</b><br>
                                        <p>"{{$header->description}}"</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($item->requests as $request)
                                        <b>{{$request->fields}}</b><br>
                                        <p>"{{$request->description}}"</p>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($item->responses as $response)
                                        <b>{{$response->fields}}</b><br>
                                        <p>"{{$request->description}}"</p>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

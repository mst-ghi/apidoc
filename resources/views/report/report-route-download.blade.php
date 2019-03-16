<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" media="all"
          rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        tr th{
            font-size: 8px !important;
            text-align: left !important;
        }
        tr td{
            font-size: 8px !important;
            text-align: left !important;
        }
        tr td p{
            font-size: 6px !important;
            text-align: left !important;
        }
    </style>
</head>
<body>
<h5 style="text-align: center">Route List</h5>
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
            <td><span class="badge badge-secondary" style="font-size: xx-small">{{ strtoupper($item->method) }}</span></td>
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
</body>
</html>

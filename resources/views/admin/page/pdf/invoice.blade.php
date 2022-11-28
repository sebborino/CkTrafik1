<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ahmad</title>

    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <style>
        body{
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .header{
            width:100%;
            font-weight: bolder;
            text-align: center;
            font-size: 24px;
        }

        .page-break {
        page-break-after: always;
}

    </style>
</head>
<body>
    @php
        ini_set('max_execution_time', 300);     
        $count = count($rows) -1;
    @endphp
    <h1 class="header">CK Trafik 1 Aps</h1>
    @for($x = 0; $x <= $count; $x++)
    <div class="row">

        <div class="col-12">
            {{ $rows[$x][4] }}
        </div>
        <div class="page-break"></div>
    @endfor
    </div>
 
      
</body>
</html>